@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cập nhật nhà cung cấp</h6>
        </div>

        <div class="card-body">

            <form action="{{  route('supplier.update', $supplier->ncc_id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tên nhà cung cấp:</label>
                            <input type="text" class="form-control cus_name" name="ncc_ten"
                                value="{{ $supplier->ncc_ten }}">
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại khách hàng:</label>
                            <input type="text" class="form-control cus_sdt" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Nhập số điện thoại" name="ncc_sdt"
                                value="{{ $supplier->ncc_sdt }}">
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email khách hàng:</label>
                            <input type="text" class="form-control cus_email" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Nhập email" name="ncc_email"
                                value="{{ $supplier->ncc_email }}">
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Địa chỉ cụ thể:</label>
                    <textarea cols="10" class="form-control location_old" name="location_old" disabled> {{$supplier->ncc_diachi}} 
                    </textarea>
                </div>

                <a href="#boxnoidung" aria-expanded="false" data-toggle="collapse"
                    class="btn btn-primary  mt-3 ml-2 mb-3">Cập nhật lại địa chỉ</a>
                <div class="collapse mt-4" id="boxnoidung">
                    <div class="card card-body">
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
                        <input type="hidden" name="result1" id="result" value="">

                        <div class="form-group">
                            <label>Địa chỉ cụ thể:</label>
                            <textarea cols="10" class="form-control location1" name="location1">
                    </textarea>
                        </div>
                    </div>
                </div>


                <a href="{{   route('supplier.index') }}" class="btn btn-success mt-3 mb-3">Trở lại</a>

                <button type="submit" name="add_sup" class="btn btn-primary mt-3 mb-3 add_sup">Cập nhật nhà cung cấp</button>
                {{-- <button class="btn btn-primary mt-3 add_cus" >Thêm khách hàng</button> --}}

                {{-- <input type="button" class="btn btn-primary mt-3 add_cus" value="Thêm khách hàng"> --}}

            </form>

        </div>



    </div>
@endsection
