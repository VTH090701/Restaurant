@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thanh toán hóa đơn</h6>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <h3 style="margin-left: 20px">Mã hóa đơn: {{ $order->hoadon_id }} </h3>
                <p style="margin-left: 20px">Thời gian: {{ $order->hoadon_ngaytao }} </p>
                <p style="margin-left: 20px">Hóa đơn nhập bởi: {{ $order->admins->nv_ten }} </p>
            </div>
            <div class="col-md-6">
                <h3 style="margin-left: 20px">Invoice to: </h3>
                <p style="margin-left: 20px"> Họ và tên: {{ $order->customers->khachhang_ten ?? 'None' }} </p>
                <p style="margin-left: 20px">Địa chỉ: {{ $order->customers->khachhang_diachi }} </p>
                <p style="margin-left: 20px">Số điện thoại: {{ $order->customers->khachhang_sdt ?? 'None' }} </p>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                            $total += $item->cthoadon_slsp * $item->cthoadon_giasp;
                        @endphp
                        <tr>
                            <td>{{ $item->products->ma_ten ?? 'None' }}</td>
                            <td>{{ number_format($item->products->ma_gia) . ' ' . 'VNĐ' }}</td>
                            <td>{{ $item->cthoadon_slsp ?? 'None' }}</td>
                            <td>{{ number_format($item->cthoadon_slsp * $item->cthoadon_giasp) . ' ' . 'VNĐ' }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-right">Tổng tiền:</td>
                        {{-- <td><input type="text" value="{{ $total }}" class="form-control total_order"
                                name="total_order" style="color: black; border: azure;"></td> --}}
                        <td>

                            {{ number_format($total) . ' ' . 'VNĐ' }}
                        </td>
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





                    <form method="POST" action="{{ url('/payment-order-store') }}">
                        @csrf
                        {{-- <tr>
                            <td colspan="3" class="text-right">Khách đưa</td>
                            <td>
                                <input type="number" name="paid_amount" id="paid_amount" class="form-control"
                                    value="0">
                            </td>

                        </tr>
                        <tr>
                            <td colspan="3" class="text-right">Tiền thối </td>
                            <td>
                                <input type="number" name="balance" id="balance" class="form-control" disabled>
                            </td>
                        </tr> --}}
                </tbody>
            </table>

            <h4>Hình thức thanh toán:</h4>
            <div class="row mt-2 ">
                <span class="radio-item  ml-2">
                    <input type="radio" name="payment_method" class="true payment_method" value="1"
                        checked="checked">
                    <label for="payment_method"><i class="fa fa-money-bill text-success"></i> Tiền mặt</label>
                </span>

                <span class="radio-item  ml-2">
                    <input type="radio" name="payment_method" class="true payment_method" value="3">
                    <label for="payment_method"><i class="fa fa-credit-card text-info"></i> Thẻ tín dụng</label>
                </span>
                <span class="radio-item  ml-2">
                    <input type="radio" name="payment_method" class="true payment_method" value="2">
                    <label for="payment_method"><img src="{{ asset('/backend/img/momo.png') }}" width="18px"
                            height="18px"> Chuyển khoản (Ví Momo)</label>
                </span>
                <span class="radio-item  ml-2">
                    <input type="radio" name="payment_method" class="true payment_method" value="4">
                    <label for="payment_method"><img src="{{ asset('/backend/img/vnpay.png') }}" width="20px"
                            height="20px">Chuyển khoản (Ví VNPAY)</label>
                </span>
            </div>



            <div class="row mt-3">
                <div class="col-12" style="display: flex;">
                    <input type="hidden" class="ban_id" name="ban_id" style="width: 100%"
                        value="{{ $order->table->ban_id }}">
                    <input type="hidden" class="order_id" name="order_id" style="width: 100%"
                        value="{{ $order->hoadon_id }}">
                    {{-- <input type="button" class="btn btn-success send_order" value="Thanh toán"> --}}
                    {{-- <input type="submit" class="btn btn-success redirect btn-sm" value="Thanh toán"> --}}
                    <button type="submit" class="btn btn-success btn-sm " name="redirect">Thanh toán</button>
                    </form>

                    {{-- <form action="{{ url('exit-order') }}" method="POST" style="margin-left: 5px">
                        @csrf
                        <input type="submit" class="btn btn-danger" value="Trở lại">
                    </form> --}}
                    <a href="{{ url('/print-invoice/' . $order->hoadon_id) }}"
                        class="btnprn btn btn-warning ml-2 btn-sm">Print</a>

                    <a href="{{ url('/dashboard') }}" class="btn btn-info ml-2 btn-sm">Trở lại</a>


                    <button type="button" class="btn btn-primary ml-2 btn-sm" data-toggle="modal"
                        data-target=".bd-example-modal-lg">Giảm
                        giá</button>


                    @if (Session::get('coupon'))
                        <a href="{{ url('/delete-coupon-checkout') }}" class="btn btn-danger ml-2 btn-sm">Xóa mã giảm</a>
                    @endif

                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <h3 class="m-2 text-center" style="color: black;font-weight: bold">Các loại mã giảm giá
                                </h3>
                                <br>
                                <div class="row mb-4 mr-2 ml-2">
                                    @foreach ($coupon as $key => $cou)
                                        <div class="col-md-4">
                                            <a href="{{ url('/check-coupon/' . $cou->gg_id) }}"
                                                style="text-decoration: none">
                                                <div
                                                    style="border: 3px solid #15b1a9;background-color:#d7fcfa;border-radius: 5px ">
                                                    @if ($cou->gg_tinhnang == 1)
                                                        <p class="m-2" style="color: #15b1a9;font-size: 15px">Loại mã:
                                                            Giảm theo tiền</p>
                                                        <p class="m-3"
                                                            style="color: #15b1a9;font-size: 30px;font-weight: bold">
                                                            {{ number_format($cou->gg_stg) . ' ' . 'VNĐ' }}</p>
                                                    @elseif($cou->gg_tinhnang == 2)
                                                        <p class="m-2" style="color: #15b1a9;font-size: 15px">Loại mã:
                                                            Giảm theo phần trăm</p>
                                                        <p class="m-3"
                                                            style="color: #15b1a9;font-size: 30px;font-weight: bold">
                                                            {{ $cou->gg_stg }}%</p>
                                                    @endif

                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <button type="button" class="btn btn-primary btn-sm ml-2" data-toggle="modal"
                        data-target="#exampleModalLong">
                        Đánh giá
                    </button>

                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Đánh giá của khách hàng</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('/checkout-evaluate/'. $order->hoadon_id ) }}" method="POST">
                                        <div class="row mt-2">
                                            <div class="col">
                                                <h4 class="ml-2">Chất lượng món ăn:</h4>
                                                <span class="radio-item ml-2">
                                                    <input type="radio" name="clma" class="true clma"
                                                        value="5" checked="checked">
                                                    <label for="clma">Tốt</label>
                                                </span>
                                                <span class="radio-item ml-2">
                                                    <input type="radio" name="clma" class="true clma"
                                                        value="4">
                                                    <label for="clma">Khá</label>
                                                </span>
                                                <span class="radio-item ml-2">
                                                    <input type="radio" name="clma" class="true clma"
                                                        value="3">
                                                    <label for="clma">Trung bình</label>
                                                </span>
                                                <span class="radio-item ml-2">
                                                    <input type="radio" name="clma" class="true clma"
                                                        value="2">
                                                    <label for="clma">Kém</label>
                                                </span>
                                                <span class="radio-item ml-2">
                                                    <input type="radio" name="clma" class="true clma"
                                                        value="1">
                                                    <label for="clma">Rất kém</label>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col">
                                                <h4 class="ml-2">Thái độ phục vụ:</h4>
                                                <span class="radio-item ml-2">
                                                    <input type="radio" name="tdpv" class="true tdpv"
                                                        value="5" checked="checked">
                                                    <label for="tdpv">Tốt</label>
                                                </span>
                                                <span class="radio-item ml-2">
                                                    <input type="radio" name="tdpv" class="true tdpv"
                                                        value="4">
                                                    <label for="tdpv">Khá</label>
                                                </span>
                                                <span class="radio-item ml-2">
                                                    <input type="radio" name="tdpv" class="true tdpv"
                                                        value="3">
                                                    <label for="tdpv">Trung bình</label>
                                                </span>
                                                <span class="radio-item ml-2">
                                                    <input type="radio" name="tdpv" class="true tdpv"
                                                        value="2">
                                                    <label for="tdpv">Kém</label>
                                                </span>
                                                <span class="radio-item ml-2">
                                                    <input type="radio" name="tdpv" class="true tdpv"
                                                        value="1">
                                                    <label for="tdpv">Rất kém</label>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col">
                                                <h4 class="ml-2">Không gian cửa hàng:</h4>
                                                <span class="radio-item ml-2">
                                                    <input type="radio" name="kgch" class="true kgch"
                                                        value="5" checked="checked">
                                                    <label for="kgch">Tốt</label>
                                                </span>
                                                <span class="radio-item ml-2">
                                                    <input type="radio" name="kgch" class="true kgch"
                                                        value="4">
                                                    <label for="kgch">Khá</label>
                                                </span>
                                                <span class="radio-item ml-2">
                                                    <input type="radio" name="kgch" class="true kgch"
                                                        value="3">
                                                    <label for="kgch">Trung bình</label>
                                                </span>
                                                <span class="radio-item ml-2">
                                                    <input type="radio" name="kgch" class="true kgch"
                                                        value="2">
                                                    <label for="kgch">Kém</label>
                                                </span>
                                                <span class="radio-item ml-2">
                                                    <input type="radio" name="kgch" class="true kgch"
                                                        value="1">
                                                    <label for="kgch">Rất kém</label>
                                                </span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row ">
                                            <label class="ml-3">Ghi chú phản hồi:</label>
                                            <textarea class="form-control m-3" name="dg_gc"></textarea>
                                        </div>
                                    </form>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng </button>
                                    <button type="button" class="btn btn-primary">Lưu đánh giá</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}



                </div>
            </div>
        </div>
    </div>
    <script></script>
@endsection
