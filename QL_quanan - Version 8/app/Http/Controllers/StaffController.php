<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Roles;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_adm = Admin::orderby('nv_id', 'ASC')->get();
        return view('admin.staff.all_staff')->with(compact('all_adm'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.staff.add_staff');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'phone' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'required|max:255',
            'location' => 'required|max:255',
            'status' => 'required',
            'avatar' => 'required',
        ],[
            'phone.required' => 'Số điện thoại không được để trống',
            // 'phone.integer' => 'Số điện thoại phải là số nguyên',
            
        ]);
        $diachi = $request->result;
        $diachi .= ', ';
        $diachi .= $request->location;


        $data = array();
        $data['nv_ten'] = $request->name;
        $data['nv_sdt'] = $request->phone;
        $data['nv_email'] = $request->email;
        $data['nv_matkhau'] = md5($request->password);
        $data['nv_diachi'] = $diachi;
        $data['nv_tinhtrang'] = $request->status;

        $get_image = $request->file('avatar');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $get_name_image;
            $get_image->move('public/upload/hoso_nv', $new_image);
            $data['nv_hinhanh'] = $new_image;
            DB::table('nhanvien')->insert($data);
            Toastr::success('Thêm nhân viên thành công', 'Thông báo');
            return Redirect::to('/staff');
        }

        $data['created_at'] = Carbon::now();
        DB::table('nhanvien')->insert($data);
        Toastr::success('Thêm nhân viên thành công', 'Thông báo');
        return Redirect::to('/staff');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Admin::find($id);
        return view('admin.staff.details_staff',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit_adm = Admin::find($id);
        return view('admin.staff.edit_staff')->with(compact('edit_adm'));
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
            $data['nv_diachi'] = $diachi1;
        } else {
            $admin = Admin::find($id);
            $data['nv_diachi'] = $admin->nv_diachi;
        }

        $data['nv_ten'] = $request->name;
        $data['nv_sdt'] = $request->phone;
        $data['nv_email'] = $request->email;
        $data['nv_matkhau'] = md5($request->password);
        $data['nv_tinhtrang'] = $request->status;

        $get_image = $request->file('avatar');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $get_name_image;
            $get_image->move('public/upload/hoso_nv', $new_image);
            $data['nv_hinhanh'] = $new_image;
            DB::table('nhanvien')->where('nv_id', $id)->update($data);
            Toastr::success('Cập nhật nhân viên thành công', 'Thông báo');
            return Redirect::to('/staff');
        }

        // $data['created_at'] = Carbon::now();
        DB::table('nhanvien')->where('nv_id', $id)->update($data);
        Toastr::success('Cập nhật nhân viên thành công', 'Thông báo');
        return Redirect::to('/staff');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        Toastr::success('Xóa tài khoản nhân viên thành công', 'Thông báo');
        return Redirect::to('/staff');
    }
    public function get_all_staff()
    {

        $admin = DB::table('nhanvien')->get();
        return DataTables::of($admin)
            ->addIndexColumn()
            ->addColumn('action', function ($admin) {
                if ($admin->nv_tinhtrang == 1) {

                    return '
                    <div style="display:flex;" style="width:55px"> 

                    <a href="' . route('staff.edit', $admin->nv_id) . '" class="mt-1">
                    <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:green; "></i></a>
                    &nbsp|
                    <form action="' . route('staff.destroy', [$admin->nv_id]) . '" method="POST" >                      
                    ' . csrf_field() . '
                    ' . method_field('delete') . '
                        <button class="btn btn-sm " onclick="return myFunction();"> <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i></button>
                        </form>
                    &nbsp|&nbsp
                    <a href="' . route('lock_staff', $admin->nv_id) . '" class="mt-1">
                    <i class="fa fa-lock" aria-hidden="true" style="color: blue;" ></i>
                    </a>
                    &nbsp|&nbsp
                    <a href="' . route('staff.show', $admin->nv_id) . '" class="mt-1">
                    <i class="fa fa-eye" aria-hidden="true" style="color: grey;" ></i>
                    </a>
                    </div>';
                } else {
                    return '
                    <div style="display:flex;" style="width:55px"> 

                    <a href="' . route('staff.edit', $admin->nv_id) . '" class="mt-1">
                    <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:green; "></i></a>
                    &nbsp|
                    <form action="' . route('staff.destroy', [$admin->nv_id]) . '" method="POST" >                      
                    ' . csrf_field() . '
                    ' . method_field('delete') . '
                        <button class="btn btn-sm " onclick="return myFunction();"> <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i></button>
                        </form>
                        &nbsp|&nbsp
                        <a href="' . route('unlock_staff', $admin->nv_id) . '" class="mt-1">
                    <i class="fa fa-unlock-alt" aria-hidden="true" style="color: orange;"></i>
                    </a>
                    &nbsp|&nbsp
                    <a href="' . route('staff.show', $admin->nv_id) . '" class="mt-1">
                    <i class="fa fa-eye" aria-hidden="true" style="color: grey;" ></i>
                    </a>
                    </div>';
                };
            })
            ->addColumn('avatar', function ($admin) {
                return '<img src="/public/upload/hoso_nv/' . $admin->nv_hinhanh . '" width="100" height="100" style="border-radius: 50px">';
            })
            ->addColumn('status', function ($admin) {
                if ($admin->nv_tinhtrang == 1) {
                    return '<span class="badge badge-primary">Hoạt động</span>';
                } else {
                    return '<span class="badge badge-danger">Khóa</span>';
                }
            })
            ->rawColumns(['action', 'status', 'avatar'])
            ->make(true);
    }
    public function lock_staff($admin_id)
    {
        $admin = Admin::find($admin_id);
        $admin->nv_tinhtrang = 0;
        $admin->save();
        Toastr::success('Khóa tài khoản nhân viên thành công', 'Thông báo');
        return Redirect::to('/staff');
    }
    public function unlock_staff($admin_id)
    {
        $admin = Admin::find($admin_id);
        $admin->nv_tinhtrang = 1;
        $admin->save();
        Toastr::success('Mở khóa tài khoản nhân viên thành công', 'Thông báo');
        return Redirect::to('/staff');
    }


    public function assign_roles1(Request $request){
        
        if(Auth::id() == $request->admin_id){
            Toastr::warning('Bạn không phần quyền chính mình', 'Thông báo');
            return redirect()->back();

        }
        $data =  $request->all();
        $user = Admin::where('nv_email',$request->admin_email)->first();
        $user->roles()->detach();
        if( $request->admin_roles){
            $user->roles()->attach(Roles::where('quyen_ten','admin')->first());
        }
        if( $request->nvpv_roles){
            $user->roles()->attach(Roles::where('quyen_ten','nhanvien_pv')->first());
        }
        if( $request->nvbep_roles){
            $user->roles()->attach(Roles::where('quyen_ten','nhanvien_bep')->first());
        }

        Toastr::success('Cấp quyền thành công !','Thông báo');
        return redirect('/staff');

    }
}
