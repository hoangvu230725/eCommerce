@extends('dashboardadmin')

@section('content')
<div id="content">
    <h3>Chi tiết đơn hàng #{{ $order->MaDonHang }}</h3>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->chiTietDonHangs as $item)
            <tr>
                <td>{{ $item->sanPham->TenSanPham ?? 'Không rõ' }}</td>
                <td>{{ $item->SoLuong }}</td>
                <td>{{ number_format($item->Gia, 0, ',', '.') }} đ</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.orders') }}" class="btn btn-secondary">Quay lại</a>
</div>
@endsection