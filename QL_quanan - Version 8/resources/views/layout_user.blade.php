<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Restaurant</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('/frontend/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('/frontend/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/frontend/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('/frontend/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('/frontend/css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('/frontend/css/lightgallery.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/frontend/css/lightslider.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/frontend/css/prettify.css') }}" rel="stylesheet">

    {{-- <link href="{{ asset('/frontend/font/css/font-awesome.min.css') }}" rel="stylesheet"> --}}

    {{-- <link href="{{ asset('/backend/css/style.css') }}" rel="stylesheet"> --}}

    {{-- Datatables --}}
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">


</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Restaurant</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="{{ url('/') }}" class="nav-item nav-link">Trang chủ</a>
                        {{-- <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="service.html" class="nav-item nav-link">Service</a> --}}
                        <a href="{{ url('/about-us') }}" class="nav-item nav-link">Chúng tôi</a>
                        <a href="{{ url('/contact') }}" class="nav-item nav-link">Liên hệ</a>
                        <a href="{{ url('/menu') }}" class="nav-item nav-link">Menu</a>
                        <a href="{{ url('/post-customer') }}" class="nav-item nav-link">Bài viết</a>

                        @if (Session::get('customer_id'))
                            <a href="{{ url('/list-reservation') }}" class="nav-item nav-link">Lịch đặt bàn</a>
                        @else
                            <a href="{{ url('/dang-nhap') }}" class="nav-item nav-link">Đăng nhập</a>
                        @endif
                    </div>

                    @if (Session::get('customer_id'))
                        <a href="{{ url('/step-one') }}" class="btn btn-primary py-2 px-4">Đặt bàn</a>
                    @else
                        <a href="{{ url('/dang-nhap') }}" class="btn btn-primary py-2 px-4">Đặt bàn</a>
                    @endif

                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-user-circle-o" aria-hidden="true" style="color: white;width: 100%">Hello</i>
                        </a>
                        <div class="dropdown-menu m-0">
                            <a href="booking.html" class="dropdown-item">Booking</a>
                            <a href="team.html" class="dropdown-item">Our Team</a>
                            <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        </div>
                    </div> --}}

                    @if (Session::get('customer_id'))
                        <div class="dropdown" style="margin-left: 20px">
                            <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#"
                                id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown"
                                aria-expanded="false">

                                <img src="/public/upload/hoso_kh/{{ Session::get('customer_image') }}"
                                    class="rounded-circle" height="25" />

                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                                <li>
                                    <a class="dropdown-item" href="{{ url('/hoso') }}">Hồ sơ</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">Cài đặt</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ url('/dang-xuat') }}">Đăng xuất</a>
                                </li>
                            </ul>
                        </div>
                    @endif

                </div>
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container my-5 py-5">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-6 text-center text-lg-start">
                            <h1 class="display-3 text-white animated slideInLeft">Món ăn như thế nào là món ăn ngon?
                            </h1>
                            <p class="text-white animated slideInLeft mb-4 pb-2">Có người nghĩ, một món ăn ngon đầu
                                tiên
                                là phải đẹp, chỉ khi đẹp mới cảm thấy thích, mới có ham muốn ăn món ăn đó. Nhưng với
                                người khác, một món ăn ngon là ở tấm lòng người nấu ăn và cả cách người dùng thưởng thức
                                nó.
                                Tình cảm yêu thương đặt vào món ăn như một gia vị giúp món ăn thêm đậm đà. Vì thế, khi
                                biết trân trọng công sức người nấu ăn, chúng ta sẽ thấy ngon miệng hơn. </p>
                            <a href="" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Đặt
                                bàn</a>
                        </div>
                        <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                            <img class="img-fluid" src="{{ asset('/frontend/img/ảnh_nav.png') }}" alt=""
                                width="100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        @yield('user_content')
        <!-- Content Row -->
        {{-- <div class="row">

            </div> --}}

        <!-- Content Row -->



        <!-- Content Row -->





        <!-- Testimonial End -->


        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Cừa hàng</h4>
                        <a class="btn btn-link" href="">Chúng tôi</a>
                        <a class="btn btn-link" href="">Liên hệ</a>
                        <a class="btn btn-link" href="">Menu bàn</a>
                        <a class="btn btn-link" href="">Đặt bàn</a>
                        {{-- <a class="btn btn-link" href="">Terms & Condition</a> --}}
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Liện hệ</h4>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Đường 3/2, quận Ninh Kiều, thành
                            phố Cần Thơ</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>0914549857</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>thanhhieu090701@gmail.com</p>
                        {{-- <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div> --}}
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Mở cửa</h4>
                        <h5 class="text-light fw-normal">Thứ hai - Chủ nhật</h5>
                        <p>Buổi trưa: 13PM - 16PM</p>
                        <p>Buổi sáng: 17PM - 20PM</p>

                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Phản hồi</h4>
                        <p>Nếu bạn muốn phải hồi muốn ăn hay gọi trực tiếp hoặc gửi email vào địa chỉ bên dưới. </p>
                        {{-- <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control border-primary w-100 py-3 ps-4 pe-5" type="text"
                                placeholder="Your email">
                            <button type="button"
                                class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </div> --}}
                    </div>
                </div>
            </div>
            {{-- <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.

                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>


    <script src="{{ asset('/frontend/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('/frontend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('/frontend/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('/frontend/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('/frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/frontend/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('/frontend/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('/frontend/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('/frontend/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ asset('/frontend/js/lightslider.js') }}"></script>
    <script src="{{ asset('/frontend/js/prettify.js') }}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.5.1/axios.min.js"
        integrity="sha512-emSwuKiMyYedRwflbZB2ghzX8Cw8fmNVgZ6yQNNXXagFzFOaQmbvQ1vmDkddHjm5AITcBIZfC7k4ShQSjgPAmQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('../../backend/js/index.js') }}"></script>

    {{-- Datatable --}}
    <script src="http://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <!-- Template Javascript -->
    <script src="{{ asset('/frontend/js/main.js') }}"></script>


    <script type="text/javascript">
        (function(d, m) {
            var kommunicateSettings = {
                "appId": "314a71fa12cec1211976e0c00df566212",
                "popupWidget": true,
                "automaticChatOpenOnNavigation": true
            };
            var s = document.createElement("script");
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://widget.kommunicate.io/v2/kommunicate.app";
            var h = document.getElementsByTagName("head")[0];
            h.appendChild(s);
            window.kommunicate = m;
            m._globals = kommunicateSettings;
        })(document, window.kommunicate || {});
        /* NOTE : Use web server to view HTML files as real-time update will not work if you directly open the HTML file in the browser. */
    </script>

    <script>
        $(document).ready(function() {
            load_comment();

            function load_comment() {
                var product_id = $('.comment_product_id').val();
                var _token = $('input[name ="_token"]').val();
                // alert(product_id);
                $.ajax({
                    url: "{{ url('/load-comment') }}",
                    method: "POST",
                    data: {
                        product_id: product_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#comment_show').html(data);
                    }
                });
            }

            $('.send-comment').click(function() {
                var product_id = $('.comment_product_id').val();
                var comment_content = $('.comment_content').val();
                var _token = $('input[name ="_token"]').val();

                $.ajax({
                    url: "{{ url('/send-comment') }}",
                    method: "POST",
                    data: {
                        product_id: product_id,
                        comment_content: comment_content,
                        _token: _token
                    },
                    success: function(data) {

                        $('#notify_comment').html(
                            '<span class="text text-success">Thêm bình luận thành công, bình luận đang chờ duyệt</span>'
                        )
                        load_comment();
                        $('#notify_comment').fadeOut(9000);
                        $('.comment_content').val('');
                    }
                });
            });



        });
    </script>


    <script>
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
                var table = $('.myTableres1').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('list_reservation1') }}",
                        data: {
                            start_date: start_date,
                            end_date: end_date,
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
                            data: 'action',
                            name: 'action',

                        },
                        {
                            data: 'tinhtrang1',
                            name: 'tinhtrang1',

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
                $('.myTableres1').DataTable().destroy();
                fetch(start_date, end_date);
            }
        });


        $('.send_reservation').click(function() {
            event.preventDefault();

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Xác nhận đặt bàn',
                text: "Lịch đặt bàn của bạn sẽ không được hủy, bạn chắc chắn muốn đặt bàn",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Không, trở lại',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                        'Thành công!',
                        'Đặt bàn thành công',
                        'success'
                    )
                    var ban_id = $('.ban_id').val();
                    var _token = $('input[name ="_token"]').val();
                    $.ajax({
                        url: "{{ url('/step-two') }}",
                        method: "POST",
                        data: {
                            ban_id: ban_id,
                            _token: _token
                        }
                    });


                    setTimeout(function() {
                        window.location.href = "{{ url('/') }}";
                    }, 3000);

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Đóng!',
                        'Đặt bàn thất bại',
                        'error'
                    )
                }
            })

        });





        // $('.show_confirm').click(function(event) {
        // alert('1');
        // var form = $(this).closest("form");
        // var name = $(this).data("name");
        // event.preventDefault();
        // swal({
        // title: `Are you sure you want to delete this record?`,
        // text: "If you delete this, it will be gone forever.",
        // icon: "warning",
        // buttons: true,
        // dangerMode: true,
        // })
        // .then((willDelete) => {
        // if (willDelete) {
        // form.submit();
        // }
        // });
        // });
    </script>


    <script type="text/javascript">
        function myFunction() {
            if (!confirm("Bạn chắc chắn muốn xóa"))
                event.preventDefault();
        }
    </script>


    <script>
        $('.input-search-ajax').keyup(function() {
            var _text = $(this).val();
            var _token = $('input[name ="_token"]').val();
            $.ajax({
                url: "{{ url('/search-customer') }}",
                method: "POST",
                data: {
                    _text: _text,
                    _token: _token
                },
                success: function(data) {
                    if (data.code == 200) {
                        $('.product-list').html(data.search_components);
                    }
                },
                error: function() {}
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery: true,
                item: 1,
                loop: true,
                thumbItem: 3,
                slideMargin: 0,
                enableDrag: false,
                currentPagerPosition: 'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }
            });
        });
    </script>
</body>

</html>
