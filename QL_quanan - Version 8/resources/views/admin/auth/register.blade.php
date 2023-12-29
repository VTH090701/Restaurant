<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Đăng ký Authentication</title>

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
                                        <h1 class="h4 text-gray-900 mb-4">Đăng ký Authentication!</h1>
                                    </div>
                                    <?php
                                    $mess = Session::get('mess');
                                    if ($mess) {
                                        echo '<div class="alert alert-primary" role="alert">' . $mess . '</div>';                                        
                                        Session::put('mess', null);
                                    }
                                    ?>
                                    @foreach ($errors->all() as $val )
                                        <ul>
                                            <li>{{$val}}</li>
                                        </ul>
                                    @endforeach
                                    <form class="user" method="POST" action="{{ url('/register') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                placeholder="Nhập số họ tên..." value="{{ old('admin_name')}}" name="admin_name">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                placeholder="Nhập số diện thoại..." value="{{ old('admin_phone')}}" name="admin_phone">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                placeholder="Nhập email..." value="{{ old('admin_email')}}" name="admin_email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                placeholder="Nhập password..." value="{{ old('admin_password ')}}" name="admin_password">
                                        </div>

                                        <input type="submit" class="btn btn-primary btn-user btn-block"
                                            value="Đăng ký">
                                    </form>
                                    <hr>
                                    {{-- <div class="text-center">
                                        <a class="small" href="{{url('/register-auth')}}">Tạo tài khoản!</a>
                                    </div> --}}
                                    <div class="text-center">
                                        <a class="small" href="{{url('/admin')}}">Đăng nhập!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{url('/login-auth')}}">Đăng nhập Auth!</a>
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
