<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TT Restaurant</title>
    <style>
        body {
            background-color: #F6F6F6;
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
            padding: 0;
        }

        p {
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }

        .brand-section {
            background-color: #0d1033;
            padding: 10px 40px;
        }

        .logo {
            width: 50%;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-6 {
            width: 50%;
            flex: 0 0 auto;
        }

        .text-white {
            color: #fff;
        }

        .company-details {
            float: right;
            text-align: right;
        }

        .body-section {
            padding: 16px;
            border: 1px solid gray;
        }

        .heading {
            font-size: 20px;
            margin-bottom: 08px;
        }

        .sub-heading {
            color: #262626;
            margin-bottom: 05px;
        }

        table {
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }

        table thead tr {
            border: 1px solid #111;
            background-color: #f2f2f2;
        }

        table td {
            vertical-align: middle !important;
            text-align: center;
        }

        table th,
        table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }

        .table-bordered {
            box-shadow: 0px 0px 5px 0.5px gray;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .text-right {
            text-align: end;
        }

        .w-20 {
            width: 20%;
        }

        .float-right {
            float: right;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="brand-section">
            <div class="row">
                <div class="col-6">
                    <h1 class="text-white">TH Restaurant</h1>
                </div>

            </div>
        </div>

        <div class="body-section">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <h2 class="heading">Mã hóa đơn: {{ $order->hoadon_id }} </h2>
                    {{-- <p class="sub-heading">Tracking No. fabcart2025 </p> --}}
                    <p class="sub-heading">Thời gian: {{$order->hoadon_ngaytao}}</p>
                    <p class="sub-heading">Hóa đơn nhập bởi: {{$order->admins->nv_ten}} </p>
                </div>
                <div class="col-md-6 col-xs-12">
                    <h2 class="heading">Invoice to: </h2>
                    <p class="sub-heading">Họ và tên: {{ $order->customers->khachhang_ten ?? 'None' }} </p>
                    <p>Địa chỉ: {{ $order->customers->khachhang_diachi }}
                       </p>                    
                    <p class="sub-heading">Số điện thoại: {{ $order->customers->khachhang_sdt ?? 'None' }} </p>
                    {{-- <p class="sub-heading">City,State,Pincode: {{ $order->customers->khachhang_diachi ?? 'None' }} </p> --}}
                </div>
            </div>
        </div>

        <div class="body-section">
            <h3 class="heading">Chi tiết hóa đơn</h3>
            <br>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th class="w-20">Giá</th>
                        <th class="w-20">Số lượng</th>
                        <th class="w-20">Tổng cộng</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($order->orderdetails as $item)
                        @php
                            $total +=  $item->cthoadon_slsp * $item->cthoadon_giasp 
                        @endphp 
                        <tr>
                            <td>{{ $item->products->ma_ten ?? 'None' }}</td>
                            <td>{{ number_format($item->products->ma_gia) . ' ' . 'VNĐ' }}</td>
                            <td>{{ $item->cthoadon_slsp ?? 'None' }}</td>
                            <td>{{ number_format($item->cthoadon_slsp * $item->cthoadon_giasp) . ' ' . 'VNĐ' }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-right">Tổng tiền</td>
                        <td> {{ number_format($total) . ' ' . 'VNĐ' }}</td>
                    </tr>
                    
                    
                    @if (Session::get('coupon'))
                        @foreach (Session::get('coupon') as $cou)
                            @if ($cou['coupon_condition'] == 1)
                                <tr>
                                    <td colspan="3" class="text-right">Giảm giá:</td>
                                    <td>
                                        {{ number_format($cou['coupon_number']) . ' ' . 'VNĐ' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right">Số tiền sau giảm:</td>
                                    <td>
                                        @php
                                            $total_coupon = $total - $cou['coupon_number'];
                                        @endphp
                                        {{ number_format($total_coupon) . ' ' . 'VNĐ' }}
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="3" class="text-right">Giảm giá:</td>
                                    <td>
                                        {{ $cou['coupon_number'] }}%
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right">Số tiền sau giảm:</td>
                                    <td>
                                        @php
                                            $total_coupon = $total - ($total * $cou['coupon_number']) / 100;
                                        @endphp
                                        {{ number_format($total_coupon) . ' ' . 'VNĐ' }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                    {{-- <tr>
                        <td colspan="3" class="text-right">Khách đưa</td>
                        <td> {{ $total}}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">Tiền thối </td>
                        <td>0</td>
                    </tr> --}}
                </tbody>

            </table>
            <br>
            <h3 class="heading">Vui lòng kiểm tra lại hóa đơn thanh toán!</h3>
            {{-- <h3 class="heading">Payment Mode: Cash on Delivery</h3> --}}
        </div>

        <div class="body-section">
            <p>Đ/c: Đường 3/2, quận Ninh Kiều, thành phố Cần Thơ</p>
            <p>Liên hệ qua: 0914549857</p>
        </div>      
    </div>

</body>

</html>
