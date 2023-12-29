@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Chi tiết phiếu nhập</h6>
        </div>

        <div class="card-body">
            {{-- <div class="table-responsive mt-3">
                <h4 style="font-weight: bold;color: black;font-family: Arial, Helvetica, sans-serif;">
                    Nhân viên:</h4>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã nhân viên</th>
                            <th>Tên nhân viên</th>
                            <th>Email</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>{{ $receipt->admin_id }}</td>
                            <td>{{ $receipt->admins->admin_name }}</td>
                            <td>{{ $receipt->admins->admin_email }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <hr>
            <h4 style="font-weight: bold;color: black;font-family: Arial, Helvetica, sans-serif;">Nhà cung cấp:</h4>

            <div class="table-responsive mt-3">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã nhà cung cấp</th>
                            <th>Tên nhà cung cấp</th>
                            <th>Số điện thoại</th>
                            <th>Email nhà cung cấp</th>
                            <th>Địa chỉ nhà cung cấp</th>

                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>{{$receipt->suppliers->ncc_id }}</td>
                            <td>{{$receipt->suppliers->ncc_ten  }}</td>
                            <td>{{$receipt->suppliers->ncc_sdt  }}</td>
                            <td>{{$receipt->suppliers->ncc_email  }}</td>
                            <td>{{$receipt->suppliers->city->name_city  }}</td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <hr>

            <h4 style="font-weight: bold;color: black;font-family: Arial, Helvetica, sans-serif;">Chi tiết phiếu nhập:</h4>
            <div class="table-responsive mt-3">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm nhập</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Đơn vị tính</th>
                            <th>Tổng tiền</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($receipt->receiptdetails as $key => $item)

                            <tr>
                                <td>{{ $item->ctnh_ten }}</td>
                                <td>{{ $item->ctnh_soluong }}</td>
                                <td>{{ number_format( $item->ctnh_dongia) . ' ' . 'VNĐ' }}</td>
                                <td>{{ $item->ctnh_ten }}</td>
                                <td>
                                    {{ number_format( $item->ctnh_soluong *  $item->ctnh_dongia) . ' ' . 'VNĐ' }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
         
            <a href="{{url('/all-receipt')}}" class="btn btn-success">Trở lại</a> --}}



            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">

                            <p style="font-size: 20px;">Mã phiếu:</p>
                        </div>
                        <div class="col-md-8">
                            <p style="font-size: 20px;"> {{ $receipt->pnh_id }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">

                            <p style="font-size: 20px;">Người lập phiếu:</p>
                        </div>
                        <div class="col-md-8">
                            <p style="font-size: 20px;"> {{ $receipt->admins->nv_ten }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p style="font-size: 20px;">Thời gian lập:</p>
                        </div>
                        <div class="col-md-8">
                            <p style="font-size: 20px;"> {{ $receipt->pnh_ngaylapphieu }}</p>

                            {{-- <input type="datetime-local" class="form-control" name="time"> --}}
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-4">
                            <p style="font-size: 20px;">Nhà cung cấp:</p>
                        </div>
                        <div class="col-md-8">
                            <p style="font-size: 20px;"> {{ $receipt->suppliers->ncc_ten }}</p>

                          
                        </div>

                    </div> --}}

                </div>
                <div class="col-md-6">
                    <p style="font-size: 20px;">Nội dung: </p>
                    <textarea class="form-control" rows="3" name="desc" disabled> {{ $receipt->pnh_ghichu }}</textarea>
                </div>

            </div>
            <hr>
            <h5>Dữ liệu nhập hàng:</h5>


            <div class="table-responsive mt-2">
                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên hàng</th>
                            <th>Nhà cung cấp</th>
                            <th>Đơn vị tính</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>

                        </tr>
                    </thead>
                    @php
                        $i = 1;
                    @endphp
                    <tbody class="addMoreProduct">
                        @foreach ($receipt->receiptdetails as $key => $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->ingredients->nl_ten }}</td>
                                <td>{{ $item->suppliers->ncc_ten }}</td>
                                <td>{{ $item->ingredients->nl_dvt }}</td>
                                <td>{{ $item->ctnh_soluong }}</td>
                                <td>{{ number_format($item->ctnh_dongia) . ' ' . 'VNĐ' }}</td>
                                <td>
                                    {{ number_format($item->ctnh_soluong * $item->ctnh_dongia) . ' ' . 'VNĐ' }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <h4 style="float: right">Tổng tiền:
                <b class="total" id="total">{{ number_format($receipt->pnh_thanhtien) . ' ' . 'VNĐ' }}</b>
            </h4>
            <a href="{{ url('/all-receipt') }}" class="btn btn-warning">Trở về</a>

            {{-- @if ($receipt->pnh_tinhtrang == 0)
                <a href="{{ url('/comfirm-receipt/' . $receipt->pnh_id) }}" class="btn btn-success">Xác nhận</a>
            @endif --}}
            
        </div>
    </div>
@endsection
