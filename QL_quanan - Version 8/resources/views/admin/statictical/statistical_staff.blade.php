@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liệt kê doanh thu nhân viên</h6>
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
            <div class="statistical-list">
                <div class="table-responsive">
                    <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã nhân viên </th>
                                <th>Tên nhân viên </th>
                                <th>Email </th>
                                <th>Số điện thoại</th>
                                <th>Doanh thu tháng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($statistical_staff as $key => $sta)
                                <tr>
                                    <td>{{ $sta->id }}</td>
                                    <td>{{ $sta->ten }}</td>
                                    <td>{{ $sta->email }}</td>
                                    <td>{{ $sta->phone }}</td>

                                    <td>{{ number_format($sta->tongdt ) . ' ' . 'VNĐ' }}</td>
                                  
                                   
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
