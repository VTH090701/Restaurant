@extends('layout_user')
@section('user_content')
    <!-- Reservation Start -->
    <div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">

        <?php
        $mess = Session::get('mess');
        if ($mess) {
            echo '<div class="alert alert-primary m-2" role="alert">' . $mess . '</div>';
            Session::put('mess', null);
        }
        ?>

        <h2 class="m-4">Lịch sử đặt bàn của bạn</h2>

{{-- 
        <div class="row">
            <div class="col-md-8">

            </div>

            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small input-search-ajax"
                        placeholder="Tìm kiếm..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
  
            </div>
        </div> --}}
        <div class="row m-2">

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i
                                class="fas fa-calendar-alt"></i></span>
                    </div>
                    {{-- <label>Start Date:</label> --}}
                    <input type="text" name="start_date2" class="form-control start_date" id="start_date">
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i
                                class="fas fa-calendar-alt"></i></span>
                    </div>
                    {{-- <label>End Date:</label> --}}
                    <input type="text" name="end_date2" class="form-control end_date" id="end_date">
                </div>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary filter" id="filter" style="margin-top: 8px">Lọc</button>
                {{-- <button class="btn btn-primary reset" style="margin-top: 8px">Reset</button> --}}
                <a href="{{url('/list-reservation')}}"  class="btn btn-primary reset mt-2"> Reset</a>
            </div>
        </div>


        <div class="table-responsive m-4">
            <table class="table table-bordered myTableres1" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mã đặt bàn</th>
                        <th>Tên người đặt</th>
                        <th>Email người đặt</th>
                        <th>Số điện thoại</th>
                        <th>Thời gian</th>
                        <th>Bàn số</th>
                        <th>Số lượng người</th>
                        <th>Tình trạng</th>
                        <th>Quản lý</th>
                        <th></th>

                    </tr>
                </thead>
                {{-- <tbody>
                    @foreach ($reservations as $key => $res)
                        <tr>
                            <td>{{ $res->datban_id }}</td>
                            <td>{{ $res->datban_ten }}</td>
                            <td>{{ $res->datban_email }}</td>
                            <td>{{ $res->datban_sdt }}</td>
                            <td>
                                {{ $res->datban_date }}
                            </td>
                            <td>{{ $res->table->ban_ten ?? null }}</td>
                            <td>{{ $res->datban_slnguoi }}</td>

                            @if ($res->datban_tinhtrang == 0)
                                <td>
                                    Chưa duyệt
                                </td>
                            @else
                                <td>
                                    Đã duyệt
                                </td>
                            @endif

                            <td style="display: flex;">

                                @if (Carbon\Carbon::now() < $res->datban_date)
                                    <a href="{{ url('/edit-reservation-customer/' . $res->datban_id) }}">
                                        <i class="fa fa-edit" aria-hidden="true" style="color:blue; "></i>

                                    </a>
                                    |
                                @else
                                
                                @endif

                               
                                <a href="{{ url('/delete-reservation-customer/' . $res->datban_id) }}">
                                    <i class="fa fa-trash" aria-hidden="true" style="color: red;"></i></a>
                            </td>
                            <td>
                                @if (Carbon\Carbon::now() < $res->datban_date)
                                    Gần đây
                                @else
                                    Đã hết hạn
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody> --}}

            </table>
        </div>
    </div>
@endsection
