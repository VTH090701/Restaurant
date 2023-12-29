@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chi tiết phiên làm việc</h6>
        </div>
        {{-- <?php
        $mess = Session::get('mess');
        if ($mess) {
            echo $mess;
            Session::put('mess', null);
        }
        ?> --}}
        <div class="card-body">
            <div class="row">
                {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3" style="margin-left: auto;">
                    Cập nhật làm việc
                </button> --}}
                <a href="{{ url('/all-shift') }}" class="btn btn-success" style="margin-left: auto;">Trở lại</a>

                @if ($shift->phienlamviec_tt == 0)
                    <a href="{{ url('/edit-shift/' . $shift->phienlamviec_id) }}" class="btn btn-primary"
                        style="margin-left: 5px;">Cập nhật phiên</a>

                    <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal2"
                        style="margin-left: 5px;">
                        Đóng phiên làm việc
                    </button>
                @else
                @endif


                {{-- <a class="btn btn-primary" href="{{ url('/') }}" style="margin-left: 5px">Cập nhật phiên</a> --}}

                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Đóng phiên làm việc</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5 style="font-weight: bold; font-size: 30px">Thông tin phiên làm việc</h5>
                                <p class="mt-4">Nhân viên: {{ $shift->admins->nv_ten }}</p>

                                <p>Số tiền đầu kì: 0 VNĐ</p>
                                <p>Số tiền cuối kì: {{ number_format($shift->phienlamviec_dt) . ' ' . 'VNĐ' }}</p>
                                <?php
                                $total_1 = 0;
                                $total_2 = 0;
                                $total_3 = 0;
                                foreach ($shift->orders as $key => $item) {
                                    if ($item->hoadon_httt == 1) {
                                        $total_1 += $item->hoadon_tongtien;
                                    } elseif ($item->hoadon_httt == 2 || $item->hoadon_httt == 4) {
                                        $total_2 += $item->hoadon_tongtien;
                                    } elseif ($item->hoadon_httt == 3) {
                                        $total_3 += $item->hoadon_tongtien;
                                    }
                                }
                                ?>
                                <form action="{{ url('/off-shift/' . $shift->phienlamviec_id) }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        {{-- <label for="">Số tiền cuối kì:
                                            {{ number_format($shift->phienlamviec_dt) . ' ' . 'VNĐ' }}</label> --}}
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <tr>
                                                <td><i class="fa fa-money-bill text-success"></i> Tiền mặt</td>
                                                <td style="font-size: 15px">{{ number_format($total_1) . ' ' . 'VNĐ' }}</td>
                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-university text-danger"></i> Chuyển khoản</td>
                                                <td style="font-size: 15px">{{ number_format($total_2) . ' ' . 'VNĐ' }}</td>

                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-credit-card text-info"></i> Thẻ tín dụng</td>
                                                <td style="font-size: 15px">{{ number_format($total_3) . ' ' . 'VNĐ' }}</td>

                                            </tr>
                                        </table>
                                        <hr>
                                        <p>Tổng chi tiêu phiên: {{ number_format($shift->phienlamviec_tc) . ' ' . 'VNĐ' }}</p>

                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            @foreach ($shift->detailsshifts as $item)
                                                <tr>
                                                    <td style="font-size: 15px">{{ $item->ctphien_motachi }}</td>
                                                    <td style="font-size: 15px">
                                                        {{ number_format($item->ctphien_sotienchi) . ' ' . 'VNĐ' }}
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </table>

                                        <label>Ghi chú trong phiên làm việc:</label>
                                        <textarea class="form-control" name="plv_gt"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <button type="submit" class="btn btn-primary" name="add_customer_pos">Xác
                                            nhận</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-6">
                    <h3 style="margin-left: 20px">Mã phiên: {{ $shift->phienlamviec_id }} </h3>
                    <p style="margin-left: 20px">Nhân viên: {{ $shift->admins->nv_ten }} </p>
                    <p style="margin-left: 20px">Thời gian bắt đầu: {{ $shift->phienlamviec_tgbd }} </p>
                    <p style="margin-left: 20px">Thời gian kết thúc: {{ $shift->phienlamviec_tgkt }} </p>
                    @if ($shift->phienlamviec_gt)
                        <p style="margin-left: 20px">Ghi chú trong phiên làm việc: {{ $shift->phienlamviec_gt }} </p>
                    @else
                    @endif

                    <p style="margin-left: 20px">Trạng thái phiên:
                        @if ($shift->phienlamviec_tt == 0)
                            Đang mở
                        @else
                            Hoàn thành
                        @endif
                    </p>

                </div>
            </div>
            <h4 style="margin-left: 20px;font-size: 20px">Tổng doanh thu:
                {{ number_format($shift->phienlamviec_dt) . ' ' . 'VNĐ' }}</h4>
            <div class="row" style="margin-left: 20px">
                <div class="table-responsive mt-2">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <td style="font-size: 20px"><i class="fa fa-money-bill text-success"></i> Tiền mặt</td>
                            <td style="font-size: 22px">{{ number_format($total_1) . ' ' . 'VNĐ' }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 20px"><i class="fa fa-university text-danger"></i> Chuyển khoản</td>
                            <td style="font-size: 22px">{{ number_format($total_2) . ' ' . 'VNĐ' }}</td>

                        </tr>
                        <tr>
                            <td style="font-size: 20px"><i class="fa fa-credit-card text-info"></i> Thẻ tín dụng</td>
                            <td style="font-size: 22px">{{ number_format($total_3) . ' ' . 'VNĐ' }}</td>

                        </tr>
                    </table>
                </div>
            </div>
            <h4 style="margin-left: 20px;font-size: 20px">Tổng chi tiêu:
                {{ number_format($shift->phienlamviec_tc) . ' ' . 'VNĐ' }}
            </h4>
            <div class="row" style="margin-left: 20px">
                <div class="table-responsive mt-2">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        @foreach ($shift->detailsshifts as $item)
                            <tr>
                                <td style="font-size: 20px">{{ $item->ctphien_motachi }}</td>
                                <td style="font-size: 22px">{{ number_format($item->ctphien_sotienchi) . ' ' . 'VNĐ' }}
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
            <div class="row" style="margin-left: 20px">
                <h4 class="mt-2">Các hóa đơn trong phiên làm việc:</h4>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã hóa đơn</th>
                                <th>Tổng tiền</th>
                                <th>Tình trạng</th>
                                <th>Thời gian</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Mã hóa đơn</th>
                                <th>Tổng tiền</th>
                                <th>Tình trạng</th>
                                <th>Thời gian</th>
                                <th>Quản lý</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($shift->orders as $key => $item)
                                <tr>
                                    <td>{{ $item->hoadon_id }}</td>
                                    <td>{{ number_format($item->hoadon_tongtien) . ' ' . 'VNĐ' }}</td>
                                    <td>
                                        @if ($item->hoadon_tinhtrang == 0)
                                            Chưa thanh toán
                                        @else
                                            Đã thanh toán
                                        @endif
                                    </td>
                                    <td>{{ $item->hoadon_ngaytao }}</td>
                                    <td>
                                        <a href="{{ url('/details-ordtomer/' . $item->hoadon_id) }}"
                                            style="text-decoration: none;">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                            </i>
                                        </a>
                                        {{-- | 
                                        <a href="{{ url('/delete-ordtomer/' . $item->hoadon_id) }}">
                                            <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i>

                                        </a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
