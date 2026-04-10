@extends('dashboardadmin')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i> Home</a></div>
        <h1>Hóa đơn</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><a href="#"> <i class="bi bi-receipt"></i>
                            </a></span>
                        <h5>Lịch sử hóa đơn</h5>
                    </div>
                    <table class="table table-bordered
                                    table-striped">
                        <thead>
                            <tr>

                                <th>Mã đơn hàng</th>
                                <th>Tên đăng nhập</th>
                                <th>Tên khách hàng</th>
                                <th>Ngày đặt hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($donHang as $hoaDon)
                            <tr class="">

                                <td>{{$hoaDon->MaDonHang}}</td>
                                <td>{{$hoaDon->nguoiDung->TenDangNhap}}</td>
                                <td>{{ $hoaDon->nguoiDung->khachHang->HoTen ?? 'Không có thông tin' }}</td>
                                <td>{{$hoaDon->NgayDatHang}}</td>
                                <td>{{ number_format($hoaDon->TongTien, 0, ',', '.') }} VND</td>
                                <td>{{$hoaDon->TrangThai}}</td>

                                <td class="text-center">
                                    <a href="{{ route('admin.detailInvoices', ['id' => $hoaDon->MaDonHang]) }}" class="btn btn-primary btn-mini">Chi Tiết</a>
                                    <form action="{{ route('admin.deleteInvoices', ['id' => $hoaDon->MaDonHang]) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-mini" onclick="return confirm('Bạn có chắc chắn muốn xóa hóa đơn này?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row" style="margin-left: 18px;">
                        <div class="page_list_clearfix  text-center">

                            {{ $donHang->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection