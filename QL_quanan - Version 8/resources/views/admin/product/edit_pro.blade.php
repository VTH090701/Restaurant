@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cập nhật sản phẩm</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                @foreach ($edit_product as $key => $pro)
                    <form method="POST" action="{{ route('product.update', $pro->ma_id ) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                        placeholder="Nhập tên sản phẩm" name="pro_name" value="{{ $pro->ma_ten }}">
                                </div>
                               
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá bán</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                        placeholder="Nhập tên giá" name="pro_price" value="{{ $pro->ma_gia }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                        name="pro_img">
                                    <img class="mt-2 ml-2" style="border-radius: 50px" src="/public/upload/product/{{ $pro->ma_hinhanh }}" width="100" height="100">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea class="form-control" name="pro_desc"> {{ $pro->ma_mota }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung</label>
                            <textarea class="form-control" name="pro_content">{{ $pro->ma_noidung }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputConfirmPassword1">Danh mục sản phẩm</label>
                                    <select class="form-control" name="pro_cate">
                                        @foreach ($cate_product as $key => $cate)
                                            @if ($cate->danhmuc_id == $pro->danhmuc_id)
                                                <option selected value="{{ $cate->danhmuc_id }}">{{ $cate->danhmuc_ten }}
                                                </option>
                                            @else
                                                <option value="{{ $cate->danhmuc_id }}">{{ $cate->danhmuc_ten }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="pro_status" class="form-control">
                                        @if ($pro->ma_tinhtrang == 1)
                                            <option selected value="1">Hiển thị</option>
                                            <option value="0">Ẩn</option>
                                        @else
                                        <option selected value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        
                        
                        <a href="{{route('product.index')}}" class="btn btn-success">Trở lại</a>

                        <button type="submit" name="update_pro" class="btn btn-primary">Cập nhật Sản phẩm</button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection
