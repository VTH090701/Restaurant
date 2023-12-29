@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liệt kê doanh số bán hàng nhân viên</h6>
        </div>
        <div class="card-body">


            {{-- <form class="row mt-2 ml-2 mr-2">
                @csrf
                <div class="col-md-4">

                </div>
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <p>
                        Lọc theo:
                        <select class="year-filter form-control">

                            @foreach ($year as $key => $year)
                                <option value="{{ $year->year }}">{{ $year->year }}</option>
                            @endforeach


                        </select>
                    </p>
                </div>

            </form> --}}
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã nhân viên </th>
                                <th>Tên nhân viên </th>
                                <th>Tháng </th>
                                <th>Năm</th>
                                <th>Doanh số bán hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin as $key => $ad)
                                <tr>
                                    <td>{{ $ad->nv_id }}</td>
                                    <td>{{ $ad->nv_ten }}</td>      
                                    <td>{{ $ad->month }}</td>                                    
                                    <td>{{ $ad->year }}</td>
                                    <td>{{ number_format($ad->total ) . ' ' . 'VNĐ' }}</td>
                                  
                                   
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <a href="{{ url('/statictical-data') }}" class="btn btn-success ml-3">Trở lại</a>

            </div>
        </div>
    </div>
@endsection
