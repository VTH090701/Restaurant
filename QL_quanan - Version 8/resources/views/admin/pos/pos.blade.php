@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pos</h6>
        </div>
      
        
        <style>
            .menu ul {
                list-style: none;

                /* border: 1px solid black;
                                padding: 15px;
                                margin: 2px;
                                border-radius: 5px;  */
            }

            .menu ul li {
                /* padding: 10px; */

                /* border: 1px solid black;
                                padding: 10px 20px; */

            }

            .menu ul li a {
                text-decoration: none;

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
                <div class="col-lg-7 col-md-12 ">



                    <div class="row ">
                        <div class="col-sm-7">
                            <a href="" class="btn btn-primary active load_cate_pro "
                                data-url1="{{ route('loadCate', ['id' => 0]) }}" style="margin-top: 5px;">
                                Tất cả
                            </a>
                            @foreach ($category_views as $cate)
                                <a class="btn btn-primary active load_cate_pro" href=""
                                    data-url1="{{ route('loadCate', ['id' => $cate->danhmuc_id]) }}"
                                    style="margin-left: 5px; margin-top: 5px;">
                                    {{ $cate->danhmuc_ten }}
                                </a>
                            @endforeach
                        </div>

                        <div class="col-sm-5 mt-2">
                            <form method="POST"
                                class=" d-sm-inline-block form-inline   my-2 my-md-0 mw-100">
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



                    <div class="row mt-4 product-list">

                        @foreach ($product_views as $key => $pro)
                            <div class="menu">
                                <ul>
                                    <li>
                                        <a href="#" class="add_to_cart"
                                            data-url="{{ route('addToCart', ['id' => $pro->ma_id]) }}">
                                            <div class="img-product1">
                                                <img src="public/upload/product/{{ $pro->ma_hinhanh }}" width="100"
                                                    height="100">
                                            </div>
                                            <div class="product-info1 mt-1">
                                                {{-- <span class="product-name1">{{ $pro->sp_ten }} ({{$pro->sp_sl}})</span><br> --}}
                                                <span class="product-name1">{{ $pro->ma_ten }}</span><br>
                                                <strong>{{ number_format($pro->ma_gia) . ' ' . 'VNĐ' }}</strong>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class=" col-lg-5 col-md-12 ">
                    <div style="display: flex;">
                        <h5>Hóa đơn tạm tính</h5>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                            style="margin-left:auto "> <i class="fa fa-plus-square" aria-hidden="true"
                                style="color: white"></i>
                            Khách hàng
                        </button>

                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Thêm khách hàng</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ url('/add-customer-pos') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label for="">Tên khách hàng:</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Số điện thoại:</label>
                                            <input type="text" class="form-control" name="phone">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Email:</label>
                                            <input type="text" class="form-control" name="email">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Mật khẩu:</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div>
                                                    <label for="exampleInputEmail1">Chọn thành phố:</label>
                                                    <select name="province" id="province" class="form-control province">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div>
                                                    <label for="exampleInputEmail1">Chọn quận huyện:</label>
                                                    <select name="district" id="district" class="form-control district">
                                                        <option value="">---Chọn quận huyện---</option>
                    
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div>
                                                    <label for="exampleInputEmail1">Chọn xã phường:</label>
                    
                                                    <select name="ward" id="ward" class="form-control ward">
                                                        <option value="">---Chọn xã---</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                    
                    
                                        <input type="hidden" name="result" id="result" value="">
                                        <input type="hidden" value="avatar_user.png" name="image">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Địa chỉ cụ thể:</label>
                                            <textarea cols="10" class="form-control location" placeholder="Nhập địa chỉ cụ thể của bạn" name="location"
                                                id="result">
                                            </textarea>
                                        </div>
                    

                                        {{-- <div>
                                            <label for="exampleInputEmail1">Chọn thành phố</label>
                                            <select class="form-control choose city" name="city" id="city">
                                                <option value="">--Chọn tỉnh thành phố--</option>
                                                @foreach ($city as $key => $ci)
                                                    <option value="{{ $ci->matp }}">{{ $ci->name_city }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label for="exampleInputEmail1">Chọn quận huyện</label>
                                            <select class="form-control choose province" name="province" id="province">
                                                <option value="">--Chọn quận huyện--</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="exampleInputEmail1">Chọn xã phường</label>
                                            <select class="form-control wards" name="wards" id="wards">
                                                <option value="">--Chọn xã--</option>
                                            </select>
                                        </div> --}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <button type="submit" class="btn btn-primary" name="add_customer_pos">Lưu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="table-responsive" class="mt-2">
                        @include('admin.pos.components.cart_components')
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
