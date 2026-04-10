@extends('dashboardadmin')

@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i> Home</a></div>
        <h1>Kết Quả Tìm Kiếm <p>Từ khóa: <strong>{{ $keyword }}</strong></p>
        </h1>

    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">


                <div class="widget-box">
                    <div class="widget-title">
                        <h5>Kết Quả Tìm Kiếm Người dùng</h5>
                    </div>
                    <div class="widget-content">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên đăng nhập</th>
                                    <th>Email</th>
                                    <th>Vai trò</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($nguoiDung as $nguoi)
                                <tr>
                                    <td>{{ $nguoi->TenDangNhap }}</td>
                                    <td>{{ $nguoi->Email }}</td>
                                    <td>{{ $nguoi->VaiTro }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3">Không tìm thấy kết quả nào.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="widget-box">
                    <div class="widget-title">
                        <h5>Kết Quả Tìm Kiếm Hóa Đơn Theo Tên Khách Hàng</h5>
                    </div>
                    <div class="widget-content">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mã Đơn Hàng</th>
                                    <th>Tên Khách Hàng</th>
                                    <th>Ngày Đặt Hàng</th>
                                    <th>Tổng Tiền</th>
                                    <th>Trạng Thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($hoaDon as $donHang)
                                <tr>
                                    <td>{{ $donHang->MaDonHang }}</td>
                                    <td>{{ $donHang->nguoiDung->khachHang->HoTen ?? 'Không có thông tin' }}</td>
                                    <td>{{ $donHang->NgayDatHang }}</td>
                                    <td>{{ number_format($donHang->TongTien, 0, ',', '.') }} VND</td>
                                    <td>{{ $donHang->TrangThai }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">Không tìm thấy kết quả nào.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title">
                        <h5>Kết Quả Tìm Kiếm Mã Giảm Giá</h5>
                    </div>
                    <div class="widget-content">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th>Số Tiền Giảm</th>
                                    <th>Ngày Hết Hạn</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($maGiamGia as $item)
                                <tr>
                                    <td>{{ $item->Ma }}</td>
                                    <td>{{ number_format($item->SoTienGiam, 0, ',', '.') }} VND</td>
                                    <td>{{ $item->NgayHetHan }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3">Không tìm thấy kết quả nào.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="{{ route('admin.reports') }}" class="btn btn-primary">Quay Lại</a>
            </div>
        </div>
    </div>
</div>
@endsection