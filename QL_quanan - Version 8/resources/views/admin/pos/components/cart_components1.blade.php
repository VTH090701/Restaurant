<form action="{{ url('/save-order-again') }}" method="POST">
    @csrf
    @php
        $order_id = Session::get('order_id');
    @endphp
    <input type="hidden" value="{{ $order_id }}" name="order_id">
    <div data-url-again="{{ route('deleteCartagain') }}" class="cart_again">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Tên món ăn</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php
    $cart1 = Session::get('cart1');
    $total = 0;
    if (isset($cart1)) {
    ?>
                @foreach ($cart1 as $id => $cartItem)
                    <?php
                    $total += $cartItem['price'] * $cartItem['quantity'];
                    ?>
                    <tr>
                        <td>{{ $cartItem['name'] }}</td>
                        <td>
                            <a href="#" class="add_to_cart_again_plus"
                            data-url="{{ route('addTocartagainPlus', ['id' => $id]) }}"><i class="fa fa-plus"
                                aria-hidden="true"></i></a>

                            <input type="number" value="{{ $cartItem['quantity'] }}" min="1" style="width: 50px">


                            <a href="#" class="add_to_cart_again_minus"
                            data-url="{{ route('addToCartagainMinus', ['id' =>  $id ]) }}"
                            ><i class="fa fa-minus" aria-hidden="true"></i></a>

                        </td>
                        <td>{{ number_format( $cartItem['price']) . ' ' . 'VNĐ' }}</td>
                        <td>{{ number_format(  $cartItem['price'] * $cartItem['quantity']) . ' ' . 'VNĐ' }}</td>
                        <td>
                            <a href="" data-id-again="{{ $id }}" class="cart_delete_again">
                                <i class="fa fa-times" aria-hidden="true" style="color: red;"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                <?php
    }else{
    ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php
    }?>
            </tbody>
        </table>

    </div>
    <hr>

    <div class="row">
        <div class="col-6">
            <h5>Tổng tiền: </h5>
        </div>
        <div class="col-6">
            <input type="text" value="{{ number_format($total) . ' ' . 'VNĐ' }}" class="form-control total_order"
                name="total_order" style="color: black; font-size: 20pt;border: azure;font-weight:bold">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <h6>Khách hàng:</h6>
            <select class="form-control" name="customer_order">
                @foreach ($customer_views as $key => $cus)
                    <option value="{{ $cus->khachhang_id }}" class="customer_order">{{ $cus->khachhang_ten }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <h6>Bàn:</h6>
            <select class="form-control" name="table_order">
                @foreach ($table_views as $key => $tab)
                    <option value="{{ $tab->ban_id }}" class="table_order">{{ $tab->ban_ten }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <h6>Ghi chú:</h6>
            @foreach ($table_views as $key => $tab)
                <input type="text" class="form-control note_order" name="note_order"
                    value="{{ $tab->hoadon_ghichu }}">
            @endforeach
        </div>

        {{-- <div class="col-2">
            <a target="_blank" href="{{ url('/print-order/' . $order_id) }}"><i class="fa fa-print"
                    aria-hidden="true" style="font-size: 30pt; margin-top: 18pt"></i>
            </a>
        </div> --}}
    </div>
    <div class="row mt-3">

        <div class="col-sm-6">
            <input type="submit" class="btn-lg btn-danger save_order" style="width: 100%" value="Lưu">
        </div>
</form>
{{-- <div class="col-sm-6">
    <form action="{{ url('/payment-order/' . $order_id) }}" method="POST">
        @csrf
        <input type="submit" class="btn-lg btn-success" style="width: 100%" value="Thanh Toán">
        @foreach ($table_views as $key => $tab)
            <input type="hidden" name="ban_id" style="width: 100%" value="{{ $tab->ban_id }}">
        @endforeach
    </form>
</div> --}}
<div class="col-sm-6">
    {{-- <form action="{{ url('exit-order') }}" method="POST">
        @csrf
        <input type="submit" class="btn-lg btn-success" style="width: 100%" value="Thoát">
    </form> --}}
    <a href="{{ url('exit-order') }}" class="btn btn-lg btn-success " style="width: 100%" >Thoát</a>

</div>
</div>
