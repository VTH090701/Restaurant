    <thead>
        <tr>
            <th>Mã hóa đơn</th>
            <th>Tổng tiền</th>
            <th>Bàn</th>
            <th>Nhân viên</th>
            <th>Khách hàng</th>
            <th>Tình trạng</th>
            <th>Thời gian</th>
            <th>Quản lý</th>
        </tr>
    </thead>
   
    <tbody>
        @foreach ($result as $key => $ord)
            <tr>
                <td>{{ $ord['hoadon_id'] }}</td>
                <td>{{ number_format($ord['hoadon_tongtien']) . ' ' . 'VNĐ' }}</td>
                <td>{{ $ord['ban_ten'] }}</td>
                <td>{{ $ord['khachhang_ten'] }}</td>
                <td>{{ $ord['admin_name'] }}</td>
                <td>
                    @if($ord['hoadon_tinhtrang'] == 0)
                    Chưa thanh toán
                    @else
                    Đã thanh toán
                    @endif
                </td>

                <td>{{ $ord['created_at'] }}</td>
                <td>
                    <a href="{{ url('/details-ordtomer/' . $ord['hoadon_id']) }}" style="text-decoration: none;">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                        </i>
                    </a>
                    | <a href="{{ url('/delete-ordtomer/' . $ord['hoadon_id']) }}">
                        <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i>

                    </a>
                </td>
            </tr>
        @endforeach

    </tbody>
 
