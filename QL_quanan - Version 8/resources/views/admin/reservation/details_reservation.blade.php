@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Chi tiết lịch đặt bàn</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive mt-3">
                <h4 style="font-weight: bold;color: black;font-family: Arial, Helvetica, sans-serif;">
                    Thông tin đăng nhập:</h4>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã khách hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $reservation->customer->khachhang_id }}</td>
                            <td>{{ $reservation->customer->khachhang_ten }}</td>
                            <td>{{ $reservation->customer->khachhang_sdt }}</td>
                            <td>{{ $reservation->customer->khachhang_email }}</td>

                        </tr>

                    </tbody>
                </table>
            </div>
            <hr>

            <h4 style="font-weight: bold;color: black;font-family: Arial, Helvetica, sans-serif;">Thông tin đặt bàn:</h4>
            <div class="table-responsive mt-3">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã đặt bàn</th>
                            <th>Tên người đặt</th>
                            <th>Email người đặt</th>
                            <th>Số điện thoại người đặt</th>
                            <th>Thời gian đặt</th>
                            <th>Bàn</th>

                        </tr>
                    </thead>
                    <tbody>
                        <td>{{ $reservation->datban_id }}</td>
                        <td>{{ $reservation->datban_ten }}</td>
                        <td>{{ $reservation->datban_email }}</td>
                        <td>{{ $reservation->datban_sdt }}</td>
                        <td>{{ $reservation->datban_thoigian }}</td>
                        <td>{{ $reservation->table->ban_ten }}</td>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <a href="{{ url('/all-reservation') }}" class="btn btn-warning ml-3 mr-2" > Trở lại</a>
                @if ($reservation->datban_tinhtrang == 0)

                <form method="POST"
                    action="{{ url('/approve-reservation/' . $reservation->datban_id) }}">
                    @csrf
                    <input type="submit" value="Duyệt lịch đặt" class="btn btn-success" >
                </form>
            @else
            @endif
            </div>
          

        </div>
    </div>
@endsection
