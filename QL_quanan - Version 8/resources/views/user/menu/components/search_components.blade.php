    <div class="row g-4">
        @foreach ($product as $item1)
            <div class="col-lg-6">
                <a href="{{ url('/menu/' . $item1->ma_id) }}">
                    <div class="d-flex align-items-center">
                        <div class="img-product">
                            <img class="flex-shrink-0 img-fluid rounded"
                                src="public/upload/product/{{ $item1->ma_hinhanh }}" alt=""
                                width="100" height="100">
                        </div>
                        <div class="w-100 d-flex flex-column text-start ps-4">
                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                <span>{{ $item1->ma_ten }}</span>
                                <span
                                    class="text-primary">{{ number_format($item1->ma_gia) . ' ' . 'VNĐ' }}</span>
                            </h5>
                            <small class="fst-italic">{{ $item1->ma_ten }}</small>
                        </div>
                    </div>
                </a>

            </div>
        @endforeach
    </div>
