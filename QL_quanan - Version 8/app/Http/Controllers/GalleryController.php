<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;
use Brian2694\Toastr\Facades\Toastr;

class GalleryController extends Controller
{


    public function add_gallery($product_id)
    {
        $pro_id = $product_id;
        return view('admin.gallery.add_gallery', compact('pro_id'));
    }
    public function select_gallery(Request $request)
    {
        $product_id = $request->pro_id;
        $gallery = Gallery::where('ma_id', $product_id)->get();
        $gallery_count = $gallery->count();
        $output = '  <form>
        ' . csrf_field() . '
        <table class="table">
        <thead>
            <tr>
                <th>Thứ tự</th>
                <th>Tên hình ảnh</th>
                <th>Hình ảnh</th>
                <th>Quản lý</th>
            </tr>
        </thead>
        <tbody>
        ';
        if ($gallery_count > 0) {
            $i = 0;
            foreach ($gallery as $key  => $gal) {
                $i++;
                $output .= '
              
                <tr>
                <td>' . $i . '</td>

                <td contenteditable class="edit_gal_name" data-gal_id="' . $gal->hinhanh_id . '">' . $gal->hinhanh_ten . '</td>
                <td>
                
                <img src=" ' . url('public/upload/gallery/' . $gal->hinhanh_anh) . '"
                class="img-thumbnail" width="120" height ="120"> 
                
                <input type="file" class="file_image btn btn-xs" style="width:40%;" data-gal_id="' . $gal->hinhanh_id . '" id="file-' . $gal->hinhanh_id . '" name="file" accept="image/*" >
                </td>
                <td>
                <button type="button" data-gal_id="' . $gal->hinhanh_id . '" class = "btn btn-xs btn-danger delete-gallery" onclick="return myFunction();">Xóa</button>
                </td>
                </tr> 
                </form>
                ';
            }
        } else {
            $output .= '
            <tr>
            <td colspan="4">Sản phẩm này chưa thư viện ảnh</td>
          
            </tr>
            
            ';
        }
        $output .= '
        </tbody>
        </table>
        </form>
        ';
        echo $output;
    }
    public function insert_gallery(Request $request, $pro_id)
    {
        $get_image = $request->file('file');
        if ($get_image) {
            foreach ($get_image as $image) {
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));

                // $new_image = $get_name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $new_image = $get_name_image;
                $image->move('public/upload/gallery/', $new_image);
                $gallery = new Gallery();
                $gallery->hinhanh_ten = $new_image;
                $gallery->hinhanh_anh = $new_image;
                $gallery->ma_id = $pro_id;
                $gallery->save();
            }
        }
        Toastr::success('Thêm thư viện ảnh thành công','Thông báo');
        return redirect()->back();
    }
    
    public function update_gallery_name(Request $request){
        $gal_id = $request->gal_id;
        $gal_text = $request->gal_text;

        $gallery =  Gallery::find($gal_id);
        $gallery->hinhanh_ten = $gal_text;
        $gallery->save();
    }
    public function delete_gallery(Request $request){
        $gal_id = $request->gal_id;
        $gallery =  Gallery::find($gal_id);
        unlink('public/upload/gallery/'. $gallery->hinhanh_anh );
        $gallery->delete();       
    }

}
