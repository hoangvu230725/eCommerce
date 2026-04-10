@extends('dashboard')

@section('content')
<div class="container mt-5">
    <h2>Thêm Sản Phẩm Mới</h2>
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" name="TenSanPham" value="{{ old('TenSanPham') }}">
            @error('TenSanPham') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea class="form-control" name="MoTa" rows="3">{{ old('MoTa') }}</textarea>
            @error('MoTa') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="number" class="form-control" name="Gia" value="{{ old('Gia') }}">
            @error('Gia') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Số lượng tồn</label>
            <input type="number" class="form-control" name="SoLuongTon" value="{{ old('SoLuongTon') }}">
            @error('SoLuongTon') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Số lượng bán</label>
            <input type="number" class="form-control" name="SoLuongBan" value="{{ old('SoLuongBan', 0) }}">
            @error('SoLuongBan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select class="form-select" name="MaDanhMuc">
                <option value="">-- Chọn danh mục --</option>
                @foreach($danhMucs as $dm)
                    <option value="{{ $dm->MaDanhMuc }}" {{ old('MaDanhMuc') == $dm->MaDanhMuc ? 'selected' : '' }}>
                        {{ $dm->TenDanhMuc }}
                    </option>
                @endforeach
            </select>
            @error('MaDanhMuc') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh sản phẩm</label>
            <input type="file" class="form-control" name="Anh">
            @error('Anh') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
        <a href="{{ route('product.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
