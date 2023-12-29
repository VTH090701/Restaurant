@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liệt kê số liệu</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4" style="">
                    <h4 style="font-weight: bold;color: black">Biểu đồ thống kê:</h4>

                    <div id="donut-example"></div>


                </div>
                <div class="col-md-2 mt-3">
                    {{-- <h4 style="font-weight: bold;color: black" class="mb-4">Thống kê số liệu:</h4> --}}
                    <p class="mt-5"> <i class="fa fa-circle" aria-hidden="true"
                            style="color: #FF0000;font-size: 20px"></i> Món ăn:
                        {{ $product }}</p>
                    <p> <i class="fa fa-circle" aria-hidden="true" style="color: #4B0082;font-size: 20px"></i> Danh mục:
                        {{ $cate }}</p>
                    <p> <i class="fa fa-circle" aria-hidden="true" style="color: #FFA500;font-size: 20px"></i> Hóa đơn:
                        {{ $order }}</p>
                    <p> <i class="fa fa-circle" aria-hidden="true" style="color: #FFD700;font-size: 20px"></i> Khách hàng:
                        {{ $customer }}</p>
                    <p> <i class="fa fa-circle" aria-hidden="true" style="color: #008080;font-size: 20px"></i> Nhân nhiên:
                        {{ $staff }}</p>
                    <p> <i class="fa fa-circle" aria-hidden="true" style="color: #00BCD4;font-size: 20px"></i> Phiên làm
                        việc:
                        {{ $shift }}</p>
                    <p> <i class="fa fa-circle" aria-hidden="true" style="color: #00ACC1;font-size: 20px"></i> Phiếu nhập
                        hàng:
                        {{ $receipt }}</p>

                    <p> <i class="fa fa-circle" aria-hidden="true" style="color: #0097A7;font-size: 20px"></i>
                        Lịch đặt bàn:
                        {{ $reservation }}</p>
                </div>
                <div class="col-md-6">
                    <h4 style="font-weight: bold;color: black" class="ml-5">Món ăn bán chạy:</h4>
                    <ul style="list-style: none;">
                        @foreach ($product_selling as $pro)
                            <li style=" border:1px solid #eeeeee;border-radius: 5px" class="m-2">
                                <div class="row">
                                    <img src="public/upload/product/{{ $pro->ma_hinhanh }}" width="60" height="60"
                                        style="border-radius:50% ">
                                    <p class="m-3"> {{ $pro->ma_ten }}</p>
                                    <p class="m-3">{{ number_format($pro->ma_gia) . ' ' . 'VNĐ' }}</p>
                                    <p class="m-3">Tổng lượt bán: {{ $pro->total }}</p>
                                </div>

                            </li>
                        @endforeach

                    </ul>

                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <h4 style="font-weight: bold;color: black">Tổng doanh số bán hàng theo nhân viên:</h4>
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Mã nhân viên</th>
                                    <th>Tên nhân viên</th>
                                    <th>Tổng doanh thu</th>

                                    <th style="width: 80px;">Quản lý</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($staff_revenue as $key => $sta)
                                    <tr>
                                        <td>{{ $sta->nv_id }}</td>
                                        <td>{{ $sta->nv_ten }}</td>
                                        <td>{{ number_format($sta->total) . ' ' . 'VNĐ' }}</td>
                                        <td>
                                            <a href="{{ url('/details-staff-revenue/' . $sta->nv_id) }}">
                                                <i class="fa fa-eye" aria-hidden="true"
                                                    style="color:rgb(240, 111, 6); "></i>
                                            </a>
                                            {{-- |
                                            <a href="{{ url('/edit-receipt/' .$re->pnh_id) }}">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i>
                                            </a>
                                            | <a href="{{ url('/delete-receipt/' .$re->pnh_id) }}">
                                                <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i>
                                            </a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="col-md-6">
                    <h4 style="font-weight: bold;color: black">Top khách hàng :</h4>
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Mã khách hàng</th>
                                    <th>Tên khách hàng</th>
                                    <th>Tổng tiền khách hàng đã ăn</th>
                                    <th style="width: 80px;">Quản lý</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($customer_revenue as $key => $cus)
                                    <tr>
                                        <td>{{ $cus->khachhang_id }}</td>
                                        <td>{{ $cus->khachhang_ten }}</td>
                                        <td>{{ number_format($cus->total) . ' ' . 'VNĐ' }}</td>
                                        <td>
                                            <a href="{{ url('/details-customer-revenue/' . $cus->khachhang_id) }}">
                                                <i class="fa fa-eye" aria-hidden="true"
                                                    style="color:rgb(240, 111, 6); "></i>
                                            </a>
                                            {{-- |
                                            <a href="{{ url('/edit-receipt/' .$re->pnh_id) }}">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i>
                                            </a>
                                            | <a href="{{ url('/delete-receipt/' .$re->pnh_id) }}">
                                                <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i>
                                            </a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <h4 style="font-weight: bold;color: black">Top khách hàng đặt lịch :</h4>
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Mã khách hàng</th>
                                    <th>Tên khách hàng</th>
                                    <th>Tổng lịch đặt</th>

                                    <th style="width: 80px;">Quản lý</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($res_revenue as $key => $cus)
                                    <tr>
                                        <td>{{ $cus->khachhang_id }}</td>
                                        <td>{{ $cus->khachhang_ten }}</td>
                                        <td>{{ $cus->count }}</td>
                                        <td>
                                            <a href="{{ url('/details-reservation-revenue/' . $cus->khachhang_id) }}">
                                                <i class="fa fa-eye" aria-hidden="true"
                                                    style="color:rgb(240, 111, 6); "></i>
                                            </a>
                                            {{-- |
                                            <a href="{{ url('/edit-receipt/' .$re->pnh_id) }}">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i>
                                            </a>
                                            | <a href="{{ url('/delete-receipt/' .$re->pnh_id) }}">
                                                <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i>
                                            </a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-6">
                    <h4 style="font-weight: bold;color: black">Số liệu trong kho:</h4>
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                            <tbody>
                                @foreach ($slcl as $key => $slcl)

                                <tr>
                                    <td>Số lượng nguyên liệu còn</td>
                                    <td>
                                        {{ $slcl->count }}
                                    </td>
                                    <td>
                                        <a href="{{ url('/details-ingredient-remaining-statistical') }}">
                                            <i class="fa fa-eye" aria-hidden="true"
                                                style="color:rgb(240, 111, 6); "></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach

                                @foreach ($slhh as $key => $slcl)
                                <tr>
                                    <td>Số lượng nguyên liệu gần hết</td>
                                    <td>
                                        {{ $slcl->count }}
                                    </td>
                                    <td>
                                        <a href="{{ url('/details-ingredient-statistical/') }}">
                                            <i class="fa fa-eye" aria-hidden="true"
                                                style="color:rgb(240, 111, 6); "></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
        
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
                                    


@endsection
