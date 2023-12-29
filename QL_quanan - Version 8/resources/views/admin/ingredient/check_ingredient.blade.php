@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Kiểm kho</h6>
        </div>

        <div class="card-body">

            <div class="table-responsive mt-2">
                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã nguyên liệu</th>
                            <th>Tên nguyên liệu</th>
                            <th>Số lượng</th>
                            <th>Số lượng thực tế</th>
                            <th>Chênh lệch</th>

                        </tr>
                    </thead>

                    <tbody class="check_ingredient">
                        <form method="POST" action="{{ url('/check-update-ingredient') }}">
                            @csrf
                            @foreach ($ingredient as $key => $item)
                                <tr>
                                    <td>{{ $item->nl_id }}</td>
                                    <td>{{ $item->nl_ten }}</td>
                                    <td>{{ $item->nl_slcl }} {{ $item->nl_dvt }}
                                    <input type="hidden" value="{{  $item->nl_slcl }}" name="slcl[]" class="slcl">
                                    </td>
                                    <td>
                                        <input type="hidden" value="{{$item->nl_id}}" name="nl_id[]">
                                        <input type="text" class="form-control sltt" value="0" name="sltt[]"  id="sltt">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control slchl" value="0" name="slchl[]" id="slchl">
                                    </td>

                                </tr>
                            @endforeach
                    </tbody>

                </table>
                <input type="submit" class="btn btn-primary" value="Cập nhật">
                <a href="{{ url('/all-input-receipt') }}" class="btn btn-warning">Trở về</a>
                </form>

            </div>
        </div>

    </div>
@endsection
