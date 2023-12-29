<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Http\Requests\ReservationStoreRequest;
use App\Models\City;
use App\Models\Customer;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Mail;
use Brian2694\Toastr\Facades\Toastr;

class ReservationController extends Controller
{

    public function all_reservation()
    {
        $reservations = Reservation::all();
        return view('admin.reservation.all_reservation', compact('reservations'));
    }
    public function get_all_reservation(Request $request)
    {
        if ($request->start_date2 && $request->end_date2) {
            $reservation = Reservation::whereDate('datban_thoigian', '>=', $request->start_date2)
                ->whereDate('datban_thoigian', '<=', $request->end_date2)->get();
        } else {
            $reservation = Reservation::select('*')->orderBy('datban_id','DESC');
        }
        // $reservation = Reservation::all();

        return DataTables::of($reservation)
            ->addIndexColumn()
            ->addColumn('action', function ($reservation) {
                return '<a href="' . route('edit_reservation', $reservation->datban_id) . '">
            <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue;font-size:14px "></i></a>
            |
            <a  onclick="return myFunction();" href="' . route('delete_reservation',  $reservation->datban_id) . '">
            <i class="fa fa-trash-o" aria-hidden="true" style="color: red;font-size:14px"></i></a>
            |
            <a  href="' . route('details_reservation',  $reservation->datban_id) . '">
            <i class="fa fa-eye" aria-hidden="true" style="color: red;font-size:14px"></i></a>';
            })
            ->addColumn('ban', function ($reservation) {
                return $reservation->table->ban_ten;
            })
            ->addColumn('checkout', function ($reservation) {
                if($reservation->datban_kt  == 0 ){
                    return 'Chưa đến';
                }elseif($reservation->datban_kt == 1){
                    return 'Đã đến';

                }else{
                    return 'Không đến';

                }
            })
            ->addColumn('tinhtrang', function ($reservation) {
                if ($reservation->datban_tinhtrang == '0') {
                    return 'Chưa duyệt';
                } elseif ($reservation->datban_tinhtrang == '1') {
                    return 'Đã duyệt';
                }else{
                    return 'Đã hủy';
                }
            })
            ->rawColumns(['ban', 'action', 'tinhtrang'])
            ->make(true);
    }
    public function add_reservation()
    {

        $table = Table::where('ban_dat', '0')->get();
        $customer = Customer::all();
        return view('admin.reservation.add_reservation', compact('table', 'customer'));
    }
    public function save_reservation(ReservationStoreRequest $request)
    {

        //Kiểm tra số lượng người đặt
        $table = Table::findOrFail($request->ban_id);
        if ($request->datban_slnguoi > $table->ban_slnguoi) {
            return back()->with('warning', 'Vui Lòng chọn bàn căn cứ vào số lượng khách hàng');
        }

        $earliestTime1 = Carbon::createFromTimeString('13:00:00');
        $lastTime1 = Carbon::createFromTimeString('16:00:00');
        $earliestTime = Carbon::createFromTimeString('17:00:00');
        $lastTime = Carbon::createFromTimeString('21:00:00');


        //Kiểm tra lịch đặt có trùng không
        $request_date = Carbon::parse($request->datban_thoigian);
        foreach ($table->reservations as $key => $res) {


            if (Carbon::parse($res->datban_thoigian)->format('Y-m-d') == $request_date->format('Y-m-d') ) {

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


        Reservation::create($request->validated());
        Toastr::success('Thêm lịch đặt bàn thành công', 'Thông báo');
        return Redirect::to('/all-reservation');
    }
    public function edit_reservation($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);
        $table = Table::where('ban_dat', '0')->get();
        $customer = Customer::all();

        return view('admin.reservation.edit_reservation', compact('reservation', 'table', 'customer'));
    }
    public function update_reservation_admin(ReservationStoreRequest $request, $reservation_id)
    {
       
        $reservation = Reservation::find($reservation_id);
        $table = Table::findOrFail($request->ban_id);
        if ($request->datban_slnguoi > $table->ban_slnguoi) {
            Toastr::warning('Vui Lòng chọn bàn căn cứ vào số lượng khách hàng', 'Thông báo');
            return redirect()->back();
        }


        $earliestTime1 = Carbon::createFromTimeString('13:00:00');
        $lastTime1 = Carbon::createFromTimeString('16:00:00');

        $earliestTime = Carbon::createFromTimeString('17:00:00');
        $lastTime = Carbon::createFromTimeString('21:00:00');

        $request_date = Carbon::parse($request->datban_thoigian);
        
        $reservations = $table->reservations()->where('datban_id', '!=', $reservation->datban_id)->get();
        foreach ($reservations as $key => $res) {


         

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
        Toastr::success('Cập nhật lịch đặt bàn thành công', 'Thông báo');

        return Redirect::to('/all-reservation');
    }
    public function delete_reservation($reservation_id)
    {

        $reservation = Reservation::find($reservation_id);
        $reservation->datban_tinhtrang = 2;
        $reservation->update();


        Toastr::success('Xóa lịch đặt bàn thành công', 'Thông báo');

        return Redirect::to('/all-reservation');
    }

    public function details_reservation($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);
        return view('admin.reservation.details_reservation', compact('reservation'));
    }

    public function approve_reservation($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);
        $reservation->datban_tinhtrang = 1;
        $reservation->save();

        Mail::send('user.email.confirm', compact('reservation'), function ($email) use ($reservation) {
            $email->subject('Xác nhận lịch đặt bàn');
            $email->to($reservation->datban_email);
        });
        Toastr::success('Duyệt lịch đặt bàn thành công', 'Thông báo');

        return Redirect::to('/all-reservation');
    }

    
    public function customer_checkout_yes(Request $request, $reservation_id)
    {
       
        $reservation = Reservation::find($reservation_id);
        $reservation->datban_kt = 1;
        $reservation->update();
        Toastr::success('Nhận khách thành công', 'Thông báo');
        return Redirect::to('/dashboard');
    }
    public function customer_checkout_no(Request $request, $reservation_id)
    {
        
        $reservation = Reservation::find($reservation_id);
        $reservation->datban_kt = 2;
        $reservation->update();

        Toastr::success('Nhận khách không đến thành công', 'Thông báo');
        return Redirect::to('/dashboard');
    }
    public function calendar_reservation()
    {

        $reservations = Reservation::all();
        $events = array();

        foreach ($reservations as $reservation) {
            $events[] = [
                'title' => $reservation->table->ban_ten,
                'start' => $reservation->datban_thoigian,
                'end' => $reservation->datban_thoigian,

            ];
        }

        return view('admin.reservation.calendar_reservation', ['events' => $events]);
    }
}
