@foreach ($product as $key => $pro)
    <div class="menu">
        <ul>
            <li>
                <a href="#" class="add_to_cart_again" data-url="{{ route('addToCartgain', ['id' => $pro->ma_id]) }}">
                    <div class="img-product1">
                        <img src="public/upload/product/{{ $pro->ma_hinhanh }}" width="100" height="100">
                    </div>
                    <div class="product-info1">
                        <span class="product-name1">{{ $pro->ma_ten }}</span><br>
                        <strong>{{ number_format($pro->ma_gia) . ' ' . 'VNĐ' }}</strong>
                    </div>
                </a>
            </li>
        </ul>
    </div>
@endforeach
<script type="text/javascript">
    function addTocartagain(event) {
        event.preventDefault();
        let urlCart = $(this).data('url');
        $.ajax({
            type: "GET",
            url: urlCart,
            dataType: 'json',
            success: function(data) {
                if (data.code == 200) {
                    $('#table-responsive1').html(data.cart_components1);
                }
            },
            error: function() {

            }

        });
    }
    $(function() {
        $('.add_to_cart_again').on('click', addTocartagain);

    });
</script>
