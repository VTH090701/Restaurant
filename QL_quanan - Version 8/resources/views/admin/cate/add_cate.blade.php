@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm danh mục</h6>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <form method="POST" action="{{ route('category.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên danh mục</label>
                        <input type="text" class="form-control" id="cate_name" placeholder="Nhập tên danh mục"
                            name="cate_name">
                    </div>
                    @error('cate_name')
                        <div class="text-sm " style="color: red">Tên danh mục không được để trống</div>
                    @enderror

                    <div class="form-group">
                        <label for="">Mô tả danh mục</label>
                        <textarea class="form-control" name="cate_desc" id="cate_desc"></textarea>
                    </div>

                    @error('cate_desc')
                        <div class="text-sm " style="color: red">Mô tả danh mục không được để trống</div>
                    @enderror
                    <div class="form-group">
                        <label for="">Hiển thị</label>
                        <select name="cate_status" class="form-control">
                            <option value="0">Ẩn</option>
                            <option value="1">Hiển thị</option>

                        </select>
                    </div>
                    @error('cate_status')
                        <div class="text-sm " style="color: red">Tên người đặt không được để trống</div>
                    @enderror
                    <a href="{{ route('category.index') }}" class="btn btn-success">Trở lại</a>
                    <button type="submit" name="add_cate" class="btn btn-primary">Thêm danh mục</button>
                </form>
            </div>
        </div>
    </div>
@endsection
