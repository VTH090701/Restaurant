@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liệt kê bình luận</h6>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i
                                    class="fas fa-calendar-alt"></i></span>
                        </div>
                        {{-- <label>Start Date:</label> --}}
                        <input type="text" name="start_date4" class="form-control start_date4" id="start_date4">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i
                                    class="fas fa-calendar-alt"></i></span>
                        </div>
                        {{-- <label>End Date:</label> --}}
                        <input type="text" name="end_date4" class="form-control end_date4" id="end_date4">
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary filter4" id="filter4" style="margin-top: 8px">Lọc</button>
                    {{-- <button class="btn btn-primary reset" style="margin-top: 8px">Reset</button> --}}
                    <a href="{{url('/all-comment')}}"  class="btn btn-primary reset mt-2"> Reset</a>
                </div>
            </div>


            <div class="table-responsive mt-2">
                <table class="table table-bordered myTablecom" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã bình luận</th>
                            <th>Khách hàng</th>
                            <th>Nội dung bình luận</th>
                            <th>Món ăn</th>
                            <th>Thời gian bình luận</th>
                            <th>Trạng thái</th>
                            <th>Quản lý</th>

                        </tr>
                    </thead>

                    {{-- <tbody>
                        @foreach ($comment as $key => $com)
                            <tr>
                                <td>{{ $com->binhluan_id }}</td>
                                <td>{{ $com->customers->khachhang_ten }}</td>
                                <td>{{ $com->binhluan_noidung }}</td>
                                <td>{{ $com->products->ma_ten }}</td>
                                <td>{{ $com->binhluan_thoigian }}</td>
                                <td>
                                    <?php
                                if($com->binhluan_tinhtrang == 0){
                                ?>
                                    <a href="{{ URL::to('/unactive-comment/' . $com->binhluan_id) }}">

                                        <i class="fa fa-toggle-on" aria-hidden="true"
                                            style="font-size: 18pt;color: green"></i></a>
                                    <?php    
                                }else{
                                ?>
                                    <a href="{{ URL::to('/active-comment/' . $com->binhluan_id) }}">
                                        <i class="fa fa-toggle-off" aria-hidden="true"
                                            style="font-size: 18pt;color: red"></i></a>

                                    <?php
                                }
                                ?>
                                    | <a href="{{ URL::to('/delete-comment/' . $com->binhluan_id) }}">
                                        <i class="fa fa-trash-o" aria-hidden="true" style="color: red;font-size: 22px"></i>

                                    </a>
                                </td>

                              
                            </tr>
                        @endforeach

                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>
@endsection
