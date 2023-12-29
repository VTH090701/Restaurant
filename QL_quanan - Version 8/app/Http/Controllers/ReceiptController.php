<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Receipt;
use App\Models\Detailsreceipt;
use App\Models\Detailsshift;
use App\Models\Order;
use App\Models\Statictical;
use Illuminate\Support\Arr;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;
use App\Models\Ingredient;
use PDF;

class ReceiptController extends Controller
{


    public function all_receipt()
    {
        $receipt = Receipt::all();
        return view('admin.receipt.all_receipt', compact('receipt'));
    }

    public function get_all_receipt(Request $request)
    {


        if ($request->start_date3 && $request->end_date3) {
            $receipt = Receipt::whereDate('pnh_ngaylapphieu', '>=', $request->start_date3)->whereDate('pnh_ngaylapphieu', '<=', $request->end_date3)->orderBy('pnh_ngaylapphieu','DESC');

        } else {
            $receipt = Receipt::select('*')->orderBy('pnh_ngaylapphieu','DESC');

        }

        return DataTables::of($receipt)
            ->addIndexColumn()
           
            ->addColumn('ten_nv', function ($receipt) {
                return $receipt->admins->nv_ten;
            })

            ->addColumn('thanhtien', function ($receipt) {
                return  number_format($receipt->pnh_thanhtien) . ' ' . 'VNĐ';
            })
           
            ->addColumn('action', function ($receipt) {
                return '
                    <a href="' . route('details_receipt', $receipt->pnh_id) . '">
                    <i class="fa fa-eye" aria-hidden="true" style="color:rgb(240, 111, 6); "></i></a>
                    |
                    
                    <a href="' . route('print_receipt', $receipt->pnh_id) . '">
                    <i class="fa fa-print" aria-hidden="true" style="color: orange;"></i>
                    </a>
                    ';
            })
         
            ->rawColumns(['ten_nv', 'thanhtien', 'action'])
            ->make(true);
    }
   
  
    
  

    public function details_receipt($receipt_id)
    {

        $receipt = Receipt::find($receipt_id);
        return view('admin.receipt.details_receipt', compact('receipt'));
    }
  
    

    public function print_receipt($receipt_id)
    {

        if (Receipt::find($receipt_id)) {
            $receipt = Receipt::find($receipt_id);
            $data = [
                'receipt' => $receipt,
            ];
            $pdf = PDF::loadView('admin.pos.invoice2', $data);
            return $pdf->download('phieunhap.pdf');
        }
        return redirect('/all-receipt');
    }

    public function get_input_receipt()
    {
        $supplier = Supplier::all();
        $ingredient = Ingredient::where('nl_tinhtrang', 1)->get();
        return view('admin.receipt.get_input_receipt', compact('supplier', 'ingredient'));
    
    }
    public function post_input_receipt(Request $request)
    {
        $this->validate($request, [
            'nl_id' => 'required',
            'time' => 'required',
            'desc' => 'required',

        ], [
            'desc.required' => 'Ghi chú không được để trống',
            'time.required' => 'Thời gian nhập không được để trống',
        ]);


        $bien = 0;
        for ($nl_id = 0; $nl_id < count($request->nl_id); $nl_id++) {
            if (
                isset($request->ncc_id[$nl_id])   && isset($request->nl_id[$nl_id])
                && isset($request->quantity[$nl_id]) && isset($request->price[$nl_id])
            ) {
                $bien = 1;
            }else{
                Toastr::warning('Hãy nhập đầy đủ thông tin nguyên liệu', 'Thông báo');
                return Redirect::to('/input-receipt');
            }
        }

        if($bien == 1){
            $total = 0;
            for ($nl_id = 0; $nl_id < count($request->nl_id); $nl_id++) {
                $total += $request->quantity[$nl_id] * $request->price[$nl_id];
            }
            $receipt_date = Carbon::parse($request->time);
            $statistic = Statictical::whereDate('thongke_ngay', $receipt_date->format('Y-m-d'))->get();
            if ($statistic) {
                $statistic_count = $statistic->count();
            } else {
                $statistic_count = 0;
            }
    
            if ($statistic_count > 0) {
                $statistic_update = Statictical::whereDate('thongke_ngay', $receipt_date->format('Y-m-d'))->first();
                $statistic_update->thongke_cp += $total;
                $statistic_update->update();
            } else {
                $statistic_new = new Statictical();
                $statistic_new->thongke_ngay = $request->time;
                $statistic_new->thongke_dt = 0;
                $statistic_new->thongke_sl =  0;
                $statistic_new->thongke_thd =  0;
                $statistic_new->thongke_cp =  $total;
                $statistic_new->save();
            }
    
            //Lưu phiếu nhập hàng
            $receipt = new Receipt([
                'nv_id' => Auth::id(),
                'pnh_ngaylapphieu' => $request->time,
                'pnh_thanhtien' => $total,
                'pnh_ghichu' => $request->desc,
            ]);
            $receipt->save();
            //Lưu chi tiết phiếu nhập
            for ($nl_id = 0; $nl_id < count($request->nl_id); $nl_id++) {
                $detailsreceipt = new Detailsreceipt();
                $detailsreceipt->pnh_id =  $receipt->pnh_id;
                $detailsreceipt->ncc_id  =  $request->ncc_id[$nl_id];
                $detailsreceipt->nl_id  =  $request->nl_id[$nl_id];
                $detailsreceipt->ctnh_soluong  =  $request->quantity[$nl_id];
                $detailsreceipt->ctnh_dongia  =  $request->price[$nl_id];
                $detailsreceipt->save();
            }
            // Cập nhật số lượng nguyên liệu trong kho
            $ingredient = Ingredient::all();
            foreach ($receipt->receiptdetails as $key => $item) {
                foreach ($ingredient as $ing)
                    if ($ing->nl_id == $item->nl_id) {
                        $ing->nl_slcl += $item->ctnh_soluong;
                        $ing->update();
                    }
            }
    
    
            Toastr::success('Thêm phiếu nhập thành công', 'Thông báo');
            return Redirect::to('/all-receipt');
        }
     
    }
  
   
    
}
