@extends('layout_user')
@section('user_content')
    <link href="{{ asset('/frontend/css/details_menu.css') }}" rel="stylesheet">

    <div class="container">
        <div class="card">
            <div class="container-fliud">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Detaisl Food</h5>
                    <h1 class="mb-5">Chi tiết món ăn</h1>
                </div>
                <div class="wrapper row mb-5">
                    <div class="preview col-md-6">

                        {{-- <div class="preview-pic tab-content">
                            <div class="tab-pane active" id="pic-1"><img src="/public/upload/product/{{ $menu->sp_hinhanh }}" width="100" height="350"/></div>
                            <div class="tab-pane" id="pic-2"><img src="http://placekitten.com/400/252" /></div>
                            <div class="tab-pane" id="pic-3"><img src="http://placekitten.com/400/252" /></div>
                            <div class="tab-pane" id="pic-4"><img src="http://placekitten.com/400/252" /></div>
                            <div class="tab-pane" id="pic-5"><img src="http://placekitten.com/400/252" /></div>
                        </div>
                        <ul class="preview-thumbnail nav nav-tabs">
                            <li class="active"><a data-target="#pic-1" data-toggle="tab"><img
                                        src="http://placekitten.com/200/126" /></a></li>
                            <li><a data-target="#pic-2" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a>
                            </li>
                            <li><a data-target="#pic-3" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a>
                            </li>
                            <li><a data-target="#pic-4" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a>
                            </li>
                            <li><a data-target="#pic-5" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a>
                            </li>
                        </ul> --}}
                        <ul id="imageGallery">
                            @foreach ($gallery as $key => $gal)
                                <li data-thumb="/public/upload/gallery/{{ $gal->hinhanh_anh }}"
                                    data-src="/public/upload/gallery/{{ $gal->hinhanh_anh }}">
                                    <img src="/public/upload/gallery/{{ $gal->hinhanh_anh }}" width="100%"
                                        height="300" />
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="details col-md-6">
                        <h3 class="product-title">{{ $menu->ma_ten }}</h3>
                        {{-- <div class="rating">
                        <div class="stars">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                        <span class="review-no">41 reviews</span>
                    </div> --}}
                        <p class="product-description">{{ $menu->ma_mota }}</p>
                        <h4 class="price">Giá: {{ number_format($menu->ma_gia) . ' ' . 'VNĐ' }}</h4>


                        @if ($product_selling)
                            @foreach ($product_selling as $pro)
                                <p class="vote">Lượt bán: {{ $pro->total }}</p>
                            @endforeach
                        @else
                            <p class="vote">Lượt bán: 0</p>
                        @endif
                        {{-- <h5 class="sizes">sizes:
                        <span class="size" data-toggle="tooltip" title="small">s</span>
                        <span class="size" data-toggle="tooltip" title="medium">m</span>
                        <span class="size" data-toggle="tooltip" title="large">l</span>
                        <span class="size" data-toggle="tooltip" title="xtra large">xl</span>
                    </h5>
                    <h5 class="colors">colors:
                        <span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
                        <span class="color green"></span>
                        <span class="color blue"></span>
                    </h5>
                    <div class="action">
                        <button class="add-to-cart btn btn-default" type="button">add to cart</button>
                        <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
                    </div> --}}
                    </div>
                </div>
                <hr class="">
                <div class="row mt-3 mb-5">
                    <h3 class="mt-2 mb-2">Bình luận của khách hàng:</h3>
                    <style>
                        .style_comment {
                            border: 1px solid #dddd;
                            border-radius: 10px;
                            background: #F0F0E9;

                        }
                    </style>
                    <form>
                        @csrf
                        <input type="hidden" name="comment_product_id" value="{{ $menu->ma_id }}"
                            class="comment_product_id">
                        <div class="col-md-12">
                            <div id="comment_show"></div>
                        </div>


                        <p></p>
                    </form>
                </div>
                <hr>

                @if (Session::get('customer_id'))
                @else
                @endif


                <div class="row mt-5">
                    <div class="col-md-12">

                        <?php
                        $mess = Session::get('mess');
                        if ($mess) {
                            echo '<div class="alert alert-primary" role="alert">' . $mess . '</div>';
                            Session::put('mess', null);
                        }
                        
                        $customer_id = Session::get('customer_id');
                        $i = 0;
                        foreach ($customer as $key => $value) {
                            if ($value->khachhang_id == $customer_id) {
                                $i++;
                            }
                        }
                        ?>

                        @if (Session::get('customer_id'))
                            <form action="#">
                                <textarea rows="9" cols="70" style="width: 100%;" name="comment" class="comment_content"
                                    placeholder="Nội dung bình luận"></textarea>
                                <div id="notify_comment"></div>
                                @if ($i == 0)
                                    <a href="{{ url('/notify-error-comment') }}" class="btn btn-primary">Gửi bình
                                        luận</a>
                                @else
                                    <button type="button" class="send-comment btn btn-primary">Gửi bình luận</button>
                                @endif
                            </form>
                        @else
                            Bạn hãy đăng nhập để có thể bình luận món ăn!
                        @endif






                    </div>
                </div>
                <hr>

                <div class="m-2">
                    <h2>Các món ăn liên quan:</h2>
                    <div class="row ">
                        @foreach ($related_product as $key => $related)
                            <div class="col-md-3 text-center m-2"
                                style="border: 1px solid #fdf993;border-radius:5px;background-color: #ffffff; ">
                                <a href="{{ url('/menu/' . $related->ma_id) }}">
                                    <img class="mt-4" src="/public/upload/product/{{ $related->ma_hinhanh }}"
                                        width="100%" height="200" />
                                    <div class="mt-3" style="">
                                        <p style="color: black;font-size: 20px;font-weight: bold">{{ $related->ma_ten }}
                                        </p>

                                        <p style="color: black;font-size: 20x;;font-weight: bold">
                                            {{ number_format($related->ma_gia) . ' ' . 'VNĐ' }}</p>
                                    </div>
                                </a>

                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    @endsection
