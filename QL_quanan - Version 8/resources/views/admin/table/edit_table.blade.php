@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cập nhật bàn</h6>
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
                @foreach ($edit_table as $key => $edit_val)
                <form method="POST" action="{{ route('table.update', $edit_val->ban_id ) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên bàn</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Nhập tên bàn" name="tab_name" value="{{ $edit_val->ban_ten }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên bàn</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Nhập số lượng người" name="tab_qty" value="{{ $edit_val->ban_slnguoi }}">
                    </div>
                    {{-- <div class="form-group">
                        <label for="exampleInputPassword1">Hiển thị</label>
                        <select name="tab_status" class="form-control">
                            <option value="0">Không hoạt động</option>
                            <option value="1">Hoạt động</option>
                        </select>
                    </div> --}}
                    <a href="{{route('table.index')}}" class="btn btn-success">Trở lại</a>

                    <button type="submit" name="update_tab" class="btn btn-primary">Cập nhật bàn</button>
                </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection
