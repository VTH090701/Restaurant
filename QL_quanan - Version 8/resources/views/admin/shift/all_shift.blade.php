@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liệt kê phiên làm việc</h6>
        </div>

        <div class="card-body">
           
        
            <?php
            $bien_tam = 0;
            ?>
            @foreach ($shift_all as $key => $shift)
                <?php
                if ($shift->phienlamviec_tt == 0) {
                    $bien_tam = 1;
                }
                
                ?>
            @endforeach
            @if ($bien_tam == 1)
                <div class="row">
                    <a class="btn btn-primary" style="margin-left:auto " href="{{ url('/notice-shift') }}"> <i
                            class="fa fa-plus-square" aria-hidden="true" style="color: white"></i> Mở phiên làm
                        việc</a>
                </div>
            @else
                <div class="row">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1"
                        style="margin-left:auto "> <i class="fa fa-plus-square" aria-hidden="true" style="color: white"></i>
                        Mở phiên làm việc
                    </button>
                </div>
                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Mở phiên làm việc</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5>Thông tin phiên</h5>
                                <p>Nhân viên: {{ Auth::user()->nv_ten }}</p>
                                <form action="{{ url('/on-shift') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="">Số tiền đầu kì:</label>
                                        <input type="text" class="form-control" name="name" value="0 VNĐ" disabled>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <button type="submit" class="btn btn-primary" name="add_customer_pos">Bắt
                                            đầu</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
            <div class="row mt-3">

                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i
                                    class="fas fa-calendar-alt"></i></span>
                        </div>
                        {{-- <label>Start Date:</label> --}}
                        <input type="text" name="start_date1" class="form-control start_date1" id="start_date1">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i
                                    class="fas fa-calendar-alt"></i></span>
                        </div>
                        {{-- <label>End Date:</label> --}}
                        <input type="text" name="end_date1" class="form-control end_date1" id="end_date1">
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary filter" id="filter1" style="margin-top: 8px">Lọc</button>
                    {{-- <button class="btn btn-primary reset" style="margin-top: 8px">Reset</button> --}}
                    <a href="{{ url('/all-shift') }}" class="btn btn-primary reset mt-2"> Reset</a>
                </div>

            </div>
            <div class="table-responsive mt-2">
                <table class="table table-bordered myTableshi" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã phiên</th>
                            <th>Nhân viên</th>
                            <th>Thời gian tạo</th>
                            <th>Thời gian kết thúc </th>
                            <th>Trạng thái</th>
                            <th>Doanh thu</th>
                            <th>Tổng chi</th>
                            <th>Quản lý</th>

                        </tr>
                    </thead>
                    {{-- <tbody>
                        @foreach ($shift_all as $key => $shift)
                            <tr>
                                <td>{{ $shift->phienlamviec_id }}</td>
                                <td>{{ $shift->created_at }}</td>
                                <td>{{ $shift->updated_at }}</td>
                                <td>
                                    @if ($shift->phienlamviec_tt == 0)
                                        Đang mở
                                    @else
                                        Hoàn thành
                                    @endif
                                </td>
                                <td>{{ number_format($shift->phienlamviec_dt) . ' ' . 'VNĐ' }}</td>
                                <td>{{ number_format($shift->phienlamviec_tc) . ' ' . 'VNĐ' }}</td>

                                <td>
                                    <a href="{{ url('/details-shift/' . $shift->phienlamviec_id) }}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i>
                                    </a>
                                    | <a href="{{ url('/delete-shift/' . $shift->phienlamviec_id) }}">
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
