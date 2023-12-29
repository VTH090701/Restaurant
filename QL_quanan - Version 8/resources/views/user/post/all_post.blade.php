@extends('layout_user')
@section('user_content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Post</h5>
                <h1 class="mb-5">Các bài viết:</h1>
            </div>
            @foreach ($post as $po)
                <a href="{{ url('/details-post/' . $po->baiviet_id) }}">
                    <div class="row g-4">
                        <div class="col-lg-4 text-center">
                            <img src="public/upload/post/{{ $po->baiviet_hinhanh }}" width="60%">
                        </div>
                        <div class="col-lg-8">
                            <h3>{{ $po->baiviet_tieude }}</h3>
                            <p>{!! $po->baiviet_tomtat !!}</p>
                        </div>

                    </div>
                </a>
                
            @endforeach

        </div>
    </div>
@endsection
