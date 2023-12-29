@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm thư viện ảnh</h6>
        </div>

        <div class="card-body">
            <form action="{{ url('/insert-gallery/' . $pro_id) }}" method="POST" enctype="multipart/form-data" class="mb-2">
                @csrf
                <div class="row">
                    <div class="col-md-3" align="right">

                    </div>
                    <div class="col-md-6">
                        <input type="file" class="form-control" id="file" name="file[]" accept="image/*"
                            multiple>
                        <span id="error_gallery">
                        </span>
                    </div>
                    <div class="col-md-3">
                        <input type="submit" name="upload" name="taianh" value="Tải ảnh"
                            class="btn btn-success btn-xs">
                    </div>
                </div>
            </form>
            <input type="hidden" value="{{ $pro_id }}" name="pro_id" class="pro_id">
            <div id="gallery_load">
                <form method="POST">
                    @csrf
                    <div id="gallery_load">

                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
