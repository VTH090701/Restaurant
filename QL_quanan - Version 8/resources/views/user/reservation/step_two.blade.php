@extends('layout_user')
@section('user_content')
    <!-- Reservation Start -->
    <div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
        <div class="row g-0">
            <div class="col-md-6">
                <div class="video">
                    {{-- <button type="button" class="btn-play" data-bs-toggle="modal"
                        data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                        <span></span>
                    </button> --}}
                </div>
            </div>
            <div class="col-md-6 bg-dark d-flex align-items-center">
                <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                    <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
                    <h1 class="text-white mb-4">Đặt bàn Online</h1>
                    <div class="progress m-3">
                        <div class="progress-bar w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                            aria-valuemax="100">Step 2</div>
                    </div>
                    {{-- <form action="{{url('/step-two')}}" method="POST" > --}}
                    <form method="POST">    
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select id="ban_id" name="ban_id" class="form-control ban_id">
                                        @foreach ($table as $key => $tab)
                                            <option value="{{ $tab->ban_id }}">{{ $tab->ban_ten }} ({{ $tab->ban_slnguoi }}
                                                người)</option>
                                        @endforeach
                                    </select>
                                    <label>Bàn:</label>
                                </div>
                            </div>


                            <div class="col-6">
                                {{-- <button class="btn btn-primary w-100 py-3" type="submit">Trở lại bước đầu</button> --}}
                                <a class="btn btn-primary w-100 py-3" href="{{ url('/step-one') }}">Trở lại bước đầu</a>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary w-100 py-3 send_reservation" type="submit">Đặt ngây bây
                                    giờ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
