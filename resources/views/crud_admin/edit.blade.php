@extends('dashboard')

@section('content')
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="table-wrapper">
            <div class="table-title">
                <h2>Chỉnh sửa <b>Sản Phẩm</b></h2>
            </div>

            <form action="{{ route('product.update', $product->MaSanPham) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="TenSanPham" class="form-label">Tên Sản Phẩm</label>
                    <input type="text" class="form-control" id="TenSanPham" name="TenSanPham" value="{{ old('TenSanPham', $product->TenSanPham) }}" required>
                </div>
                <div class="mb-3">
                    <label for="MoTa" class="form-label">Mô Tả</label>
                    <textarea class="form-control" id="MoTa" name="MoTa">{{ old('MoTa', $product->MoTa) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="Gia" class="form-label">Giá</label>
                    <input type="number" class="form-control" id="Gia" name="Gia" value="{{ old('Gia', $product->Gia) }}" required>
                </div>
                <div class="mb-3">
                    <label for="SoLuongTon" class="form-label">Số Lượng Tồn</label>
                    <input type="number" class="form-control" id="SoLuongTon" name="SoLuongTon" value="{{ old('SoLuongTon', $product->SoLuongTon) }}" required>
                </div>
                <div class="mb-3">
                    <label for="SoLuongBan" class="form-label">Số Lượng Bán</label>
                    <input type="number" class="form-control" id="SoLuongBan" name="SoLuongBan" value="{{ old('SoLuongBan', $product->SoLuongBan) }}">
                </div>
                <div class="mb-3">
                    <label for="MaDanhMuc" class="form-label">Danh Mục</label>
                    <select class="form-select" id="MaDanhMuc" name="MaDanhMuc" required>
                        @foreach($danhMucs as $danhMuc)
                            <option value="{{ $danhMuc->MaDanhMuc }}" {{ $product->MaDanhMuc == $danhMuc->MaDanhMuc ? 'selected' : '' }}>
                                {{ $danhMuc->TenDanhMuc }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Anh" class="form-label">Ảnh Sản Phẩm</label>
                    <input type="file" class="form-control" id="Anh" name="Anh">
                    @if($product->Anh)
                        <img src="{{ asset('image/'.$product->Anh) }}" alt="{{ $product->TenSanPham }}" width="100">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật Sản Phẩm</button>
            </form>
        </div>
    </div>
</section>
@endsection
