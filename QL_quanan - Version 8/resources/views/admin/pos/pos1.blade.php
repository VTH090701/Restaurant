@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pos</h6>
        </div>

        <style>
            .menu ul {
                list-style: none;
            }

            .menu ul li a {
                text-decoration: none
            }

            .menu ul li a:hover {
                background-color: rgba(255, 255, 255, .5);
                -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .2);
                box-shadow: 0 1px 2px rgba(0, 0, 0, .2);
            }

            .product-name1 {
                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
                color: #222;
            }

            .img-product1 {
                width: 100%;
                text-align: center;
            }


            .product-info1 {
                text-align: center;
            }
        </style>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-7 col-md-12">

                    <div class="row ">
                        <div class="col-sm-7">
                            <a href="" class="btn btn-primary active load_cate_pro1"
                                data-url1="{{ route('loadCate1', ['id' => 0]) }}"  style="margin-top: 5px;">
                                Tất cả
                            </a>
                            @foreach ($category_views as $cate)
                                <a class="btn btn-primary active load_cate_pro1" href=""
                                    data-url1="{{ route('loadCate1', ['id' => $cate->danhmuc_id]) }}" style="margin-left: 5px; margin-top: 5px;">
                                    {{ $cate->danhmuc_ten }}
                                </a>
                            @endforeach
                        </div>
                        <div class="col-sm-5 mt-2">
                            <form method="POST"
                                class="d-sm-inline-block form-inline   my-2 my-md-0 mw-100">
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small input-search-ajax1"
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


                    <div class="row mt-4 product-list">
                        @foreach ($product_views as $key => $pro)
                            <div class="menu">
                                <ul>
                                    <li>
                                        <a href="#" class="add_to_cart_again"
                                            data-url="{{ route('addToCartgain', ['id' => $pro->ma_id]) }}">
                                            <div class="img-product1">
                                                <img src="/public/upload/product/{{ $pro->ma_hinhanh }}" width="100"
                                                    height="100">
                                            </div>
                                            <div class="product-info1">
                                                {{-- <span class="product-name1">{{ $pro->sp_ten }} ({{$pro->sp_sl}})</span><br> --}}
                                                <span class="product-name1">{{ $pro->ma_ten }} </span><br>
                                                <strong>{{ number_format($pro->ma_gia) . ' ' . 'VNĐ' }}</strong>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <h5>Hóa đơn tạm tính</h5>
                    <div id="table-responsive1">
                        @include('admin.pos.components.cart_components1')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
