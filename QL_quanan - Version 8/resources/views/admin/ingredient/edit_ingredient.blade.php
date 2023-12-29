@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cập nhật nguyên liệu</h6>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <form method="POST" action="{{ route('ingredient.update', $ingredient->nl_id ) }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên nguyên liệu</label>
                        <input type="text" class="form-control" 
                            placeholder="Nhập tên nguyên liệu" name="ingredient_name" value="{{$ingredient->nl_ten}}">
                    </div>
                   
                    <div class="form-group">
                        <label for="exampleInputEmail1">Đơn vị tính</label>
                        <input type="text" class="form-control"
                            placeholder="Nhập đơn vị tính" name="ingredient_unit"  value="{{$ingredient->nl_dvt}}">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Hiển thị</label>
                        <select name="ingredient_status" class="form-control">
                            @if ($ingredient->nl_tinhtrang == 1)
                                <option selected value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            @else
                                <option selected value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            @endif
                        </select>
                    </div>
                    <a href="{{route('ingredient.index')}}" class="btn btn-success">Trở lại</a>
                    <button type="submit" name="add_ingredient" class="btn btn-primary">Cập nhật nguyên liệu</button>
                </form>
            </div>
        </div>
    </div>
@endsection
