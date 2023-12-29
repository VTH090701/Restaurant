@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liệt kê hóa đơn</h6>
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
                        <input type="text" name="start_date" class="form-control start_date" id="start_date">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i
                                    class="fas fa-calendar-alt"></i></span>
                        </div>
                        {{-- <label>End Date:</label> --}}
                        <input type="text" name="end_date" class="form-control end_date" id="end_date">
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary filter" id="filter" style="margin-top: 8px">Lọc</button>
                    {{-- <button class="btn btn-primary reset" style="margin-top: 8px">Reset</button> --}}
                    <a href="{{url('/all-order')}}"  class="btn btn-primary reset mt-2"> Reset</a>
                </div>

            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-search myTableord" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã hóa đơn</th>
                            <th>Tổng tiền</th>
                            {{-- <th>Giảm giá</th> --}}
                            <th>Bàn</th>
                            <th>Nhân viên</th>
                            <th>Khách hàng</th>
                            <th>Tình trạng</th>
                            <th>Thời gian</th>
                            <th>Quản lý</th>
                        </tr>
                    </thead>

                    {{-- <tbody>
                        @foreach ($all_ord as $key => $ord)
                            <tr>
                                <td>{{ $ord->hoadon_id }}</td>
                                <td>{{ number_format($ord->hoadon_tongtien) . ' ' . 'VNĐ' }}</td>
                                <td>{{ $ord->tables->ban_ten }}</td>
                                <td>{{ $ord->admins->admin_name }}</td>
                                <td>{{ $ord->customers->khachhang_ten }}</td>
                                <td>
                                    @if ($ord->hoadon_tinhtrang == 0)
                                        Chưa thanh toán
                                    @else
                                        Đã thanh toán
                                    @endif
                                </td>

                                <td>{{ $ord->created_at }}</td>
                                <td>
                                    <a href="{{ url('/details-ordtomer/' . $ord->hoadon_id) }}"
                                        style="text-decoration: none;">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                        </i>
                                    </a>
                                    | <a href="{{ url('/delete-ordtomer/' . $ord->hoadon_id) }}">
                                        <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i>

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
