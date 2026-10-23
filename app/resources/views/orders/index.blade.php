<x-layout>
    <h1>Danh sách đơn hàng</h1>

    <table border="1" cellpadding="8" style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày đặt</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $item)
                <tr>
                    <td>#{{ $item->id }}</td>
                    <td>{{ $item->user->name ?? 'Khách hàng' }}</td>
                    <td>{{ number_format($item->total ?? 0, 0, ',', '.') }}đ</td>
                    <td>{{ $item->status ?? 'Chưa cập nhật' }}</td>
                    <td>{{ $item->created_at?->format('d/m/Y H:i') ?? '—' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Chưa có đơn hàng nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-layout>