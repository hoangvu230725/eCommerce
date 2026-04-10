@extends('dashboard')

@section('content')
<section class="py-5">
    <div class="container">
        <h2 class="mb-4">Chỉnh sửa Danh Mục</h2>
        <form action="{{ route('category.update', $category->MaDanhMuc) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="TenDanhMuc" class="form-label">Tên Danh Mục</label>
                <input type="text" class="form-control" id="TenDanhMuc" name="TenDanhMuc" value="{{ $category->TenDanhMuc }}" required>
            </div>

            <div class="mb-3">
                <label for="MoTa" class="form-label">Mô tả</label>
                <textarea class="form-control" id="MoTa" name="MoTa" rows="3">{{ $category->MoTa }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('category.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</section>
@endsection
