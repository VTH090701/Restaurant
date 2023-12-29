
<form action="{{ url('/save-order') }}" method="POST">
    @csrf
    <div data-url="{{ route('deleteCart') }}" class="cart">
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
    $cart = Session::get('cart');
    $total = 0;
    if (isset($cart)) {
    ?>
                @foreach ($cart as $id => $cartItem)
                    <?php
                    $total += $cartItem['price'] * $cartItem['quantity'];
                    ?>
                    <tr>
                        <td>{{ $cartItem['name'] }}</td>
                        <td>
                            {{-- <a href="#" class="add_to_cart_plus"
                            data-url="{{ route('addToCartPlus', ['id' => $id]) }}"
                            ><i class="fa fa-plus" aria-hidden="true"></i></a>

                            <input type="number" value="{{ $cartItem['quantity'] }}" min="1" max="10">
                          
                            <a href=""><i class="fa fa-minus" aria-hidden="true"></i></a> --}}
                            <a href="#" class="add_to_cart_plus"
                            data-url="{{ route('addToCartPlus', ['id' =>  $id ]) }}"
                            ><i class="fa fa-plus" aria-hidden="true"></i></a>


                            <input type="number" value="{{ $cartItem['quantity'] }}" min="1" style="width: 50px">
                            <a href="#" class="add_to_cart_minus"
                            data-url="{{ route('addToCartMinus', ['id' =>  $id ]) }}"
                            ><i class="fa fa-minus" aria-hidden="true"></i></a>
                        </td>

                        <td>{{ number_format( $cartItem['price']) . ' ' . 'VNĐ' }}</td>
                        <td>{{ number_format(  $cartItem['price'] * $cartItem['quantity']) . ' ' . 'VNĐ' }}</td>
                        <td>
                            <a href="" data-id="{{ $id }}" class="cart_delete">
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
        <div class="col-sm-6">
            <h5>Tổng tiền: </h5>
        </div>
        <div class="col-sm-6">
            <input type="text" value="{{ number_format($total) . ' ' . 'VNĐ' }}" class="form-control total_order"
                name="total_order" style="color: black; font-size: 20pt;border: azure;font-weight:bold">
        </div>
    </div>


    <div class="row mt-2">
        <div class="col-7">
            <h6>Khách hàng:</h6>
            <div style="display: flex">
                <select class="form-control" name="customer_order">
                    @foreach ($customer_views as $key => $cus)
                        <option value="{{ $cus->khachhang_id }}" class="customer_order">{{ $cus->khachhang_ten }}
                        </option>
                    @endforeach
                </select>
 
            </div>
        </div>

        <div class="col-5">
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
            <input type="text" class="form-control note_order" name="note_order">
            @error('note_order')
            <div class="text-sm " style="color: red">Ghi chú không được để trống</div>
        @enderror
    
        </div>
      
    </div>
    <div class="row mt-3">
        <div class="col-sm-6">
            <input type="submit" class="btn-lg btn-danger save_order" style="width: 100%" value="Lưu">
        </div>
</form>

<div class="col-sm-6">
    {{-- <form action="{{ url('exit-order') }}" method="POST">
        @csrf
        <input type="submit" class="btn-lg btn-success" style="width: 100%" value="Thoát">
    </form> --}}
    <a href="{{ url('exit-order') }}" class="btn btn-lg btn-success " style="width: 100%" >Thoát</a>
</div>
</div>



