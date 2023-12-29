<?php

namespace App\Providers;

use App\Models\Mailsettings;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;


use App\Models\Product;
use App\Models\Shift;
use App\Models\Category;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Receipt;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        view()->composer(['admin.dashboard','layout'],function($view){
            $product = Product::all()->count();
            $order = Order::all()->count();
            $staff = Admin::all()->count();
            $customer = Customer::all()->count();
            $shift = Shift::all()->count();
            $cate = Category::all()->count();
            $rec = Receipt::all()->count();
            $reservation = Reservation::all()->count();


            $users = DB::select(" select count(tn_daxem) as unread from nhanvien left join tinnhan on nhanvien.nv_id = tinnhan.nv_id_tntu and tn_daxem = 0 and tinnhan.nv_id_tnden =  " . Auth::id() . " where nhanvien.nv_id !=  " . Auth::id() . " ");
            $view->with('product2',$product)->with('cate2',$cate)->with('order2',$order)->with('staff2',$staff)->with('customer2',$customer)->with('shift2',$shift)->with('user_message',$users)->with('rec2',$rec)->with('res2',$reservation);
        });

        Schema::defaultStringLength(length:191);

        $mailsetting = Mailsettings::first();
        if($mailsetting){
            $data = [
                'driver' => $mailsetting->mail_transport,
                'host' => $mailsetting->mail_host,
                'port' => $mailsetting->mail_port,
                'encryption' => $mailsetting->mail_encryption,
                'username' => $mailsetting->mail_user,
                'password' => $mailsetting->mail_password,
                'from' => [
                    'address' => $mailsetting->mail_from,
                    'name' => 'TH Restaurant'
                ]
            ];
            Config::set('mail', $data);
        }
    }

}
