<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use App\Models\Orderdetails;
use App\Models\Table;
use App\Models\Customer;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Builder;
use PDF;
use Brian2694\Toastr\Facades\Toastr;

class OrderController extends Controller
{
    public function all_order()
    {
        $all_ord = Order::all();
        return view('admin.order.all_order', compact('all_ord'));
    }
    public function get_all_order(Request $request)
    {

        if ($request->start_date && $request->end_date) {
            $order = Order::whereDate('hoadon_ngaytao', '>=', $request->start_date)
                ->whereDate('hoadon_ngaytao', '<=', $request->end_date)->orderBy('hoadon_ngaytao','DESC');
        } else {
            $order = Order::select('*')->orderBy('hoadon_ngaytao','DESC');
        }

        return DataTables::of($order)
            ->addIndexColumn()
            ->addColumn('action', function ($order) {
                return '<a href="' . route('details_order', $order->hoadon_id) . '">
            <i class="fa fa-eye" aria-hidden="true" style="color:blue; "></i></a>
            |
            <a onclick="return myFunction();" href="' . route('delete_order', $order->hoadon_id) . '">
            <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i></a>
            |
            <a href="' . route('print_order', $order->hoadon_id) . '">
            <i class="fa fa-print" aria-hidden="true" style="color: orange;"></i>
            </a>
            ';

            })
            ->addColumn('ten_kh', function ($order) {
                return $order->customers->khachhang_ten;
            })
            ->addColumn('tongtien', function ($order) {
                return number_format($order->hoadon_tongtien) . ' ' . 'VNĐ';
            })
            ->addColumn('ban', function ($order) {
                return $order->tables->ban_ten;
            })
            ->addColumn('nv', function ($order) {
                return $order->admins->nv_ten;
            })
           
            ->addColumn('status', function ($order) {
                if ($order->hoadon_tinhtrang == 0) {
                    return '<span class="badge badge-danger" style="font-size: 13px">Vừa gọi
                    món</span>';
                } elseif ($order->hoadon_tinhtrang == 1) {
                    return '<span class="badge badge-warning"
                    style="font-size: 13px">Bếp đã xong</span>';
                } elseif ($order->hoadon_tinhtrang == 2) {
                    return '<span class="badge badge-primary"
                    style="font-size: 13px">Hoàn tất</span>';
                } else {
                    return '<span class="badge badge-success"
                    style="font-size: 13px">Đã thanh toán</span>';
                }
            })
            ->rawColumns(['tongtien', 'created', 'ban', 'nv', 'ten_kh', 'status', 'action'])
            ->make(true);
    }
    public function details_ordtomer($order_id)
    {
        $order = Order::find($order_id);
        return view('admin.order.details_order', compact('order'));
    }

    public function delete_ordtomer($order_id)
    {
        $order = Order::find($order_id);
        $order->delete();
        Toastr::success('Xóa hóa đơn thành công', 'Thông báo');

        return Redirect::to('/all-order');
    }
    public function print_order($order_id)
    {
        if (Order::find($order_id)) {
            $order = Order::find($order_id);
            $data = [
                'order' => $order,
            ];
            $pdf = PDF::loadView('admin.pos.invoice4', $data);
            return $pdf->download('hoadon.pdf');
        }
        return redirect('/all-order');
    }
}
