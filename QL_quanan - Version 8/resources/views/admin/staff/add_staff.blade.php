@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm nhân viên</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">

                    {{-- <form method="POST" nctype="multipart/form-data"> --}}
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tên nhân viên:</label>
                                <input type="text" class="form-control name" placeholder="Nhập tên khánh hàng"
                                    name="name">
                            </div>
                            @error('name')
                                <div class="text-sm " style="color: red">Tên đặt không được để trống</div>
                            @enderror
                            <div class="form-group">
                                <label for="">Số điện thoại :</label>
                                <input type="text" class="form-control phone" placeholder="Nhập số điện thoại"
                                    name="phone">
                            </div>
                            @error('phone')
                                <div class="text-sm " style="color: red">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="">Email:</label>
                                <input type="text" class="form-control cus_email" placeholder="Nhập email"
                                    name="email">
                            </div>
                            @error('email')
                                <div class="text-sm " style="color: red">Email không được để trống</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Mật khẩu:</label>
                                <input type="password" class="form-control password"placeholder="Nhập mật khẩu"
                                    name="password">
                            </div>
                            @error('password')
                                <div class="text-sm " style="color: red">Mật khẩu không được để trống</div>
                            @enderror
                            <div class="form-group">
                                <label for="">Avatar:</label>
                                <input type="file" class="form-control avatar" placeholder="Nhập hình ảnh"
                                    name="avatar">
                            </div>
                            @error('avatar')
                                <div class="text-sm " style="color: red">Hình ảnh không được để trống</div>
                            @enderror
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <select name="status" id="status" class="form-control status">
                                    <option value="1">Hoạt động</option>
                                    <option value="0">Khóa</option>

                                </select>
                            </div>
                            @error('status')
                                <div class="text-sm " style="color: red">Trạng thái không được để trống</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div>
                                <label for="exampleInputEmail1">Chọn thành phố:</label>
                                <select name="province" id="province" class="form-control province">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div>
                                <label for="exampleInputEmail1">Chọn quận huyện:</label>
                                <select name="district" id="district" class="form-control district">
                                    <option value="">---Chọn quận huyện---</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div>
                                <label for="exampleInputEmail1">Chọn xã phường:</label>

                                <select name="ward" id="ward" class="form-control ward">
                                    <option value="">---Chọn xã---</option>
                                </select>
                            </div>
                        </div>
                    </div>




                    <input type="hidden" name="result" id="result" value="">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Địa chỉ cụ thể:</label>
                        <textarea cols="10" class="form-control location" placeholder="Nhập địa chỉ cụ thể của bạn" name="location"
                            id="result">
                        </textarea>
                    </div>
                    @error('location')
                        <div class="text-sm " style="color: red">Địa chỉ cụ thể không được để trống</div>
                    @enderror



                    <a href="{{ route('staff.index') }}" class="btn btn-success mt-3">Trở lại</a>
                    <button type="submit" name="add_cus" class="btn btn-primary mt-3 add_cus">Thêm nhân viên</button>

                    {{-- <button class="btn btn-primary mt-3 add_cus" >Thêm khách hàng</button> --}}

                    {{-- <input type="button" class="btn btn-primary mt-3 add_cus" value="Thêm khách hàng"> --}}
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript"></script>
@endsection
