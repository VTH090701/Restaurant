@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liệt kê các định lượng</h6>
        </div>
       
        <div class="card-body">
            <div class="row">
                <a class="btn btn-primary" style="margin-left: auto" href="{{ route('quantitative.create') }}">
                    <i class="fa fa-sign-in" aria-hidden="true">Thêm định lương món ăn</i>
                </a>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-bordered myTablequan" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã định lượng</th>
                            <th>Món ăn</th>
                            <th>Hình ảnh</th>
                            <th>Đơn vị tính</th>
                            <th>Trạng thái</th>
                            <th>Quản lý</th>
                        </tr>
                    </thead>

                    {{-- <tbody>
                        @foreach ($quantitative as $key => $quan)
                            <tr>
                                <td>{{ $quan->dl_id }}</td>
                                <td>{{ $quan->product->ma_ten }}</td>

                               
                              
                                <td>
                                    <a href="{{ url('/edit-quantitative/'. $quan->dl_id ) }}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i>
                                    </a>
                                    | <a href="{{ url('/delete-quantitative/' .  $quan->dl_id) }}">
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
