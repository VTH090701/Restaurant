@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Chi tiết hóa đơn</h6>
        </div>
        <?php
        $mess = Session::get('mess');
        if ($mess) {
            echo $mess;
            Session::put('mess', null);
        }
        ?>
        <div class="card-body">
            <div class="table-responsive mt-3">
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
                            <td>{{ $order->nv_id }}</td>
                            <td>{{ $order->admins->nv_ten }}</td>
                            <td>{{ $order->admins->nv_email }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <hr>
            <h4 style="font-weight: bold;color: black;font-family: Arial, Helvetica, sans-serif;">Khách hàng:</h4>

            <div class="table-responsive mt-3">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã khách hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Email</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>{{ $order->customers->khachhang_id }}</td>
                            <td>{{ $order->customers->khachhang_ten }}</td>
                            <td>{{ $order->customers->khachhang_email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr>

            <h4 style="font-weight: bold;color: black;font-family: Arial, Helvetica, sans-serif;">Chi tiết hóa đơn:</h4>
            <div class="table-responsive mt-3">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng cộng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($order->orderdetails as $item)
                            @php
                                $total += $item->cthoadon_slsp * $item->cthoadon_giasp;
                            @endphp
                            <tr>
                                <td>{{ $item->products->ma_ten ?? 'None' }}</td>
                                {{-- <td>{{ $item->products->sp_gia ?? 'None' }}</td> --}}
                                <td>{{ number_format($item->products->ma_gia) . ' ' . 'VNĐ' }}</td>
                                <td>{{ $item->cthoadon_slsp ?? 'None' }}</td>
                                <td>{{ number_format($item->cthoadon_slsp * $item->cthoadon_giasp) . ' ' . 'VNĐ' }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="text-right">Tổng tiền</td>
                            <td> {{ number_format($total) . ' ' . 'VNĐ' }}</td>
                        </tr>


                        @if ($order->gg_id != null)
                            @if ($order->coupons->gg_tinhnang == 1)
                                <tr>
                                    <td colspan="3" class="text-right">Giảm giá:</td>
                                    <td>
                                        {{ number_format($order->coupons->gg_stg) . ' ' . 'VNĐ' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right">Số tiền sau giảm:</td>
                                    <td>
                                        @php
                                            $total_coupon = $total - $order->coupons->gg_stg;
                                        @endphp
                                        {{ number_format($total_coupon) . ' ' . 'VNĐ' }}
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="3" class="text-right">Giảm giá:</td>
                                    <td>
                                        {{ $order->coupons->gg_stg }}%
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right">Số tiền sau giảm:</td>
                                    <td>
                                        @php
                                            $total_coupon = $total - ($total * $$order->coupons->gg_stg) / 100;
                                        @endphp
                                        {{ number_format($total_coupon) . ' ' . 'VNĐ' }}
                                    </td>
                                </tr>
                            @endif
                        @endif


                    </tbody>
                </table>
            </div>
            <div class="row mt-2" style="margin-left: 0px">
                <h5>Vị trí ngồi: {{ $order->tables->ban_ten }}</h5>

            </div>
            <div class="row mt-2" style="margin-left: 0px">
                <h5>Phiên làm việc: {{ $order->shifts->phienlamviec_id }}</h5>

            </div>
            <div class="row mt-2" style="margin-left: 0px">
                <h5>Hình thức thanh toán:
                    @if ($order->hoadon_httt == 1)
                        <i class="fa fa-money-bill text-success"></i> Tiền mặt
                    @elseif ($order->hoadon_httt == 2)
                        <img src="{{ asset('/backend/img/momo.png') }}" width="18px" height="18px"> Chuyển khoản (Ví
                        Momo)
                    @elseif ($order->hoadon_httt == 3)
                        <i class="fa fa-credit-card text-info"></i> Thẻ tín dụng
                    @elseif ($order->hoadon_httt == 4)
                        <img src="{{ asset('/backend/img/vnpay.png') }}" width="20px" height="20px">Chuyển khoản (Ví
                        VNPAY)
                    @else
                        Chưa thanh toán
                    @endif
                </h5>
            </div>
            <a href="{{ url('/all-order') }}" class="btn btn-success">Trở lại</a>

        </div>
    </div>
@endsection
