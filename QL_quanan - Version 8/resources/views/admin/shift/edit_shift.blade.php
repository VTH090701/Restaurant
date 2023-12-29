@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cập nhật phiên làm việc</h6>
        </div>
        <div class="card-body">
            <?php
            $mess = Session::get('mess');
            if ($mess) {
                echo '<div class="alert alert-primary" role="alert">' . $mess . '</div>';
                Session::put('mess', null);
            }
            ?>
        
            <div class="table-responsive">
                <form method="POST" action="{{url('/edit-shift/'. $edit_shift->phienlamviec_id)}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mã phiên:</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="" name="" value="{{ $edit_shift->phienlamviec_id }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nhân viên:</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="" name="" value="{{ $edit_shift->admins->nv_ten }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Thời gian bắt đầu:</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="" name="time" value="{{ $edit_shift->phienlamviec_tgbd }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Chi tiết chi tiêu:</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="" name="desc" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số tiền chi tiêu:</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="" name="money" value="" required>
                    </div>
                    <a href="{{url('/details-shift/'.$edit_shift->phienlamviec_id)}}" class="btn btn-success">Trở lại</a>

                    <button type="submit" name="edit_shift" class="btn btn-primary">Cập nhật phiên</button>
                </form>

            </div>
        </div>
    </div>
@endsection
