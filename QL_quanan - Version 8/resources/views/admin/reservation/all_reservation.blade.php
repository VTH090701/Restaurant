@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liệt kê lịch đặt bàn</h6>
        </div>
 
        <div class="card-body">
            



             <div class="row">

                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i
                                    class="fas fa-calendar-alt"></i></span>
                        </div>
                        {{-- <label>Start Date:</label> --}}
                        <input type="text" name="start_date2" class="form-control start_date2" id="start_date2">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i
                                    class="fas fa-calendar-alt"></i></span>
                        </div>
                        {{-- <label>End Date:</label> --}}
                        <input type="text" name="end_date2" class="form-control end_date2" id="end_date2">
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary filter" id="filter2" style="margin-top: 8px">Lọc</button>
                    {{-- <button class="btn btn-primary reset" style="margin-top: 8px">Reset</button> --}}
                    <a href="{{url('/all-reservation')}}"  class="btn btn-primary reset mt-2"> Reset</a>
                </div>

            </div>
            <div class="row">
                <a class="btn btn-info" style="margin-left: auto" href="{{ url('/getevent') }}">
                    <i class="fa fa-calendar" aria-hidden="true"> Xem trên lịch</i>

                </a>
                <a class="btn btn-primary ml-2"  href="{{ url('/add-reservation') }}">
                    <i class="fa fa-sign-in" aria-hidden="true"> Thêm lịch đặt bàn</i>
                </a>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-bordered myTableres" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã đặt</th>
                            <th>Tên người đặt</th>
                            <th>Email người đặt</th>
                            <th>Số điện thoại</th>
                            <th>Thời gian</th>
                            <th>Bàn</th>
                            <th>Số lượng người</th>
                            <th>Tình trạng</th>
                            <th>Checkout</th>
                            <th>Quản lý</th>

                        </tr>
                    </thead>
                    {{-- <tbody>
                        @foreach ($reservations as $key => $reservations)
                            <tr>
                                <td>{{ $reservations->datban_id }}</td>
                                <td>{{ $reservations->datban_ten }}</td>
                                <td>{{ $reservations->datban_email }}</td>
                                <td>{{ $reservations->datban_sdt }}</td>
                                <td>{{ $reservations->datban_date }}</td>
                                <td>{{ $reservations->table->ban_ten ?? Null }}</td>
                                <td>{{ $reservations->datban_slnguoi }}</td>
                                <td>
                                    <a href="{{ url('/edit-reservation/' . $reservations->datban_id) }}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i>
                                    </a>
                                  
                                </td>
                            </tr>
                        @endforeach

                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>
@endsection
