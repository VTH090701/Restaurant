<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupon = Coupon::all();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        return view('admin.coupon.all_coupon', compact('coupon', 'today'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupon.add_coupon');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'coupon_name' => 'required',
            'coupon_code' => 'required',
            'coupon_qty' => 'required|integer',
            'coupon_condition' => 'required',
            'coupon_number' => 'required|integer',
            'date_start' => 'required',
            'date_end' => 'required',

        ],[
            'coupon_name.required' => 'Tên giảm giá không được để trống',
            'coupon_code.required' => 'Mã giảm giá không được để trống',
            'coupon_qty.required' => 'Số lượng mã giảm không được để trống',
            'coupon_condition.required' => 'Tính năng không được để trống',
            'coupon_number.required' => 'Số tiền hoặc % giảm không được để trống',
            'date_start.required' => 'Ngày bắt đầu không được để trống',
            'date_end.required' => 'Ngày kết thúc không được để trống',
            'coupon_qty.integer' => 'Số lượng mã giảm phải là số nguyên',
            'coupon_number.integer' => 'Số lượng mã giảm phải là số nguyên',

        ]);
        
        $coupon = new Coupon([
            'gg_ten' => $request->coupon_name,
            'gg_magiam' => $request->coupon_code,
            'gg_soluong' => $request->coupon_qty,
            'gg_tinhnang' => $request->coupon_condition,
            'gg_stg' => $request->coupon_number,
            'gg_ngaybd' => $request->date_start,
            'gg_ngaykt' => $request->date_end,

        ]);
        $coupon->save();
        Toastr::success('Thêm giảm giá thành công !', 'Thông báo');
        return Redirect::to('/coupon');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::find($id);
        return view('admin.coupon.edit_coupon', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $coupon = Coupon::find($id);
        $coupon->gg_ten = $request->coupon_name;
        $coupon->gg_magiam = $request->coupon_code;
        $coupon->gg_soluong = $request->coupon_qty;
        $coupon->gg_tinhnang = $request->coupon_condition;
        $coupon->gg_stg = $request->coupon_number;

        $coupon->gg_ngaybd = $request->date_start;
        $coupon->gg_ngaykt = $request->date_end;

        $coupon->update();
        Toastr::success('Cập nhật giảm giá thành công !', 'Thông báo');
        return redirect('/coupon');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        Toastr::success('Xóa giảm giá thành công !', 'Thông báo');
        return redirect('/coupon');
    }
    public function get_coupon(Request $request )
    {
        $coupon = Coupon::all();
        //$today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        if ($request->start_date5 && $request->end_date5) {
            $coupon = Coupon::whereDate('gg_ngaybd', '>=', $request->start_date5)
                ->whereDate('gg_ngaybd', '<=', $request->end_date5)->get();
        } else {
            $coupon = Coupon::all();
        }
        return DataTables::of($coupon )
            ->addIndexColumn()
            ->addColumn('stg', function ($coupon) {
                if ($coupon->gg_tinhnang == 1) {
                    return  number_format($coupon->gg_stg) . ' ' . 'VNĐ';
                } else {
                    return  $coupon->gg_stg.'%';
                }
            })
            ->addColumn('tinhnang', function ($coupon) {
                if ($coupon->gg_tinhnang == 1) {
                    return 'Giảm theo tiền';
                } else {
                    return 'Giảm theo phần trăm';
                }
            })
            ->addColumn('status', function ($coupon) {
                if ($coupon->gg_ngaykt >Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d')){
                    return '<td><span class="badge badge-success">Khả dụng</span>
                    </td>';
                }else{
                    return '<td><span class="badge badge-danger">Đã Hết</span>
                    </td>';
                }
            })
            ->addColumn('action', function ($coupon) {
                return '
                <div style="display:flex;"> 

                <a href="' . route('coupon.edit', $coupon->gg_id) . '" class="mt-1">
                    <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i></a>
                    &nbsp|
                    <form action="' . route('coupon.destroy', [$coupon->gg_id]) . '" method="POST" >                      
                    ' . csrf_field() . '
                    ' . method_field('delete') . '
                        <button class="btn btn-sm " onclick="return myFunction();" > <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i></button>
                        </form>
                </div> ';
            })
            ->rawColumns(['tinhnang','stg', 'status', 'action'])
            ->make(true);
    }
    public function check_coupon($coupon_id)
    {

        $coupon = Coupon::find($coupon_id);
        $coupon_session = Session::get('coupon');

        if ($coupon_session) {
            $cou[] = array(
                'coupon_id' => $coupon->gg_id,
                'coupon_condition' => $coupon->gg_tinhnang,
                'coupon_number' => $coupon->gg_stg,

            );
            Session::put('coupon', $cou);
        } else {
            $cou[] = array(
                'coupon_id' => $coupon->gg_id,
                'coupon_condition' => $coupon->gg_tinhnang,
                'coupon_number' => $coupon->gg_stg,

            );
            Session::put('coupon', $cou);
        }

        Toastr::success('Thêm giảm giá thành công !', 'Thông báo');
        return redirect()->back();
    }
    public function delete_coupon_checkout()
    {
        Session::forget('coupon');
        Toastr::success('Xóa giảm giá thành công !', 'Thông báo');
        return redirect()->back();
    }
}
