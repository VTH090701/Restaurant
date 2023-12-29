@extends('layout_user')
@section('user_content')
    <!-- Reservation Start -->
    <div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
        <div class="row g-0">
            <div class="col-md-6">
                <img src="{{ asset('/frontend/img/ảnh_login.png') }}" width="100%" height="100%"
                    style="background: rgb(0, 0, 0)">
            </div>
            <div class="col-md-6 bg-dark d-flex align-items-center">
                <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                    <h5 class="section-title ff-secondary text-start text-primary fw-normal">Get password</h5>
                    <h1 class="text-white mb-4">Lấy lại mật khẩu</h1>
                    @foreach ($errors->all() as $val)
                        <ul>
                            <li>{{ $val }}</li>
                        </ul>
                    @endforeach
                    <?php
                    $mess = Session::get('mess');
                    if ($mess) {
                        echo '<div class="alert alert-primary" role="alert">' . $mess . '</div>';
                        Session::put('mess', null);
                    }
                    ?>
                    <form action="{{ url('/forget-password') }}" method="POST">
                        @csrf
                        <div class="mb-3" style="color: white;">
                            Vui lòng nhập email mà bạn đã đăng ký tài khoản trong hệ thống của chúng tôi.
                        </div>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="khachhang_email" name="khachhang_email"
                                        placeholder="Nhập email">
                                    <label for="email"></label>
                                </div>
                                @error('kh_email')
                                    <div class="text-sm " style="color: red">Email người đặt không được để trống</div>
                                @enderror
                            </div>


                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Gửi email xác nhận</button>
                            </div>
                            {{-- <a href="{{url('/dang-ky')}}"> Nếu bạn chưa có tài khoản. Hãy click vào đây để đăng ký !</a>
                            <a href="{{url('/forger-password')}}"> Bạn đã quên mật khẩu. Hãy click vào đây để Lấy lại nó !</a> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
