@extends('dashboard')

@section('content')
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h2>Quản lí <b>Sản Phẩm</b></h2>
                    </div>
                    <div class="col-md-6 text-end">
                    <a class="btn btn-success" href="{{ route('product.create') }}">
                        <i class="bi bi-pencil"></i> <span>Thêm Sản Phẩm</span>
                    </a>

                    </div>
                </div>
                <form action="{{ route('product.index') }}" method="GET" class="row g-2 mb-3">
                    <div class="col-md-4">
                        <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm..." value="{{ request('keyword') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Tìm kiếm
                        </button>
                    </div>
                </form>

            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Mã Sản Phẩm</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Ảnh</th>
                        <th>Giá</th>
                        <th>Số Lượng Tồn</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->MaSanPham }}</td>
                        <td>{{ $product->TenSanPham }}</td>
                        <td><img src="{{ asset('image/'.$product->Anh) }}" alt="{{ $product->TenSanPham }}" width="50"></td>
                        <td>{{ number_format($product->Gia, 0, ',', '.') }} VND</td>
                        <td>{{ $product->SoLuongTon }}</td>
                        <td>
                         <!-- Edit Product -->
<a href="{{ route('product.edit', $product->MaSanPham) }}"><i class="bi bi-pencil"></i></a>


                            <!-- Delete Product -->
                            <form action="{{ route('product.destroy', $product->MaSanPham) }}" method="POST" style="display:inline;" id="delete-form-{{ $product->MaSanPham }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $product->MaSanPham }})">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Phân trang -->
        <div class="d-flex justify-content-center mt-4">
            {!! $products->links('pagination::bootstrap-5') !!}
        </div>
        @if($products->isEmpty())
            <p>Không có sản phẩm nào phù hợp với từ khóa tìm kiếm của bạn.</p>
        @endif
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('crud.index') }}" class="btn btn-outline-secondary btn-lg">
                <i class="bi bi-arrow-left-circle me-2"></i> Quay lại
            </a>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    function confirmDelete(productId) {
        if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
            document.getElementById('delete-form-' + productId).submit();
        }
    }
</script>
@endsection
@yield('scripts')
