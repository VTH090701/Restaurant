@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liệt kê bài viết</h6>
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
                        <input type="text" name="start_date6" class="form-control start_date6" id="start_date6">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i
                                    class="fas fa-calendar-alt"></i></span>
                        </div>
                        {{-- <label>End Date:</label> --}}
                        <input type="text" name="end_date6" class="form-control end_date6" id="end_date6">
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary filter6" id="filter6" style="margin-top: 8px">Lọc</button>
                    {{-- <button class="btn btn-primary reset" style="margin-top: 8px">Reset</button> --}}
                    <a href="{{route('coupon.index')}}"  class="btn btn-primary reset mt-2"> Reset</a>
                </div>
            </div>
            <div class="row">
                <a class="btn btn-primary" style="margin-left: auto" href="{{route('post.create')}}">
                    <i class="fa fa-sign-in" aria-hidden="true"> Thêm bài viết</i>
                </a>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-bordered myTablepost" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã bài viết</th>
                            <th>Nhân viên</th>
                            <th>Tiêu đề</th>
                            <th>Hình ảnh</th>
                            <th>Tóm tắt bài viết</th>
                            <th>Thời gian đăng</th>
                            <th>Thời gian cập nhật</th>

                            <th>Hiển thị</th>
                            <th>Quản lý</th>

                        </tr>
                    </thead>
                    {{-- <tbody>
                        @foreach ($post as $key => $po)
                            <tr>
                                <td>{{ $po->baiviet_id }}</td>
                                <td>{{ $po->baiviet_tieude }}</td>
                                <td><img src="public/upload/post/{{ $po->baiviet_hinhanh }}" width="100" height="100"></td>
                                <td>{!! $po->baiviet_tomtat !!}</td>

                                <td>
                                    <?php
                                if( $po->baiviet_tinhtrang  == 0){
                                ?>
                                    <a href="{{ url('/active-post/' .  $po->baiviet_id) }}"><span
                                            class="fa-thumb-styling fa fa-thumbs-down"
                                            style="font-size: 18pt;color: red"></span></a>
                                    <?php    
                                }else{
                                ?>
                                    <a href="{{ url('/unactive-post/' .  $po->baiviet_id ) }}"><span
                                            class="fa-thumb-styling fa fa-thumbs-up" style="font-size: 18pt"></span></a>

                                    <?php
                                }
                                ?>
                                </td>
                              
                                <td>
                                    <a href="{{ url('/edit-post/'.  $po->baiviet_id ) }}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i>
                                    </a>
                                    | <a href="{{ url('/delete-post/' .  $po->baiviet_id ) }}">
                                        <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i>

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
