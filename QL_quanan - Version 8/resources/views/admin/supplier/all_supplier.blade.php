@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liệt kê nhà cung cấp</h6>
        </div>

        <div class="card-body">
            {{-- <div class="row">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i
                                    class="fas fa-calendar-alt"></i></span>
                        </div>
                        <input type="text" name="start_date" class="form-control start_date" id="start_date">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i
                                    class="fas fa-calendar-alt"></i></span>
                        </div>
                        <input type="text" name="end_date" class="form-control end_date" id="end_date">
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary filter" id="filter" style="margin-top: 8px">Lọc</button>
                    <a href="{{url('/all-receipt')}}"  class="btn btn-primary reset mt-2"> Reset</a>
                </div>
            </div> --}}
            <div class="row">
                <a class="btn btn-primary" style="margin-left: auto" href="{{ route('supplier.create') }}">
                    <i class="fa fa-sign-in" aria-hidden="true"> Thêm nhà cung cấp</i>
                </a>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-bordered myTablesup" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã nhà cung cấp</th>
                            <th>Tên nhà cung cấp</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Quản lý</th>
                        </tr>
                    </thead>

                    {{-- <tbody>
                        @foreach ($supplier as $key => $sup)
                            <tr>
                                <td>{{ $sup->ncc_id }}</td>
                                <td>{{ $sup->ncc_ten }}</td>
                                <td>{{ $sup->ncc_sdt }}</td>
                                <td>{{ $sup->ncc_email }}</td>
                                <td>{{ $sup->ncc_diachi }}</td>
                                <td>

                                    <a href="{{ url('/edit-supplier/' . $sup->ncc_id) }}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i>
                                    </a>
                                    | <a href="{{ url('/delete-supplier/' . $sup->ncc_id) }}">
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
