@extends('layout')
@section('admin_content')
    {{-- <style>
        .notification {

            position: relative;

        }
        .notification .badge {
            position: absolute;
            top: -10px;
            right: -10px;
            padding: 3px 6px;
            border-radius: 50%;
            background: red;
            color: white;
        }
    </style>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

        <a href="{{ url('/chat') }}" class="notification">
            <i class="fa fa-commenting-o" aria-hidden="true" style="font-size: 20px">
            </i>
            @foreach ($users as $user)
                <div class="badge1" id="badge1">
                    <span class="badge" id="badge"> {{ $user->unread }} </span>
                </div>
            @endforeach
        </a>

    </div> --}}

    <div>
        <style>
            .info {
                background-color: #e7f3fe;
                border-left: 6px solid #2196F3;
            }
        </style>
            @hasanyroles(['admin','nhanvien_pv'])

        @foreach ($reservation as $key => $res)
            <div class="info p-2 mt-2" style="display: flex">
                <p><strong>Note! </strong>Mã lịch đặt:{{ $res->datban_id }} ,{{ $res->table->ban_ten }} - {{ Carbon\Carbon::parse($res->datban_thoigian )->format('H:i:s') }} , {{ $res->datban_ten }} , {{ $res->datban_sdt }} ,
                    số lượng người {{ $res->datban_slnguoi }}
                    @if ($res->datban_kt == 0)
                        <span class="badge -pill badge-info">Chưa đến</span>
                    @elseif($res->datban_kt == 1)
                        <span class="badge -pill badge-success">Đã đến</span>
                    @else
                        <span class="badge -pill badge-danger">Không đến</span>
                    @endif
                </p>

                @if ($res->datban_kt == 0)
                    <div style="margin-left: auto;display: flex;">
                        <form action="{{ url('/customer-checkout-yes/' . $res->datban_id) }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $res->ban_id }}" name="ban_id">
                            <input type="submit" class="btn btn-success btn-sm" value="Khách đến">
                        </form>
                        |
                        <form action="{{ url('/customer-checkout-no/' . $res->datban_id) }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $res->ban_id }}" name="ban_id">
                            <input type="submit" class="btn btn-danger btn-sm" value="Không đến">
                        </form>
                    </div>
                @else
                @endif



            </div>
        @endforeach
        @endhasanyroles



        <hr>



        <div class="dashboard"> 
       


        <div class="row">
            @hasanyroles(['admin','nhanvien_pv'])
            <div class="col-lg-3 col-md-4 mt-2">
                <a href="{{ url('/pos') }}" style="text-decoration: none;color:grey;">
                    <div
                        style="border: 1px; background: #c7f1ef;border: solid #88f4f8;border-radius:5px;text-align: center;padding: 10px 0  ">
                        <i class="fa fa-plus" aria-hidden="true" style="font-size: 70px; margin-top: 8px;"></i>
                        <p style="">Thêm hóa đơn mới</p>
                    </div>
                </a>
            </div>
            @endhasanyroles

            @foreach ($all_order as $key => $order)
                <div class="col-lg-3 col-md-4 mt-2">
                    @if ($order->hoadon_tinhtrang == 0)
                        <div style="border: 1px; background: rgb(237, 242, 197);border: solid #f7ea75;border-radius:5px; ">
                            <div style="text-align: right;"><span class="badge badge-danger" style="font-size: 13px">Vừa gọi
                                    món</span></div>
                        @elseif($order->hoadon_tinhtrang == 1)
                            <div
                                style="border: 1px; background: rgb(206, 247, 202);border: solid #00cc07;border-radius:5px;  ">
                                <div style="text-align: right;"><span class="badge badge-warning"
                                        style="font-size: 13px">Bếp đã xong</span></div>
                            @else
                                <div style="border: 1px; background:#c7f1ef;border: solid #88f4f8;border-radius:5px;  ">
                                    <div style="text-align: right;"><span class="badge badge-primary"
                                            style="font-size: 13px">Hoàn tất</span></div>
                    @endif
                    <div style="text-align: center;padding-bottom: 5px;">
                        HD: {{ $order->tables->ban_ten }}
                        @hasanyroles(['admin','nhanvien_pv'])


                        <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#exampleModal1">Đổi
                            bàn</button>

                            @endhasanyroles

                        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Danh sách bàn</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <p style="font-weight: bold; font-size: 30px;color: black " class="pt-3 pl-2 pr-2">
                                        Danh sách các bàn còn trống
                                    </p>
                                    <div class="modal-body">
                                        <div class="form-group mb-1 ml-2 mr-2">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Bàn</th>
                                                        <th class="w-20">Tình trạng</th>
                                                        <th class="w-20"></th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($table as $tab)
                                                        <tr>
                                                            <td>{{ $tab->ban_ten }}</td>
                                                            <td>Còn trống</td>
                                                            <td>
                                                                <form
                                                                    action="{{ url('/change-table/' . $tab->ban_id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="table_old"
                                                                        value="{{ $order->ban_id }}">
                                                                    <input type="hidden" name="order_id"
                                                                        value="{{ $order->hoadon_id }}">

                                                                    <input type="submit" value="Đổi bàn"
                                                                        class="btn btn-sm btn-success">
                                                                </form>


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



                    </div>
                    <div style="text-align: center;padding-bottom: 5px;">Tổng
                        tiền:{{ number_format($order->hoadon_tongtien) . ' ' . 'VNĐ' }}</div>
                    @hasanyroles(['admin','nhanvien_pv'])
                    <div style="display: flex;padding-bottom: 10px;padding-top: 10px">
                        @if ($order->hoadon_tinhtrang == 1)
                            <button class="btn btn-primary  btn-sm" data-toggle="modal" data-target="#exampleModal"
                                style="margin: auto">
                                Xác nhận
                            </button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Xác nhận món ăn</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <p style="font-weight: bold; font-size: 30px;color: black "
                                            class="pt-3 pl-2 pr-2">
                                            Xác nhận món ăn!
                                        </p>
                                        <p class="ml-2">Nhân viên order: {{ $order->admins->nv_ten }}</p>
                                        <p class="ml-2">Khách hàng: {{ $order->customers->khachhang_ten }}</p>
                                        <p class="ml-2">{{ $order->tables->ban_ten }}</p>
                                        <p class="ml-2">Danh sách món ăn: </p>
                                        <div class="form-group mb-1 ml-2 mr-2">
                                            <table class="table table-bordered">
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
                                        </div>
                                        <h6 class="ml-2">Ghi chú: {{ $order->hoadon_ghichu }}</h6>
                                        <p class="ml-2" style="color: black">Nhân viên vui lòng kiểm tra lại các món ăn
                                            trước khi đem ra bàn!</p>

                                        <form action="{{ url('/confirm-order/' . $order->hoadon_id) }}"
                                            method="POST">
                                            @csrf

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Đóng</button>
                                                <a class="btn btn-warning"
                                                    href="{{ url('/unaccept-order/' . $order->hoadon_id) }}">Không xác
                                                    nhận</a>

                                                <button type="submit" class="btn btn-primary" name="cofirm_order">Xác
                                                    nhận</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                        @endif



                        @if ($order->hoadon_tinhtrang == 0)
                            <a href="{{ url('/add-order-again/' . $order->hoadon_id) }}" class="btn btn-danger  btn-sm"
                                style="margin: auto"> Thêm món</a>
                        @elseif($order->hoadon_tinhtrang == 1)
                            <a href="{{ url('/add-order-again/' . $order->hoadon_id) }}" class="btn btn-danger  btn-sm"
                                style="margin: auto"> Thêm món</a>
                        @else
                            <a href="{{ url('/add-order-again/' . $order->hoadon_id) }}"
                                class="btn btn-danger btn-sm" style="margin: auto"> Thêm món</a>
                        @endif



                        @if ($order->hoadon_tinhtrang == 2)
                            <a href="{{ url('/payment-order/' . $order->hoadon_id) }}" class="btn btn-success btn-sm"
                                style="margin: auto">Thanh toán</a>
                        @endif


                    </div>
                    @endhasanyroles
                    @hasrole('nhanvien_bep')
                        <div style="padding-bottom: 10px;padding-top: 10px">
                            @php
                                $cart_again = Session::get('cart_again');
                            @endphp
                            @if ($cart_again)
                                Xem chi tiết
                            @else
                                <form action="{{ url('/details-order-dashboard') }}" method="POST"
                                    style=" text-align: center;">
                                    @csrf
                                    <input type="hidden" value="{{ $order->hoadon_id }}" name="order_id_again">
                                    <input type="submit" class="btn btn-warning" value="Xem chi tiết"
                                    style="  text-align: center;">
                                </form>
                            @endif

                        </div>
                    @endhasrole
                </div>
            
        </div>
        @endforeach
    </div>

    

</div>



    </div>
@endsection
