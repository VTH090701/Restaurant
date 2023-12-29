<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;
use Brian2694\Toastr\Facades\Toastr;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_tab = DB::table('ban')->get();
        $manager_tab = view('admin.table.all_table')->with('all_tab',$all_tab);
        return view('layout')->with('admin.table.all_table',$manager_tab);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.table.add_table');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'tab_name' => 'required|max:255',
            'tab_qty' => 'required|integer|max:255',
        
        ],[
            'tab_qty.required' => 'Số lượng người trong bàn không được để trống',
            'tab_qty.integer' => 'Số lượng người trong bàn phải là số nguyên',

        ]);
        $data = array();
        $data['ban_ten']=$request->tab_name;
        $data['ban_slnguoi']=$request->tab_qty;
        $data['ban_tinhtrang']=0;
        $data['ban_dat']= 0;
        $data['created_at'] = Carbon::now();
        DB::table('ban')->insert($data);
        Toastr::success('Thêm bàn thành công','Thông báo');
        return Redirect::to('/table');
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
        $edit_table=DB::table('ban')->where('ban_id',$id)->get();
        $manager_table= view('admin.table.edit_table')->with('edit_table', $edit_table);
        return view('layout')->with('admin.table.edit_table',$manager_table);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data= array();
        $data['ban_ten']= $request->tab_name; 
        $data['ban_slnguoi']=$request->tab_qty;
        $data['updated_at'] = Carbon::now(); 
        DB::table('ban')->where('ban_id',$id )->update($data);
        Toastr::success('Cập nhật bàn sản phẩm thành công','Thông báo');
        return Redirect::to('/table');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('ban')->where('ban_id',$id )->delete();   
        Toastr::success('Xóa bàn sản phẩm thành công','Thông báo');
        return Redirect::to('/table');
    }
    public function get_all_table(){
        $table = Table::orderby('ban_id', 'ASC')->get();

        return DataTables::of($table)
            ->addIndexColumn()
            ->addColumn('status', function ($table) {
                if($table->ban_tinhtrang == 0){
                    return 'Chưa hoạt động';
                }else{
                    return 'Đang hoạt động';
                }
                
            })
            ->addColumn('action', function ($table) {
                return '
                <div style="display:flex;"> 
                <a href="' . route('table.edit', $table->ban_id) . '" class="mt-1">
                    <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i></a>
                    &nbsp|
                    <form action="' . route('table.destroy', [$table->ban_id]) . '" method="POST" >                      
                    ' . csrf_field() . '
                    ' . method_field('delete') . '
                        <button class="btn btn-sm " onclick="return myFunction();"> <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i></button>
                        </form>
                </div>  ';
            })
            ->rawColumns(['active','action'])
            ->make(true);
    }
}
