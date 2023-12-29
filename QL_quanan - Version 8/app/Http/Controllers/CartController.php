<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderdetails;
use App\Models\Table;
use App\Models\Customer;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\Shift;
use Illuminate\Support\Facades\Auth;
use PDF;
use Brian2694\Toastr\Facades\Toastr;
use App\Events\NoticeEvent;
use App\Models\Detailsreceipt;
use App\Models\Ingredient;
use App\Models\Quantitative;
use Pusher\Pusher;

// use function Laravel\Prompts\alert;
// session_start();

class CartController extends Controller
{


    public function save_order(Request $request)
    {
        // Lưu vào csdl order
        $this->validate($request, [
            'note_order' => 'required|max:255',

        ]);
        $content = Session::get('cart');
        if ($content) {
            $nl_kdu = '';
            $ingredient = Ingredient::all();
            $quantitative = Quantitative::where('dl_trangthai', 1)->get();

            foreach ($quantitative as $quan) {
                foreach ($content as $v_content) {
                    if ($v_content['ID'] ==  $quan->ma_id) {

                        foreach ($quan->quantitativedetails as $details1) {
                            foreach ($ingredient as $ingre) {
                                if ($details1->nl_id == $ingre->nl_id) {
                                    if ($ingre->nl_slcl > ($details1->ctdl_sl * $v_content['quantity'])) {
                                        $ingre->nl_slcl =  $ingre->nl_slcl -  ($details1->ctdl_sl * $v_content['quantity']);
                                        $ingre->nl_slsd += ($details1->ctdl_sl * $v_content['quantity']);
                                        $ingre->update();
                                    } else {
                                        $nl_kdu .= ' ' . $ingre->nl_ten;
                                    }
                                }
                            }
                        }
                    }
                }
            }


            foreach ($quantitative as $quan) {
                foreach ($content as $v_content) {
                    if ($v_content['ID'] ==  $quan->ma_id) {
                        foreach ($quan->quantitativedetails as $details1) {
                            foreach ($ingredient as $ingre) {
                                if ($details1->nl_id == $ingre->nl_id) {
                                    if ($ingre->nl_slcl > ($details1->ctdl_sl * $v_content['quantity'])) {
                                    } else {
                                        Toastr::warning('Nguyên liệu ' .  $nl_kdu . ' không đủ!', 'Thông báo');
                                        return redirect()->back();
                                    }
                                }
                            }
                        }
                    }
                }
            }


            $admin_id = Auth::id();
            $shift_id = Session::get('shift_id');
            $order = new Order();
            $order->nv_id = $admin_id;
            $order->phienlamviec_id = $shift_id;


            //Lưu doanh thu trong hóa đơn    
            $shift = Shift::find($shift_id);
            $shift->phienlamviec_dt += (int)$request->total_order * 1000;
            $shift->save();

            //Lưu hóa đơn
            $order->ban_id = $request->table_order;
            $order->khachhang_id = $request->customer_order;
            $order->hoadon_tinhtrang = 0;
            $order->hoadon_httt = 0;
            $order->hoadon_ngaytao = Carbon::now();
            $order->hoadon_tongtien = (int)$request->total_order * 1000;
            $order->hoadon_ghichu = $request->note_order;
            $order->save();

            // Lưu vào csdl table
            $table = Table::find($request->table_order);
            $table->ban_tinhtrang = 1;
            $table->save();

            //Lưu vào csld orderdetails
            if ($content) {
                foreach ($content as $v_content) {
                    $orderdetails = new Orderdetails();
                    $orderdetails->hoadon_id = $order->hoadon_id;
                    $orderdetails->ma_id = $v_content['ID'];
                    $orderdetails->cthoadon_slsp = $v_content['quantity'];
                    $orderdetails->cthoadon_giasp = $v_content['price'];
                    $orderdetails->save();
                }
            }

            //in phiếu chế biến
            $data = [
                'order' => $order,
            ];
            $pdf = PDF::loadView('admin.pos.invoice', $data);
            $time = Carbon::now()->format('s');
            Storage::put('public/storage/uploads_phieuchebien/' . 'HD_' . '' . $order->hoadon_id  . '_Time_' . $time .   '.' . 'pdf', $pdf->output());
            Session::forget('cart');
            Toastr::success('Lưu hóa đơn thành công, phiếu chế biến sẽ được xuất ở nhà bếp', 'Thông báo');
            NoticeEvent::dispatch($order->table->ban_ten . ' vừa gọi món ăn!');
            return Redirect::to('/dashboard');
        } else {
            Toastr::error('Hãy mở phiên làm việc để có thể lưu hóa đơn', 'Thông báo');
            return Redirect::to('/dashboard');
        }
    }


    public function add_order_again($order_id)
    {
        $all_order_again = DB::table('hoadon')->select('cthoadon_id', 'cthoadon.ma_id', 'cthoadon_slsp', 'cthoadon_giasp', 'ma_ten')->join('cthoadon', 'cthoadon.hoadon_id', '=', 'hoadon.hoadon_id')
            ->join('monan', 'monan.ma_id', '=', 'cthoadon.ma_id')->where('hoadon.hoadon_id', $order_id)
            ->orderby('hoadon.hoadon_id', 'asc')->get()->toArray();

        foreach ($all_order_again as $key) {
            $array[$key->ma_id]['ID'] = $key->ma_id;
            $array[$key->ma_id]['name'] = $key->ma_ten;
            $array[$key->ma_id]['price'] = $key->cthoadon_giasp;
            $array[$key->ma_id]['quantity'] = $key->cthoadon_slsp;
        }

        $category = DB::table('danhmuc')->where('danhmuc_tinhtrang', '1')->orderby('danhmuc_id', 'asc')->get();
        $product = DB::table('monan')->where('ma_tinhtrang', '1')->orderby('ma_id', 'asc')->get();
        $customer_views = DB::table('khachhang')->join('hoadon', 'hoadon.khachhang_id', '=', 'khachhang.khachhang_id')->where('hoadon.hoadon_id', $order_id)->get();
        $table_views = DB::table('ban')->join('hoadon', 'hoadon.ban_id', '=', 'ban.ban_id')
            ->where('hoadon.hoadon_id', $order_id)->get();

        Session::put('cart1', $array);
        Session::put('order_id', $order_id);

        return view('admin.pos.pos1')->with('category_views', $category)->with('product_views', $product)
            ->with('customer_views', $customer_views)->with('table_views', $table_views);
    }

    public function addToCartagain($id)
    {
        $product = Product::find($id);
        $cart1 = Session::get('cart1');
        if (isset($cart1[$id])) {
            $cart1[$id]['quantity'] = $cart1[$id]['quantity'] + 1;
        } else {
            $cart1[$id] = [
                'ID' => $product->ma_id,
                'name' => $product->ma_ten,
                'price' => $product->ma_gia,
                'quantity' => 1
            ];
        }
        $carts1 = Session::put('cart1', $cart1);
        $order_id = Session::get('order_id');

        $customer_views = DB::table('khachhang')->join('hoadon', 'hoadon.khachhang_id', '=', 'khachhang.khachhang_id')
            ->where('hoadon.hoadon_id', $order_id)->get();
        $table_views = DB::table('ban')->join('hoadon', 'hoadon.ban_id', '=', 'ban.ban_id')
            ->where('hoadon.hoadon_id', $order_id)->get();

        $cartComponent1 = view('admin.pos.components.cart_components1', compact('customer_views', 'table_views'))->render();
        return response()->json(['cart_components1' => $cartComponent1, 'code' => 200], status: 200);
    }


    public function addTocartagainPlus($id)
    {
        $cart1 = Session::get('cart1');
        if (isset($cart1[$id])) {
            $cart1[$id]['quantity'] = $cart1[$id]['quantity'] + 1;
        }


        $carts1 = Session::put('cart1', $cart1);
        $order_id = Session::get('order_id');

        $customer_views = DB::table('khachhang')->join('hoadon', 'hoadon.khachhang_id', '=', 'khachhang.khachhang_id')
            ->where('hoadon.hoadon_id', $order_id)->get();
        $table_views = DB::table('ban')->join('hoadon', 'hoadon.ban_id', '=', 'ban.ban_id')
            ->where('hoadon.hoadon_id', $order_id)->get();

        $cartComponent1 = view('admin.pos.components.cart_components1', compact('customer_views', 'table_views'))->render();
        return response()->json(['cart_components1' => $cartComponent1, 'code' => 200], status: 200);
    }

    public function addToCartagainMinus($id)
    {
        $cart1 = Session::get('cart1');
        if (isset($cart1[$id])) {
            if ($cart1[$id]['quantity'] > 1) {
                $cart1[$id]['quantity'] = $cart1[$id]['quantity'] - 1;
            }
        }


        $carts1 = Session::put('cart1', $cart1);
        $order_id = Session::get('order_id');

        $customer_views = DB::table('khachhang')->join('hoadon', 'hoadon.khachhang_id', '=', 'khachhang.khachhang_id')
            ->where('hoadon.hoadon_id', $order_id)->get();
        $table_views = DB::table('ban')->join('hoadon', 'hoadon.ban_id', '=', 'ban.ban_id')
            ->where('hoadon.hoadon_id', $order_id)->get();

        $cartComponent1 = view('admin.pos.components.cart_components1', compact('customer_views', 'table_views'))->render();
        return response()->json(['cart_components1' => $cartComponent1, 'code' => 200], status: 200);
    }



    public function deleteCartagain(Request $request)
    {
        if ($request->id) {
            $carts1 = Session::get('cart1');
            unset($carts1[$request->id]);
            session::put('cart1', $carts1);
            $carts1 = Session::get('cart1');

            $order_id = Session::get('order_id');

            $customer_views = DB::table('khachhang')->join('hoadon', 'hoadon.khachhang_id', '=', 'khachhang.khachhang_id')
                ->where('hoadon.hoadon_id', $order_id)->get();
            $table_views = DB::table('ban')->join('hoadon', 'hoadon.ban_id', '=', 'ban.ban_id')
                ->where('hoadon.hoadon_id', $order_id)->get();

            $cartComponent1 = view('admin.pos.components.cart_components1', compact('customer_views', 'table_views'))->render();
            return response()->json(['cart_components1' => $cartComponent1, 'code' => 200], status: 200);
        }
    }
    public function save_order_again(Request $request)
    {



        $content = Session::get('cart1');
        $order_id = $request->order_id;
        $nl_kdu = '';
        //Trừ nguyên liệu

        $ingredient = Ingredient::all();
        $quantitative = Quantitative::where('dl_trangthai', 1)->get();
        $orderdetails = Orderdetails::where('hoadon_id', $order_id)->get();


        $order1 = array();
        $order2 = array();
        $i = 0;
        $y = 0;
        foreach ($content as $v_content) {
            foreach ($orderdetails as $details) {
                $i++;
                if ($v_content['ID'] == $details->ma_id) {
                    if (($v_content['quantity'] - $details->cthoadon_slsp)  == 0) {
                    } elseif (($v_content['quantity'] - $details->cthoadon_slsp)  > 0) {
                        $order1[$i]['id'] = $details->ma_id;
                        $order1[$i]['name'] = $details->products->ma_ten;
                        $order1[$i]['qty'] =  ($v_content['quantity'] - $details->cthoadon_slsp);
                    }
                }
            }
        }

        $orderdetails1 = Orderdetails::where('hoadon_id', $order_id)->select('ma_id')->get()->toArray();
        $result = array_diff(array_column($content, 'ID'), array_column($orderdetails1, 'ma_id'));
        foreach ($content as $key =>  $v_content) {
            foreach ($result as $res) {
                $y++;
                if ($v_content['ID'] == $res) {
                    $order2[$y]['id'] = $v_content['ID'];
                    $order2[$y]['name'] = $v_content['name'];
                    $order2[$y]['qty'] =  $v_content['quantity'];
                }
            }
        }
        $order_again = array_merge($order1, $order2);


        foreach ($quantitative as $quan) {
            foreach ($order_again as $v_content) {
                if ($v_content['id'] ==  $quan->ma_id) {
                    foreach ($quan->quantitativedetails as $details1) {
                        foreach ($ingredient as $ingre) {
                            if ($details1->nl_id == $ingre->nl_id) {
                                if ($ingre->nl_slcl > ($details1->ctdl_sl * $v_content['qty'])) {
                                    $ingre->nl_slcl =  $ingre->nl_slcl -  ($details1->ctdl_sl * $v_content['qty']);
                                    $ingre->nl_slsd += ($details1->ctdl_sl * $v_content['qty']);
                                    $ingre->update();
                                } else {
                                   
                                    $nl_kdu .= ' ' . $ingre->nl_ten;
                                }
                            }
                        }
                    }
                }
            }
        }
        foreach ($quantitative as $quan) {
            foreach ($order_again as $v_content) {
                if ($v_content['id'] ==  $quan->ma_id) {
                    foreach ($quan->quantitativedetails as $details1) {
                        foreach ($ingredient as $ingre) {
                            if ($details1->nl_id == $ingre->nl_id) {
                                if ($ingre->nl_slcl > ($details1->ctdl_sl * $v_content['qty'])) {
                                } else {
                                    Toastr::warning('Nguyên liệu ' .  $nl_kdu . ' không đủ!', 'Thông báo');
                                    return redirect()->back();
                                }
                            }
                        }
                    }
                }
            }
        }


        //Cập nhật hóa đơn
        $admin_id = Auth::id();
        $order = Order::find($order_id);
        $order->nv_id = $admin_id;
        $shift_id =   $order->phienlamviec_id;

        //Cập nhật phiên
        $shift = Shift::find($shift_id);
        $shift->phienlamviec_dt +=  ((int)$request->total_order  * 1000) - (int)$order->hoadon_tongtien;
        $shift->save();

        //Cập nhật hóa đơn
        $order->ban_id = $request->table_order;
        $order->khachhang_id = $request->customer_order;
        $order->hoadon_tinhtrang = 0;
        $order->hoadon_httt = 0;
        $order->hoadon_tongtien = (int)$request->total_order * 1000;
        $order->hoadon_ghichu = $request->note_order;
        $order->update();

        //Cập nhật bàn
        $table = Table::find($request->table_order);
        $table->ban_tinhtrang = 1;
        $table->update();



        //Thêm món
        $product = Product::all();
        $orderdetails = Orderdetails::where('hoadon_id', $order_id)->get();



        //Lưu chi tiết giỏ hàng
        $item = Orderdetails::where('hoadon_id', $order_id)->delete();
        if ($content) {
            foreach ($content as $v_content) {
                $orderdetails = new Orderdetails();
                $orderdetails->hoadon_id = $order_id;
                $orderdetails->ma_id = $v_content['ID'];
                $orderdetails->cthoadon_slsp = $v_content['quantity'];
                $orderdetails->cthoadon_giasp = $v_content['price'];
                $orderdetails->save();
            }
        }


        $data = [
            'order' => $order,
            'order_again' => $order_again,
        ];


        $pdf = PDF::loadView('admin.pos.invoice3', $data);
        $time = Carbon::now()->format('s');
        Storage::put('public/storage/uploads_phieuchebien/' . 'HD_' . '' . $order_id  . '_Time_' . $time .   '.' . 'pdf', $pdf->output());
        Session::forget('cart1');
        Session::forget('order_id');
        Toastr::success('Lưu hóa đơn thành công, phiếu chế biến sẽ được xuất ở nhà bếp', 'Thông báo');
        NoticeEvent::dispatch($order->table->ban_ten . ' vừa gọi thêm món ăn!');

        return Redirect::to('/dashboard');
    }

    public function details_order_dashboard(Request $request)
    {
        $order = Order::find($request->order_id_again);
        return view('admin.pos.detail_order', compact('order'));
    }
    public function order_complete($order_id)
    {
        $order = Order::find($order_id);
        $order->hoadon_tinhtrang = 1;
        $order->save();

        Toastr::success('Món ăn đã xong !', 'Thông báo');
        NoticeEvent::dispatch('Món ăn bàn ' . $order->table->ban_ten . ' đã xong');
        return redirect('/dashboard');
    }

    public function confirm_order($order_id)
    {
        $order = Order::find($order_id);
        $order->hoadon_tinhtrang = 2;
        $order->save();

        Toastr::success('Xác nhận món ăn đã xong !', 'Thông báo');
        NoticeEvent::dispatch('Xác nhận món ăn ' . $order->table->ban_ten . ' thành công!');
        return redirect('/dashboard');
    }
    public function unaccept_order($order_id)
    {
        $order = Order::find($order_id);
        $order->hoadon_tinhtrang = 0;
        $order->save();
        Toastr::success('Không xác nhận món ăn thành công!', 'Thông báo');
        NoticeEvent::dispatch($order->table->ban_ten . ' vừa không xác nhận món ăn!');

        return redirect('/dashboard');
    }
    public function change_table(Request $request, $table_id)
    {
        $order = Order::find($request->order_id);
        $order->ban_id = $table_id;
        $order->save();

        $table = Table::find($request->table_old);
        $table->ban_tinhtrang = 0;
        $table->save();

        $table1 = Table::find($table_id);
        $table1->ban_tinhtrang = 1;
        $table1->save();

        Toastr::success('Đổi bàn thành công', 'Thông báo');
        return redirect('/dashboard');
    }
}
