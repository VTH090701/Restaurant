@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm khánh hàng</h6>
        </div>
        <?php
        $mess = Session::get('mess');
        if ($mess) {
            echo $mess;
            Session::put('mess', null);
        }
        ?>
        <div class="card-body">
            <div class="table-responsive">
                <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">

                    {{-- <form method="POST" nctype="multipart/form-data"> --}}
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tên khách hàng:</label>
                                <input type="text" class="form-control cus_name" placeholder="Nhập tên khánh hàng"
                                    name="cus_name">
                            </div>
                            @error('cus_name')
                                <div class="text-sm " style="color: red">Tên khách hàng không được để trống</div>
                            @enderror
                            <div class="form-group">
                                <label for="">Số điện thoại khách hàng:</label>
                                <input type="text" class="form-control cus_sdt" placeholder="Nhập số điện thoại"
                                    name="cus_sdt">
                            </div>
                            @error('cus_sdt')
                                <div class="text-sm " style="color: red">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="">Email khách hàng:</label>
                                <input type="text" class="form-control cus_email" placeholder="Nhập email"
                                    name="cus_email">
                            </div>
                            @error('cus_email')
                                <div class="text-sm " style="color: red">Email không được để trống</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Mật khẩu:</label>
                                <input type="password" class="form-control cus_password"placeholder="Nhập mật khẩu"
                                    name="cus_password">
                            </div>
                            @error('cus_password')
                                <div class="text-sm " style="color: red">Mật khẩu không được để trống</div>
                            @enderror
                            <div class="form-group">
                                <label for="">Avatar:</label>
                                <input type="file" class="form-control cus_avatar" placeholder="Nhập hình ảnh"
                                    name="cus_avatar">
                            </div>
                            @error('cus_avatar')
                                <div class="text-sm " style="color: red">Avatar không được để trống</div>
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
                                <label for="">Chọn thành phố: (<strong style="color: red">*</strong>) </label>
                                <select name="province" id="province" class="form-control province">
                                </select>
                            </div>
                          
                        </div>
                        <div class="col-md-4">
                            <div>
                                <label for="">Chọn quận huyện:  (<strong style="color: red">*</strong>) </label>
                                <select name="district" id="district" class="form-control district">
                                    <option value="">---Chọn quận huyện---</option>

                                </select>
                            </div>
                            
                        </div>
                        <div class="col-md-4">
                            <div>
                                <label for="">Chọn xã phường:  (<strong style="color: red">*</strong>) </label>

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



                    <a href="{{route('customer.index')}}" class="btn btn-success mt-3">Trở lại</a>

                    <button type="submit" name="add_cus" class="btn btn-primary mt-3 add_cus">Thêm khánh hàng</button>
                    {{-- <button class="btn btn-primary mt-3 add_cus" >Thêm khách hàng</button> --}}

                    {{-- <input type="button" class="btn btn-primary mt-3 add_cus" value="Thêm khách hàng"> --}}
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript"></script>
@endsection
