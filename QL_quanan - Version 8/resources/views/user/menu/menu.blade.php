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
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Menu</h5>
                <h1 class="mb-5">Danh sách các món ăn</h1>
            </div>

            <div class="row ">
                <div class="col-md-6 ">

                </div>
                <div class="col-md-6 ">
                    <form method="POST" class="" style="float: right">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small input-search-ajax"
                                placeholder="Tìm kiếm..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                    <li class="nav-item">
                        <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill"
                            href="#tab-1">
                            <i class="fa  fa-bars fa-2x text-primary"></i>
                            {{-- <i class="fa fa-cutlery fa-2x text-primary" aria-hidden="true"></i> --}}
                            <div class="ps-3">
                                {{-- <small class="text-body">Popular</small> --}}
                                <h6 class="mt-n1 mb-0">Tất cả món ăn</h6>
                            </div>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
                            <i class="fa fa-utensils fa-2x text-primary" aria-hidden="true"></i>

                            <div class="ps-3">
                                <h6 class="mt-n1 mb-0">Món ăn chính</h6>
                            </div>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill" href="#tab-3">
                            <i class="fa fa-coffee fa-2x text-primary"></i>
                            <div class="ps-3">
                                {{-- <small class="text-body">Lovely</small> --}}
                                <h6 class="mt-n1 mb-0">Thức uống</h6>
                            </div>
                        </a>
                    </li>
                </ul>


                <div class="tab-content">
                    <div id="tab-1" class=" product-list tab-pane fade show p-0 active">
                        <div class="row g-4">
                            @foreach ($pro_all as $item1)
                                <div class="col-lg-6">
                                    <a href="{{ url('/menu/' . $item1->ma_id) }}">
                                        <div class="d-flex align-items-center">
                                            <div class="img-product">
                                                <img class="flex-shrink-0 img-fluid rounded"
                                                    src="public/upload/product/{{ $item1->ma_hinhanh }}" alt=""
                                                    width="100" height="100">
                                            </div>
                                            <div class="w-100 d-flex flex-column text-start ps-4">
                                                <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                    <span>{{ $item1->ma_ten }}</span>
                                                    <span
                                                        class="text-primary">{{ number_format($item1->ma_gia) . ' ' . 'VNĐ' }}</span>
                                                </h5>
                                                <small class="fst-italic">{{ $item1->ma_ten }}</small>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                            @endforeach
                        </div>

                    </div>

                    <div id="tab-2" class="tab-pane fade show p-0 ">
                        <div class="row g-4">
                            @foreach ($pro_main as $item1)
                                <div class="col-lg-6">
                                    <a href="{{ url('/menu/' . $item1->ma_id) }}">
                                        <div class="d-flex align-items-center">
                                            <div class="img-product">
                                                <img class="flex-shrink-0 img-fluid rounded"
                                                    src="public/upload/product/{{ $item1->ma_hinhanh }}" alt=""
                                                    width="100" height="100">
                                            </div>
                                            <div class="w-100 d-flex flex-column text-start ps-4">
                                                <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                    <span>{{ $item1->ma_ten }}</span>
                                                    <span
                                                        class="text-primary">{{ number_format($item1->ma_gia) . ' ' . 'VNĐ' }}</span>
                                                </h5>
                                                <small class="fst-italic">{{ $item1->ma_ten }}</small>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- <div id="tab-2" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded" src="img/menu-1.jpg" alt=""
                                        style="width: 80px;">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <h5 class="d-flex justify-content-between border-bottom pb-2">
                                            <span>Chicken Burger</span>
                                            <span class="text-primary">$115</span>
                                        </h5>
                                        <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded" src="img/menu-2.jpg" alt=""
                                        style="width: 80px;">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <h5 class="d-flex justify-content-between border-bottom pb-2">
                                            <span>Chicken Burger</span>
                                            <span class="text-primary">$115</span>
                                        </h5>
                                        <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded" src="img/menu-3.jpg" alt=""
                                        style="width: 80px;">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <h5 class="d-flex justify-content-between border-bottom pb-2">
                                            <span>Chicken Burger</span>
                                            <span class="text-primary">$115</span>
                                        </h5>
                                        <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded" src="img/menu-4.jpg" alt=""
                                        style="width: 80px;">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <h5 class="d-flex justify-content-between border-bottom pb-2">
                                            <span>Chicken Burger</span>
                                            <span class="text-primary">$115</span>
                                        </h5>
                                        <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded" src="img/menu-5.jpg" alt=""
                                        style="width: 80px;">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <h5 class="d-flex justify-content-between border-bottom pb-2">
                                            <span>Chicken Burger</span>
                                            <span class="text-primary">$115</span>
                                        </h5>
                                        <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded" src="img/menu-6.jpg" alt=""
                                        style="width: 80px;">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <h5 class="d-flex justify-content-between border-bottom pb-2">
                                            <span>Chicken Burger</span>
                                            <span class="text-primary">$115</span>
                                        </h5>
                                        <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded" src="img/menu-7.jpg" alt=""
                                        style="width: 80px;">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <h5 class="d-flex justify-content-between border-bottom pb-2">
                                            <span>Chicken Burger</span>
                                            <span class="text-primary">$115</span>
                                        </h5>
                                        <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid rounded" src="img/menu-8.jpg" alt=""
                                        style="width: 80px;">
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <h5 class="d-flex justify-content-between border-bottom pb-2">
                                            <span>Chicken Burger</span>
                                            <span class="text-primary">$115</span>
                                        </h5>
                                        <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div id="tab-3" class="tab-pane fade show p-0">
                        <div class="row g-4">

                            @foreach ($pro_drink as $key => $item)
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded"
                                            src="public/upload/product/{{ $item->ma_hinhanh }}" alt=""
                                            style="width: 100px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>{{ $item->ma_ten }}</span>
                                                <span
                                                    class="text-primary">{{ number_format($item->ma_gia) . ' ' . 'VNĐ' }}</span>
                                            </h5>
                                            <small class="fst-italic">{{ $item->ma_ten }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
