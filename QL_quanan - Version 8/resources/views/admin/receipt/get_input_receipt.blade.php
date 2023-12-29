@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm phiếu nhập</h6>
        </div>

        <div class="card-body">
            <div style="display: flex;">
                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin-left:auto "> <i
                        class="fa fa-plus-square" aria-hidden="true" style="color: white"></i>
                    Nhà cung cấp
                </button>
                <button class="btn btn-info ml-2" data-toggle="modal" data-target="#exampleModal1"> <i
                        class="fa fa-plus-square" aria-hidden="true" style="color: white"></i>
                    Nguyên liệu
                </button>
            </div>
            {{-- Modal nhà cung cấp --}}
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm nhà cung cấp</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('/save-supplier1') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="">Tên nhà cung cấp:</label>
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

                                <div class="form-group mb-3 mt-3">
                                    <label for="">Địa chỉ cụ thể:</label>
                                    <textarea class="form-control" name="location"></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-primary" name="add_supplier">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Modal nguyên liệu --}}
            <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm nguyên liệu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('/save-ingredient1') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="">Tên nguyên liệu:</label>
                                    <input type="text" class="form-control" name="ingredient_name">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Đơn vị tính:</label>
                                    <input type="text" class="form-control" name="ingredient_unit">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Hiển thị</label>
                                    <select name="ingredient_status" class="form-control">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-primary" name="add_ingredient">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <form action="{{ url('/input-receipt') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">

                        <div class="row">
                            <div class="col-md-4">
                                <p style="font-size: 20px;">Người lập phiếu:</p>
                            </div>
                            <div class="col-md-8">
                                <p style="font-size: 20px;"> {{ Auth::user()->nv_ten }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <p style="font-size: 20px;">Thời gian lập:</p>
                            </div>
                            <div class="col-md-8">
                                <input type="datetime-local" class="form-control" name="time">
                            </div>
                            @error('time')
                                <div class="text-sm " style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-4">
                                <p style="font-size: 20px;">Nhà cung cấp:</p>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="ncc_id">
                                    <option value="">---------- Chọn nhà cung cấp ----------</option>
                                    @foreach ($supplier as $key => $sup)
                                        <option value="{{ $sup->ncc_id }}">{{ $sup->ncc_ten }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div> --}}

                    </div>
                    <div class="col-md-6">
                        <p style="font-size: 20px;">Nội dung: </p>
                        <textarea class="form-control" rows="3" name="desc"></textarea>
                        @error('desc')
                            <div class="text-sm " style="color: red">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <hr>
                <h5>Dữ liệu nhập hàng:</h5>

                <?php
                $warning = Session::get('warning');
                if ($warning) {
                    echo '<div class="alert alert-primary" role="alert">' . $warning . '</div>';
                    Session::put('warning', null);
                }
                ?>
                <div class="table-responsive mt-2">
                    <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên hàng</th>
                                <th>Nhà cung cấp</th>
                                <th>Đơn vị tính</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                                <th>
                                    <a href="#" class="btn btn-sm btn-success add_more"><i class="fa fa-plus"
                                            aria-hidden="true"></i>
                                    </a>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="addMoreProduct">
                            <tr>
                                <td>1</td>
                                {{-- <td><input type="text" name="name[]" id="name" class="form-control name"></td> --}}
                                <td>
                                    <select class="form-control nl_id" name="nl_id[]" id="nl_id">
                                        <option value="">--Nguyên liệu--</option>
                                        @foreach ($ingredient as $key => $ing)
                                            <option data-nl_dvt={{ $ing->nl_dvt }} value="{{ $ing->nl_id }}">
                                                {{ $ing->nl_ten }}</option>
                                        @endforeach
                                    </select>

                                </td>

                                <td>
                                    <select class="form-control ncc_id" name="ncc_id[]" id="ncc_id">
                                        <option value="">--Nhà cung cấp--</option>
                                        @foreach ($supplier as $key => $sup)
                                            <option value="{{ $sup->ncc_id }}">{{ $sup->ncc_ten }}</option>
                                        @endforeach
                                    </select>
                                </td>



                                <td><input type="text" name="unit[]" id="unit" class="form-control unit"></td>

                                <td><input type="number" name="quantity[]" id="quantity"
                                        class="form-control quantity">
                                </td>
                                <td><input type="numer" name="price[]" id="price" class="form-control price"></td>
                                <td><input type="number" name="total_amount[]" id="total_amount"
                                        class="form-control total_amount"></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-danger delete"><i class="fa fa-times"
                                            aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>
                <h4 style="float: right">Tổng tiền:
                    <b class="total" id="total">0.00</b>
                </h4>
                <a href="{{ url('/all-receipt') }}" class="btn btn-warning">Trở về</a>
                <input type="submit" value="Thêm phiếu nhập" class="btn btn-success">
            </form>
        </div>
    </div>
@endsection
