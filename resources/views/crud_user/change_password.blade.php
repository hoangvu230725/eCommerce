@extends('dashboard')

@section('content')
<div class="container mt-5 mb-5">
    <h3>Đổi Mật Khẩu</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('change.password.post') }}">
        @csrf

        <div class="mb-3">
            <label>Mật khẩu cũ</label>
            <input type="password" name="MatKhauCu" class="form-control" required maxlength="50">
            @error('MatKhauCu') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Mật khẩu mới</label>
            <input type="password" name="MatKhauMoi" class="form-control" required maxlength="50">
            @error('MatKhauMoi') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Nhập lại mật khẩu mới</label>
            <input type="password" name="MatKhauMoi_confirmation" class="form-control" required maxlength="50">
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
    </form>
</div>
@endsection
