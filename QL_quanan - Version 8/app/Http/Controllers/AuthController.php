<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register_auth()
    {
        return view('admin.auth.register');
    }
    public function register(Request $request)
    {
        $this->validation($request);
        $data = $request->all();

        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->admin_image = '';
        $admin->admin_code = '';
        $admin->save();
        return redirect()->back()->with('mess', 'Đăng ký thành công!');
    }
    public function validation($request)
    {
        return $this->validate($request, [
            'admin_name' => 'required|max:255',
            'admin_phone' => 'required|max:255',
            'admin_email' => 'required|email|max:255',
            'admin_password' => 'required|max:255',
        ]);
    }

    public function login_auth()
    {
        return view('admin.auth.login');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'admin_email' => 'required|email',
            'admin_password' => 'required',
        ],[
            'admin_email.required' => 'Email không được để trống',
            'admin_email.email' => 'Email phải đúng định dạng',
            'admin_password.required' => 'Mật khẩu không được để trống',
            
        ]);

        
        //$data = $request->all();
        if(Auth::attempt(['nv_email' => $request->admin_email, 'admin_password' => $request->admin_password, 'nv_tinhtrang' => 0]) ){
            return redirect()->back()->with('mess','Tài khoản này hiện đang bị khóa!');


        }elseif(Auth::attempt(['nv_email' => $request->admin_email, 'admin_password' => $request->admin_password, 'nv_tinhtrang' => 1])){
            return redirect('/dashboard');

        }
        else{
            return redirect()->back()->with('mess','Tài khoản hoặc mật khẩu của bạn đã sai. Vui lòng nhập lại!');

        };


    }
    public function logout_auth(){
        Auth::logout();
        return redirect('/login-auth');
    }
    public function get_forget_auth(){

        return view('admin.auth.forget_password');
    }
    
    public function post_forget_auth(Request $request){
        $request->validate([
            'nv_email' => 'required|exists:nhanvien'
        ], [
            'nv_email.required' => 'Vui lòng nhập địa chỉ email hợp lệ',
            'nv_email.exists' => 'Email này không tồn tại trong hệ thống'
        ]);
        $token = strtoupper(Str::random(10));
        $admin = Admin::where('nv_email', $request->nv_email)->first();
        $admin->update(['nv_token' => $token]);


        Mail::send('admin.auth.check_email_forget', compact('admin'), function ($email) use ($admin) {
            $email->subject('TH Restaurant - Lấy lại mật khẩu tài khoản');
            $email->to($admin->nv_email, $admin->nv_ten);
        });
        return redirect()->back()->with('mess', 'Vui lòng check email để thực hiện thay đổi mật khẩu');
    }
    public function get_password_auth(Admin $auth, $token){

        if ($auth->nv_token == $token) {
            $auths = Admin::find($auth)->first();
            return view('admin.auth.get_password', compact('auths'));
        }
        return abort(404);
    }



    public function post_password_auth(Admin $auth, $token, Request $request)
    {

        $request->validate([
            'nv_matkhau' => 'required',
            'nv_matkhau_confirm' => 'required|same:nv_matkhau',
        ]);

        $password_new = md5($request->nv_matkhau);
        $auth->update(['nv_matkhau' => $password_new, 'nv_token' => null]);
        return redirect('/login-auth')->with('mess', 'Đổi mật khẩu thành công');
    }

}
