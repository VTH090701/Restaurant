<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\City;
use App\Models\Customer;
use App\Models\Province;
use App\Models\Wards;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Brian2694\Toastr\Facades\Toastr;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_cus = Customer::orderby('khachhang_id', 'ASC')->get();
        return view('admin.customer.all_customer')->with(compact('all_cus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customer.add_customer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'cus_name' => 'required|max:255',
            'cus_sdt' => 'required',
            'cus_email' => 'required|email|max:255',
            'cus_password' => 'required|max:255',
            'location' => 'required|max:255',
            'status' => 'required',
            'cus_avatar' => 'required',
        ],[
            'cus_sdt.required' => 'Số điện thoại khách hàng không được để trống',
            // 'cus_sdt.integer' => 'Số điện thoại khách hàng phải là số nguyên',
            
        ]);
        
        $diachi = $request->result;
        $diachi .= ', ';
        $diachi .= $request->location;


        $data = array();
        $data['khachhang_ten'] = $request->cus_name;
        $data['khachhang_sdt'] = $request->cus_sdt;
        $data['khachhang_email'] = $request->cus_email;
        $data['khachhang_matkhau'] = md5($request->cus_password);
        $data['khachhang_diachi'] = $diachi;
        $data['khachhang_trangthai'] = $request->status;

        $get_image = $request->file('cus_avatar');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $get_name_image;
            $get_image->move('public/upload/hoso_kh', $new_image);
            $data['khachhang_hinhanh'] = $new_image;
            DB::table('khachhang')->insert($data);
            Toastr::success('Thêm khách hàng thành công', 'Thông báo');
            return Redirect::to('/customer');
        }

        $data['created_at'] = Carbon::now();
        DB::table('khachhang')->insert($data);
        Toastr::success('Thêm khách hàng thành công', 'Thông báo');
        return Redirect::to('/customer');
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
        $edit_cus = Customer::find($id);
        return view('admin.customer.edit_customer')->with(compact('edit_cus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $diachi1 = $request->result1;
        // $diachi1 .= ', ';
        $diachi1 .= $request->location1;


        $data = array();
        if ($diachi1 != '') {
            $data['khachhang_diachi'] = $diachi1;
        } else {
            $customer = Customer::find($id);
            $data['khachhang_diachi'] = $customer->khachhang_diachi;
        }



        $data['khachhang_ten'] = $request->cus_name;
        $data['khachhang_sdt'] = $request->cus_sdt;
        $data['khachhang_email'] = $request->cus_email;
        //$data['khachhang_matkhau'] = md5($request->cus_password);
        $data['khachhang_trangthai'] = $request->status;


        $get_image = $request->file('cus_avatar');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $get_name_image;
            $get_image->move('public/upload/hoso_kh', $new_image);
            $data['khachhang_hinhanh'] = $new_image;
            DB::table('khachhang')->where('khachhang_id', $id)->update($data);
            Toastr::success('Cập nhật khách hàng thành công', 'Thông báo');
            return Redirect::to('/customer');
        }

        DB::table('khachhang')->where('khachhang_id', $id)->update($data);
        Toastr::success('Cập nhật khách hàng thành công', 'Thông báo');
        return Redirect::to('/customer');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // DB::table('khachhang')->where('khachhang_id', $customer_id)->delete();
        $customer = Customer::find($id);
        $customer->delete();

        //unlink('public/upload/hoso_kh/'. $customer->khachhang_hinhanh );

        Toastr::success('Xóa khách hàng thành công', 'Thông báo');

        return Redirect::to('/customer');
    }
    public function get_all_customer(Request $request)
    {


        $customer = DB::table('khachhang')->get();

        return DataTables::of($customer)
            ->addIndexColumn()
            ->addColumn('action', function ($customer) {
                if ($customer->khachhang_trangthai == 1) {

                    return '
                    <div style="display:flex;" style="width:55px"> 
                    <a href="' . route('customer.edit', $customer->khachhang_id) . '" class="mt-1">
                    <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:green; "></i></a>
                    &nbsp|
                    <form action="' . route('customer.destroy', [$customer->khachhang_id]) . '" method="POST" >                      
                    ' . csrf_field() . '
                    ' . method_field('delete') . '
                        <button class="btn btn-sm " onclick="return myFunction();"> <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i></button>
                        </form>
                   |&nbsp
                    <a href="' . route('lock_customer', $customer->khachhang_id) . '" class="mt-1">
                    <i class="fa fa-lock" aria-hidden="true" style="color: blue;" ></i>
                    </a>
                    </div>';
                } else {
                    return '
                    <div style="display:flex;" style="width:55px"> 
                    <a href="' . route('customer.edit', $customer->khachhang_id) . '" class="mt-1">
                    <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:green; "></i></a>
                    &nbsp|
                    <form action="' . route('customer.destroy', [$customer->khachhang_id]) . '" method="POST" >                      
                    ' . csrf_field() . '
                    ' . method_field('delete') . '
                        <button class="btn btn-sm " onclick="return myFunction();"> <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i></button>
                        </form>
                    |&nbsp
                    <a href="' . route('unlock_customer', $customer->khachhang_id) . '" class="mt-1">
                    <i class="fa fa-unlock-alt" aria-hidden="true" style="color: orange;"></i>
                    </a>
                    </div>';
                };
            })
            ->addColumn('avatar', function ($customer) {
                return '<img src="public/upload/hoso_kh/' . $customer->khachhang_hinhanh . '" width="100" height="100" style="border-radius: 50px">';
            })
            ->addColumn('status', function ($customer) {
                if ($customer->khachhang_trangthai == 1) {
                    return '<span class="badge badge-primary">Hoạt động</span>';
                } else {
                    return '<span class="badge badge-danger">Khóa</span>';
                }
            })
            ->rawColumns(['action', 'status', 'avatar'])
            ->make(true);
    }
    public function lock_customer($customer_id){
        $customer = Customer::find($customer_id);
        $customer->khachhang_trangthai = 0;
        $customer->save();
        Toastr::success('Khóa tài khoản khách hàng thành công', 'Thông báo');
        return Redirect::to('/customer');
    }
    public function unlock_customer($customer_id){
        $customer = Customer::find($customer_id);
        $customer->khachhang_trangthai = 1;
        $customer->save();
        Toastr::success('Mở khóa tài khoản khách hàng thành công', 'Thông báo');
        return Redirect::to('/customer');
    }
}
