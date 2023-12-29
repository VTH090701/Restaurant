<?php

namespace App\Http\Controllers;

use App\Models\Mailsettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Brian2694\Toastr\Facades\Toastr;

class EmailController extends Controller
{
    public function config_email(){
        $mails = Mailsettings::all();
        return view('admin.email.config_email',compact('mails'));
        
    }
    public function save_config_email(Request $request, $mail_id ){
        $mail = Mailsettings::find($mail_id);
        $mail->mail_transport = $request->mail_transport;
        $mail->mail_host = $request->mail_host;
        $mail->mail_port = $request->mail_port;
        $mail->mail_user = $request->mail_user;
        $mail->mail_password = $request->mail_password;
        $mail->mail_encryption = $request->mail_encryption;
        $mail->mail_from = $request->mail_from;
        $mail->update();

        Toastr::success('Cập nhật mail thành công','Thông báo');
        return redirect()->back();
    }
}
