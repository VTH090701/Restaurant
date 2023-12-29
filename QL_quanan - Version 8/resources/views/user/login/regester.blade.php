@extends('layout_user')
@section('user_content')
    <script></script>
    <!-- Reservation Start -->
    <div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
        <div class="row g-0">
            <div class="col-md-6">
                <img src="{{ asset('/frontend/img/ảnh_login.png') }}" width="100%" height="100%"
                    style="background: rgb(0, 0, 0)">
            </div>
            <div class="col-md-6 bg-dark d-flex align-items-center">
                <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                    <h5 class="section-title ff-secondary text-start text-primary fw-normal">Regester</h5>
                    <h1 class="text-white mb-4">Đăng ký</h1>

                    <form action="{{ url('/dang-ky') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="email" name="kh_name"
                                        placeholder="Nhập họ tên">
                                    <label for="email">Nhập họ tên</label>
                                </div>
                                @error('kh_name')
                                    <div class="text-sm " style="color: red">{{$message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="kh_phone" name="kh_phone"
                                        placeholder="Nhập số điện thoại">
                                    <label for="email">Nhập số điện thoại</label>
                                </div>
                                @error('kh_phone')
                                    <div class="text-sm " style="color: red">{{$message }}</div>
                                @enderror
                                {{-- @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach --}}

                            </div>
                            <div class="col-md-6 ">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="kh_email"
                                        placeholder="Nhập email">
                                    <label for="email">Nhập email</label>
                                </div>
                                @error('kh_email')
                                    <div class="text-sm " style="color: red">{{$message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 ">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="kh_pass" name="kh_pass"
                                        placeholder="Nhập mật khẩu">
                                    <label for="email">Nhập mật khẩu</label>
                                </div>
                                @error('kh_pass')
                                    <div class="text-sm " style="color: red">{{$message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div>
                                    <label for="">Chọn thành phố:</label>
                                    <select name="province" id="province" class="form-control province">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <label for="">Chọn quận huyện:</label>
                                    <select name="district" id="district" class="form-control district">
                                        <option value="">---Chọn quận huyện---</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <label for="">Chọn xã phường:</label>
                                    <select name="ward" id="ward" class="form-control ward">
                                        <option value="">---Chọn xã---</option>
                                    </select>
                                </div>
                            </div>


                            <input type="hidden" name="result" id="result" value="">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Địa chỉ cụ thể:</label>
                                <textarea cols="10" class="form-control location" placeholder="Nhập địa chỉ cụ thể của bạn" name="location"
                                    id="result">
                                </textarea>
                                @error('location')
                                    <div class="text-sm " style="color: red">{{$message }}</div>
                                @enderror
                            </div>
                            <a href="{{ url('/dang-nhap') }}"> Nếu bạn đã có tài khoản. Hãy click vào đây để đăng nhập
                                !</a>
                            <input type="hidden" value="avatar_user.png" name="kh_image">
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Đăng ký</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
