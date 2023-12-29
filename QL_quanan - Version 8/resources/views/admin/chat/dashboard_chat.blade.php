@extends('layout')
@section('admin_content')
    <link href="{{ asset('/backend/css/chat.css') }}" rel="stylesheet">

    {{-- <div class="container-fluid"> --}}
    <div class="row">
        <div class="col-md-4">
            <div class="user-wrapper">

                <ul class="users">
                    @foreach ($users as $user)
                        <li class="user" id="{{ $user->nv_id }}">

                            @if ($user->unread)
                                <span class="pending" >{{ $user->unread }}
                                </span>
                            @endif

                            {{-- <span class="pending">{{$user->unread}}
                                1</span> --}}
                            <div class="media">
                                <div class="media-left">
                                    <img src="public/upload/hoso_nv/{{ $user->nv_hinhanh }}" alt=""
                                        class="media-object" >
                                </div>
                                <div class="media-body">
                                    <p class="name"></p>{{ $user->nv_ten }}</p>
                                    <p class="email">{{ $user->nv_email }}</p>

                                </div>
                            </div>

                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
        <div class="col-md-8" id="messages">

        </div>
    </div>
    {{-- </div> --}}
@endsection
