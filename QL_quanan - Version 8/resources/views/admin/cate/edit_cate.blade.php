@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cập nhật danh mục</h6>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                @foreach ($edit_category as $key => $edit_val)
                    <form method="POST" action="{{ route('category.update', $edit_val->danhmuc_id ) }}">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Nhập tên danh mục" name="cate_name" value="{{ $edit_val->danhmuc_ten }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea class="form-control" name="cate_desc" >{{ $edit_val->danhmuc_mota }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="cate_status" class="form-control">
                                @if ($edit_val->danhmuc_tinhtrang == 1)
                                    <option selected value="1">Hiển thị</option>
                                    <option value="0">Ẩn</option>
                                @else
                                    <option selected value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                @endif
                            </select>
                        </div>
                        <a href="{{ route('category.index') }}" class="btn btn-success">Trở lại</a>

                        <button type="submit" name="edit_cate" class="btn btn-primary">Cập nhật danh mục</button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection
