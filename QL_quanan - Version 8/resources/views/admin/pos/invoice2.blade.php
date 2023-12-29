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
                <div class="col-7">
                    <h2 class="heading">Mã phiếu nhập: {{ $receipt->pnh_id }} </h2>
                    {{-- <p class="sub-heading">Tracking No. fabcart2025 </p> --}}
                    <p class="sub-heading">Thời gian: {{$receipt->pnh_ngaylapphieu}}</p>
                    <p class="sub-heading">Nhân viên : {{$receipt->admins->nv_ten}} </p>
                </div>
                <div class="col-5">
                    {{-- <h2 class="heading">Invoice to: </h2> --}}

                    {{-- <p class="sub-heading">Nhà cung cấp: {{ $receipt->suppliers->ncc_ten ?? 'None' }} </p>
                    <p>Địa chỉ: {{ $receipt->suppliers->city->name_city ?? 'None' }}, {{ $receipt->suppliers->province->name_district ?? 'None' }}
                        ,{{ $receipt->suppliers->wards->name_town ?? 'None' }} </p>                    
                    <p class="sub-heading">Số điện thoại: {{ $receipt->suppliers->ncc_sdt ?? 'None' }} </p> --}}
                </div>
            </div>
        </div>

        <div class="body-section">
            <h3 class="heading">Chi tiết phiếu nhập</h3>
            <br>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th class="w-20">Tên sản phẩm</th>
                        <th class="w-20">Nhà cung cấp</th>
                        <th >Đơn vị tính</th>
                        <th >Số lượng</th>

                        <th class="w-20">Giá</th>
                        <th class="w-20">Thành tiền</th>

                        {{-- <th>STT</th>
                        <th>Tên hàng</th>
                        <th>Nhà cung cấp</th>

                        <th>Đơn vị tính</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
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
                    <tr>
                        <td colspan="5" class="text-right">Tổng tiền</td>
                        <td> {{ number_format($receipt->pnh_thanhtien) . ' ' . 'VNĐ' }}</td>
                    </tr>
                
                </tbody>
               
            </table>
            <br>
            <h6 class="heading">Ghi chú: {{$receipt->pnh_ghichu}}</h6>
        </div>

        <div class="body-section">
            <p>Đ/c: Đường 3/2, quận Ninh Kiều, thành phố Cần Thơ</p>
            <p>Liên hệ qua: 0914549857</p>
        </div>      
    </div>

</body>

</html>
