@extends('dashboard') {{-- Thay bằng layout thật sự bạn đang dùng --}}

@section('content')
<div class="container mt-5 mb-5">
    <h2>Thông Tin Khách Hàng</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $nguoiDung->MaNguoiDung }}</p>
            <p><strong>Tên đăng nhập:</strong> {{ $nguoiDung->TenDangNhap }}</p>
            <p><strong>Email:</strong> {{ $nguoiDung->Email }}</p>
            <p><strong>Vai trò:</strong> {{ $nguoiDung->VaiTro }}</p>
         

            <a href="{{ route('change.password') }}" class="btn btn-primary mt-3">Đổi mật khẩu</a>
        </div>
    </div>
</div>
@endsection
