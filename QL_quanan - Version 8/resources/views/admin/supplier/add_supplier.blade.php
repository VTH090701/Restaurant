@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm nhà cung cấp</h6>
        </div>

        <div class="card-body">


            <form action="{{ route('supplier.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="">Tên nhà cung cấp:</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        @error('name')
                            <div class="text-sm " style="color: red">Tên không được để trống</div>
                        @enderror
                        <div class="form-group mb-3">
                            <label for="">Số điện thoại:</label>
                            <input type="text" class="form-control" name="phone">
                        </div>
                        @error('phone')
                            <div class="text-sm " style="color: red">Số điện thoại không được để trống</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="">Email:</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        @error('email')
                            <div class="text-sm " style="color: red">Email không được để trống</div>
                        @enderror
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4">
                        <div>
                            <label for="exampleInputEmail1">Chọn thành phố:(<strong style="color: red">*</strong>)</label>
                            <select name="province" id="province" class="form-control province">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <label for="exampleInputEmail1">Chọn quận huyện:(<strong style="color: red">*</strong>)</label>
                            <select name="district" id="district" class="form-control district">
                                <option value="">---Chọn quận huyện---</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <label for="exampleInputEmail1">Chọn xã phường:(<strong style="color: red">*</strong>)</label>
                            <select name="ward" id="ward" class="form-control ward">
                                <option value="">---Chọn xã---</option>
                            </select>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="result" id="result" value="">

                <div class="form-group mb-3 mt-3">
                    <label for="">Địa chỉ cụ thể:</label>
                    <textarea class="form-control" name="location"></textarea>
                </div>
                @error('location')
                    <div class="text-sm " style="color: red">Địa chỉ cụ thể không được để trống</div>
                @enderror

                <div class="mt-2">
                    <a href="{{ route('supplier.index') }}" class="btn btn-success">Trở lại</a>
                    <button type="submit" class="btn btn-primary" name="add_supplier">Thêm nhà cung cấp</button>
                </div>

            </form>

        </div>



    </div>
@endsection
