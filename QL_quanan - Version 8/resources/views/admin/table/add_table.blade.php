@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm bàn</h6>
        </div>
        <?php
        $mess = Session::get('mess');
        if ($mess) {
            echo $mess;
            Session::put('mess', null);
        }
        ?>
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST" action="{{route('table.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên bàn</label>
                        <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" name="tab_name">
                    </div>
                    @error('tab_name')
                        <div class="text-sm " style="color: red">Tên bàn không được để trống</div>
                    @enderror
                    <div class="form-group">
                        <label for="">Số lượng người trong bàn</label>
                        <input type="text" class="form-control" placeholder="Nhập số lượng người" name="tab_qty">
                    </div>
                    @error('tab_qty')
                        <div class="text-sm " style="color: red">{{ $message }}</div>
                    @enderror
                    {{-- <div class="form-group">
                        <label for="exampleInputPassword1">Hiển thị</label>
                        <select name="tab_status" class="form-control">
                            <option value="0">Không hoạt động</option>
                            <option value="1">Hoạt động</option>
                        </select>
                    </div> --}}
                    <a href="{{ route('table.index') }}" class="btn btn-success">Trở lại</a>

                    <button type="submit" name="add_tab" class="btn btn-primary">Thêm bàn</button>
                </form>
            </div>
        </div>
    </div>
@endsection
