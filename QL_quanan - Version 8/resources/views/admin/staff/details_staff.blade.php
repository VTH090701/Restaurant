@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liệt kê nhân viên</h6>
        </div>
        <div class="row mt-3">
            <div class="col-6">
                <h3 style="margin-left: 20px">Thông tin chi tiết nhân viên:</h3>
                <p style="margin-left: 20px">Họ tên : {{ $user->nv_ten }} </p>
                <p style="margin-left: 20px">Email: {{ $user->nv_email }} </p>
                <p style="margin-left: 20px">Số điện thoại: {{ $user->nv_sdt }} </p>
                <p style="margin-left: 20px">Địa chỉ: {{ $user->nv_diachi }} </p>

            </div>
            <div class="col-6">
                {{-- <h3>Invoice to: </h3>
                <p>Họ và tên: {{ $order->customers->khachhang_ten ?? 'None' }} </p>
                <p>Địa chỉ: {{ $order->customers->khachhang_diachi}} </p>
                <p>Số điện thoại: {{ $order->customers->khachhang_sdt ?? 'None' }} </p> --}}
            </div>
        </div>
        <div class="card-body">
            <h5>Cấp quyền cho nhân viên:</h5>
            <div class="table-responsive mt-2">
                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Admin</th>
                            <th>Nhân viên phục vụ </th>
                            <th>Nhân viên bếp</th>
                            {{-- <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Trạng thái</th>
                            <th>Quản lý</th> --}}
                        </tr>
                    </thead>

                    <tbody>
                        <form method="POST" action="{{ url('/assign-roles1') }}">
                            @csrf
                            <tr>
                                <input type="hidden" name="admin_email" value="{{$user->nv_email}}">
                                <input type="hidden" name="admin_id" value="{{$user->nv_id}}">

                                <td><input type="checkbox" name="admin_roles"
                                        {{ $user->hasRole('admin') ? 'checked' : '' }}></td>
                                <td><input type="checkbox" name="nvpv_roles"
                                        {{ $user->hasRole('nhanvien_pv') ? 'checked' : '' }}></td>
                                <td><input type="checkbox" name="nvbep_roles"
                                        {{ $user->hasRole('nhanvien_bep') ? 'checked' : '' }}></td>
                            </tr>
                    </tbody>
                </table>
                <a href="{{route('staff.index') }}" class="btn btn-warning">Trở về</a>
                <input type="submit" value="Lưu lại" class="btn btn-dark">
                </form>

            </div>
        </div>
    </div>
@endsection
