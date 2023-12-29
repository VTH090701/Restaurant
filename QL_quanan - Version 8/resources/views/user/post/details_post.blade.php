@extends('layout_user')
@section('user_content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Post</h5>
                <h1 class="mb-5">Chi tiết bài viết:</h1>
            </div>
            <div class="row">
                <h3 class="text-center">{{ $post->baiviet_tieude }}</h3>
            </div>
            <img src="/public/upload/post/{{ $post->baiviet_hinhanh }}"  style="
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 300px;
            ">
            <div class="row m-3">
                <p>{!! $post->baiviet_noidung !!}</p>
            </div>


        </div>
    </div>
@endsection
