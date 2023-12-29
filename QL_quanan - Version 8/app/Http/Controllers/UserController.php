<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use App\Models\Table;
use App\Models\Reservation;
use App\Models\City;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ReservationStoreRequest;
use App\Models\Admin;
use App\Models\Gallery;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
class UserController extends Controller
{
    public function index()
    {
        $pro_drink = Product::where('danhmuc_id', '5')->get();
        $pro_main = Product::where('danhmuc_id', '3')->orwhere('danhmuc_id', '4')->orwhere('danhmuc_id', '12')->get();
        $admin = DB::select('SELECT * FROM nhanvien,ctquyen WHERE nhanvien.nv_id=ctquyen.nv_id AND ctquyen.quyen_id = 3;');

        return view('user.dashboard_user', compact('pro_drink', 'pro_main','admin'));
    }
    public function step_one(Request $request)
    {
        $reservation = $request->session()->get('reservation');
        $min_date = Carbon::today();
        $max_date = Carbon::now()->addWeek();
        return view('user.reservation.step_one', compact('reservation', 'min_date', 'max_date'));
    }
    public function step_one_store(Request $request)
    {
        $validated = $request->validate([
            'datban_ten' => ['required'],
            'datban_email' => ['required'],
            'datban_sdt' => ['required'],
            'datban_thoigian' => ['required', 'date', new DateBetween, new TimeBetween],
            'datban_slnguoi' => ['required'],
            'khachhang_id' => ['required'],
            'datban_tinhtrang' => ['required'],
            'datban_kt' => ['required'],

        ]);

        if (empty($request->session()->get('reservation'))) {
            $reservation = new Reservation();
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);
        } else {
            $reservation = $request->session()->get('reservation');
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);
        }

        return to_route('steptwo');
    }
    public function step_two(Request $request)
    {
        $reservation = $request->session()->get('reservation');
        $earliestTime1 = Carbon::createFromTimeString('13:00:00');
        $lastTime1 = Carbon::createFromTimeString('16:00:00');
        $earliestTime = Carbon::createFromTimeString('17:00:00');
        $lastTime = Carbon::createFromTimeString('21:00:00');
        $reservations = Reservation::all();
        $table_id = 0;
        foreach ($reservations as $key => $res) {
            if (Carbon::parse($res->datban_thoigian)->format('Y-m-d') ==  Carbon::parse($reservation->datban_thoigian)->format('Y-m-d')) {
                if (
                    $earliestTime1->format('H:i:s') < Carbon::parse($reservation->datban_thoigian)->format('H:i:s')  &&  Carbon::parse($reservation->datban_thoigian)->format('H:i:s') < $lastTime1->format('H:i:s')
                    &&
                    $earliestTime1->format('H:i:s') < Carbon::parse($res->datban_thoigian)->format('H:i:s')  &&  Carbon::parse($res->datban_thoigian)->format('H:i:s') < $lastTime1->format('H:i:s')
                    && $res->datban_tinhtrang == 1
                ) {
                    $table_id = $reservations->ban_id;
                } elseif (
                    $earliestTime->format('H:i:s') < Carbon::parse($reservation->datban_thoigian)->format('H:i:s')  &&  Carbon::parse($reservation->datban_thoigian)->format('H:i:s') < $lastTime->format('H:i:s')
                    &&
                    $earliestTime->format('H:i:s') < Carbon::parse($res->datban_thoigian)->format('H:i:s')  &&  Carbon::parse($res->datban_thoigian)->format('H:i:s') < $lastTime->format('H:i:s')
                    && $res->datban_tinhtrang == 1
                ) {
                    $table_id = $res->ban_id;
                    //echo $res->ban_id;
                }
            }


        }

        // $res_table_ids = Reservation::orderby('datban_thoigian')->get()->filter(function ($value) use ($reservation) {
        //     return Carbon::parse($value->datban_thoigian)->format('Y-m-d') == Carbon::parse($reservation->datban_thoigian)->format('Y-m-d');
        // })->pluck('ban_id');

        $table = Table::where('ban_dat', '0')
            ->where('ban_slnguoi', '>=', $reservation->datban_slnguoi)
            ->whereNotIn('ban_id', [$table_id] )
            ->get();
        return view('user.reservation.step_two', compact('reservation', 'table'));
    }



    public function step_two_store(Request $request)
    {
        $validated = $request->validate([
            'ban_id' => ['required'],
        ]);
        $reservation = $request->session()->get('reservation');
        $reservation->fill($validated);
        $reservation->save();

        // $table = Table::find($request->ban_id);
        // $table->ban_dat = 1;
        // $table->save();

        $request->session()->forget('reservation');
    }

    public function dang_nhap()
    {
        return view('user.login.login');
    }
    public function dang_ky()
    {
        // $city = City::orderby('matp', 'ASC')->get();
        return view('user.login.regester');
    }
    public function dang_nhap_store(Request $request)
    {


        $this->validate($request, [
            'kh_email' => 'required|email',
            'kh_pass' => 'required'
        
        ],[
            'kh_email.required' => 'Email không được để trống',
            'kh_email.email' => 'Email phải đúng định dạng',
            'kh_pass.required' => 'Mật khẩu không được để trống'

        ]);
        
        $kh_email = $request->kh_email;
        $kh_pass = md5($request->kh_pass);

     
        if (DB::table('khachhang')->where('khachhang_email', $kh_email)->where('khachhang_matkhau', $kh_pass)
            ->where('khachhang_trangthai', 1)->first()) 
        {
            $result = DB::table('khachhang')->where('khachhang_email', $kh_email)->where('khachhang_matkhau', $kh_pass)
                ->where('khachhang_trangthai', 1)->first();
            Session::put('customer_id', $result->khachhang_id);
            Session::put('customer_name', $result->khachhang_ten);
            Session::put('customer_image', $result->khachhang_hinhanh);
            return Redirect::to('/step-one');
        }elseif(DB::table('khachhang')->where('khachhang_email', $kh_email)->where('khachhang_matkhau', $kh_pass)
        ->where('khachhang_trangthai', 0)->first()){
            Session::put('mess', 'Tài khoản này hiện đang bị khóa');
            return Redirect::to('/dang-nhap');
        } 
        else {
            Session::put('mess', 'Mật khẩu hoặc tài khoản của bạn bị sai! Hãy thử lại');
            return Redirect::to('/dang-nhap');
        }
    }
    public function dang_ky_store(Request $request)
    {
        $this->validate($request, [
            'kh_name' => 'required',
            'kh_phone' => 'required',
            'kh_email' => 'required|email',
            'kh_pass' => 'required',
            'kh_image' => 'required',
            'location' => 'required',

        ],[
            'kh_email.required' => 'Email không được để trống',
            'kh_email.email' => 'Email phải đúng định dạng',
            'kh_name.required' => 'Tên không được để trống',
            'kh_phone.required' => 'Số điện thoại không được để trống',
            // 'kh_phone.integer' => 'Số điện thoại phải là chữ số',
            // 'kh_phone.max' => 'Số điện thoại giới hạn 12 chữ số',
            'kh_pass.required' => 'Mật khẩu không được để trống',
            'kh_image.required' => 'Hình ảnh không được để trống',
            'location.required' => 'Địa chỉ không được để trống',

        ]);





        $diachi = $request->result;
        $diachi .= ', ';
        $diachi .= $request->location;


        $customer = new Customer();
        $customer->khachhang_ten = $request->kh_name;
        $customer->khachhang_sdt = $request->kh_phone;
        $customer->khachhang_email = $request->kh_email;
        $customer->khachhang_matkhau  = md5($request->kh_pass);
        $customer->khachhang_diachi  = $diachi;
        $customer->khachhang_trangthai = 1;
        $customer->khachhang_hinhanh  = $request->kh_image;
        $customer->save();



        Session::put('mess', 'Đăng ký thành công');
        return Redirect::to('/dang-nhap');
    }

    public function dang_xuat()
    {
        Session::put('customer_id', null);
        Session::put('customer_name', null);
        Session::put('customer_image', null);

        return Redirect::to('/');
    }
    public function hoso()
    {
        $customer_id = Session::get('customer_id');
        $customer = Customer::find($customer_id);
        return view('user.hoso', compact('customer'));
    }
    public function hoso_update(Request $request)
    {

        $diachi1 = $request->result1;
        // $diachi1 .= ', ';
        $diachi1 .= $request->location1;

        $customer_id = Session::get('customer_id');
        $customer = Customer::find($customer_id);

        if ($diachi1 != '') {
            $customer->khachhang_diachi = $diachi1;
        } else {
            $customer->khachhang_diachi =   $customer->khachhang_diachi;
        }

        $customer->khachhang_ten = $request->cus_name;
        $customer->khachhang_email = $request->cus_email;
        $customer->khachhang_sdt = $request->cus_phone;






        $get_image = $request->file('cus_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $get_name_image;
            $get_image->move('public/upload/hoso_nv', $new_image);
            $customer->khachhang_hinhanh = $new_image;
            $customer->update();
            Session::put('mess', 'Cập nhật hồ sơ thành công');
            return Redirect::to('/hoso');
        }

        $customer->update();
        Session::put('mess', 'Cập nhật hồ sơ thành công');
        return Redirect::to('/hoso');
    }
    public function hoso_password_update(Request $request)
    {

        $customer = Customer::find($request->pass_id);
        if ($customer) {
            if ($customer->khachhang_matkhau == $request->pass_old) {
                $customer->khachhang_matkhau = $request->pass_new;
                $customer->save();
                Session::put('success', 'Cập nhật mật khẩu thành công');
                return Redirect::to('/hoso');
            } else {
                Session::put('error', 'Mật khẩu cũ của bạn không đúng');
                return Redirect::to('/hoso');
            }
        }
    }
    public function menu()
    {
        $pro_drink = Product::where('danhmuc_id', '18')->get();
        $pro_main = Product::where('danhmuc_id', '3')->orwhere('danhmuc_id', '4')->orwhere('danhmuc_id', '12')->get();
        $pro_all = Product::all();

        return view('user.menu.menu', compact('pro_drink', 'pro_main','pro_all'));
    }
    public function about_us()
    {
        return view('user.about.about_us');
    }
    public function contact()
    {
        return view('user.contact.contact');
    }
    public function get_list_reservation(Request $request)
    {
        $customer_id = Session::get('customer_id');
       

        if ($request->start_date && $request->end_date) {
            $reservation = Reservation::where('khachhang_id', $customer_id)->whereDate('datban_thoigian', '>=', $request->start_date)
                ->whereDate('datban_thoigian', '<=', $request->end_date)->orderBy('datban_id', 'DESC');
        } else {
            $reservation = Reservation::where('khachhang_id', $customer_id)->orderBy('datban_id', 'DESC');
        }


        return DataTables::of($reservation)
        ->addIndexColumn()
        ->addColumn('action', function ($reservation) {
        if(Carbon::now() < $reservation->datban_thoigian){
            if($reservation->datban_tinhtrang == 0){

                  return '   <a href="' . route('edit_reservation_customer', $reservation->datban_id) . '">
                <i class="fa fa-edit" aria-hidden="true" style="color:blue; "></i></a>|
                <a onclick="return myFunction();" href="' . route('delete_reservation_customer', $reservation->datban_id) . '"
                >
                <i class="fa fa-trash" aria-hidden="true" style="color: red;"></i></a>';
            }else{
                return '';
            }
          
        }else{
           
            return '';
        }
        })


        ->addColumn('ban', function ($reservation) {
            return $reservation->table->ban_ten;
        })
        ->addColumn('tinhtrang', function ($reservation) {
            if($reservation->datban_tinhtrang == '0'){
                return 'Chờ duyệt';
            }elseif($reservation->datban_tinhtrang == '1') {
                 return 'Đã duyệt';
            }else{
                return 'Đã hủy';
            }
        })
        ->addColumn('tinhtrang1', function ($reservation) {
            if(Carbon::now() < $reservation->datban_thoigian){
                return 'Gần đây';
            }else{
                 return 'Đã hết hạn';
            }
        })
        ->rawColumns(['ban', 'action','tinhtrang','tinhtrang1'])
        ->make(true);



    }
    public function list_reservation()
    {

        $customer_id = Session::get('customer_id');
        $reservations = Reservation::where('khachhang_id', $customer_id)->orderBy('datban_id', 'DESC')->get();
        return view('user.reservation.list_reservation', compact('reservations'));
    }

    public function edit_reservation_customer($reservation_id)
    {
        $table = Table::where('ban_dat', '0')->where('ban_slnguoi','>',0)->get();
        $reservation = Reservation::find($reservation_id);
        return view('user.reservation.edit_reservation_user', compact('reservation', 'table'));
    }
    public function update_reservation_user(ReservationStoreRequest $request, $reservation_id)
    {

        // $reservation = Reservation::find($reservation_id);
        // $table = Table::findOrFail($request->ban_id);
        // if ($request->datban_slnguoi > $table->ban_slnguoi) {
        //     return back()->with('warning', 'Vui Lòng chọn bàn căn cứ vào số lượng khách hàng');
        // }

        // //Kiểm tra lịch đặt có trùng không
        // $request_date = Carbon::parse($request->datban_thoigian);
        // $reservations = $table->reservations()->where('datban_id', '!=', $reservation->datban_id)->get();
        // foreach ($reservations as $key => $res) {
        //     if (Carbon::parse($res->datban_thoigian)->format('Y-m-d') == $request_date->format('Y-m-d')) {
        //         return back()->with('warning', 'Bàn này dành riêng cho ngày này');
        //     }
        // }
        // // Reservation::create($request->validated());
        // $reservation->update($request->validated());
        // Session::put('mess', 'Cập nhật lịch đặt bàn thành công');
        // return Redirect::to('/list-reservation');








        $reservation = Reservation::find($reservation_id);

        $table = Table::findOrFail($request->ban_id);
        if ($request->datban_slnguoi > $table->ban_slnguoi) {
            //return back()->with('warning', 'Vui Lòng chọn bàn căn cứ vào số lượng khách hàng');
            return back()->with('warning', 'Vui Lòng chọn bàn căn cứ vào số lượng khách hàng');
        }


        $earliestTime1 = Carbon::createFromTimeString('13:00:00');
        $lastTime1 = Carbon::createFromTimeString('16:00:00');

        $earliestTime = Carbon::createFromTimeString('17:00:00');
        $lastTime = Carbon::createFromTimeString('21:00:00');

        //Kiểm tra lịch đặt có trùng không
        $request_date = Carbon::parse($request->datban_thoigian);
        
        $reservations = $table->reservations()->where('datban_id', '!=', $reservation->datban_id)->get();
        foreach ($reservations as $key => $res) {


            // if (Carbon::parse($res->datban_thoigian)->format('Y-m-d') == $request_date->format('Y-m-d')) {
            //     Toastr::warning('Bàn này dành riêng cho ngày này', 'Thông báo');
            //     return redirect()->back();
            // }

            if (Carbon::parse($res->datban_thoigian)->format('Y-m-d') == $request_date->format('Y-m-d')) {
                if (
                    $earliestTime1->format('H:i:s') < $request_date->format('H:i:s')  &&  $request_date->format('H:i:s') < $lastTime1->format('H:i:s')
                    &&
                    $earliestTime1->format('H:i:s') < Carbon::parse($res->datban_thoigian)->format('H:i:s')  &&  Carbon::parse($res->datban_thoigian)->format('H:i:s') < $lastTime1->format('H:i:s')
                    && $res->datban_tinhtrang == 1
                ) {
                    return back()->with('warning', 'Bàn này dành riêng cho trưa này');
                } elseif (
                    $earliestTime->format('H:i:s') < $request_date->format('H:i:s')  &&  $request_date->format('H:i:s') < $lastTime->format('H:i:s')
                    &&
                    $earliestTime->format('H:i:s') < Carbon::parse($res->datban_thoigian)->format('H:i:s')  &&  Carbon::parse($res->datban_thoigian)->format('H:i:s') < $lastTime->format('H:i:s')
                    && $res->datban_tinhtrang == 1
                ) {
                    return back()->with('warning', 'Bàn này dành riêng cho tối này');
                }
            }



        }


        $reservation->update($request->validated());
        Session::put('mess', 'Cập nhật lịch đặt bàn thành công');
        return Redirect::to('/list-reservation');

        return Redirect::to('/all-reservation');
    }
    public function delete_reservation_customer($reservation_id)
    {
      
        $reservation = Reservation::find($reservation_id);
        $reservation->datban_tinhtrang = 2;
        $reservation->update();
        // $reservation = Reservation::find($reservation_id);
        // $reservation->delete();

        // $table = Table::find($reservation->ban_id);
        // $table->ban_dat = 0;
        // $table->save();

        Session::put('mess', 'Hủy lịch đặt bàn thành công');
        return Redirect::to('/list-reservation');
    }
    public function forget_password()
    {
        return view('user.forget_password_user');
    }

    public function post_forget_password(Request $request)
    {
        $request->validate([
            'khachhang_email' => 'required|exists:khachhang'
        ], [
            'khachhang_email.required' => 'Vui lòng nhập địa chỉ email hợp lệ',
            'khachhang_email.exists' => 'Email này không tồn tại trong hệ thống'
        ]);
        $token = strtoupper(Str::random(10));
        $customer = Customer::where('khachhang_email', $request->khachhang_email)->first();
        $customer->update(['khachhang_token' => $token]);


        Mail::send('user.check_email_forget', compact('customer'), function ($email) use ($customer) {
            $email->subject('TH Restaurant - Lấy lại mật khẩu tài khoản');
            $email->to($customer->khachhang_email, $customer->khachhang_ten);
        });
        return redirect()->back()->with('mess', 'Vui lòng check email để thực hiện thay đổi mật khẩu');
    }
    public function get_password(Customer $customer, $token)
    {
        if ($customer->khachhang_token == $token) {
            $customers = Customer::find($customer)->first();
            return view('user.get_password', compact('customers'));
        }
        return abort(404);
    }

    public function post_get_password(Customer $customer, $token, Request $request)
    {

        $request->validate([
            'khachhang_matkhau' => 'required',
            'khachhang_matkhau_confirm' => 'required|same:khachhang_matkhau',
        ]);

        $password_new = $request->khachhang_matkhau;
        $customer->update(['khachhang_matkhau' => $password_new, 'khachhang_token' => null]);
        return redirect('/dang-nhap')->with('mess', 'Đổi mật khẩu thành công');
    }

    public function menudetails($menu_id)
    {

        $product_selling = DB::select('SELECT monan.ma_id, SUM(cthoadon_slsp) AS "total" FROM monan , cthoadon WHERE monan.ma_id = cthoadon.ma_id AND monan.ma_id =16 GROUP BY monan.ma_id ORDER BY SUM(cthoadon_slsp);');
        
        $customer = DB::select('SELECT khachhang_id FROM hoadon , cthoadon WHERE cthoadon.hoadon_id = hoadon.hoadon_id AND cthoadon.ma_id = "' . $menu_id . '" ;');

        $details_product = DB::table('monan')->join('danhmuc', 'danhmuc.danhmuc_id', '=', 'monan.danhmuc_id')->where('monan.ma_id', $menu_id)->get();

        $menu = Product::find($menu_id);

        $gallery = Gallery::where('ma_id', $menu_id)->get();


        foreach ($details_product as $key => $value) {

            $cate_id = $value->danhmuc_id;
        }

        $related_product = DB::table('monan')->join('danhmuc', 'danhmuc.danhmuc_id', '=', 'monan.danhmuc_id')->where('danhmuc.danhmuc_id', $cate_id)->whereNotIn('monan.ma_id', [$menu_id])->get();

        return view('user.menu.details_menu', compact('menu', 'gallery', 'related_product', 'customer','product_selling'));
    }
    public function notify_error_comment()
    {
        
        return redirect()->back()->with('mess', 'Bạn chưa có sử dụng món ăn này nên không thể bình luận');
    }

    public function search_customer(Request $request){

        $product = DB::table('monan')->where('ma_ten', 'like', '%' . $request->_text . '%')->get();
        $searchComponent = view('user.menu.components.search_components', compact('product'))->render();
        return response()->json(['search_components' => $searchComponent, 'code' => 200], status: 200);
    }

    public function post(){
        $post = Post::where('baiviet_tinhtrang',1)->get();
        return view('user.post.all_post',compact('post'));
    }

    public function details_post($post_id){
        $post = Post::find($post_id);
        return view('user.post.details_post',compact('post'));
    }
 
}
