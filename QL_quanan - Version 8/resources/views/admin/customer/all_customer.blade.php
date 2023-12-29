@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liệt kê khách hàng</h6>
        </div>

        <div class="card-body">
            <div class="row">
                <a class="btn btn-primary" style="margin-left: auto" href="{{ route('customer.create') }}">
                    <i class="fa fa-sign-in" aria-hidden="true"> Thêm khách hàng</i>
                </a>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-bordered myTablecus" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID khách hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Hình ảnh</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Trạng thái</th>
                            <th>Quản lý</th>

                        </tr>
                    </thead>
                 
                    {{-- <tbody>
                        @foreach ($all_cus as $key => $cus)
                            <tr>
                                <td>{{ $cus->khachhang_id }}</td>
                                <td>{{ $cus->khachhang_ten }}</td>
                                <td>{{ $cus->khachhang_sdt }}</td>
                                <td>{{ $cus->khachhang_email }}</td>
                                <td>{{ $cus->city->name_city }}, {{ $cus->province->name_district }}, {{ $cus->wards->name_town }}</td>

                                <td>
                                    <a href="{{ url('/edit-customer/'. $cus->khachhang_id) }}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i>
                                    </a>
                                    | <a href="{{ url('/delete-customer/' . $cus->khachhang_id) }}">
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
