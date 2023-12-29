<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::all();
        return view('admin.post.all_post', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.post.add_post');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'post_name' => 'required|max:255',
            'post_desc' => 'required',
            'post_content' => 'required',
            'post_status' => 'required|max:255',
            'post_image' => 'required',

        ]);
        
        $data = $request->all();
        $post = new Post();
        $post->baiviet_tieude = $data['post_name'];
        $post->baiviet_tomtat = $data['post_desc'];
        $post->baiviet_noidung = $data['post_content'];
        $post->baiviet_tinhtrang = $data['post_status'];
        $post->baiviet_tgd = Carbon::now();

        $post->nv_id = Auth::id();

        $get_image = $request->file('post_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));

            $new_image = $get_name_image;
            $get_image->move('public/upload/post', $new_image);
            $post->baiviet_hinhanh = $new_image;


            $post->save();
            Toastr::success('Thêm bài viết thành công thành công', 'Thông báo');
            return Redirect::to('/post');
        } else {
            Toastr::warnning('Làm ơn thêm hình ảnh', 'Thông báo');
            return redirect()->back();
        }

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
          $post = Post::find($id);
        return view('admin.post.edit_post', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $post = Post::find($id);
        $post->baiviet_tieude = $data['post_name'];
        $post->baiviet_tomtat = $data['post_desc'];
        $post->baiviet_noidung = $data['post_content'];
        $post->baiviet_tinhtrang = $data['post_status'];
        $post->baiviet_tgcn= Carbon::now();

        $post->nv_id = Auth::id();

        $get_image = $request->file('post_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));

            $new_image = $get_name_image;
            $get_image->move('public/upload/post', $new_image);
            $post->baiviet_hinhanh = $new_image;


            $post->update();
            Toastr::success('Cập nhật bài viết thành công thành công', 'Thông báo');
            return Redirect::to('/post');
        }
        $post->update();

        Toastr::success('Cập nhật bài viết thành công thành công', 'Thông báo');
        return Redirect::to('/post');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        $imgae = $post->baiviet_hinhanh;
        unlink('public/upload/post/' . $imgae);

        $post->delete();

        Toastr::success('Xóa bài viết thành công thành công', 'Thông báo');
        return Redirect::to('/post');
    }
    public function get_all_post(Request $request){

        if ($request->start_date6 && $request->end_date6) {
            $post = Post::whereDate('baiviet_tgd', '>=', $request->start_date6)
                ->whereDate('baiviet_tgd', '<=', $request->end_date6)->get();
        } else {
            $post = Post::all();
        }

        return DataTables::of($post)
            ->addIndexColumn()
            ->addColumn('desc', function ($post) {
                return $post->baiviet_tomtat;
            })
            ->addColumn('nv', function ($post) {
                return $post->admins->nv_ten;
            })
            ->addColumn('image', function ($post) {
                return'<img src="public/upload/post/'.$post->baiviet_hinhanh.'" width="100" height="100">';
            })
            ->addColumn('active', function ($post) {
                if($post->baiviet_tinhtrang == 0){
                    return '<a href="' . route('active_post', $post->baiviet_id) . '"><i class="fa fa-toggle-off" aria-hidden="true" 
                    style="font-size: 18pt;color: red"></i></a>';
                }else{
                    return '  <a href="' . route('unactive_post',  $post->baiviet_id) . '"><i class="fa fa-toggle-on" aria-hidden="true"
                    style="font-size: 18pt;color: green"></i></a>';
                }
                
            })
            ->addColumn('action', function ($post) {
                return '
                <div style="display:flex;"> 
                    <a href="' . route('post.edit', $post->baiviet_id) . '" class="mt-1">
                    <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i></a>
                    &nbsp|
                    <form action="' . route('post.destroy', [$post->baiviet_id]) . '" method="POST" >                      
                    ' . csrf_field() . '
                    ' . method_field('delete') . '
                        <button class="btn btn-sm " onclick="return myFunction();"> <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i></button>
                        </form>
                </a>
                </div>    ';
            })
            ->rawColumns(['nv','image','active','action','desc'])
            ->make(true);
    }
    public function active_post($post_id){
     
        $post = Post::find($post_id);
        $post->baiviet_tinhtrang = 1 ;
        $post->update();

        Toastr::success('Kích hoạt bài viết thành công','Thông báo');
        return Redirect::to('/post');
    }

    public function unactive_post($post_id){
     
        $post = Post::find($post_id);
        $post->baiviet_tinhtrang = 0 ;
        $post->update();

        Toastr::success('Không kích hoạt bài viết thành công','Thông báo');
        return Redirect::to('/post');
    }
}
