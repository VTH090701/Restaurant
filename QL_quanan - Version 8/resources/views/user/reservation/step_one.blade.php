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
                        <div class="progress-bar w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0"
                            aria-valuemax="100">Step 1</div>
                    </div>
                    <form action="{{ url('/step-one') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Nhập họ tên"
                                        value="{{ $reservation->datban_ten ?? null }}" name="datban_ten">
                                    <label for="name">Họ Tên</label>
                                </div>
                                @error('datban_ten')
                                    <div class="text-sm " style="color: red">Tên người đặt không được để trống</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Nhập Email"
                                        value="{{ $reservation->datban_email ?? null }}" name="datban_email">
                                    <label for="email">Email</label>
                                </div>
                                @error('datban_email')
                                    <div class="text-sm " style="color: red">Email người đặt không được để trống</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="email"
                                        placeholder="Nhập số điện thoại" value="{{ $reservation->datban_sdt ?? null }}"
                                        name="datban_sdt">
                                    <label for="email">Số điện thoại</label>
                                </div>
                                @error('datban_sdt')
                                    <div class="text-sm " style="color: red">Số điện thoại người đặt không được để trống</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating date" id="date3" data-target-input="nearest">
                                    <input type="datetime-local" class="form-control "
                                        min="{{ $min_date->format('Y-m-d\TH:i:s') }}"
                                        max="{{ $max_date->format('Y-m-d\TH:i:s') }}"
                                        value="{{ $reservation ? Carbon\Carbon::parse($reservation->datban_thoigian)->format('Y-m-d\TH:i:s') : '' }}"
                                        name="datban_thoigian" />
                                    <label for="datetime">Thời gian</label>
                                </div>
                                <span class="text-xs" style="color: white">Vui lòng chọn thời gian trong khoảng từ 13:00 - 16:00 hoặc 17:00-21:00</span>
                                @error('datban_thoigian')
                                    <div class="text-sm " style="color: red">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="datban_slnguoi"
                                        value="{{ $reservation->datban_slnguoi ?? null }}" placeholder="Nhập số lượng người"
                                        name="datban_slnguoi">
                                    <label>Số lượng người</label>
                                </div>
                                @error('datban_slnguoi')
                                    <div class="text-sm " style="color: red">Số lượng người không được để trống</div>
                                @enderror
                            </div>
                            <input type="hidden" name="khachhang_id" id="khachhang_id" value="{{ Session::get('customer_id') }}">
                            <input type="hidden" value="0" name="datban_tinhtrang">
                            <input type="hidden" value="0" name="datban_kt">

                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Tiếp tục</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
