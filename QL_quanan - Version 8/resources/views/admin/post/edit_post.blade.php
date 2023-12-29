@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cập nhật bài viết</h6>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <form method="POST" action="{{ route('post.update', $post->baiviet_id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="">Tên bài viết</label>
                        <input type="text" class="form-control" id="post_name" placeholder="Nhập tên bài viết"
                            name="post_name" value="{{ $post->baiviet_tieude }}">
                    </div>
                    @error('post_name')
                        <div class="text-sm " style="color: red">Tên danh mục không được để trống</div>
                    @enderror

                    <div class="form-group">
                        <label for="">Tóm tắt bài viết</label>
                        <textarea class="form-control" name="post_desc" id="ckeditor">{{ $post->baiviet_tomtat }}</textarea>
                    </div>
                    @error('post_desc')
                        <div class="text-sm " style="color: red">Mô tả danh mục không được để trống</div>
                    @enderror


                    <div class="form-group">
                        <label for="">Nội dung bài viết</label>
                        <textarea class="form-control" name="post_content" id="ckeditor1">{{ $post->baiviet_noidung }}</textarea>
                    </div>
                    @error('post_content')
                        <div class="text-sm " style="color: red">Mô tả danh mục không được để trống</div>
                    @enderror



                    <div class="form-group">
                        <label for="">Hình ảnh</label>
                        <input type="file" class="form-control" name="post_image">
                        <img src="/public/upload/post/{{ $post->baiviet_hinhanh }}" width="100" height="100">
                    </div>
                    @error('post_image')
                        <div class="text-sm " style="color: red">Hình ảnh không được để trống</div>
                    @enderror

                    <div class="form-group">
                        <label for="exampleInputPassword1">Hiển thị</label>
                        <select name="post_status" class="form-control">
                            @if ($post->baiviet_tinhtrang == 1)
                                <option selected value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            @else
                                <option selected value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            @endif
                        </select>
                    </div>

                    @error('post_status')
                        <div class="text-sm " style="color: red">Tên người đặt không được để trống</div>
                    @enderror


                    <a href="{{ route('post.index') }}" class="btn btn-success">Trở lại</a>
                    <button type="submit" name="update_post" class="btn btn-primary">Cập nhật bài viết</button>
                </form>
            </div>
        </div>
    </div>
@endsection
