<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TH Admin</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('/backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('/backend/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/backend/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/backend/css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">


    {{-- datatable --}}

    <link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    {{-- chart --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

    {{-- toastr --}}
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    {{-- izitoast --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css"
        integrity="sha512-DIW4FkYTOxjCqRt7oS9BFO+nVOwDL4bzukDyDtMO7crjUZhwpyrWBFroq+IqRe6VnJkTpRAS6nhDvf0w+wHmxg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css"
        integrity="sha512-liDnOrsa/NzR+4VyWQ3fBzsDBzal338A1VfUpQvAcdt+eL88ePCOd3n9VQpdA0Yxi4yglmLy/AmH+Lrzmn0eMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ url('/dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    {{-- <i class="fas fa-laugh-wink"></i> --}}
                    <i class="fa fa-cog" aria-hidden="true"></i>

                </div>
                <div class="sidebar-brand-text mx-3">TH System <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            {{-- <li class="nav-item active"> --}}
            <li class="nav-item ">
                <a class="nav-link" href="{{ url('/dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            {{-- <div class="sidebar-heading">
                Interface
            </div> --}}

            @hasanyroles(['admin','nhanvien_pv','nhanvien_bep'])

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo14"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa fa-database" aria-hidden="true"></i>
                    <span>Quản lý dữ liệu</span>
                </a>
                <div id="collapseTwo14" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @hasrole('admin')
                            {{-- <a class="collapse-item" href="{{ url('/all-category') }}">Danh mục</a> --}}
                            <a class="collapse-item" href="{{ route('category.index') }}">Danh mục</a>
                            <a class="collapse-item" href="{{ route('product.index') }}">Món ăn</a>
                            <a class="collapse-item" href="{{ route('table.index') }}">Bàn</a>
                            <a class="collapse-item" href="{{ route('customer.index') }}">Khách hàng</a>
                        @endhasrole
                        <a class="collapse-item" href="{{ url('/all-order') }}">Hóa đơn</a>
                        @hasrole('admin')
                            <a class="collapse-item" href="{{ url('/all-comment') }}">Bình luận</a>
                            <a class="collapse-item" href="{{ route('coupon.index') }}">Giảm giá</a>
                            <a class="collapse-item" href="{{ route('post.index') }}">Bài viết</a>
                            <a class="collapse-item" href="{{ url('/all-reservation') }}">Lịch đặt bàn</a>
                            <a class="collapse-item" href="{{ url('/config-email') }}">Cấu hình email</a>
                            <a class="collapse-item" href="{{ url('/all-receipt') }}">Phiếu nhập hàng</a>
                            <a class="collapse-item" href="{{ route('ingredient.index') }}">Nguyên liệu</a>
                            <a class="collapse-item" href="{{ route('supplier.index') }}">Nhà cung cấp</a>
                            <a class="collapse-item" href="{{ route('staff.index') }}">Nhân viên</a>
                            <a class="collapse-item" href="{{ url('/all-input-receipt') }}">Kho</a>
                            <a class="collapse-item" href="{{ route('quantitative.index') }}">Khai báo định lượng</a>
                        @endhasrole

                    </div>
                </div>
            </li>
            @endhasanyroles

            @hasrole('admin')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo16"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        <span>Thống kê báo cáo</span>
                    </a>
                    <div id="collapseTwo16" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ url('/statictical') }}">Doanh thu</a>
                            <a class="collapse-item" href="{{ url('/statictical-data') }}">Số liệu</a>

                            {{-- <a class="collapse-item" href="{{ url('/chat') }}">Nhắn tin</a> --}}

                        </div>
                    </div>
                </li>
            @endhasrole

            @hasanyroles(['nhanvien_bep','nhanvien_pv','admin'])

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo15"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Hoạt động</span>
                </a>
                <div id="collapseTwo15" class="collapse" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ url('/all-shift') }}">Phiên làm việc</a>
                        <a class="collapse-item" href="{{ url('/chat') }}">Nhắn tin</a>

                    </div>
                </div>
            </li>
            @endhasanyroles


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="{{ url('/chat') }}" id="searchDropdown">
                                <i class="fa fa-commenting-o" aria-hidden="true" style="font-size: 20px">
                                </i>

                                @foreach ($user_message as $user)
                                    <div class="badge1" id="badge1">
                                        <span class="badge" id="badge"
                                            style="
                                    position: relative;
                                    top: -10px;
                                    right: 10px;
                                    padding: 2px 4px;
                                    border-radius: 50%;
                                    background: red;
                                    color: white;">
                                            {{ $user->unread }}</span>
                                    </div>
                                @endforeach

                            </a>

                        </li>



                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{-- <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Session::get('admin_name') }}</span> --}}
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nv_ten }}</span>

                                {{-- <img class="img-profile rounded-circle"
                                    src="public/upload/profile/{{ Session::get('admin_image') }}" width="150px"
                                    height="190px"> --}}
                                <img class="img-profile rounded-circle"
                                    src="/public/upload/hoso_nv/{{ Auth::user()->nv_hinhanh }}" width="150px"
                                    height="190px">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ url('/profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                               
                                <div class="dropdown-divider"></div>
                               
                                <a class="dropdown-item" href="{{ url('/logout-auth') }}" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('admin_content')
                   
                  
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sẵn sàng thoát?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Đăng xuất" bên dưới nếu bạn đã sẵn sàng kết thúc phiên hiện tại của mình.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Trở lại</button>
                    {{-- <a class="btn btn-primary" href="{{ url('/logout') }}">Đăng xuất</a> --}}
                    <a class="btn btn-primary" href="{{ url('/logout-auth') }}">Đăng xuất</a>

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

    <script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>

    {{-- JS tỉnh thành --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.5.1/axios.min.js"
        integrity="sha512-emSwuKiMyYedRwflbZB2ghzX8Cw8fmNVgZ6yQNNXXagFzFOaQmbvQ1vmDkddHjm5AITcBIZfC7k4ShQSjgPAmQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('/backend/js/index.js') }}"></script>

    {{-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script> --}}
    <script src="http://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
   
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>



    {{-- Chart --}}

    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    {{-- FullCalendar --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"
        integrity="sha512-iusSCweltSRVrjOz+4nxOL9OXh2UA0m8KdjsX8/KUUiJz+TCNzalwE0WE6dYTfHDkXuGuHq3W9YIhDLN7UNB0w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Toastr --}}
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

    {{-- izitoast --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
        integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Pusher --}}
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="{{ asset('/backend/js/printPage.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
    <script src="{{ asset('/backend/js/layout.js') }}"></script>



  
    <script>
      
        ClassicEditor
            .create(document.querySelector('#ckeditor'))
            .then(editor => {
                console.log(editor);

            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#ckeditor1'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>


    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
        var pusher = new Pusher('41416ec66a8e6efbc43a', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('TH-app');
        channel.bind('notice', function(data) {
            iziToast.success({
                title: 'Thông báo',
                message: data.message

            });

            window.setTimeout(function() {
                // location.reload();
                $('.dashboard').load(location.href + " .dashboard");
            }, 6000);

        });
    </script>





    <script type="text/javascript">
        // Bảng hóa đơn
        $(function() {
            $('#start_date').datepicker({
                "dateFormat": "yy-mm-dd"
            });
            $('#end_date').datepicker({
                "dateFormat": "yy-mm-dd"
            });
        });


        function fetch(start_date, end_date) {

            $(function() {
                var table = $('.myTableord').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('list_order') }}",
                        data: {
                            start_date: start_date,
                            end_date: end_date,
                        }
                    },

                    columns: [{
                            data: 'hoadon_id',
                            name: 'hoadon_id'
                        },
                        {
                            data: 'tongtien',
                            name: 'tongtien'
                        },

                        {
                            data: 'ban',
                            name: 'ban',
                        }, {
                            data: 'nv',
                            name: 'nv',
                        },
                        {
                            data: 'ten_kh',
                            name: 'ten_kh',
                        },
                        {
                            data: 'status',
                            name: 'status',
                        },
                        {
                            data: 'hoadon_ngaytao',
                            name: 'hoadon_ngaytao',
                        },
                        {
                            data: 'action',
                            name: 'action',

                        },
                    ]
                });
            })
        }
        fetch();

        $(document).on("click", "#filter", function(e) {
            e.preventDefault();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            if (start_date == "" || end_date == "") {
                alert('Chọn ngày cả hai');
            } else {
                $('.myTableord').DataTable().destroy();
                fetch(start_date, end_date);
            }
        });


        //Bảng phiên làm việc

        $(function() {
            $('#start_date1').datepicker({
                "dateFormat": "yy-mm-dd"
            });
            $('#end_date1').datepicker({
                "dateFormat": "yy-mm-dd"
            });
        });

        function fetch1(start_date1, end_date1) {
            $(function() {
                var table = $('.myTableshi').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('list_shift') }}",
                        data: {
                            start_date1: start_date1,
                            end_date1: end_date1,
                        }
                    },
                    columns: [{
                            data: 'phienlamviec_id',
                            name: 'phienlamviec_id'
                        },
                        {
                            data: 'ten_nv',
                            name: 'ten_nv'
                        },
                        {
                            data: 'phienlamviec_tgbd',
                            name: 'phienlamviec_tgbd'
                        },
                        {
                            data: 'phienlamviec_tgkt',
                            name: 'phienlamviec_tgkt',
                        },
                        {
                            data: 'status',
                            name: 'status',
                        },
                        {
                            data: 'dt',
                            name: 'dt',
                        },
                        {
                            data: 'tc',
                            name: 'tc',
                        },
                        {
                            data: 'action',
                            name: 'action',

                        },
                    ]
                });
            })
        }
        fetch1();

        $(document).on("click", "#filter1", function(e) {
            e.preventDefault();
            var start_date1 = $("#start_date1").val();
            var end_date1 = $("#end_date1").val();

            if (start_date1 == "" || end_date1 == "") {
                alert('Chọn ngày cả hai');
            } else {
                $('.myTableshi').DataTable().destroy();
                fetch1(start_date1, end_date1);
            }
        });

        // Bảng đặt bàn 
        $(function() {
            $('#start_date2').datepicker({
                "dateFormat": "yy-mm-dd"
            });
            $('#end_date2').datepicker({
                "dateFormat": "yy-mm-dd"
            });
        });

        function fetch2(start_date2, end_date2) {
            $(function() {
                var table = $('.myTableres').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('list_reservation') }}",
                        data: {
                            start_date2: start_date2,
                            end_date2: end_date2,
                        }
                    },
                    columns: [{
                            data: 'datban_id',
                            name: 'datban_id'
                        },
                        {
                            data: 'datban_ten',
                            name: 'datban_ten'
                        },
                        {
                            data: 'datban_email',
                            name: 'datban_email'
                        },
                        {
                            data: 'datban_sdt',
                            name: 'datban_sdt',
                        },
                        {
                            data: 'datban_thoigian',
                            name: 'datban_thoigian',
                        },
                        {
                            data: 'ban',
                            name: 'ban',
                        },
                        {
                            data: 'datban_slnguoi',
                            name: 'datban_slnguoi',
                        },
                        {
                            data: 'tinhtrang',
                            name: 'tinhtrang',
                        },
                        {
                            data: 'checkout',
                            name: 'checkout',
                        },
                        {
                            data: 'action',
                            name: 'action',

                        },
                    ]
                });
            })
        }
        fetch2();

        $(document).on("click", "#filter2", function(e) {
            e.preventDefault();
            var start_date2 = $("#start_date2").val();
            var end_date2 = $("#end_date2").val();

            if (start_date2 == "" || end_date2 == "") {
                alert('Chọn ngày cả hai');
            } else {
                $('.myTableres').DataTable().destroy();
                fetch2(start_date2, end_date2);
            }
        });

        //Bảng bài viếy
        $(function() {
            $('#start_date6').datepicker({
                "dateFormat": "yy-mm-dd"
            });
            $('#end_date6').datepicker({
                "dateFormat": "yy-mm-dd"
            });
        });


        function fetch6(start_date6, end_date6) {
            $(function() {
                var table = $('.myTablepost').DataTable({
                    processing: true,
                    serverSide: true,
                    //ajax: "{{ route('list_post') }}",
                    ajax: {
                        url: "{{ route('list_post') }}",
                        data: {
                            start_date6: start_date6,
                            end_date6: end_date6,
                        }
                    },
                    columns: [{
                            data: 'baiviet_id',
                            name: 'baiviet_id'
                        },
                        {
                            data: 'nv',
                            name: 'nv'
                        },
                        {
                            data: 'baiviet_tieude',
                            name: 'baiviet_tieude'
                        },
                        {
                            data: 'image',
                            name: 'image'
                        },
                        {
                            data: 'desc',
                            name: 'desc'
                        },
                        {
                            data: 'baiviet_tgd',
                            name: 'baiviet_tgd'
                        },
                        {
                            data: 'baiviet_tgcn',
                            name: 'baiviet_tgcn'
                        },
                        {
                            data: 'active',
                            name: 'active',
                        },
                        {
                            data: 'action',
                            name: 'action',

                        },
                    ]
                });
            })
        }
        fetch6();

        $(document).on("click", "#filter6", function(e) {
            e.preventDefault();
            var start_date6 = $("#start_date6").val();
            var end_date6 = $("#end_date6").val();
            if (start_date6 == "" || end_date6 == "") {
                alert('Chọn ngày cả hai');
            } else {
                $('.myTablepost').DataTable().destroy();
                fetch6(start_date6, end_date6);
            }
        });
        // Bảng danh mục
        $(function() {
            var table = $('.myTablecat').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('list_category') }}",
                columns: [{
                        data: 'danhmuc_id',
                        name: 'danhmuc_id'
                    },
                    {
                        data: 'danhmuc_ten',
                        name: 'danhmuc_ten'
                    },
                    {
                        data: 'danhmuc_mota',
                        name: 'danhmuc_mota'
                    },
                    {
                        data: 'active',
                        name: 'active',
                    },
                    {
                        data: 'action',
                        name: 'action',

                    },
                ]
            });
        })
        //Bảng bình luận
        $(function() {
            $('#start_date4').datepicker({
                "dateFormat": "yy-mm-dd"
            });
            $('#end_date4').datepicker({
                "dateFormat": "yy-mm-dd"
            });
        });


        function fetch4(start_date4, end_date4) {

            $(function() {
                var table = $('.myTablecom').DataTable({
                    processing: true,
                    serverSide: true,

                    // ajax: "{{ route('list_comment') }}",
                    ajax: {
                        url: "{{ route('list_comment') }}",
                        data: {
                            start_date4: start_date4,
                            end_date4: end_date4,
                        }
                    },
                    columns: [{
                            data: 'binhluan_id',
                            name: 'binhluan_id'
                        },
                        {
                            data: 'ten_kh',
                            name: 'ten_kh'
                        },
                        {
                            data: 'binhluan_noidung',
                            name: 'binhluan_noidung'
                        },
                        {
                            data: 'ten_ma',
                            name: 'ten_ma'
                        },
                        {
                            data: 'binhluan_thoigian',
                            name: 'binhluan_thoigian',
                        },
                        {
                            data: 'status',
                            name: 'status',
                        },
                        {
                            data: 'action',
                            name: 'action',

                        },
                    ]
                });
            })
        }
        fetch4();

        $(document).on("click", "#filter4", function(e) {
            e.preventDefault();
            var start_date4 = $("#start_date4").val();
            var end_date4 = $("#end_date4").val();

            if (start_date4 == "" || end_date4 == "") {
                alert('Chọn ngày cả hai');
            } else {
                $('.myTablecom').DataTable().destroy();
                fetch4(start_date4, end_date4);
            }
        });

        //Bảng nguyên liệu
        $(function() {
            var table = $('.myTableing').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('list_ingredient') }}",
                columns: [{
                        data: 'nl_id',
                        name: 'nl_id'
                    },
                    {
                        data: 'nl_ten',
                        name: 'nl_ten'
                    },
                    {
                        data: 'nl_dvt',
                        name: 'nl_dvt'
                    },
                   
                    {
                        data: 'active',
                        name: 'active',
                    },
                    {
                        data: 'action',
                        name: 'action',

                    },
                ]
            });
        })

        //Bảng nhà cung cấp
        $(function() {
            var table = $('.myTablesup').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('list_supplier') }}",
                columns: [{
                        data: 'ncc_id',
                        name: 'ncc_id'
                    },
                    {
                        data: 'ncc_ten',
                        name: 'ncc_ten'
                    },
                    {
                        data: 'ncc_sdt',
                        name: 'ncc_sdt'
                    },
                    {
                        data: 'ncc_email',
                        name: 'ncc_email'
                    },
                    {
                        data: 'ncc_diachi',
                        name: 'ncc_diachi'
                    },

                    {
                        data: 'action',
                        name: 'action',

                    },
                ]
            });
        })
        //Bảng all-input-receipt
        $(function() {
            var table = $('.myTableall').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('list_all_input_receipt') }}",
                columns: [{
                        data: 'nl_id',
                        name: 'nl_id'
                    },
                    {
                        data: 'nl_ten',
                        name: 'nl_ten'
                    },
                    {
                        data: 'sl',
                        name: 'sl'
                    },


                ]
            });
        })

        //Bảng bàn
        $(function() {
            var table = $('.myTabletab').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('list_table') }}",
                columns: [{
                        data: 'ban_id',
                        name: 'ban_id'
                    },
                    {
                        data: 'ban_ten',
                        name: 'ban_ten'
                    },
                    {
                        data: 'ban_slnguoi',
                        name: 'ban_slnguoi'
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'action',
                        name: 'action',

                    },
                ]
            });
        })


        //Bảng định lượng món ăn
        $(function() {
            var table = $('.myTablequan').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('list_quantitative') }}",
                columns: [{
                        data: 'dl_id',
                        name: 'dl_id'
                    },
                    {
                        data: 'ma_ten',
                        name: 'ma_ten',

                    }, {
                        data: 'ma_ha',
                        name: 'ma_ha',

                    },
                    {
                        data: 'dl_dvt',
                        name: 'dl_dvt',

                    },
                    {
                        data: 'active',
                        name: 'active',

                    },
                    {
                        data: 'action',
                        name: 'action',

                    },
                ]
            });
        })

        //Bảng giảm giá
        $(function() {
            $('#start_date5').datepicker({
                "dateFormat": "yy-mm-dd"
            });
            $('#end_date5').datepicker({
                "dateFormat": "yy-mm-dd"
            });
        });


        function fetch5(start_date5, end_date5) {
            $(function() {
                var table = $('.myTablecou').DataTable({
                    processing: true,
                    serverSide: true,
                    //ajax: "{{ route('list_coupon') }}",
                    ajax: {
                        url: "{{ route('list_coupon') }}",
                        data: {
                            start_date5: start_date5,
                            end_date5: end_date5,
                        }
                    },
                    columns: [{
                            data: 'gg_ten',
                            name: 'gg_ten'
                        },
                        {
                            data: 'gg_magiam',
                            name: 'gg_magiam',

                        },
                        {
                            data: 'gg_soluong',
                            name: 'gg_soluong',

                        }, {
                            data: 'tinhnang',
                            name: 'tinhnang',

                        }, {
                            data: 'stg',
                            name: 'stg',

                        },
                        {
                            data: 'gg_ngaybd',
                            name: 'gg_ngaybd',

                        },
                        {
                            data: 'gg_ngaykt',
                            name: 'gg_ngaykt',

                        },
                        {
                            data: 'status',
                            name: 'status',

                        },
                        {
                            data: 'action',
                            name: 'action',

                        },
                    ]
                });
            })
        }
        fetch5();

        $(document).on("click", "#filter5", function(e) {
            e.preventDefault();
            var start_date5 = $("#start_date5").val();
            var end_date5 = $("#end_date5").val();
            if (start_date5 == "" || end_date5 == "") {
                alert('Chọn ngày cả hai');
            } else {
                $('.myTablecou').DataTable().destroy();
                fetch5(start_date5, end_date5);
            }
        });

        //Bảng khách hàng
        $(function() {
            var table = $('.myTablecus').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('list_customer') }}",
                columns: [{
                        data: 'khachhang_id',
                        name: 'khachhang_id'
                    },
                    {
                        data: 'khachhang_ten',
                        name: 'khachhang_ten'
                    },
                    {
                        data: 'avatar',
                        name: 'avatar'
                    },
                    {
                        data: 'khachhang_sdt',
                        name: 'khachhang_sdt',
                    },
                    {
                        data: 'khachhang_email',
                        name: 'khachhang_email',
                    },
                    {
                        data: 'khachhang_diachi',
                        name: 'khachhang_diachi',
                    },
                    {
                        data: 'status',
                        name: 'status',

                    },
                    {
                        data: 'action',
                        name: 'action',

                    },
                ]
            });
        })
        $(function() {
            var table = $('.myTablepro').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('list_product') }}",
                columns: [{
                        data: 'ma_id',
                        name: 'sp_id'
                    },
                    {
                        data: 'ma_ten',
                        name: 'ma_ten'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'gallery',
                        name: 'gallery'
                    },
                    {
                        data: 'danhmuc_ten',
                        name: 'danhmuc_ten'
                    },
                    {
                        data: 'sp_price',
                        name: 'sp_price'
                    },
                    {
                        data: 'active',
                        name: 'active',

                    },
                    {
                        data: 'action',
                        name: 'action',

                    },
                ]
            });
        })

        //Bảng phiếu nhập
        $(function() {
            $('#start_date3').datepicker({
                "dateFormat": "yy-mm-dd"
            });
            $('#end_date3').datepicker({
                "dateFormat": "yy-mm-dd"
            });
        });

        function fetch3(start_date3, end_date3) {
            $(function() {
                var table = $('.myTablerec').DataTable({
                    processing: true,
                    serverSide: true,
                    //ajax: "{{ route('list_receipt') }}",
                    ajax: {
                        url: "{{ route('list_receipt') }}",
                        data: {
                            start_date3: start_date3,
                            end_date3: end_date3,
                        }
                    },
                    columns: [{
                            data: 'pnh_id',
                            name: 'pnh_id'
                        },

                        {
                            data: 'ten_nv',
                            name: 'ten_nv'
                        },

                        {
                            data: 'thanhtien',
                            name: 'thanhtien'
                        },
                        {
                            data: 'pnh_ngaylapphieu',
                            name: 'pnh_ngaylapphieu'
                        },
                    
                        {
                            data: 'action',
                            name: 'action',

                        },
                    ]
                });
            })
        }
        fetch3();

        $(document).on("click", "#filter3", function(e) {
            e.preventDefault();
            var start_date3 = $("#start_date3").val();
            var end_date3 = $("#end_date3").val();
            if (start_date3 == "" || end_date3 == "") {
                alert('Chọn ngày cả hai');
            } else {
                $('.myTablerec').DataTable().destroy();
                fetch3(start_date3, end_date3);
            }
        });

        //Bảng nhân viên
        $(function() {
            var table = $('.myTablesta').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('list_staff') }}",
                columns: [{
                        data: 'nv_id',
                        name: 'nv_id'
                    },
                    {
                        data: 'nv_ten',
                        name: 'nv_ten'
                    },
                    {
                        data: 'avatar',
                        name: 'avatar'
                    },
                    {
                        data: 'nv_email',
                        name: 'nv_email'
                    },
                    {
                        data: 'nv_sdt',
                        name: 'nv_sdt'
                    },
                    {
                        data: 'nv_diachi',
                        name: 'nv_diachi'
                    },
                    {
                        data: 'status',
                        name: 'status'

                    },
                    {
                        data: 'action',
                        name: 'action'

                    },
                ]
            });
        })

        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name ="_token"]').val();
                var result = '';

                if (action == 'city') {
                    result = 'province';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: "{{ url('/select-location') }}",
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }

                });
            });
        });



        $('#paid_amount').keyup(function() {
            var total = $('.total_order').val();
            var paid_amount = $(this).val();
            var tot = paid_amount - total;
            $('#balance').val((tot));
        });


        $('.input-search-ajax').keyup(function() {
            var _text = $(this).val();
            var _token = $('input[name ="_token"]').val();
            $.ajax({
                url: "{{ url('/search') }}",
                method: "POST",
                data: {
                    _text: _text,
                    _token: _token
                },
                success: function(data) {
                    if (data.code == 200) {
                        // $('.product-list').attr(null);
                        $('.product-list').html(data.search_components);
                    }
                },
                error: function() {}
            });
        });


        $('.input-search-ajax1').keyup(function() {
            var _text = $(this).val();
            var _token = $('input[name ="_token"]').val();
            $.ajax({
                url: "{{ url('/search1') }}",
                method: "POST",
                data: {
                    _text: _text,
                    _token: _token
                },
                success: function(data) {
                    if (data.code == 200) {
                        // $('.product-list').attr(null);
                        $('.product-list').html(data.search_components1);
                    }
                },
                error: function() {}
            });
        });

        
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            chart30daysorder();

            var chart =
                new Morris.Bar({
                    element: 'myfirstchart',
                    lineColors: ['#819C79', '#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
                    parseTime: false,
                    hideHover: 'auto',
            
                    xkey: 'period',
                    ykeys: ['order', 'sales', 'expense', 'quantity'],
                    labels: ['đơn hàng', 'doanh thu', 'chi phí', 'số lượng']
                });

            $(function() {
                $("#datepicker_tk1").datepicker({
                    prevText: "Tháng trước",
                    nextText: "Tháng sau",
                    dateFormat: "yy-mm-dd",
                    dayNamesMin: [
                        'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'
                    ],
                    duration: 'slow'
                });
                $("#datepicker_tk2").datepicker({
                    prevText: "Tháng trước",
                    nextText: "Tháng sau",
                    dateFormat: "yy-mm-dd",
                    dayNamesMin: [
                        'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'
                    ],
                    duration: 'slow'
                });

            });

            function chart30daysorder() {
                var _token = $('input[name ="_token"]').val();
                $.ajax({
                    url: "{{ url('/days-order') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        chart.setData(data);
                    }
                });
            }

            $('.statictical-filter').change(function() {
                var statictical_value = $(this).val();
                var _token = $('input[name ="_token"]').val();
                $.ajax({
                    url: "{{ url('/statictical-filter') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        statictical_value: statictical_value,
                        _token: _token
                    },
                    success: function(data) {
                        chart.setData(data);
                    }
                });

            });

            $('#btn-statictical-filter').click(function() {
                var _token = $('input[name ="_token"]').val();
                var from_date = $('#datepicker_tk1').val();
                var to_date = $('#datepicker_tk2').val();
                $.ajax({
                    url: "{{ url('/filter-by-date') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        from_date: from_date,
                        to_date: to_date,
                        _token: _token
                    },
                    success: function(data) {

                        chart.setData(data);
                    }
                });
            });

        });


    </script>
    <script>
        $(document).ready(function() {
            load_gallery()

            function load_gallery() {
                var pro_id = $('.pro_id').val();
                var _token = $('input[name ="_token"]').val();

                //alert(pro_id);
                $.ajax({
                    url: "{{ url('/select-gallery') }}",
                    method: "POST",
                    data: {
                        pro_id: pro_id,
                        _token: _token

                    },
                    success: function(data) {
                        $('#gallery_load').html(data);
                    }
                });

            }


            $('#file').change(function() {
                var error = '';
                var files = $('#file')[0].files;

                if (files.length > 5) {
                    error += '<p>Bạn chỉ tối đa được 5 ảnh</p>';
                } else if (files.length == '') {
                    error += '<p>Bạn không được bỏ trống ảnh</p>';
                } else if (files.size > 200000000) {
                    error += '<p>File ảnh không được lớn hơn 2MB</p>';
                }

                if (error == '') {
                } else {
                    $('#file').val('');
                    return false;
                }

            });



            $(document).on('blur', '.edit_gal_name', function() {
                var gal_id = $(this).data('gal_id');
                var gal_text = $(this).text();
                var _token = $('input[name ="_token"]').val();
                $.ajax({
                    url: "{{ url('/update-gallery-name') }}",
                    method: "POST",
                    data: {
                        gal_id: gal_id,
                        gal_text: gal_text,
                        _token: _token
                    },
                    success: function(data) {
                        load_gallery();
                        $('#error_gallery').html(
                            '<span class="text-danger">Cập nhật sản phẩm thành công</span>');

                    }
                });
            });


            $(document).on('click', '.delete-gallery', function() {
                var gal_id = $(this).data('gal_id');
                var _token = $('input[name ="_token"]').val();
                if (confirm('Bạn có muốn xóa ảnh này?')) {
                    $.ajax({
                        url: "{{ url('/delete-gallery') }}",
                        method: "POST",
                        data: {
                            gal_id: gal_id,

                            _token: _token
                        },
                        success: function(data) {
                            load_gallery();
                            $('#error_gallery').html(
                                '<span class="text-danger">Xóa hình ảnh thành công</span>');

                        }
                    });
                }
            });
        });
    </script>

    <script>
        $('.year-filter').change(function() {
            var statictical_value = $(this).val();
            var _token = $('input[name ="_token"]').val();

            $.ajax({
                url: "{{ url('/year-filter') }}",
                method: "POST",
                data: {
                    statictical_value: statictical_value,
                    _token: _token
                },
                success: function(data) {
                    if (data.code == 200) {
                        // $('.product-list').attr(null);
                        $('.statistical-list').html(data.statistical_component);
                    }
                },
                error: function() {}
            });

        });
    </script>


    <script script type="text/javascript">
        $(document).ready(function() {
            $('.btnprn').printPage();
        });
    </script>





    <script>
        var receiver_id = '';
        var my_id = "{{ Auth::id() }}";
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            Pusher.logToConsole = true;

            var pusher = new Pusher('41416ec66a8e6efbc43a', {
                cluster: 'ap1'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {

                if (my_id == data.nv_id_tntu) {
                    $('#' + data.nv_id_tnden).click();

                } else if (my_id == data.nv_id_tnden) {

                    if (receiver_id == data.nv_id_tntu) {
                        $('#' + data.nv_id_tntu).click();
                    } else {
                        var pending = parseInt($('#' + data.nv_id_tntu).find('.pending').html());


                        var badge = parseInt($('#badge1').find('.badge').html());
                        if (badge) {
                            $('#badge').html(badge + 1);
                        } else {
                            $('#badge').html(badge + 1);

                        }


                        if (pending) {
                            $('#' + data.nv_id_tntu).find('.pending').html(pending + 1);


                        } else {
                            $('#' + data.nv_id_tntu).append('<span class="pending">1</span>');


                        }



                    }
                }


            });


            $('.user').click(function() {
                $('.user').removeClass('active');
                $(this).addClass('active');
                $(this).find('.pending').remove();
                receiver_id = $(this).attr('id');
                //alert(receiver_id);
                $.ajax({
                    type: "get",
                    url: "message/" + receiver_id,
                    data: "",
                    cache: false,
                    success: function(data) {
                        $('#messages').html(data);
                        scrollToBottomFunc();
                    }
                })
            });

            $(document).on('keyup', '.input-text input', function(e) {
                var message = $(this).val();
                if (e.keyCode == 13 && message != '' && receiver_id != '') {
                    //alert(message);
                    $(this).val('');
                    var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                    var _token = $('input[name ="_token"]').val();

                    $.ajax({
                        type: "post",
                        url: "message",
                        data: datastr,
                        cache: false,
                        success: function(data) {

                        },
                        error: function(jqXHR, status, err) {

                        },
                        complete: function() {
                            scrollToBottomFunc();
                        }
                    })
                }

            });

            $(document).on('keyup', '.input-text input', function(e) {
                var message = $(this).val();
                if (e.keyCode == 13 && message != '' && receiver_id != '') {
                    //alert(message);
                    $(this).val('');
                    var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                    var _token = $('input[name ="_token"]').val();

                    $.ajax({
                        type: "post",
                        url: "message",
                        data: datastr,
                        cache: false,
                        success: function(data) {

                        },
                        error: function(jqXHR, status, err) {

                        },
                        complete: function() {
                            scrollToBottomFunc();
                        }
                    })
                }
            });

            $(document).on("click", ".button-text", function(e) {
                var message = $('.submit').val();
                if (message != '' && receiver_id != '') {
                    //alert(message);
                    $(this).val('');
                    var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                    var _token = $('input[name ="_token"]').val();

                    $.ajax({
                        type: "post",
                        url: "message",
                        data: datastr,
                        cache: false,
                        success: function(data) {

                        },
                        error: function(jqXHR, status, err) {

                        },
                        complete: function() {
                            scrollToBottomFunc();
                        }
                    })
                }
            });

            function scrollToBottomFunc() {
                $('.message-wrapper').animate({
                    scrollTop: $('.message-wrapper').get(0).scrollHeight
                }, 50);
            }
        });
    </script>






    <script>
        var colorDanger = "#FF1744";
        Morris.Donut({
            element: 'donut-example',
            resize: true,
            colors: [
                '#FF0000',
                '#4B0082',
                '#FFA500',
                '#FFD700',
                '#008080',
                '#00BCD4',
                '#00ACC1',
                '#0097A7',
                '#00838F',
                '#006064'
            ],
            //labelColor:"#cccccc", // text color
            //backgroundColor: '#333333', // border color
            data: [{
                    label: "Món ăn",
                    value: <?php echo $product2; ?>
                    // ,color: colorDanger
                },
                {
                    label: "Danh mục",
                    value: <?php echo $cate2; ?>
                    // ,color: colorDanger
                },
                {
                    label: "Hóa đơn",
                    value: <?php echo $order2; ?>
                },
                {
                    label: "Khách hàng",
                    value: <?php echo $customer2; ?>
                },
                {
                    label: "Nhân viên",
                    value: <?php echo $staff2; ?>
                },
                {
                    label: "Phiên làm việc",
                    value: <?php echo $shift2; ?>
                },
                {
                    label: "Phiếu nhập hàng",
                    value: <?php echo $rec2; ?>
                },
                {
                    label: "Lịch đặt bàn",
                    value: <?php echo $res2; ?>
                }
            ]
        });
    </script>

</body>

</html>
