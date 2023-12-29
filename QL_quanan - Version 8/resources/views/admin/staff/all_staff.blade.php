@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liệt kê nhân viên</h6>
        </div>
 
        <div class="card-body">
            <div class="row">
                <a class="btn btn-primary" style="margin-left: auto" href="{{ route('staff.create') }}">
                    <i class="fa fa-sign-in" aria-hidden="true"> Thêm nhân viên</i>
                </a>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-bordered myTablesta" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã nhân viên</th>
                            <th>Tên nhân viên</th>
                            <th>Hình ảnh</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Trạng thái</th>
                            <th style="width: 80px;">Quản lý</th>
                        </tr>
                    </thead>

                    {{-- <tbody>
                        @foreach ($receipt as $key => $re)
                            <tr>
                                <td>{{ $re->pnh_id }}</td>
                                <td>{{ $re->suppliers->ncc_ten }}</td>
                                <td>{{ $re->admins->admin_name }}</td>
                                <td>{{ number_format( $re->pnh_thanhtien ) . ' ' . 'VNĐ' }}</td>
                                <td>{{ $re->pnh_ngaylapphieu }}</td>
                                <td>
                                    <a href="{{ url('/details-receipt/' .$re->pnh_id) }}">
                                        <i class="fa fa-eye" aria-hidden="true" style="color:rgb(240, 111, 6); "></i>
                                    </a>
                                    |
                                    <a href="{{ url('/edit-receipt/' .$re->pnh_id) }}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i>
                                    </a>
                                    | <a href="{{ url('/delete-receipt/' .$re->pnh_id) }}">
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
