<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_cate = DB::table('danhmuc')->get();
        $manager_cate = view('admin.cate.all_cate')->with('all_cate', $all_cate);
        return view('layout')->with('admin.cate.all_cate', $manager_cate);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cate.add_cate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'cate_name' => 'required|max:255',
            'cate_desc' => 'required|max:255',
            'cate_status' => 'required',

        ]);

        $data = array();
        $data['danhmuc_ten'] = $request->cate_name;
        $data['danhmuc_mota'] = $request->cate_desc;
        $data['danhmuc_tinhtrang'] = $request->cate_status;
        $data['created_at'] = Carbon::now();
        DB::table('danhmuc')->insert($data);
        Toastr::success('Thêm danh mục thành công !', 'Thông báo');
        return Redirect::to('/category');
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
        $edit_category = DB::table('danhmuc')->where('danhmuc_id', $id)->get();
        $manager_category = view('admin.cate.edit_cate')->with('edit_category', $edit_category);
        return view('layout')->with('admin.cate.edit_cate', $manager_category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = array();
        $data['danhmuc_ten'] = $request->cate_name;
        $data['danhmuc_mota'] = $request->cate_desc;
        $data['danhmuc_tinhtrang'] = $request->cate_status;
        $data['updated_at'] = Carbon::now();
        DB::table('danhmuc')->where('danhmuc_id', $id)->update($data);
        //Session::put('mess', 'Cập nhật danh mục sản phẩm thành công');
        Toastr::success('Cập nhật danh mục sản phẩm thành công','Thông báo');
        return Redirect::to('/category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('danhmuc')->where('danhmuc_id', $id)->delete();
        Toastr::success('Xóa danh mục sản phẩm thành công', 'Thông báo');
        return Redirect::to('/category');
    }

    public function get_all_category()
    {

        $category = Category::orderby('danhmuc_id', 'ASC')->get();
        return DataTables::of($category)
            ->addIndexColumn()
            ->addColumn('active', function ($category) {
                if ($category->danhmuc_tinhtrang == 0) {
                    return ' <a href="' . route('active_category', $category->danhmuc_id) . '"><i class="fa fa-toggle-off" aria-hidden="true" 
                    style="font-size: 18pt;color: red"></i></a>';
                } else {
                    return '  <a  href="' . route('unactive_category', $category->danhmuc_id) . '"><i class="fa fa-toggle-on" aria-hidden="true"
                    style="font-size: 18pt;color: green"></i></a>';
                }
            })
            ->addColumn('action', function ($category) {
                return '
                    <div style="display:flex;"> 
                        <a href="' . route('category.edit', $category->danhmuc_id) . '" class="mt-1">
                            <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i></a>
                            &nbsp|
                        <form action="' . route('category.destroy', [$category->danhmuc_id]) . '" method="POST" >                      
                    ' . csrf_field() . '
                    ' . method_field('delete') . '
                        <button class="btn btn-sm " onclick="return myFunction();"> <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i></button>
                        </form>
                    </div>';
            })
            ->rawColumns(['active', 'action'])
            ->make(true);
    }
    public function active_category($category_id)
    {
        DB::table('danhmuc')->where('danhmuc_id', $category_id)->update(['danhmuc_tinhtrang' => 1]);
        Toastr::success('Kích hoạt danh mục sản phẩm thành công','Thông báo');
        return Redirect::to('/category');
    }
    public function unactive_category($category_id)
    {
        DB::table('danhmuc')->where('danhmuc_id', $category_id)->update(['danhmuc_tinhtrang' => 0]);
        Toastr::success('Không kích hoạt danh mục sản phẩm thành công','Thông báo');
        return Redirect::to('/category');
    }
}
