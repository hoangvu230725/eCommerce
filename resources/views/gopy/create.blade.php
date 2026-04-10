@extends('dashboard')
@section('content')
<div class="container mt-4">
    <h4>Thêm góp ý mới</h4>
    <form action="{{ route('gopy.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email của bạn</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tieude" class="form-label">Tiêu đề</label>
            <input type="text" name="tieude" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="noidung" class="form-label">Nội dung</label>
            <textarea name="noidung" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Gửi góp ý</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Quay lại</a>
    </form>

</div>
@endsection