<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Orderdetails;
use App\Models\Reservation;
use App\Models\Shift;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Yajra\DataTables\DataTables;


class AdminController extends Controller
{


    public function showdashboard()
    {
        $honay = Carbon::now();
        $reservation = Reservation::whereDate('datban_thoigian', $honay)->where('datban_tinhtrang', 1)->get();

        $shift = Shift::where('phienlamviec_tt', 0)->select('phienlamviec_id')->get();
        if ($shift) {
            $shift_id = 0;
            foreach ($shift as $shi) {
                $shift_id = $shi->phienlamviec_id;
            }
            Session::put('shift_id', $shift_id);
        }

        $table = Table::where('ban_tinhtrang', 0)->where('ban_slnguoi', '>', '0')->get();
        $all_order = Order::where('hoadon_tinhtrang', 0)->orwhere('hoadon_tinhtrang', 1)->orwhere('hoadon_tinhtrang', 2)->get();
        return view('admin.dashboard', compact('all_order', 'reservation', 'table',));
    }



    public function profile()
    {

        $admin_id = Auth::id();
        $admin = Admin::find($admin_id);
        return view('admin.profile', compact('admin'));
    }
    public function profile_update(Request $request)
    {
        $admin_id = Auth::id();
        $admin = Admin::find($admin_id);
        $diachi1 = $request->result1;
        $diachi1 .= $request->location1;


        if ($diachi1 != '') {
            $admin->nv_diachi = $diachi1;
        } else {
            $admin->nv_diachi = $admin->nv_diachi;
        }

        $admin->nv_ten = $request->adm_name;
        $admin->nv_email = $request->adm_email;
        $admin->nv_sdt = $request->adm_phone;



        $get_image = $request->file('adm_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $get_name_image;
            $get_image->move('public/upload/hoso_nv', $new_image);
            $admin->nv_hinhanh = $new_image;
            $admin->update();
            Toastr::success('Cập nhật hồ sơ thành công', 'Thông báo');

            return Redirect::to('/profile');
        }

        $admin->update();
        Toastr::success('Cập nhật hồ sơ thành công', 'Thông báo');

        return Redirect::to('/profile');
    }

    public function profile_password_update(Request $request)
    {
        $admin = Admin::find($request->pass_id);
        if ($admin) {
            if ($admin->nv_matkhau == md5($request->pass_old)) {
                $admin->nv_matkhau = md5($request->pass_new);
                $admin->save();
                Toastr::success('Cập nhật mật khẩu thành công', 'Thông báo');
                return Redirect::to('/profile');
            } else {
                Toastr::error('Mật khẩu cũ của bạn không đúng', 'Thông báo');

                return Redirect::to('/profile');
            }
        }
    }
    public function forget_password()
    {

        return view('forget_password');
    }
    public function recover_pass(Request $request)
    {
        $email = $request->email_acc;
        $checkAdmin = Admin::where('admin_email', $email)->first();

        if (!$checkAdmin) {
            return redirect()->back()->with('status', 'Email không tồn tại');
        }

        $code = bcrypt(md5(time() . $email));
        $checkAdmin->admin_code = $code;
        $checkAdmin->admin_timecode = Carbon::now();
        $checkAdmin->save();
        return redirect()->back()->with('success', 'Link lấy lại mật khẩu đã được gửi vào email của bạn');
    }
    public function resetPassword()
    {
        return view('forget_password_notify');
    }
}
