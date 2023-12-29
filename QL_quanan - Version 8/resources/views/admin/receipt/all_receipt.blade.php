@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liệt kê phiếu nhập hàng</h6>
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
                        <input type="text" name="start_date3" class="form-control start_date3" id="start_date3">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i
                                    class="fas fa-calendar-alt"></i></span>
                        </div>
                        {{-- <label>End Date:</label> --}}
                        <input type="text" name="end_date3" class="form-control end_date3" id="end_date3">
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary filter3" id="filter3" style="margin-top: 8px">Lọc</button>
                    {{-- <button class="btn btn-primary reset" style="margin-top: 8px">Reset</button> --}}
                    <a href="{{url('/all-receipt')}}"  class="btn btn-primary reset mt-2"> Reset</a>
                </div>
            </div>
            {{-- <div class="row">
                <a class="btn btn-primary" style="margin-left: auto" href="{{url('/input-receipt')}}"> 
                    <i class="fa fa-sign-in" aria-hidden="true"> Nhập hàng vào kho</i>
                </a>

            </div> --}}
            <div class="row">
                <a class="btn btn-primary" style="margin-left: auto" href="{{ url('/input-receipt') }}">
                    <i class="fa fa-sign-in" aria-hidden="true"> Thêm phiếu nhập</i>
                </a>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-bordered myTablerec" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã phiếu nhập hàng</th>
                            {{-- <th>Nhà cung cấp</th> --}}
                            <th>Nhân viên</th>
                            <th>Tổng tiền nhập</th>
                            <th>Ngày lập phiếu</th>
                            {{-- <th>Ngày xác nhận</th>
                            <th>Tình trạng</th> --}}
                            <th>Quản lý</th>
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
