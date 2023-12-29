<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class CommentController extends Controller
{

    public function all_comment()
    {
        $comment = Comment::all();
        return view('admin.comment.all_comment', compact('comment'));
    }

    public function get_comment(Request $request)
    {
        if ($request->start_date4 && $request->end_date4) {
            $comment = Comment::whereDate('binhluan_thoigian', '>=', $request->start_date4)
                ->whereDate('binhluan_thoigian', '<=', $request->end_date4)->get();
        } else {
            $comment = Comment::orderby('binhluan_id', 'ASC')->get();
        }

        return DataTables::of($comment)
            ->addIndexColumn()
    
            ->addColumn('ten_kh', function ($comment) {
                return $comment->customers->khachhang_ten;
            })
            ->addColumn('ten_ma', function ($comment) {
                return $comment->products->ma_ten;
            })
            ->addColumn('status', function ($comment) {
                if($comment->binhluan_tinhtrang == 1){
                    return '<span class="badge badge-danger" style="font-size: 13px">Chờ duyệt</span>';
                }else{
                    return '<span class="badge badge-success" style="font-size: 13px">Đã duyệtt</span>';

                };
            })
            ->addColumn('action', function ($comment) {
                if ($comment->binhluan_tinhtrang == 0) {
                    return '
                    <a href="' . route('unactive_comment', $comment->binhluan_id) . '"><i class="fa fa-toggle-on" aria-hidden="true"
                   style="font-size: 18pt;color: green"></i></a>
                    |
                    <a onclick="return myFunction();" href="' . route('delete_comment', $comment->binhluan_id) . '">
                    <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i>
                </a>
                    ';
                } else {
                    return '
                    <a href="' . route('active_comment', $comment->binhluan_id) . '">
                    <i class="fa fa-toggle-off" aria-hidden="true"
                    style="font-size: 18pt;color: red"></i></a>
                    |
                    <a onclick="return myFunction();" href="' . route('delete_comment', $comment->binhluan_id) . '">
                    <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i>
                </a>
                    ';
                }
            })
            ->rawColumns(['status','ten_ma','ten_kh','action'])
            ->make(true);
    }
    public function active_comment($comment_id)
    {
        $comment = Comment::find($comment_id);
        $comment->binhluan_tinhtrang = 0;
        $comment->save();
        Toastr::success('Kích hoạt bình luận thành công', 'Thông báo');

        return Redirect::to('/all-comment');
    }

    public function unactive_comment($comment_id)
    {
        $comment = Comment::find($comment_id);
        $comment->binhluan_tinhtrang = 1;
        $comment->save();
        Toastr::success('Không kích hoạt bình luận thành công', 'Thông báo');

        return Redirect::to('/all-comment');
    }
    public function load_comment(Request $request)
    {
        $product_id =  $request->product_id;
        $comment  = Comment::where('ma_id', $product_id)->where('binhluan_tinhtrang', 0)->get();
        $output = '';
        foreach ($comment as $key => $comm) {
            $output .= '
            <div class="row style_comment mt-3">
            <div class="col-md-2 mt-2 mb-2 text-center">
                <img width="70%" style=" border-radius:50px;" src=" ' . asset('/frontend/img/img_comment.jpg') . '" >
            </div>
                <div class="col-md-10 mt-3">
                    <p style="color:green;">' . $comm->customers->khachhang_email . '</p>
                    <p style="color:black;">' . $comm->binhluan_thoigian . '</p>
                    <p style="color:black;">' . $comm->binhluan_noidung . '</p>
                </div>
            </div>
        <p></p>';
        }
        echo $output;
    }
    public function send_comment(Request $request)
    {

        $khachhang_id =  Session::get('customer_id');
        $comment = new Comment();
        $comment->khachhang_id = $khachhang_id;
        $comment->binhluan_noidung =  $request->comment_content;
        $comment->ma_id = $request->product_id;
        $comment->binhluan_tinhtrang = 1;
        $comment->binhluan_thoigian = Carbon::now();
        $comment->save();
    }
    public function delete_comment($comment_id)
    {
        $comment = Comment::find($comment_id);
        $comment->delete();
        Toastr::success('Xóa bình luận thành công', 'Thông báo');
        return Redirect::to('/all-comment');
    }
}
