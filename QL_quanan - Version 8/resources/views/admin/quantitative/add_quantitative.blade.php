@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Khai báo định lượng món ăn</h6>
        </div>

        <div class="card-body">


            <form action="{{ route('quantitative.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Chọn món ăn định lượng:</h4>
                            </div>
                            <div class="col-md-6">
                                <select class="form-control sp_id" name="sp_id" id="sp_id">
                                    <option value="">------------ Món ăn ------------</option>
                                    @foreach ($product as $key => $pro)
                                        <option value="{{ $pro->ma_id }}">{{ $pro->ma_ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        @error('sp_id')
                            <div class="text-sm " style="color: red">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Thành phẩm / Đơn vị tính:</h4>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="dl_dvt">
                            </div>
                        </div>

                        @error('dl_dvt')
                            <div class="text-sm " style="color: red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Trạnh thái:</h4>
                            </div>
                            <div class="col-md-6">
                                <select class="form-control " name="dl_trangthai">
                                    <option value="">------------ Chọn ------------</option>
                                    <option value="0">------------ Không hoạt động ------------</option>
                                    <option value="1">------------ Hoạt động ------------</option>

                                </select>
                            </div>
                        </div>

                        @error('dl_trangthai')
                            <div class="text-sm " style="color: red">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
                <hr>
                <h5>Bao gồm các nguyên liệu:</h5>

                <div class="table-responsive mt-2">
                    <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên hàng</th>
                                <th>Đơn vị tính</th>
                                <th>Số lượng</th>
                                <th>
                                    <a href="#" class="btn btn-sm btn-success add_more1"><i class="fa fa-plus"
                                            aria-hidden="true"></i>
                                    </a>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="addMoreProduct1">
                            <tr>
                                <td>1</td>
                                <td>
                                    <select class="form-control nl_id" name="nl_id[]" id="nl_id">
                                        <option value="">------- Nguyên liệu -------</option>
                                        @foreach ($ingredient as $key => $ing)
                                            <option data-nl_dvt={{ $ing->nl_dvt }} value="{{ $ing->nl_id }}">
                                                {{ $ing->nl_ten }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" name="unit[]" id="unit" class="form-control unit"></td>
                                <td><input type="text" name="quantity[]" id="quantity" class="form-control quantity">
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-danger delete"><i class="fa fa-times"
                                            aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>

                <a href="{{ route('quantitative.index') }}" class="btn btn-warning" style="margin-left: auto">Trở về</a>
                <input type="submit" value="Thêm định lượng" class="btn btn-success ml-2">
            </form>
        </div>
    </div>
@endsection
