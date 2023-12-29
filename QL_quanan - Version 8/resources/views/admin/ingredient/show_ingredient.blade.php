@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Tồn kho</h6>
        </div>

        <div class="card-body">
          
            <div class="row">

                <div class="col-md-7" style="display: flex">
                    <p style="margin-left:5px; font-size: 20px"><i class="fa fa-circle" aria-hidden="true"
                            style="color: red;font-size: 20px"></i> : gần hết hàng</p>
                    <p style="margin-left:5px; font-size: 20px"><i class="fa fa-circle" aria-hidden="true"
                            style="color: grey;font-size: 20px"></i> : còn hàng</p>
                    
                </div>

                <div class="col-md-5">
                    
                    {{-- <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small input-search-ajax"
                            placeholder="Tìm kiếm..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div> --}}
                    <div class="row">
                        <a class="btn btn-primary" style="margin-left: auto" href="{{ url('/check-ingredient') }}">
                            <i class="fa fa-sign-in" aria-hidden="true"> Kiểm kho</i>
                        </a>
                    </div>
                    
                </div>

            </div>
            <div class="table-responsive mt-2">
                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã nguyên liệu</th>
                            <th>Tên nguyên liệu</th>
                            <th>Số lượng</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($ingredient as $key => $item)
                            @if ($item->nl_slcl < 1)
                                <tr style="color:red">
                                    <td>{{ $item->nl_id }}</td>
                                    <td>{{ $item->nl_ten }}</td>
                                    <td>{{ $item->nl_slcl }} {{ $item->nl_dvt }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td>{{ $item->nl_id }}</td>
                                    <td>{{ $item->nl_ten }}</td>
                                    <td>{{ $item->nl_slcl }} {{ $item->nl_dvt }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    {{-- <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Nguyên liệu đã được sử dụng / xuất kho</h6>
        </div>

        <div class="card-body">

            <div class="row">
               
                <div class="col-md-7" style="display: flex">
                   
                </div>

                <div class="col-md-5">
                    
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

            </div>
            <div class="table-responsive mt-2">
                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã nguyên liệu</th>
                            <th>Tên nguyên liệu</th>
                            <th>Số lượng</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($ingredient as $key => $item)
                          
                                <tr>
                                    <td>{{ $item->nl_id }}</td>
                                    <td>{{ $item->nl_ten }}</td>
                                    <td>{{ $item->nl_slsd }} {{ $item->nl_dvt }}</td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        
    </div> --}}
@endsection
