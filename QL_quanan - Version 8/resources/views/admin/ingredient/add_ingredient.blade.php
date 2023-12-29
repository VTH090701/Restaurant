@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm nguyên liệu</h6>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <form method="POST" action="{{ route('ingredient.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên nguyên liệu</label>
                        <input type="text" class="form-control" placeholder="Nhập tên nguyên liệu" name="ingredient_name">
                    </div>
                    @error('ingredient_name')
                        <div class="text-sm " style="color: red">Tên nguyên liệu không được để trống</div>
                    @enderror
                    {{-- <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả danh mục</label>
                        <textarea class="form-control" name="cate_desc"></textarea>
                    </div> --}}
                    <div class="form-group">
                        <label for="">Đơn vị tính</label>
                        <input type="text" class="form-control" placeholder="Nhập đơn vị tính" name="ingredient_unit">
                    </div>
                    @error('ingredient_unit')
                        <div class="text-sm " style="color: red">Đơn vị tính không được để trống</div>
                    @enderror
                    <div class="form-group">
                        <label for="exampleInputPassword1">Hiển thị</label>
                        <select name="ingredient_status" class="form-control">
                            <option value="0">Ẩn</option>
                            <option value="1">Hiển thị</option>

                        </select>
                    </div>
                    @error('ingredient_status')
                        <div class="text-sm " style="color: red">Hiển thị không được để trống</div>
                    @enderror
                    {{-- <div class="form-group">
                        <label for="">Số lượng nguyên liệu</label>
                        <input type="text" disabled class="form-control" placeholder="Số lượng nguyên liệu sẽ tăng khi nhập kho" name="ingredient_name">
                    </div> --}}
                    <a href="{{route('ingredient.index') }}" class="btn btn-success">Trở lại</a>
                    <button type="submit" name="add_ingredient" class="btn btn-primary">Thêm nguyên liệu</button>
                </form>
            </div>
        </div>
    </div>
@endsection
