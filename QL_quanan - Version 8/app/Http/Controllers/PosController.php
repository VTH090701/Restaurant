<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use Illuminate\Support\Carbon;
use App\Cart;
use App\Models\Category;
use App\Models\City;
use App\Models\Customer;
use Brian2694\Toastr\Facades\Toastr;
use App\Events\NoticeEvent;

// use function Laravel\Prompts\alert;
// session_start();

class PosController extends Controller
{
    public function pos()
    {
        $shift_id =  Session::get('shift_id');
        if($shift_id){
            $category = DB::table('danhmuc')->where('danhmuc_tinhtrang', '1')->orderby('danhmuc_id', 'asc')->get();
            $product = DB::table('monan')->join('danhmuc','danhmuc.danhmuc_id','=','monan.danhmuc_id')->where('danhmuc_tinhtrang',1)->where('ma_tinhtrang', '1')->orderby('ma_id', 'asc')->get();
            $customer = DB::table('khachhang')->where('khachhang_trangthai', '1')->orderby('khachhang_id', 'asc')->get();
            $table = DB::table('ban')->where('ban_tinhtrang', '0')->orderby('ban_id', 'asc')->get();
            return view('admin.pos.pos')->with('category_views', $category)->with('product_views', $product)
                ->with('customer_views', $customer)->with('table_views', $table);
        }else{
            Toastr::warning('Hãy mở phiên làm việc để có thể lập hóa đơn','Thông báo');
            return redirect()->back();
        }
        
    }

    public function addToCart($id)
    {
        $product = Product::find($id);
        $cart = Session::get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
        } else {
            $cart[$id] = [
                'ID' => $product->ma_id,
                'name' => $product->ma_ten,
                'price' => $product->ma_gia,
                'quantity' => 1
            ];
        }

        $carts = Session::put('cart', $cart);
        $customer_views = DB::table('khachhang')->orderby('khachhang_id', 'asc')->get();
        $table_views = DB::table('ban')->where('ban_tinhtrang', '0')->orderby('ban_id', 'asc')->get();

        $cartComponent = view('admin.pos.components.cart_components', compact('customer_views', 'table_views'))->render();
        return response()->json(['cart_components' => $cartComponent, 'code' => 200], status: 200);
    }

    public function addToCartPlus($id)
    {
        $cart = Session::get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
        }


        $carts = Session::put('cart', $cart);
        $customer_views = DB::table('khachhang')->orderby('khachhang_id', 'asc')->get();
        $table_views = DB::table('ban')->where('ban_tinhtrang', '0')->orderby('ban_id', 'asc')->get();
        $cartComponent = view('admin.pos.components.cart_components', compact('customer_views', 'table_views'))->render();
        return response()->json(['cart_components' => $cartComponent, 'code' => 200], status: 200);

    }
  
    
    public function addToCartMinus($id)
    {
        $cart = Session::get('cart');
        if (isset($cart[$id])) {
            if( $cart[$id]['quantity'] > 1){
                $cart[$id]['quantity'] = $cart[$id]['quantity'] - 1;
            }
        }

        $carts = Session::put('cart', $cart);
        $customer_views = DB::table('khachhang')->orderby('khachhang_id', 'asc')->get();
        $table_views = DB::table('ban')->where('ban_tinhtrang', '0')->orderby('ban_id', 'asc')->get();
        $cartComponent = view('admin.pos.components.cart_components', compact('customer_views', 'table_views'))->render();
        return response()->json(['cart_components' => $cartComponent, 'code' => 200], status: 200);

    }
    
    public function deleteCart(Request $request)
    {
        if ($request->id) {
            $carts = Session::get('cart');
            unset($carts[$request->id]);
            session::put('cart', $carts);
            $carts = Session::get('cart');

            $customer_views = DB::table('khachhang')->orderby('khachhang_id', 'asc')->get();
            $table_views = DB::table('ban')->where('ban_tinhtrang', '0')->orderby('ban_id', 'asc')->get();

            $cartComponent = view('admin.pos.components.cart_components', compact('customer_views', 'table_views'))->render();
            return response()->json(['cart_components' => $cartComponent, 'code' => 200], status: 200);
        }
    }

    public function add_customer_pos(Request $request)
    {

        $data = $request->all();
        if ($data == null) {
            Toastr::warning('Thêm khách hàng thất bại', 'Thông báo');
            return redirect()->back();
        } {
            $this->validate($request, [
                'name' => 'required|max:255',
                'phone' => 'required|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required|max:255',
                'location' => 'required|max:255',
            ]);


            $diachi = $request->result;
            $diachi .= ', ';
            $diachi .= $request->location;

            $customer = new Customer();
            $customer->khachhang_ten = $request->name;
            $customer->khachhang_sdt = $request->phone;
            $customer->khachhang_email = $request->email;
            $customer->khachhang_matkhau  = md5($request->password);
            $customer->khachhang_diachi  = $diachi;
            $customer->khachhang_trangthai = 1;
            $customer->khachhang_hinhanh  = $request->image;
            $customer->save();
            Toastr::success('Thêm khách hàng thành công', 'Thông báo');
            return redirect()->back();
        }
    }

    public function loadCate($id)
    {
        if ($id == 0) {
            $product = Product::all();
        } else {
            $product = DB::table('monan')->where('danhmuc_id', $id)->get();
        }
        $productComponent = view('admin.pos.components.product_components', compact('product'))->render();
        return response()->json(['product_components' => $productComponent, 'code' => 200], status: 200);
    }

    public function loadCate1($id)
    {
        if ($id == 0) {
            $product = Product::all();
        } else {
            $product = DB::table('monan')->where('danhmuc_id', $id)->get();
        }
        $productComponent1 = view('admin.pos.components.product_components1', compact('product'))->render();
        return response()->json(['product_components1' => $productComponent1, 'code' => 200], status: 200);
    }

    public function search(Request $request)
    {

        $product = DB::table('monan')->where('ma_ten', 'like', '%' . $request->_text . '%')->get();
        $searchComponent = view('admin.pos.components.search_components', compact('product'))->render();
        return response()->json(['search_components' => $searchComponent, 'code' => 200], status: 200);
    }
    public function search1(Request $request)
    {

        $product = DB::table('monan')->where('ma_ten', 'like', '%' . $request->_text . '%')->get();
        $searchComponent1 = view('admin.pos.components.search_components1', compact('product'))->render();
        return response()->json(['search_components1' => $searchComponent1, 'code' => 200], status: 200);
    }
    public function exit_order()
    {
        Session::forget('cart');
        return redirect('/dashboard');
    }
}
