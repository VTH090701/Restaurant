@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liệt kê số lượng nguyên liệu gần hết </h6>
        </div>
        <div class="card-body">


            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tên nguyên liệu</th>
                                <th>Số lượng </th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ingredient as $key => $in)
                                <tr>
                                    <td>{{ $in->nl_ten }}</td>
                                    <td>{{ $in->nl_slcl }} {{$in->nl_dvt}}</td>      
                                   
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
