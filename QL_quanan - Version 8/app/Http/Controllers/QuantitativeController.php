<?php

namespace App\Http\Controllers;

use App\Models\Detailsquantitative;
use App\Models\Ingredient;
use App\Models\Product;
use App\Models\Quantitative;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class QuantitativeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quantitative = Quantitative::all();
        return view('admin.quantitative.all_quantitative', compact('quantitative'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ingredient = Ingredient::all();
        $product = Product::all();
        return view('admin.quantitative.add_quantitative', compact('ingredient', 'product'));
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'sp_id' => 'required',
            'dl_dvt' => 'required',
            'dl_trangthai' => 'required',

        ], [
            'sp_id.required' => 'Món ăn không được để trống',
            'dl_dvt.required' => 'Đơn vị tính / thành phẩm không được để trống',
            'dl_trangthai.required' => 'Trạng thái không được để trống',
        ]);

        $bien = 0;
        for ($nl_id = 0; $nl_id < count($request->nl_id); $nl_id++) {
            if (isset($request->quantity[$nl_id])) {
                $bien = 1;
            } else {
                Toastr::warning('Hãy nhập đầy đủ thông tin nguyên liệu', 'Thông báo');
                return redirect()->back();
            }
        }

        $quantitative = new Quantitative();
        $quantitative->ma_id = $request->sp_id;
        $quantitative->dl_dvt = $request->dl_dvt;
        $quantitative->dl_trangthai = $request->dl_trangthai;
        $quantitative->save();

        for ($nl_id = 0; $nl_id < count($request->nl_id); $nl_id++) {
            $detailquantitative = new Detailsquantitative();
            $detailquantitative->dl_id = $quantitative->dl_id;
            $detailquantitative->nl_id = $request->nl_id[$nl_id];
            // $detailquantitative->dl_dvt = $request->unit[$nl_id];
            $detailquantitative->ctdl_sl = $request->quantity[$nl_id];
            $detailquantitative->save();
        }
        Toastr::success('Thêm định lương thành công', 'Thông báo');
        return Redirect::to('/quantitative');
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
        $quantitative = Quantitative::find($id);
        $ingredient = Ingredient::all();
        return view('admin.quantitative.edit_quantitative', compact('quantitative', 'ingredient'));
   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $quantitative = Quantitative::find($id);
        $quantitative->dl_dvt = $request->dl_dvt;
        $quantitative->dl_trangthai = $request->dl_trangthai;
        $quantitative->update();

        $detailquantitative = Detailsquantitative::where('dl_id', $id);
        $detailquantitative->delete();

        for ($nl_id = 0; $nl_id < count($request->nl_id); $nl_id++) {
            $detailquantitative = new Detailsquantitative();
            $detailquantitative->dl_id = $quantitative->dl_id;
            $detailquantitative->nl_id = $request->nl_id[$nl_id];
            // $detailquantitative->dl_dvt = $request->unit[$nl_id];
            $detailquantitative->ctdl_sl = $request->quantity[$nl_id];
            $detailquantitative->save();
        }
        Toastr::success('Cập nhật định lương thành công', 'Thông báo');
        return Redirect::to('/quantitative');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $quantitative = Quantitative::find($id);
       
        $quantitative->delete();
        Toastr::success('Xóa định lương thành công', 'Thông báo');
        return Redirect::to('/quantitative');
    }
    public function get_quantitative()
    {
        $quantitative = Quantitative::all();

        return DataTables::of($quantitative)
            ->addIndexColumn()
            ->addColumn('ma_ha', function ($quantitative) {
                return ' <img src="public/upload/product/' . $quantitative->product->ma_hinhanh . '" width="100" height="100">';
            })
            ->addColumn('ma_ten', function ($quantitative) {
                return $quantitative->product->ma_ten;
            })
            ->addColumn('active', function ($quantitative) {
                if ($quantitative->dl_trangthai == 0) {
                    return ' <a href="' . route('active_quantitative', $quantitative->dl_id) . '"><i class="fa fa-toggle-off" aria-hidden="true" 
                    style="font-size: 18pt;color: red"></i></a>';
                } else {
                    return '  <a href="' . route('unactive_quantitative', $quantitative->dl_id) . '"><i class="fa fa-toggle-on" aria-hidden="true"
                    style="font-size: 18pt;color: green"></i></a>';
                }
            })
            ->addColumn('action', function ($quantitative) {
                return '
                <div style="display:flex;">     
                <a href="' . route('quantitative.edit', $quantitative->dl_id) . '" class="mt-1">
                    <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i></a>
                    &nbsp|
                    <form action="' . route('quantitative.destroy', [$quantitative->dl_id]) . '" method="POST" >                      
                    ' . csrf_field() . '
                    ' . method_field('delete') . '
                        <button class="btn btn-sm " onclick="return myFunction();"> <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i></button>
                        </form>
                </div> ';
            })
            ->rawColumns(['active', 'ma_ha', 'ma_ten', 'action'])
            ->make(true);
    }
    public function active_quantitative($quantitative_id)
    {
        $quantitative = Quantitative::find($quantitative_id);
        $quantitative->dl_trangthai = 1;
        $quantitative->update();
        Toastr::success('Kích hoạt định lương thành công', 'Thông báo');
        return Redirect::to('/quantitative');
    }
    public function unactive_quantitative($quantitative_id)
    {
        $quantitative = Quantitative::find($quantitative_id);
        $quantitative->dl_trangthai = 0;
        $quantitative->update();
        Toastr::success('Không kích hoạt định lương thành công', 'Thông báo');
        return Redirect::to('/quantitative');
    }
}
