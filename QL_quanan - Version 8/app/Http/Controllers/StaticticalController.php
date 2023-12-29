<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Ingredient;
use App\Models\Order;
use App\Models\Product;
use App\Models\Receipt;
use App\Models\Reservation;
use App\Models\Shift;
use App\Models\Statictical;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StaticticalController extends Controller
{
    public function statictical(){
        
        $year = Carbon::now()->format('Y');
        $moth = Carbon::now()->format('m');   
        $product = DB::select('SELECT cthoadon.ma_id as id,cthoadon.cthoadon_giasp as gia, monan.ma_ten as ten ,monan.ma_hinhanh as hinhanh ,SUM(cthoadon.cthoadon_slsp) as soluong FROM monan ,cthoadon WHERE monan.ma_id = cthoadon.ma_id GROUP BY cthoadon.ma_id,cthoadon.cthoadon_giasp, monan.ma_ten,monan.ma_hinhanh ORDER BY SUM(cthoadon.cthoadon_slsp) DESC LIMIT 1;');

        $cate =  DB::select('SELECT SUM(thongke.thongke_dt) AS "total", SUM(thongke.thongke_sl) AS "quantity",SUM(thongke.thongke_thd) AS "totalorder" FROM thongke WHERE MONTH(thongke_ngay) = "'.$moth.'" AND YEAR(thongke_ngay) = "'.$year.'";');
        
        $cate1 =  DB::select('SELECT SUM(pnh_thanhtien) AS "total" FROM phieunhaphang WHERE MONTH(pnh_ngaylapphieu) = "'.$moth.'" AND YEAR(pnh_ngaylapphieu) = "'.$year.'";');

        return view('admin.statictical.statictical')->with('cate',$cate)->with('cate1',$cate1)->with('month',$moth)->with('product',$product);

    }
    public function filter_by_date(Request $request){
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $get = Statictical::whereBetween('thongke_ngay',[$from_date,$to_date])->orderBy('thongke_ngay','ASC')->get();
        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->thongke_ngay,
                'order' => $val->thongke_thd,
                'sales' => $val->thongke_dt,
                'quantity' => $val->thongke_sl
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function statictical_filter(Request $request){
        $data = $request->all();

       
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        
        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if( $request->statictical_value =='7ngay'){
            $get = Statictical::whereBetween('thongke_ngay', [$sub7days, $now])->orderBy('thongke_ngay', 'ASC')->get();
        }elseif( $request->statictical_value =='thangtruoc'){
            $get = Statictical::whereBetween('thongke_ngay', [$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('thongke_ngay', 'ASC')->get();
        }elseif( $request->statictical_value =='thangnay'){
            $get = Statictical::whereBetween('thongke_ngay', [$dauthangnay, $now])->orderBy('thongke_ngay', 'ASC')->get();
        }else{
            $get = Statictical::whereBetween('thongke_ngay', [$sub365days, $now])->orderBy('thongke_ngay', 'ASC')->get();
        }

        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->thongke_ngay,
                'order' => $val->thongke_thd,
                'sales' => $val->thongke_dt,
                'quantity' => $val->thongke_sl,
                'expense' => $val->thongke_cp

            );
        }
        echo $data = json_encode($chart_data);
    }

    public function days_order(){
        $sub30days= Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statictical::whereBetween('thongke_ngay', [$sub30days, $now])->orderBy('thongke_ngay', 'ASC')->get();
        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->thongke_ngay,
                'order' => $val->thongke_thd,
                'sales' => $val->thongke_dt,
                'quantity' => $val->thongke_sl
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function statistical_year(){

        
        $year = Carbon::now()->format('Y');
        $statistical_year = DB::select('SELECT (MONTH(thongke_ngay)) AS month,(YEAR(thongke_ngay)) AS year,
         SUM(thongke_dt) AS dt,SUM(thongke_sl) AS sl,SUM(thongke_cp) AS cp,SUM(thongke_thd) AS 
         thd FROM thongke WHERE YEAR(thongke_ngay) = "'.$year.'" GROUP BY month,year ORDER BY month,year ASC;');
         
        $year = DB::select('SELECT  (YEAR(thongke_ngay)) AS year FROM thongke GROUP BY year ORDER BY year DESC;');

        return view('admin.statictical.statistical_year' , compact('statistical_year','year'));

    }

    public function year_filter(Request $request){

        $statistical_year = DB::select('SELECT (MONTH(thongke_ngay)) AS month,(YEAR(thongke_ngay)) AS year, SUM(thongke_dt) AS dt,SUM(thongke_sl) AS sl,SUM(thongke_cp) AS cp,SUM(thongke_thd) AS thd FROM thongke WHERE YEAR(thongke_ngay) = "'.$request->statictical_value.'" GROUP BY month,year ORDER BY month,year ASC;');

        $statisticalComponent = view('admin.statictical.components.statistical_year', compact('statistical_year'))->render();
        return response()->json(['statistical_component' => $statisticalComponent, 'code' => 200], status: 200);


    }
    public function details_statistical_month(Request $request){
        
        $statistical_staff = DB::select('SELECT nhanvien.nv_ten as ten, nhanvien.nv_id as id , nhanvien.nv_ten as email , nhanvien.nv_sdt as phone ,SUM(hoadon.hoadon_tongtien) AS "tongdt" FROM hoadon,nhanvien WHERE hoadon.nv_id = nhanvien.nv_id AND MONTH(hoadon.created_at) = "'.$request->month.'" AND YEAR(hoadon.created_at) = "'.$request->year.'" GROUP BY ten,id,email,phone ORDER BY SUM(hoadon.hoadon_tongtien);');
        return view('admin.statictical.statistical_staff',compact('statistical_staff'));

    }
    
    public function statictical_data(){
        
        $product = Product::all()->count();
        $order = Order::all()->count();
        $staff = Admin::all()->count();
        $customer = Customer::all()->count();
        $shift = Shift::all()->count();
        $cate = Category::all()->count();
        $receipt = Receipt::all()->count();
        $reservation = Reservation::all()->count();

        $product_selling = DB::select('SELECT monan.ma_id, monan.ma_ten,monan.ma_hinhanh,monan.ma_gia, SUM(cthoadon_slsp) AS "total" FROM monan , cthoadon WHERE monan.ma_id = cthoadon.ma_id GROUP BY monan.ma_id,monan.ma_ten,monan.ma_hinhanh,monan.ma_gia ORDER BY SUM(cthoadon_slsp);');
        
        $staff_revenue = DB::select('SELECT nhanvien.nv_id, nhanvien.nv_ten , SUM(hoadon_tongtien) AS "total" FROM hoadon,nhanvien WHERE nhanvien.nv_id = hoadon.nv_id GROUP BY nhanvien.nv_id, nhanvien.nv_ten ORDER BY SUM(hoadon_tongtien) DESC ;');
        $customer_revenue = DB::select('SELECT khachhang.khachhang_id, khachhang.khachhang_ten , SUM(hoadon_tongtien) AS "total" FROM hoadon,khachhang WHERE khachhang.khachhang_id = hoadon.khachhang_id GROUP BY khachhang.khachhang_id, khachhang.khachhang_ten ORDER BY SUM(hoadon_tongtien) DESC;
        ');
        $res_revenue = DB::select('SELECT khachhang.khachhang_id, khachhang.khachhang_ten , COUNT(datban.datban_id) AS "count" FROM datban,khachhang WHERE khachhang.khachhang_id = datban.khachhang_id GROUP BY khachhang.khachhang_id, khachhang.khachhang_ten ORDER BY COUNT(datban.datban_id) DESC;
        ');
        $slcl = DB::select('SELECT COUNT(nguyenlieu.nl_id) AS "count" FROM nguyenlieu WHERE nguyenlieu.nl_slcl > 1;');
        $slhh = DB::select('SELECT COUNT(nguyenlieu.nl_id) AS "count" FROM nguyenlieu WHERE nguyenlieu.nl_slcl <= 1;');

        return view('admin.statictical.statictical_data' ,compact('product','cate',
        'order','staff','customer','shift','product_selling','staff_revenue','customer_revenue','receipt','reservation','res_revenue','slcl','slhh'));
    }

    public function details_staff_revenue($admin_id){

        $year = Carbon::now()->format('Y');
        $admin  = DB::select('SELECT nhanvien.nv_id ,nhanvien.nv_ten, (MONTH(hoadon.hoadon_ngaytao)) AS month,
        (YEAR(hoadon.hoadon_ngaytao)) AS year, SUM(hoadon.hoadon_tongtien) AS total FROM hoadon,nhanvien 
        WHERE YEAR(hoadon.hoadon_ngaytao) =  "'.$year.'" AND nhanvien.nv_id =  "'.$admin_id.'"  AND hoadon.nv_id =  "'.$admin_id.'" 
        GROUP BY nhanvien.nv_id,nhanvien.nv_ten, month,year ORDER BY month,year ASC;
        '); 
        return view('admin.statictical.statictical_staff_revenue',compact('admin'));
    }
    public function details_customer_revenue($khachhang_id){
        $year = Carbon::now()->format('Y');
        $customer  = DB::select('SELECT khachhang.khachhang_id, khachhang.khachhang_ten, (MONTH(hoadon.hoadon_ngaytao)) AS month,(YEAR(hoadon.hoadon_ngaytao)) AS year, 
        SUM(hoadon.hoadon_tongtien) AS total FROM hoadon,khachhang WHERE YEAR(hoadon.hoadon_ngaytao) = "'.$year.'" AND khachhang.khachhang_id ="'.$khachhang_id.'" AND hoadon.khachhang_id ="'.$khachhang_id.'"
        GROUP BY khachhang.khachhang_id, khachhang.khachhang_ten, month,year ORDER BY month,year ASC;'); 
        return view('admin.statictical.statictical_customer_revenue',compact('customer'));
    }


    public function details_reservation_revenue($khachhang_id){
        $year = Carbon::now()->format('Y');
        $customer  = DB::select('SELECT khachhang.khachhang_id, khachhang.khachhang_ten, (MONTH(datban.datban_thoigian)) AS month,(YEAR(datban.datban_thoigian)) AS year, COUNT(datban.datban_id) AS count FROM datban,khachhang WHERE YEAR(datban.datban_thoigian) =  "'.$year.'" AND datban.khachhang_id = "'.$khachhang_id.'" AND khachhang.khachhang_id ="'.$khachhang_id.'" GROUP BY khachhang.khachhang_id, khachhang.khachhang_ten, month,year ORDER BY  month,year ASC'); 
        return view('admin.statictical.statictiacl_reservation_revenue  ',compact('customer'));
    }

    public function details_ingredient_remaining_statistical(){
        $ingredient = Ingredient::where('nl_slcl' ,'>', 1)->get();
        return view('admin.statictical.statictical_ingredient1',compact('ingredient'));

    }
    public function details_ingredient_statistical(){
        $ingredient = Ingredient::where('nl_slcl' ,'<=', 1)->get();
        return view('admin.statictical.statictical_ingredient2',compact('ingredient'));

    }



}
