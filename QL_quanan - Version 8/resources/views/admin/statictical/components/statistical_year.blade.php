<div class="table-responsive">
    <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Tháng </th>
                <th>Năm </th>
                <th>Doanh thu</th>
                <th>Tăng trưởng</th>
                <th>Chi phí</th>
                <th>Lợi nhuận</th>
                <th>Số lượng món ăn bán</th>
                <th>Tổng hóa đơn</th>
                {{-- <th></th> --}}
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            <tr>
                <td>{{ $statistical_year[0]->month }}</td>
                <td>{{ $statistical_year[0]->year }}</td>
                <td>{{ number_format($statistical_year[0]->dt) . ' ' . 'VNĐ' }}</td>
                <td class="text-center">
                    <a href="#" class="badge badge-primary">0%</a>
                </td>
                <td>{{ number_format($statistical_year[0]->cp) . ' ' . 'VNĐ' }}</td>
                <td>{{ number_format($statistical_year[0]->dt - $statistical_year[0]->cp) . ' ' . 'VNĐ' }}
                </td>
                <td>{{ $statistical_year[0]->sl }}</td>
                <td>{{ $statistical_year[0]->thd }}</td>
            </tr>
            @foreach ($statistical_year as $key => $sta)
                @foreach ($statistical_year as $key => $sta1)
                    @if ($sta->month == $sta1->month - 1)
                        <tr>
                            <td>{{ $sta1->month }}</td>
                            <td>{{ $sta1->year }}</td>
                            <td>{{ number_format($sta1->dt) . ' ' . 'VNĐ' }}</td>
                            <td class="text-center">
                                <a href="#" class="badge badge-primary">

                                    {{ round((($sta1->dt - $sta->dt) / $sta->dt) * 100, 2) }}
                                    %</a>
                            </td>

                            <td>{{ number_format($sta1->cp) . ' ' . 'VNĐ' }}</td>
                            <td>{{ number_format($sta1->dt - $sta1->cp) . ' ' . 'VNĐ' }}</td>
                            <td>{{ $sta1->sl }}</td>
                            <td>{{ $sta1->thd }}</td>
                            {{-- <td>
                        <form action="{{ url('/details-statistical-month') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $sta->month }}" name="month">
                            <input type="hidden" value="{{ $sta->year }}" name="year">

                            <input type="submit" value="Chi tiết" class="btn btn-sm btn-success">
                        </form>
                            </td> --}}
                        </tr>
                    @endif
                @endforeach
            @endforeach

        </tbody>
    </table>
</div>
