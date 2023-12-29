@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liệt kê nguyên liệu</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <a class="btn btn-primary" style="margin-left: auto" href="{{ route('ingredient.create') }}">
                    <i class="fa fa-sign-in" aria-hidden="true"> Thêm nguyên liệu</i>
                </a>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-bordered myTableing" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã nguyên liệu</th>
                            <th>Tên nguyên liệu</th>
                            <th>Đơn vị tính</th>
                            {{-- <th>Số lượng</th> --}}
                            {{-- <th>Số lượng đã dùng</th> --}}
                            
                            <th>Hiển thị</th>
                            <th>Quản lý</th>

                        </tr>
                    </thead>
                    {{-- <tbody>
                        @foreach ($ingredient as $key => $in)
                            <tr>
                                <td>{{ $in->nl_id }}</td>

                                <td>{{ $in->nl_ten }}</td>
                                <td>{{ $in->nl_dvt }}</td>

                                <td>
                                    <?php
                                if($in->nl_tinhtrang == 0){
                                ?>
                                    <a href="{{ url('/active-ingredient/' . $in->nl_id) }}"><i class="fa fa-toggle-off"
                                            aria-hidden="true" style="font-size: 18pt;color: red"></i></a>
                                    <?php    
                                }else{
                                ?>
                                    <a href="{{ url('/unactive-ingredient/' . $in->nl_id) }}"><i class="fa fa-toggle-on"
                                            aria-hidden="true" style="font-size: 18pt;color: green"></i></a>

                                    <?php
                                }
                                ?>
                                </td>

                                <td>
                                    <a href="{{ url('/edit-ingredient/' . $in->nl_id) }}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i>
                                    </a>
                                    | <a href="{{ url('/delete-ingredient/' . $in->nl_id) }}">
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
