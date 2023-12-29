@extends('layout_user')
@section('user_content')
    {{-- <style>
        .img-product {
            height: 75px;
            width: 100%;
            text-align: center;
        }

        .img-product img {
            height: 100%;
            width: auto;
        }
    </style> --}}
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s"
                                src="{{ asset('/frontend/img/about-1.jpg') }}">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.3s"
                                src="{{ asset('/frontend/img/about-2.jpg') }}" style="margin-top: 25%;">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.5s"
                                src="{{ asset('/frontend/img/about-3.jpg') }}">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.7s"
                                src="{{ asset('/frontend/img/about-4.jpg') }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h5 class="section-title ff-secondary text-start text-primary fw-normal">About Us</h5>
                    <h1 class="mb-4">Chào mừng đã đến với <i class="fa fa-utensils text-primary me-2"></i>TH Restaurant</h1>
                    <p class="mb-4">TH Restaurant - Cửa hàng ăn uống của chúng tui được phát triển với người đứng đầu Võ
                        Thanh Hiếu và cái tên HT Restaurant cũng được bắt nguồn từ tên và chữ lót của anh ấy
                        ,với hơn 15 năm kinh nghiệm phát triển cũng như có có đứng trong ngành nghề ăn uống.</p>
                    <p class="mb-4">Menu quán vô cùng phong phú với các món ăn hấp dẫn được chế biến bởi các đầu bếp có nhiều năm kinh nghiệm
                        Thực phẩm được chọn lựa cẩn thận, đảm bảo an toàn từ khâu chế biến, để các bạn có thể yên tâm khi thưởng thức...</p>
                    <p class="mb-4">Đã phục vụ trên dưới hàng ngàn lượt khách hàng và được những phản hồi rất tốt về thức
                        ăn và đồ uống. Là nơi phù hợp cho những
                        dịp cuối tuần gia đình tụ họp cùng nhau ăn uống,...
                    </p>
                    <div class="row g-4 mb-4">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                                <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">10</h1>
                                <div class="ps-4">
                                    <p class="mb-0">Years of</p>
                                    <h6 class="text-uppercase mb-0">Experience</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                                <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">5</h1>
                                <div class="ps-4">
                                    <p class="mb-0">Popular</p>
                                    <h6 class="text-uppercase mb-0">Master Chefs</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
