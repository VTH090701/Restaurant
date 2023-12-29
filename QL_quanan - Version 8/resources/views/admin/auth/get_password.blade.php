<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Đăng nhập Authentication</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('/backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('/backend/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="{{ asset('/backend/img/Ảnh_login.jpg') }}" width="95%">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Đăng nhập Authentication!</h1>
                                    </div>
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
                                    <form
                                        action="{{ url('/get-password-auth/' . $auths->nv_id . '/' . $auths->nv_token) }}"
                                        method="POST">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="password" class="form-control" id="nv_matkhau"
                                                        name="nv_matkhau" placeholder="Nhập mật khẩu mới">
                                                </div>
                                                @error('nv_matkhau')
                                                    <div class="text-sm " style="color: red">Mật khẩu không được để trống
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 ">
                                                <div class="form-group">
                                                    <input type="password" class="form-control"
                                                        id="nv_matkhau_confirm" name="nv_matkhau_confirm"
                                                        placeholder="Nhập lại mật khẩu mới">
                                                </div>
                                                @error('nv_matkhau_confirm')
                                                    <div class="text-sm " style="color: red">Mật khẩu không được để trống
                                                    </div>
                                                @enderror
                                            </div>


                                            <div class="col-12">
                                                <button class="btn btn-primary w-100 py-3" type="submit">Đặt lại mật
                                                    khẩu</button>
                                            </div>
                                            {{-- <a href="{{url('/dang-ky')}}"> Nếu bạn chưa có tài khoản. Hãy click vào đây để đăng ký !</a>
                                                            <a href="{{url('/forget-password')}}"> Bạn đã quên mật khẩu. Hãy click vào đây để Lấy lại nó !</a> --}}
                                        </div>
                                    </form>
                                    <hr>
                                    {{-- <div class="text-center">
                                        <a class="small" href="{{url('/forget-password')}}">Quên mật khẩu?</a>
                                    </div> --}}

                                    <div class="text-center">
                                        <a class="small" href="{{ url('/login-auth') }}">Đăng nhập!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('/backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('/backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/backend/js/sb-admin-2.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
