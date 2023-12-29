@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liệt kê giảm giá</h6>
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
                        <input type="text" name="start_date5" class="form-control start_date5" id="start_date5">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i
                                    class="fas fa-calendar-alt"></i></span>
                        </div>
                        {{-- <label>End Date:</label> --}}
                        <input type="text" name="end_date5" class="form-control end_date5" id="end_date5">
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary filter5" id="filter5" style="margin-top: 8px">Lọc</button>
                    {{-- <button class="btn btn-primary reset" style="margin-top: 8px">Reset</button> --}}
                    <a href="{{url('/all-coupon')}}"  class="btn btn-primary reset mt-2"> Reset</a>
                </div>
            </div>
            <div class="row">
                <a class="btn btn-primary" style="margin-left: auto" href="{{ route('coupon.create') }}">
                    <i class="fa fa-sign-in" aria-hidden="true"> Thêm giảm giá</i>
                </a>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-bordered myTablecou" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tên giảm giá</th>
                            <th>Mã giảm giá</th>
                            <th>Số lượng</th>
                            <th>Tính năng</th>
                            <th>Số tiền hoặc phần trăm giảm</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Tình trạng</th>
                            <th>Quản lý</th>

                        </tr>
                    </thead>

                    {{-- <tbody>
                        @foreach ($coupon as $key => $cou)
                            <tr>
                                <td>{{ $cou->gg_ten }}</td>
                                <td>{{ $cou->gg_magiam }}</td>
                                <td>{{ $cou->gg_soluong }}</td>
                                @if ($cou->gg_tinhnang == 1)
                                    <td> Giảm theo tiền</td>
                                    <td>{{ number_format($cou->gg_stg) . ' ' . 'VNĐ' }}</td>
                                @else
                                    <td> Giảm theo phần trăm</td>
                                    <td>{{ $cou->gg_stg }}%</td>
                                @endif

                                @if ($cou->gg_ngaykt > $today)
                                    <td><span class="badge badge-success">Khả dụng</span>
                                    </td>
                                @else
                                    <td><span class="badge badge-danger">Đã Hết</span>
                                    </td>
                                @endif

                                <td>
                                    <a href="{{ url('/edit-coupon/' . $cou->gg_id) }}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i>
                                    </a>
                                    | <a href="{{ url('/delete-coupon/' . $cou->gg_id) }}">
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
