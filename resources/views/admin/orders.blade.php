@extends('dashboardadmin')

@section('content')
<div id="content">
    <h2>Danh sách đơn hàng</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Người đặt</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày đặt</th>
                <th>Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->MaDonHang }}</td>
                <td>{{ $order->nguoiDung->khachHang->HoTen ?? 'Không rõ' }}</td>
                <td>{{ number_format($order->TongTien, 0, ',', '.') }} đ</td>
                <td>
                    <form action="{{ route('admin.orders.update', $order->MaDonHang) }}" method="POST" class="d-flex">
                        @csrf
                        @method('PUT')
                        <select name="TrangThai" class="form-select form-select-sm me-2">
                            <option value="Đang xử lý" {{ $order->TrangThai == 'Đang xử lý' ? 'selected' : '' }}>Đang xử
                                lý</option>
                            <option value="Đã giao hàng" {{ $order->TrangThai == 'Đã giao hàng' ? 'selected' : '' }}>Đã
                                giao
                                hàng
                            </option>
                            <option value="Đã hủy" {{ $order->TrangThai == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
                    </form>
                </td>
                <td>{{ \Carbon\Carbon::parse($order->NgayDatHang)->format('d/m/Y H:i') }}</td>
                <td>
                    {{-- Nút chi tiết --}}
                    <a href="{{ route('admin.orders.show', $order->MaDonHang) }}" class="btn btn-info btn-sm me-1">Chi
                        tiết</a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    <div class="row" style="margin-left: 18px;">
        <div class="page_list_clearfix  text-center">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection