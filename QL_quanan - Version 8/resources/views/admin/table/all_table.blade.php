@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liệt kê bàn</h6>
        </div>

        <div class="card-body">
            <div class="row">
                <a class="btn btn-primary" style="margin-left: auto" href="{{route('table.create')}}">
                    <i class="fa fa-sign-in" aria-hidden="true"> Thêm bàn</i>
                </a>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-bordered myTabletab" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã bàn</th>
                            <th>Tên bàn</th>
                            <th>Số lượng người trong bàn</th>
                            <th>Tình trạng</th>
                            <th>Quản lý</th>
                        </tr>
                    </thead>
                
                </table>
            </div>
        </div>
    </div>
@endsection
