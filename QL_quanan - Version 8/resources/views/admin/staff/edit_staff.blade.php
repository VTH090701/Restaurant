@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cật nhật nhân viên</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <form action="{{route('staff.update', $edit_adm->nv_id) }}" method="POST" enctype="multipart/form-data">

                    {{-- <form method="POST" nctype="multipart/form-data"> --}}
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên nhân viên:</label>
                                <input type="text" class="form-control name" placeholder="Nhập tên khánh hàng"
                                    name="name" value="{{ $edit_adm->nv_ten }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số điện thoại :</label>
                                <input type="text" class="form-control phone" placeholder="Nhập số điện thoại"
                                    name="phone" value="{{ $edit_adm->nv_sdt }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email:</label>
                                <input type="text" class="form-control cus_email" placeholder="Nhập email" name="email"
                                    value="{{ $edit_adm->nv_email }}">
                            </div>

                        </div>
                        <div class="col-md-6">
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1">Mật khẩu:</label>
                                <input type="password" class="form-control password"placeholder="Nhập mật khẩu" name="password">
                            </div> --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Avatar:</label>
                                <input type="file" class="form-control avatar" placeholder="Nhập hình ảnh" name="avatar"
                                    value="{{ $edit_adm->nv_hinhanh }}">
                                <img src="/public/upload/hoso_nv/{{ $edit_adm->nv_hinhanh }}" width="80" height="80"
                                    class="mt-2" style="border-radius: 50px">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Trạng thái</label>

                                @if ($edit_adm->nv_tinhtrang == 1)
                                    <select name="status" id="status" class="form-control status">
                                        <option value="1" selected>Hoạt động</option>
                                        <option value="0">Khóa</option>
                                    </select>
                                @else
                                    <select name="status" id="status" class="form-control status">
                                        <option value="1">Hoạt động</option>
                                        <option value="0" selected>Khóa</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                    </div>




                    <div class="form-group">
                        <label for="exampleInputEmail1">Địa chỉ cụ thể:</label>
                        <textarea cols="10" class="form-control location_old" name="location_old" disabled> {{ $edit_adm->nv_diachi }} 
                        </textarea>
                    </div>

                    <a href="#boxnoidung" aria-expanded="false" data-toggle="collapse"
                        class="btn btn-primary  mt-3 mb-2">Cập nhật lại địa chỉ</a>
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




                    <a href="{{ route('staff.index') }}" class="btn btn-success mt-3 mb-2">Trở lại</a>
                    <button type="submit" name="up_cus" class="btn btn-primary mt-3 mb-2 up_cus">Cập nhật nhân viên</button>

                    {{-- <button class="btn btn-primary mt-3 add_cus" >Thêm khách hàng</button> --}}

                    {{-- <input type="button" class="btn btn-primary mt-3 add_cus" value="Thêm khách hàng"> --}}
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript"></script>
@endsection
