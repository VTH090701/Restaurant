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
            <div style="display: flex;">
                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin-left:auto "> <i
                        class="fa fa-plus-square" aria-hidden="true" style="color: white"></i>
                    Khách hàng
                </button>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm khách hàng</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('/add-customer-pos') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="">Tên khách hàng:</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Số điện thoại:</label>
                                    <input type="text" class="form-control" name="phone">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Email:</label>
                                    <input type="text" class="form-control" name="email">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Mật khẩu:</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div>
                                            <label for="exampleInputEmail1">Chọn thành phố:</label>
                                            <select name="province" id="province" class="form-control province">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div>
                                            <label for="exampleInputEmail1">Chọn quận huyện:</label>
                                            <select name="district" id="district" class="form-control district">
                                                <option value="">---Chọn quận huyện---</option>
            
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div>
                                            <label for="exampleInputEmail1">Chọn xã phường:</label>
            
                                            <select name="ward" id="ward" class="form-control ward">
                                                <option value="">---Chọn xã---</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
            
            
                                <input type="hidden" name="result" id="result" value="">
                                <input type="hidden" value="avatar_user.png" name="image">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ cụ thể:</label>
                                    <textarea cols="10" class="form-control location" placeholder="Nhập địa chỉ cụ thể của bạn" name="location"
                                        id="result">
                                    </textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-primary" name="add_customer_pos">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <form method="POST" action="{{ url('/save-reservation') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên người đặt:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    placeholder="Nhập tên người đặt " name="datban_ten">
                            </div>
                            @error('datban_ten')
                                <div class="text-sm " style="color: red">Tên người đặt không được để trống</div>
                            @enderror
        
        
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email người đặt:</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    placeholder="Nhập email người đặt" name="datban_email">
                            </div>
                            @error('datban_email')
                                <div class="text-sm " style="color: red">Email người đặt không được để trống</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số điện thoại người đặt:</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    placeholder="Nhập số điện thoại người nhập" name="datban_sdt">
                            </div>
                            @error('datban_sdt')
                                <div class="text-sm " style="color: red">Số điện thoại người đặt không được để trống</div>
                            @enderror
        
        
                            <div class="form-group">
                                <label for="exampleInputEmail1">Thời gian đặt:</label>
                                <input type="datetime-local" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" name="datban_thoigian">
                            </div>
                            @error('datban_thoigian')
                                <div class="text-sm " style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
       


                  


                    <div class="form-group">
                        <label for="exampleInputEmail1">Số lượng người:</label>
                        <input type="number" class="form-control" id="exampleInputEmail1"
                            placeholder="Nhập số lượng người" aria-describedby="emailHelp" name="datban_slnguoi">
                    </div>
                    @error('datban_slnguoi')
                        <div class="text-sm " style="color: red">Số lượng người không được để trống</div>
                    @enderror


                    <div class="form-group">
                        <label for="exampleInputEmail1">Bàn:</label>
                        <select id="ban_id" name="ban_id" class="form-control">
                            @foreach ($table as $key => $tab)
                                <option value="{{ $tab->ban_id }}">{{ $tab->ban_ten }} ({{ $tab->ban_slnguoi }} người)
                                </option>
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
                                <option value="{{ $cus->khachhang_id }}">{{ $cus->khachhang_ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('khachhang_id')
                        <div class="text-sm " style="color: red">Khách hàng không được để trống</div>
                    @enderror
                    <input type="hidden" value="0" name="datban_tinhtrang">
                    <input type="hidden" value="0" name="datban_kt">

                    <a href="{{url('/all-reservation')}}" class="btn btn-success" >Trở lại</a>

                    <button type="submit" name="add_res" class="btn btn-primary">Thêm lịch đặt bàn</button>
                </form>
            </div>
        </div>
    </div>
@endsection
