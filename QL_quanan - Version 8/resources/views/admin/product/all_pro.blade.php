@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liệt kê sản phẩm</h6>
        </div>
 
        <div class="card-body">
            <div class="row">
                <a class="btn btn-primary" style="margin-left: auto" href="{{route('product.create')}}">
                    <i class="fa fa-sign-in" aria-hidden="true"> Thêm món ăn</i>
                </a>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-bordered myTablepro" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã món ăn</th>
                            <th>Tên món ăn</th>
                            <th>Hình ảnh</th>
                            <th>Thư viện ảnh</th>
                            <th>Danh mục</th>
                            <th>Giá</th>
                            <th>Tình trạng</th>
                            <th>Quản lý</th>
                        </tr>
                    </thead>
                 
                    {{-- <tbody>
                        @foreach ($all_product as $key => $pro)
                            <tr>
                                <td>{{ $pro->sp_ten }}</td>
                                <td><img src="public/upload/product/{{ $pro->sp_hinhanh }}" width="100" height="100">
                                </td>
                                <td>{{ $pro->danhmuc_ten }}</td>
                                <td>{{ number_format($pro->sp_gia) . ' ' . 'VNĐ' }}</td>
                                <td>

                                    <?php
                                   if($pro->sp_tinhtrang == 0){
                                    ?>
                                    <a href="{{ url('/active-product/' . $pro->sp_id) }}"><span
                                            class="fa-thumb-styling fa fa-thumbs-down"
                                            style="font-size: 18pt;color: red"></span></a>
                                    <?php    
                                    }else{
                                    ?>
                                    <a href="{{ url('/unactive-product/' . $pro->sp_id) }}"><span
                                            class="fa-thumb-styling fa fa-thumbs-up" style="font-size: 18pt"></span></a>

                                    <?php
                                    }
                                    ?>
                           
                                </td>
                               
                                <td>
                                    <a href="{{ url('/edit-product/' . $pro->sp_id) }}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i>
                                    </a>
                                    | <a href="{{ url('/delete-product/' . $pro->sp_id) }}">
                                        <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i>

                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>
@endsection
