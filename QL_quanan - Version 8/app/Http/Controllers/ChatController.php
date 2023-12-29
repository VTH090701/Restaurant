<?php

namespace App\Http\Controllers;

use App\Events\NoticeEvent;
use App\Models\Admin;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// require __DIR__ . '/vendor/autoload.php';
use Pusher\Pusher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Brian2694\Toastr\Facades\Toastr;

class ChatController extends Controller
{
    public function chat()
    {

        $users = DB::select("select nhanvien.nv_id,nhanvien.nv_ten,nhanvien.nv_hinhanh,nhanvien.nv_email,count(tn_daxem) as unread
        from nhanvien left join tinnhan on nhanvien.nv_id = tinnhan.nv_id_tntu and tn_daxem = 0 and tinnhan.nv_id_tnden = " . Auth::id() . "
        where nhanvien.nv_id != " . Auth::id() . "
        group by nhanvien.nv_id,nhanvien.nv_ten,nhanvien.nv_ten,nhanvien.nv_email,nhanvien.nv_hinhanh");

        return view('admin.chat.dashboard_chat', ['users' => $users]);
    }
    public function getMessage($user_id)
    {
        //return $user_id;
        $my_id = Auth::id();
        Message::where(['nv_id_tntu' => $user_id, 'nv_id_tnden' => $my_id])->update(['tn_daxem' => 1]);
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('nv_id_tntu', $my_id)->where('nv_id_tnden', $user_id);
        })->orWhere(function ($query) use ($user_id, $my_id) {
            $query->where('nv_id_tntu', $user_id)->where('nv_id_tnden', $my_id);
        })->get();

        return view('admin.chat.message.index', ['messages' => $messages]);
    }
    public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->nv_id_tntu = $from;
        $data->nv_id_tnden = $to;
        $data->tn_tinnhan = $message;
        $data->tn_daxem = 0;
        $data->save();


        //Pusher
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher(
            '41416ec66a8e6efbc43a',
            '27d71f12dfdfe09dbb86',
            '1683900',
            $options
        );
        $data = ['nv_id_tntu' => $from, 'nv_id_tnden' => $to ];
        $pusher->trigger('my-channel', 'my-event', $data);

    }
}
