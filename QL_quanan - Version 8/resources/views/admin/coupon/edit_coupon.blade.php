@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm giảm giá</h6>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <form method="POST" action="{{ route('coupon.update', $coupon->gg_id) }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="">Tên mã giảm </label>
                        <input type="text" class="form-control" id="coupon_name" placeholder="Nhập tên giảm giá"
                            name="coupon_name" value="{{ $coupon->gg_ten }}">
                    </div>

                    <div class="form-group">
                        <label for="">Mã giảm </label>
                        <input type="text" class="form-control" id="coupon_code" placeholder="Nhập mã giảm"
                            name="coupon_code" value="{{ $coupon->gg_magiam }}">
                    </div>

                    <div class="form-group">
                        <label for="">Số lượng mã giảm</label>
                        <input type="text" class="form-control" id="coupon_qty" placeholder="Nhập số lượng"
                            name="coupon_qty" value="{{ $coupon->gg_soluong }}">
                    </div>


                    <div class="form-group">
                        <label for="">Tính năng mã</label>
                        {{-- <select name="coupon_condition" class="form-control">
                            <option value="0">-----Chọn-----</option>
                            <option value="1">Giảm theo tiền</option>
                            <option value="2">Giảm theo phần trăm</option>

                        </select> --}}

                        <select name="coupon_condition" class="form-control">
                            <option value="0">-----Chọn-----</option>

                            @if ($coupon->gg_tinhnang == 1)
                                <option value="1" selected>Giảm theo tiền</option>
                                <option value="2">Giảm theo phần trăm</option>
                            @else
                                <option value="1">Giảm theo tiền</option>
                                <option selected value="2">Giảm theo phần trăm</option>
                            @endif
                        </select>
                    </div>




                    <div class="form-group">
                        <label for="">Nhập % hoặc số tiền muốn giảm</label>
                        <input type="text" class="form-control" id="coupon_number"
                            placeholder="Nhập % hoặc số tiền muốn giảm" name="coupon_number" value="{{ $coupon->gg_stg }}">
                    </div>
                    <div class="form-group">
                        <label for="">Ngày bắt đầu</label>
                        <input type="date" class="form-control" id="date_start" name="date_start"
                            value="{{ $coupon->gg_ngaybd }}">
                    </div>
                    <div class="form-group">
                        <label for="">Ngày kết thúc</label>
                        <input type="date" class="form-control" id="date_end" name="date_end"
                            value="{{ $coupon->gg_ngaykt }}">
                    </div>
                    <a href="{{ route('coupon.index') }}" class="btn btn-success">Trở lại</a>
                    <button type="submit" name="up_cou" class="btn btn-primary">Cập nhật giảm giá</button>
                </form>
            </div>
        </div>
    </div>
@endsection
