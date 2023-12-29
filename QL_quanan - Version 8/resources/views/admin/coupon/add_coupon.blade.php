@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm giảm giá</h6>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <form method="POST" action="{{ route('coupon.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên mã giảm </label>
                        <input type="text" class="form-control" id="coupon_name" placeholder="Nhập tên giảm giá"
                            name="coupon_name">
                    </div>
                    @error('coupon_name')
                        <div class="text-sm " style="color: red"> {{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="">Mã giảm </label>
                        <input type="text" class="form-control" id="coupon_code" placeholder="Nhập mã giảm"
                            name="coupon_code">
                    </div>
                    @error('coupon_code')
                        <div class="text-sm " style="color: red">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="">Số lượng mã giảm</label>
                        <input type="text" class="form-control" id="coupon_qty" placeholder="Nhập số lượng"
                            name="coupon_qty">
                    </div>
                    @error('coupon_qty')
                        <div class="text-sm " style="color: red">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="">Tính năng mã</label>
                        <select name="coupon_condition" class="form-control">
                            <option value="0">-----Chọn-----</option>
                            <option value="1">Giảm theo tiền</option>
                            <option value="2">Giảm theo phần trăm</option>

                        </select>
                    </div>
                    @error('coupon_condition')
                        <div class="text-sm " style="color: red">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="">Nhập % hoặc số tiền muốn giảm</label>
                        <input type="text" class="form-control" id="coupon_number"
                            placeholder="Nhập % hoặc số tiền muốn giảm" name="coupon_number">
                    </div>
                    @error('coupon_number')
                        <div class="text-sm " style="color: red">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="">Ngày bắt đầu</label>
                        <input type="date" class="form-control" id="date_start" name="date_start">
                    </div>
                    @error('date_start')
                        <div class="text-sm " style="color: red">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="">Ngày kết thúc</label>
                        <input type="date" class="form-control" id="date_end" name="date_end">
                    </div>
                    @error('date_end')
                        <div class="text-sm " style="color: red">{{ $message }}</div>
                    @enderror

                    <a href="{{ route('coupon.index') }}" class="btn btn-success">Trở lại</a>
                    <button type="submit" name="add_cou" class="btn btn-primary">Thêm giảm giá</button>
                </form>
            </div>
        </div>
    </div>
@endsection
