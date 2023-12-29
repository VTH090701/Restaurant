@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Thống kê doanh thu</h6>
        </div>
        <h5 style="margin-left: 10px;color: black" class="mt-3">Chi tiết doanh thu tháng : {{ $month }}</h5>

        <div class="row">
            <div class="col-md-3">
                <div style="border: 1px solid #f53a3a;background-color: #db2c3e;border-radius:5px " class="ml-3 m-3">
                    <p style="margin-left: 10px;margin-top: 10px;color: black;">Doanh thu</p>
                    @foreach ($cate as $cat)
                        <p style="margin-left: 10px;font-size: 20px;color: black;">
                            {{ number_format($cat->total) . ' ' . 'VNĐ' }}</p>
                    @endforeach

                </div>

            </div>
            <div class="col-md-3  ">
                <div style="border: 1px solid #9b10ff;background-color: #9689e2;border-radius:5px" class="ml-3 m-3">
                    <p style="margin-left: 10px;margin-top: 10px;color: black;">Chi phí</p>
                    @foreach ($cate1 as $cat)
                        <p style="margin-left: 10px;font-size: 20px;color: black;">
                            {{ number_format($cat->total) . ' ' . 'VNĐ' }} </p>
                    @endforeach

                </div>
            </div>
            <div class="col-md-3 ">
                <div style="border: 1px solid #28ecfe;background-color: #bff8fb;border-radius:5px" class="ml-3 m-3">
                    <p style="margin-left: 10px;margin-top: 10px;color: black;">Tổng hóa đơn</p>
                    @foreach ($cate as $cat)
                        <p style="margin-left: 10px;font-size: 20px;color: black;">{{ $cat->totalorder }}</p>
                    @endforeach

                </div>
            </div>
            <div class="col-md-3 ">
                <div style="border: 1px solid #4bfa5f;background-color: #9ff8b3;border-radius:5px" class="ml-3 m-3">
                    <p style="margin-left: 10px;margin-top: 10px;color: black;">Tổng lượt bán</p>
                    @foreach ($cate as $cat)
                        <p style="margin-left: 10px;font-size: 20px;color: black;">{{ $cat->quantity }}</p>
                    @endforeach

                </div>
            </div>
        </div>
        <hr>
        <form class="row mt-2 ml-2 mr-2">
            @csrf
            <div class="col-md-4">
                <p>Từ ngày: <input type="text" id="datepicker_tk1" class="form-control"></p>
                <input type="button" class="btn btn-primary" id="btn-statictical-filter" value="Lọc kết quả">
                <a href="{{ url('/statictical') }}" class="btn btn-warning" >Reset</a>
               
            </div>
            <div class="col-md-4">
                <p>Đến ngày: <input type="text" id="datepicker_tk2" class="form-control"></p>
            </div>
            <div class="col-md-4">
                <p>
                    Lọc theo:
                    <select class="statictical-filter form-control">
                        <option>---Chọn---</option>
                        <option value="7ngay">7 ngày qua</option>
                        <option value="thangtruoc">tháng trước</option>
                        <option value="thangnay">tháng này</option>
                        <option value="365ngayqua">365 ngày qua</option>
                    </select>
                </p>
                <a href="{{ url('/statistical-year') }}" class="btn btn-success" style="float: right;">Thống kê doanh
                    thu năm</a>
            </div>
            {{-- <div class="col-md-6">

                </div> --}}

        </form>
        {{-- <div class="row m-2 ml-3">
           
        </div> --}}
        <div class="col-md-12">
            <div id="myfirstchart" style="height: 250px;"></div>
        </div>
        
        {{-- <hr>
        
        <h5 style="margin-left: 20px;color: black" class="mt-3">Top món ăn bán chạy:</h5>

        <div class="row">
            @foreach ($product as $key => $pro)
 
                <div class="col-md-2 text-center m-3 ml-5"
                    style="border: 1px solid #fdf993;border-radius:5px;background-color: #ffffff; ">

                    <img class="mt-4" src="public/upload/product/{{ $pro->hinhanh }}" width="100%" height="200" />
                    <div class="mt-3" style="">
                        <p style="color: black;font-size: 20px;font-weight: bold">{{ $pro->ten }}</p>

                        <p style="color: black;font-size: 20x;;font-weight: bold">
                            {{ number_format($pro->gia) . ' ' . 'VNĐ' }}</p>
                    </div>
                </div>
            @endforeach

        </div> --}}
    </div>
@endsection
