@extends('dashboardadmin')

@section('content')
<div id="content">
    <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i> Home</a></div>
        <h1>Chi Tiết Đơn Hàng</h1>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <h5>Thông Tin Đơn Hàng</h5>
                    </div>
                    <div class="widget-content">
                        <table class="table table-bordered">
                            <tr>
                                <th>Mã Đơn Hàng:</th>
                                <td>{{ $donHang->MaDonHang }}</td>
                            </tr>
                            <tr>
                                <th>Khách Hàng:</th>
                                <td>{{ $donHang->nguoiDung->khachHang->HoTen ?? 'Không có thông tin' }}</td>
                            </tr>
                            <tr>
                                <th>Nhân viên:</th>
                                <td>{{ $donHang->nguoiDung->nhanVien->HoTen ?? 'Không có thông tin' }}</td>
                            </tr>
                            <tr>
                                <th>Ngày Đặt Hàng:</th>
                                <td>{{ $donHang->NgayDatHang }}</td>
                            </tr>
                            <tr>
                                <th>Tổng Tiền:</th>
                                <td>{{ number_format($donHang->TongTien, 0, ',', '.') }} VND</td>
                            </tr>
                            <tr>
                                <th>Trạng Thái:</th>
                                <td>{{ $donHang->TrangThai }}</td>
                            </tr>
                            <tr>
                                <th>Mã Giảm Giá:</th>
                                <td>{{ $donHang->maGiamGia->Ma ?? 'Không sử dụng'}}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="widget-box">
                    <div class="widget-title">
                        <h5>Chi Tiết Sản Phẩm</h5>
                    </div>
                    <div class="widget-content">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Số Lượng</th>
                                    <th>Giá</th>
                                    <th>Thành Tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($donHang->chiTietDonHangs as $chiTiet)
                                <tr>
                                    <td>{{ $chiTiet->sanPham->TenSanPham }}</td>
                                    <td>{{ $chiTiet->SoLuong }}</td>
                                    <td>{{ number_format($chiTiet->Gia, 0, ',', '.') }} VND</td>
                                    <td>{{ number_format($chiTiet->SoLuong * $chiTiet->Gia, 0, ',', '.') }} VND</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <a href="{{ route('admin.invoices') }}" class="btn btn-primary">Quay Lại</a>
            </div>
        </div>
    </div>
</div>
@endsection