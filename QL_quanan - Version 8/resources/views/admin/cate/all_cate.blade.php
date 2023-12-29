@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liệt kê danh mục</h6>
        </div>
       
        <div class="card-body">
            <div class="row">
                <a class="btn btn-primary" style="margin-left: auto" href="{{route('category.create')}}">
                    <i class="fa fa-sign-in" aria-hidden="true"> Thêm danh mục</i>
                </a>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-bordered myTablecat" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã danh mục</th>
                            <th>Tên danh mục</th>
                            <th>Mô tả danh mục</th>
                            <th>Hiển thị</th>
                            <th>Quản lý</th>

                        </tr>
                    </thead>
                    {{-- <tbody>
                        @foreach ($all_cate as $key => $cate)
                            <tr>
                                <td>{{ $cate->danhmuc_ten }}</td>
                                <td>
                                    <?php
                                if($cate->danhmuc_tinhtrang == 0){
                                ?>
                                    <a href="{{ url('/active-category/' . $cate->danhmuc_id) }}"><span
                                            class="fa-thumb-styling fa fa-thumbs-down"
                                            style="font-size: 18pt;color: red"></span></a>
                                    <?php    
                                }else{
                                ?>
                                    <a href="{{ url('/unactive-category/' . $cate->danhmuc_id) }}"><span
                                            class="fa-thumb-styling fa fa-thumbs-up" style="font-size: 18pt"></span></a>

                                    <?php
                                }
                                ?>
                                </td>
                              
                                <td>
                                    <a href="{{ url('/edit-category/'. $cate->danhmuc_id) }}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i>
                                    </a>
                                    | <a href="{{ url('/delete-category/' . $cate->danhmuc_id) }}">
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
