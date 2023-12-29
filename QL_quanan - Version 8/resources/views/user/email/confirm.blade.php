<h3>Xin chào {{$reservation->datban_ten}}</h3>
<p>
    Cảm ơn ông đã sử dụng dịch vụ của cửa hàng ăn uống chúng tôi – Cửa hàng ăn uống TH.
    Chúng tôi rất hân hạnh xác nhận rằng chúng tôi đã đặt 1 bàn cho {{$reservation->datban_slnguoi }} người vào lúc  {{Carbon\Carbon::parse($reservation->datban_thoigian)->format('H:i:s')}} giờ ngày {{Carbon\Carbon::parse($reservation->datban_date)->format('Y-m-d')}}.
    Lưu ý khi đến cửa hàng bạn cần đọc thông tin của bạn hoặc mã đặt bàn là {{$reservation->datban_id}} để nhân viên có thể hỗ trợ bạn kịp thời!
</p>
<p>Chúng tôi mong đợi chuyến thăm của bạn đến cửa hàng ăn uống của chúng tôi.</p>
<p>
    Chân trọng.
    Cửa hàng ăn uống TH.
</p>