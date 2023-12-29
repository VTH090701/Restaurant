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
                <div class="col-md-9">
                    <h2 class="heading">Mã hóa đơn: {{ $order->hoadon_id }} </h2>
                    <p class="sub-heading">Thời gian: {{ $order->hoadon_ngaytao }} </p>
                    <p class="sub-heading">Phục vụ: {{ $order->admins->nv_ten }} </p>
                    <p class="sub-heading">{{ $order->table->ban_ten }} </p>

                </div>
                <div class="col-md-3">

                </div>
            </div>
        </div>

        <div class="body-section">
            <h2 class="heading">Phiếu chế biến</h2>
            <br>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th class="w-20">Số lượng</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($order->orderdetails as $item)
                        <tr>
                            <td>{{ $item->products->ma_ten ?? 'None' }}</td>
                            <td>{{ $item->cthoadon_slsp ?? 'None' }}</td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
            <br>
            <p>Ghi chú: {{ $order->hoadon_ghichu }}</p>
        </div>

        <div class="body-section">
            <p>Đ/c: Đường 3/2, quận Ninh Kiều, thành phố Cần Thơ</p>
            <p>Liên hệ qua: 0914549857</p>

        </div>

    </div>

</body>

</html>
