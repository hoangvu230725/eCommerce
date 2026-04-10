@extends('dashboard')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Trang Quản Trị</h2>
            <p class="text-muted">Chọn chức năng bạn muốn quản lý</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <a href="{{ route('product.index') }}" class="btn btn-outline-primary btn-lg w-100 shadow rounded-4 py-3">
                    <i class="bi bi-box-seam me-2 fs-5"></i> Quản Lí Sản Phẩm
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('category.index') }}" class="btn btn-outline-success btn-lg w-100 shadow rounded-4 py-3">
                    <i class="bi bi-tags me-2 fs-5"></i> Quản Lí Danh Mục
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
