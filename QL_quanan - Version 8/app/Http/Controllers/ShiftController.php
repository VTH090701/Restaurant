<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Detailsshift;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Brian2694\Toastr\Facades\Toastr;
// session_start();

use App\Models\Statictical;
class ShiftController extends Controller
{
    public function all_shift()
    {
        $shift_all = Shift::all();
        return view('admin.shift.all_shift', compact('shift_all'));
    }
    public function get_all_shift(Request $request){
        


        if ($request->start_date1 && $request->end_date1) {
            $shift = Shift::whereDate('phienlamviec_tgbd', '>=',$request->start_date1)
                        ->whereDate('phienlamviec_tgbd', '<=',$request->end_date1)->get();
        } else{
            $shift = Shift::select('*')->orderBy('phienlamviec_tgbd','DESC');
        }

        return DataTables::of($shift)
            ->addIndexColumn()
            ->addColumn('status', function ($shift) {
                if($shift->phienlamviec_tt == 0){
                    return 'Đang mở';
                }else{
                    return 'Hoàn thành';
                }
                
            })
            ->addColumn('action', function ($shift) {
                return '<a href="' . route('details_shift', $shift->phienlamviec_id) . '">
            <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i></a>
            |
            <a onclick="return myFunction();" href="' . route('delete_shift', $shift->phienlamviec_id) . '" >
            <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i></a>';
            })
            ->addColumn('ten_nv', function ($shift) {
                return $shift->admins->nv_ten;
            })
            ->addColumn('dt', function ($shift) {
                return number_format($shift->phienlamviec_dt) . ' ' . 'VNĐ';
              })
              ->addColumn('tc', function ($shift) {
                return number_format($shift->phienlamviec_tc) . ' ' . 'VNĐ';
              })
            ->rawColumns(['dt','tc','status','ten_nv', 'action'])
            ->make(true);
    }


    public function on_shift(Request $request)
    {
        $shift = new Shift();
        $shift->nv_id = Auth::id();
        $shift->phienlamviec_tt = 0;
        $shift->phienlamviec_dt = 0;
        $shift->phienlamviec_tc = 0;
        $shift->phienlamviec_tgbd = Carbon::now();

        $shift->save();
        Session::put('shift_id', $shift->phienlamviec_id);
        Toastr::success('Mở phiên làm việc thành công','Thông báo');

        return redirect()->back();
    }
    public function details_shift($shift_id)
    {
        $shift = Shift::find($shift_id);
        return view('admin.shift.details_shift',compact('shift'));
    }
    public function off_shift(Request $request, $shift_id){

        $shift = Shift::find($shift_id);
        $shift->phienlamviec_tt = 1;
        $shift->phienlamviec_gc = $request->plv_gt;
        $shift->phienlamviec_tgkt = Carbon::now();
        $shift->update();
        Session::forget('shift_id');
        Toastr::success('Đóng phiên làm việc thành công','Thông báo');

        return Redirect::to('/all-shift');


    }
    public function notice_shift(){
        Toastr::warning('Đã có một phiên làm việc đang mở vui lòng đóng phiên hiện tại để có thể mở thêm phiên mới!','Thông báo');
        return Redirect::to('/all-shift');
    }
    public function delete_shift($shift_id){
        $shift = Shift::find($shift_id);
        $shift->delete();
        Toastr::success('Xóa phiên làm việc thành công','Thông báo');

        return Redirect::to('/all-shift');
    }
    public function edit_shift($shift_id){
        $edit_shift = Shift::find($shift_id);
        return view('admin.shift.edit_shift',compact('edit_shift'));

    }
    public function update_shift($shift_id, Request $request){
        $details_shift = new Detailsshift();
        $details_shift->phienlamviec_id = $shift_id;
        $details_shift->ctphien_motachi = $request->desc;
        $details_shift->ctphien_sotienchi = $request->money;
        $details_shift->save();

        $shift = Shift::find($shift_id);
        $shift->phienlamviec_tc += $request->money;
        $shift->save();

        //Cập nhật chi phí
        $total = $request->money;
        $receipt_date = Carbon::now();

        $statistic = Statictical::whereDate('thongke_ngay', $receipt_date->format('Y-m-d') )->get();
        if ($statistic) {
            $statistic_count = $statistic->count();
        } else {
            $statistic_count = 0;
        }

        if ($statistic_count > 0) {

            $statistic_update = Statictical::whereDate('thongke_ngay', $receipt_date->format('Y-m-d') )->first();
            $statistic_update->thongke_cp += $total;
            $statistic_update->update();
        } else {
            $statistic_new = new Statictical();
            $statistic_new->thongke_ngay = $receipt_date->format('Y-m-d');
            $statistic_new->thongke_dt = 0;
            $statistic_new->thongke_sl =  0;
            $statistic_new->thongke_thd =  0;
            $statistic_new->thongke_cp =  $total;
            $statistic_new->save();
        }


        Toastr::success('Cập nhật phiên làm việc thành công','Thông báo');
        return redirect()->back();
    }
}
