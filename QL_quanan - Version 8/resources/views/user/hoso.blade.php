@extends('layout_user')
@section('user_content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="margin: auto">Thông tin khách hàng</h1>
    </div>
    <div class="container rounded bg-white mt-5 mb-5">

        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    {{-- <img class="rounded-circle mt-5"
                    width="150px"src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"> --}}
                    <img class="rounded-circle mt-5" src="public/upload/hoso_kh/{{ $customer->khachhang_hinhanh }}"
                        width="150px" height="190px">
                    <span class="font-weight-bold mt-2">{{ $customer->khachhang_ten }}</span><span
                        class="text-black-50">{{ $customer->khachhang_email }}</span><span>
                    </span>
                </div>
            </div>


            <div class="col-md-9 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Cài đặt hồ sơ</h4>
                    </div>
                    <?php
                    $mess = Session::get('mess');
                    if ($mess) {
                        echo '<div class="alert alert-primary" role="alert">' . $mess . '</div>';
                        Session::put('mess', null);
                    }
                    ?>

                    <form action="{{ url('/hoso-update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Họ và tên</label><input type="text"
                                    class="form-control" value="{{ $customer->khachhang_ten }}" name="cus_name"></div>
                            <div class="col-md-12"><label class="labels">Email</label><input type="text"
                                    class="form-control" value="{{ $customer->khachhang_email }}" name="cus_email"></div>

                            <div class="col-md-12"><label class="labels">Số điện thoại</label><input type="text"
                                    class="form-control" value="{{ $customer->khachhang_sdt }}" name="cus_phone"></div>
                            <div class="col-md-12"><label class="labels">Hình ảnh:</label><input type="file"
                                    class="form-control" name="cus_image">
                            </div>
                            <div class="col-md-12"><label class="labels">Địa chỉ:</label>
                                <textarea cols="10" class="form-control location_old" name="location_old" disabled> {{ $customer->khachhang_diachi }} 
                                </textarea>
                            </div>
                        </div>
                        <div class="mt-3 text-right">
                            <button class="btn btn-primary profile-button" type="submit">Lưu hồ
                                sơ</button>
                                <a href="#boxnoidung" aria-expanded="false" data-toggle="collapse"
                                class="btn btn-primary ml-2">Cập nhật lại địa chỉ</a>
                            </div>

                            <div class="collapse mt-4" id="boxnoidung">
                                <div class="card card-body">
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
                                    <input type="hidden" name="result1" id="result" value="">
        
                                    <div class="form-group">
                                        <label>Địa chỉ cụ thể:</label>
                                        <textarea cols="10" class="form-control location1" name="location1"></textarea>
                                    </div>
                                </div>
                            </div>
                    </form>


                   

                 


                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="text-right">Đổi mật khẩu</h4>
                    </div>
                    <?php
                    $error = Session::get('error');
                    $success = Session::get('success');
                    if ($error) {
                        echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                        Session::put('error', null);
                    } elseif ($success) {
                        echo '<div class="alert alert-primary" role="alert">' . $success . '</div>';
                        Session::put('success', null);
                    }
                    ?>
                    <form action="{{ url('/hoso-password-update') }}" method="POST">
                        @csrf
                        <div class="row mt-3">
                            <input type="hidden" value="{{ $customer->khachhang_id }}" name="pass_id">
                            <div class="col-md-12"><label class="labels">Mật khẩu cũ</label><input type="password"
                                    class="form-control" name="pass_old"></div>
                            <div class="col-md-12"><label class="labels">Mật khẩu mới</label><input type="password"
                                    class="form-control" name="pass_new"></div>
                        </div>
                        <div class="mt-3 text-right"><button class="btn btn-primary profile-button" type="submit">Cập nhật
                                mật khẩu</button></div>
                </div>
                </form>
            </div>
        </div>

    </div>
    </div>
    </div>
    </div>
@endsection
