<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;
use Brian2694\Toastr\Facades\Toastr;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_product = DB::table('monan')->join('danhmuc', 'danhmuc.danhmuc_id', '=', 'monan.danhmuc_id')->orderby('monan.ma_id', 'desc')->get();
        $manager_product = view('admin.product.all_pro')->with('all_product', $all_product);
        return view('layout')->with('admin.product.all_pro', $manager_product);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cate = DB::table('danhmuc')->orderby('danhmuc_id', 'desc')->get();
        return view('admin.product.add_pro')->with('cate', $cate);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'pro_name' => 'required|max:255',
            'pro_price' => 'required|integer',
            'pro_desc' => 'required|max:255',
            'pro_content' => 'required|max:255',
            'pro_cate' => 'required',
            'pro_status' => 'required',
            'pro_img' => 'required',
        ],[
            'pro_price.required' => 'Giá món ăn không được để trống',
            'pro_price.integer' => 'Giá món ăn phải là số nguyên',
        
        ]);
        $data = array();
        $data['ma_ten'] = $request->pro_name;
        $data['ma_gia'] = $request->pro_price;
        $data['ma_mota'] = $request->pro_desc;
        $data['ma_noidung'] = $request->pro_content;
        $data['danhmuc_id'] = $request->pro_cate;
        $data['ma_tinhtrang'] = $request->pro_status;

        $get_image = $request->file('pro_img');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));

            $new_image = $get_name_image;
            $get_image->move('public/upload/product', $new_image);
            $data['ma_hinhanh'] = $new_image;
            DB::table('monan')->insert($data);
            Toastr::success('Thêm sản phẩm thành công', 'Thông báo');
            return Redirect::to('/product');
        }
        $data['ma_hinhanh'] = '';
        DB::table('monan')->insert($data);
        Toastr::success('Thêm sản phẩm thành công', 'Thông báo');

        return Redirect::to('/product');
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
        $cate_product = DB::table('danhmuc')->orderby('danhmuc_id', 'desc')->get();
        $edit_product = DB::table('monan')->where('ma_id', $id)->get();
        $manager_product = view('admin.product.edit_pro')->with('edit_product', $edit_product)->with('cate_product', $cate_product);
        return view('layout')->with('admin.product.edit_pro', $manager_product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = array();
        $data['ma_ten'] = $request->pro_name;
        $data['ma_gia'] = $request->pro_price;
        $data['ma_mota'] = $request->pro_desc;
        $data['ma_noidung'] = $request->pro_content;
        $data['danhmuc_id'] = $request->pro_cate;
        $data['ma_tinhtrang'] = $request->pro_status;


        $get_image = $request->file('pro_img');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $get_name_image;
            $get_image->move('public/upload/product', $new_image);
            $data['ma_hinhanh'] = $new_image;
            DB::table('monan')->where('ma_id', $id)->update($data);
            Session::put('mess', 'Cập nhật sản phẩm thành công');
            return Redirect::to('/product');
        }
        DB::table('monan')->where('ma_id', $id)->update($data);
        Toastr::success('Cập nhật sản phẩm thành công', 'Thông báo');
        return Redirect::to('/product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        Toastr::success('Xóa sản phẩm thành công', 'Thông báo');
        return Redirect::to('/product');
    }
    public function get_all_product()
    {
        $product = DB::table('monan')
            ->join('danhmuc', 'danhmuc.danhmuc_id', '=', 'monan.danhmuc_id')
            ->get();
        return DataTables::of($product)
            ->addIndexColumn()
            ->addColumn('sp_price', function ($product) {
                return number_format($product->ma_gia) . ' ' . 'VNĐ';
            })
            ->addColumn('image', function ($product) {
                return ' <img src="public/upload/product/' . $product->ma_hinhanh . '" width="100" height="100">';
            })
            ->addColumn('gallery', function ($product) {
                return '<a href="' . route('add_gallery', $product->ma_id) . '">Thư viện ảnh</a>';
            })
            ->addColumn('active', function ($product) {
                if ($product->ma_tinhtrang == 0) {
                    return ' <a href="' . route('active_product', $product->ma_id) . '"><i class="fa fa-toggle-off" aria-hidden="true" 
                    style="font-size: 18pt;color: red"></i></a>';
                } else {
                    return '  <a href="' . route('unactive_product', $product->ma_id) . '"><i class="fa fa-toggle-on" aria-hidden="true" 
                    style="font-size: 18pt;color: green"></i></a>';
                }
            })
            ->addColumn('action', function ($product) {
                return '
                <div style="display:flex;"> 
                    <a href="' . route('product.edit', $product->ma_id) . '" class="mt-1">
                    <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i></a>
                    &nbsp|
                    <form action="' . route('product.destroy', [$product->ma_id]) . '" method="POST" >                      
                    ' . csrf_field() . '
                    ' . method_field('delete') . '
                        <button class="btn btn-sm " onclick="return myFunction();"> <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i></button>
                    </form>
                </div>';
            })
            ->rawColumns(['sp_price', 'image', 'active', 'action', 'gallery'])
            ->make(true);
    }

    public function active_product($product_id)
    {
        DB::table('monan')->where('ma_id', $product_id)->update(['ma_tinhtrang' => 1]);
        Toastr::success('Kích hoạt sản phẩm thành công', 'Thông báo');
        return Redirect::to('/product');
    }
    public function unactive_product($product_id)
    {
        DB::table('monan')->where('ma_id', $product_id)->update(['ma_tinhtrang' => 0]);
        Toastr::success('Không kích hoạt sản phẩm thành công', 'Thông báo');
        return Redirect::to('/product');
    }
}
