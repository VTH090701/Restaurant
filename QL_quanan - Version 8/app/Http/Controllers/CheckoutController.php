<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
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
use PDF;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Statictical;

class CheckoutController extends Controller
{

    public function payment_order($order_id)
    {

        $order = Order::find($order_id);
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $coupon = Coupon::where('gg_soluong', '>', 0)->wheredate('gg_ngaykt', '>', $today)->get();
        return view('admin.pos.checkout', compact('order', 'coupon'));
    }
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }


    public function payment_order_store(Request $request)
    {
        $order = Order::find($request->order_id);

        $total = 0;
        $coupon_session = Session::get('coupon');

        if ($coupon_session) {
            foreach ($coupon_session as $cou) {
                if ($cou['coupon_condition'] == 1) {
                    $total = $order->hoadon_tongtien -  $cou['coupon_number'];
                } else {
                    $total = $order->hoadon_tongtien - ($order->hoadon_tongtien * $cou['coupon_number']) / 100;
                }
            }
        } else {
            $total =  $order->hoadon_tongtien;
        }


        if ($request->payment_method == 2) {
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán qua MoMo";
            $amount = $total;
            $orderId = time() . "";
            $redirectUrl = "http://127.0.0.1:8000/kqthanhtoanmomo";
            $ipnUrl = "http://127.0.0.1:8000/kqthanhtoanmomo";
            $extraData = $order->hoadon_id;
            $requestId = time() . "";
            $requestType = "captureWallet";
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);

            $data = array(
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );


            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);  // decode json
            return redirect()->to($jsonResult['payUrl']);
        } elseif ($request->payment_method == 4) {
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://127.0.0.1:8000/kqthanhtoanvnpay";
            $vnp_TmnCode = "SC5B8F5H"; //Mã website tại VNPAY 
            $vnp_HashSecret = "RFJKYLSGOGCBOKGGISNAQCZZZLYAXUAC"; //Chuỗi bí mật

            $vnp_TxnRef = $order->hoadon_id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Thanh toán hóa đơn';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $total * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = '';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            //Add Params of 2.0.1 Version

            //$vnp_ExpireDate = $_POST['txtexpire'];

            //Billing
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef
                // "vnp_ExpireDate" => $vnp_ExpireDate,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }
            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array(
                'code' => '00', 'message' => 'success', 'data' => $vnp_Url
            );
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
        } else {
            $coupon_session = Session::get('coupon');

            if ($coupon_session) {
                foreach ($coupon_session as $cou) {
                    $order->gg_id = $cou['coupon_id'];
                    if ($cou['coupon_condition'] == 1) {
                        $order->hoadon_tongtien = $order->hoadon_tongtien -  $cou['coupon_number'];
                    } else {
                        $order->hoadon_tongtien = $order->hoadon_tongtien - ($order->hoadon_tongtien * $cou['coupon_number']) / 100;
                    }

                    $coupon = Coupon::find($cou['coupon_id']);
                    $coupon->gg_soluong = $coupon->gg_soluong - 1;
                    $coupon->update();
                }
            }


            $order->hoadon_httt = $request->payment_method;
            $order->hoadon_tinhtrang = 3;
            $order->update();

            $table = Table::find($request->ban_id);
            $table->ban_tinhtrang = 0;
            $table->update();


            //Cập nhật doanh thu
            $order_date = Carbon::parse($order->created_at);

            $statistic = Statictical::whereDate('thongke_ngay', $order_date->format('Y-m-d'))->get();

            if ($statistic) {
                $statistic_count = $statistic->count();
            } else {
                $statistic_count = 0;
            }
            $tsl = 0;
            foreach ($order->orderdetails as $item) {
                $tsl += $item->cthoadon_slsp;
            }


            if ($statistic_count > 0) {
                $statistic_update = Statictical::whereDate('thongke_ngay', $order_date->format('Y-m-d'))->first();
                $statistic_update->thongke_dt +=   $order->hoadon_tongtien;
                $statistic_update->thongke_sl +=  $tsl;
                $statistic_update->thongke_thd += 1;
                $statistic_update->update();
            } else {
                $statistic_new = new Statictical();
                $statistic_new->thongke_ngay = $order_date;
                $statistic_new->thongke_dt = $order->hoadon_tongtien;
                $statistic_new->thongke_sl =  $tsl;
                $statistic_new->thongke_thd =  1;
                $statistic_new->thongke_cp =  0;

                $statistic_new->save();
            }

            Session::forget('coupon');
            Toastr::success('Thanh toán thành công', 'Thông báo');
            return Redirect::to('/dashboard');
        }
    }




    public function kqthanhtoanmomo()
    {
        $order_id = 0;
        if ($_GET['resultCode'] == 0) {
            // echo 'thanh toán thành công';
            $order_id = $_GET['extraData'];

            $order = Order::find($order_id);
            $coupon_session = Session::get('coupon');

            if ($coupon_session) {
                foreach ($coupon_session as $cou) {
                    $order->gg_id = $cou['coupon_id'];

                    if ($cou['coupon_condition'] == 1) {
                        $order->hoadon_tongtien = $order->hoadon_tongtien -  $cou['coupon_number'];
                    } else {
                        $order->hoadon_tongtien = $order->hoadon_tongtien - ($order->hoadon_tongtien * $cou['coupon_number']) / 100;
                    }
                }
                $coupon = Coupon::find($cou['coupon_id']);
                $coupon->gg_soluong = $coupon->gg_soluong - 1;
                $coupon->update();
            }

            $order->hoadon_httt = 2;
            $order->hoadon_tinhtrang = 3;
            $order->update();

            $table = Table::find($order->ban_id);
            $table->ban_tinhtrang = 0;
            $table->update();

            //Cập nhật doanh thu
            $order_date = Carbon::parse($order->created_at);

            $statistic = Statictical::whereDate('thongke_ngay', $order_date->format('Y-m-d'))->get();

            if ($statistic) {
                $statistic_count = $statistic->count();
            } else {
                $statistic_count = 0;
            }
            $tsl = 0;
            foreach ($order->orderdetails as $item) {
                $tsl += $item->cthoadon_slsp;
            }

            if ($statistic_count > 0) {
                $statistic_update = Statictical::whereDate('thongke_ngay', $order_date->format('Y-m-d'))->first();
                $statistic_update->thongke_dt +=   $order->hoadon_tongtien;
                $statistic_update->thongke_sl +=  $tsl;
                $statistic_update->thongke_thd += 1;
                $statistic_update->update();
            } else {
                $statistic_new = new Statictical();
                $statistic_new->thongke_ngay = $order_date;
                $statistic_new->thongke_dt = $order->hoadon_tongtien;
                $statistic_new->thongke_sl =  $tsl;
                $statistic_new->thongke_thd =  1;
                $statistic_new->thongke_cp =  0;
                $statistic_new->save();
            }
            Session::forget('coupon');
            Toastr::success('Thanh toán thành công', 'Thông báo');
            return Redirect::to('/dashboard');
        } else {

            Session::forget('coupon');
            Toastr::error('Thanh toán thất bại', 'Thông báo');
            return Redirect::to('/dashboard');
        }
    }
    public function print_invoice($order_id)
    {
        $order = Order::find($order_id);
        return view('admin.pos.invoice1')->with('order', $order);;
    }


    public function kqthanhtoanvnpay()
    {
        $order_id = 0;
        if ($_GET['vnp_TransactionStatus'] == 00) {
            $order_id = $_GET['vnp_TxnRef'];
            $order = Order::find($order_id);
            $coupon_session = Session::get('coupon');
            if ($coupon_session) {
                foreach ($coupon_session as $cou) {
                    $order->gg_id = $cou['coupon_id'];

                    if ($cou['coupon_condition'] == 1) {
                        $order->hoadon_tongtien = $order->hoadon_tongtien -  $cou['coupon_number'];
                    } else {
                        $order->hoadon_tongtien = $order->hoadon_tongtien - ($order->hoadon_tongtien * $cou['coupon_number']) / 100;
                    }
                }
                $coupon = Coupon::find($cou['coupon_id']);
                $coupon->gg_soluong = $coupon->gg_soluong - 1;
                $coupon->update();
            }

            $order->hoadon_httt = 4;
            $order->hoadon_tinhtrang = 3;
            $order->update();

            $table = Table::find($order->ban_id);
            $table->ban_tinhtrang = 0;
            $table->update();

            //Cập nhật doanh thu
            $order_date = Carbon::parse($order->created_at);

            $statistic = Statictical::whereDate('thongke_ngay', $order_date->format('Y-m-d'))->get();

            if ($statistic) {
                $statistic_count = $statistic->count();
            } else {
                $statistic_count = 0;
            }
            $tsl = 0;
            foreach ($order->orderdetails as $item) {
                $tsl += $item->cthoadon_slsp;
            }


            if ($statistic_count > 0) {

                $statistic_update = Statictical::whereDate('thongke_ngay', $order_date->format('Y-m-d'))->first();
                $statistic_update->thongke_dt +=   $order->hoadon_tongtien;
                $statistic_update->thongke_sl +=  $tsl;
                $statistic_update->thongke_thd += 1;
                $statistic_update->update();
            } else {
                $statistic_new = new Statictical();
                $statistic_new->thongke_ngay = $order_date;
                $statistic_new->thongke_dt = $order->hoadon_tongtien;
                $statistic_new->thongke_sl =  $tsl;
                $statistic_new->thongke_thd =  1;
                $statistic_new->thongke_cp =  0;
                $statistic_new->save();
            }
            Session::forget('coupon');
            Toastr::success('Thanh toán thành công', 'Thông báo');
            return Redirect::to('/dashboard');
        } else {

            Session::forget('coupon');
            Toastr::error('Thanh toán thất bại', 'Thông báo');
            return Redirect::to('/dashboard');
        }
    }
}
