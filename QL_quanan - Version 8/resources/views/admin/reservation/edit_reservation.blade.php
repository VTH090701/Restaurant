@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm lịch đặt bàn</h6>
        </div>

        <div class="card-body">
            <?php
            $warning = Session::get('warning');
            if ($warning) {
                echo '<div class="alert alert-danger" role="alert">' . $warning . '</div>';
                Session::put('warning', null);
            }
            ?>


            <div class="table-responsive">
                <form method="POST" action="{{ url('/update-reservation-admin/' . $reservation->datban_id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên người đặt:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    placeholder="Nhập tên người đặt " name="datban_ten" value="{{ $reservation->datban_ten }}">
                            </div>
                            @error('datban_ten')
                                <div class="text-sm " style="color: red">Tên người đặt không được để trống</div>
                            @enderror
        
        
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email người đặt:</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    placeholder="Nhập email người đặt" name="datban_email" value="{{ $reservation->datban_email }}">
                            </div>
                            @error('datban_email')
                                <div class="text-sm " style="color: red">Email người đặt không được để trống</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số điện thoại người đặt:</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Nhập số điện thoại người nhập" name="datban_sdt"
                            value="{{ $reservation->datban_sdt }}">
                    </div>
                    @error('datban_sdt')
                        <div class="text-sm " style="color: red">Số điện thoại người đặt không được để trống</div>
                    @enderror


                    <div class="form-group">
                        <label for="exampleInputEmail1">Thời gian đặt:</label>
                        <input type="datetime-local" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" name="datban_thoigian"
                            value="{{ Carbon\Carbon::parse($reservation->datban_thoigian)->format('Y-m-d\TH:i:s') }}">
                    </div>
                    @error('datban_thoigian')
                        <div class="text-sm " style="color: red">{{ $message }}</div>
                    @enderror
                        </div>

                    </div>

                 




                    <div class="form-group">
                        <label for="exampleInputEmail1">Số lượng người:</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Nhập số lượng người"
                            aria-describedby="emailHelp" name="datban_slnguoi" value="{{ $reservation->datban_slnguoi }}">
                    </div>
                    @error('datban_slnguoi')
                        <div class="text-sm " style="color: red">Số lượng người không được để trống</div>
                    @enderror


                    <div class="form-group">
                        <label for="exampleInputEmail1">Bàn:</label>
                        <select id="ban_id" name="ban_id" class="form-control">
                            @foreach ($table as $key => $tab)
                                @if ($tab->ban_id == $reservation->ban_id)
                                    <option selected value="{{ $tab->ban_id }}">{{ $tab->ban_ten }}
                                        ({{ $tab->ban_slnguoi }} người)</option>
                                @else
                                    <option value="{{ $tab->ban_id }}">{{ $tab->ban_ten }} ({{ $tab->ban_slnguoi }}
                                        người)</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    @error('ban_id')
                        <div class="text-sm " style="color: red">Bàn không được để trống</div>
                    @enderror

                    <div class="form-group">
                        <label for="exampleInputEmail1">Khách hàng:</label>
                        <select id="khachhang_id" name="khachhang_id" class="form-control">
                            @foreach ($customer as $key => $cus)
                                @if ($cus->khachhang_id == $reservation->khachhang_id)
                                    <option selected value="{{ $cus->khachhang_id }}">{{ $cus->khachhang_ten }}</option>
                                @else
                                    <option value="{{ $cus->khachhang_id }}">{{ $cus->khachhang_ten }}</option>
                                @endif
                            @endforeach

                        </select>
                    </div>
                    @error('khachhang_id')
                        <div class="text-sm " style="color: red">Khách hàng không được để trống</div>
                    @enderror
                    <input type="hidden" value="{{$reservation->datban_tinhtrang}}" name="datban_tinhtrang">
                    <input type="hidden" value="{{$reservation->datban_kt}}" name="datban_kt">

                    <a href="{{url('/all-reservation')}}" class="btn btn-success">Trở lại</a>

                    <button type="submit" name="add_res" class="btn btn-primary">Cập nhật lịch đặt bàn</button>
                </form>
            </div>
        </div>
    </div>
@endsection
