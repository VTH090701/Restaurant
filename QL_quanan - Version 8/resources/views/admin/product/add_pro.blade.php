@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm món ăn</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tên món ăn</label>
                                <input type="text" class="form-control" placeholder="Nhập tên món ăn" name="pro_name">
                            </div>
                            @error('pro_name')
                                <div class="text-sm " style="color: red">Tên món ăn không được để trống</div>
                            @enderror

                            <div class="form-group">
                                <label for="">Giá bán</label>
                                <input type="text" class="form-control" placeholder="Nhập tên giá" name="pro_price">
                            </div>
                            @error('pro_price')
                                <div class="text-sm " style="color: red">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Hình ảnh</label>
                                <input type="file" class="form-control" name="pro_img">
                            </div>
                            @error('pro_img')
                                <div class="text-sm " style="color: red">Hình ảnh không được để trống</div>
                            @enderror
                        </div>
                    </div>




                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea class="form-control" name="pro_desc"></textarea>
                    </div>
                    @error('pro_desc')
                        <div class="text-sm " style="color: red">Mô tả không được để trống</div>
                    @enderror
                    <div class="form-group">
                        <label for="">Nội dung</label>
                        <textarea class="form-control" name="pro_content"></textarea>
                    </div>
                    @error('pro_content')
                        <div class="text-sm " style="color: red">Nội dung không được để trống</div>
                    @enderror

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Danh mục món ăn</label>
                                <select class="form-control" name="pro_cate">
                                    @foreach ($cate as $key => $cate)
                                        <option value="{{ $cate->danhmuc_id }}">{{ $cate->danhmuc_ten }}</option>
                                    @endforeach

                                </select>
                            </div>
                            @error('pro_cate')
                                <div class="text-sm " style="color: red">Danh mục không được để trống</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Hiển thị</label>
                                <select name="pro_status" class="form-control">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>

                                </select>
                            </div>
                            @error('pro_status')
                                <div class="text-sm " style="color: red">Hiển thị không được để trống</div>
                            @enderror
                        </div>
                    </div>


                    <a href="{{route('product.index')}}" class="btn btn-success">Trở lại</a>

                    <button type="submit" name="add_pro" class="btn btn-primary">Thêm Sản phẩm</button>
                </form>
            </div>
        </div>
    </div>
@endsection
