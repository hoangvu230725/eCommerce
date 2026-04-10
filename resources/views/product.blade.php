@extends('dashboard')

@section('content')
<main>
<section class="py-5">
    <div class="text-center mb-4"><h1>Danh sách sản phẩm</h1></div>

    <div class="container px-4 px-lg-5 mt-5 text-center">
    <form action="{{ url()->current() }}" method="GET" class="row mb-4 g-2">
    <div class="col-md-3">
        <input type="number" name="min_price" class="form-control" placeholder="Giá thấp nhất" value="{{ request('min_price') }}">
    </div>
    <div class="col-md-3">
        <input type="number" name="max_price" class="form-control" placeholder="Giá cao nhất" value="{{ request('max_price') }}">
    </div>
    <div class="col-md-3">
        <select name="sort_price" class="form-select">
            <option value="">-- Sắp xếp giá --</option>
            <option value="asc" {{ request('sort_price') == 'asc' ? 'selected' : '' }}>Thấp đến cao</option>
            <option value="desc" {{ request('sort_price') == 'desc' ? 'selected' : '' }}>Cao đến thấp</option>
        </select>
    </div>
    <div class="col-md-3">
        <button type="submit" class="btn btn-primary w-100">Lọc</button>
    </div>
</form>



        <div class="row justify-content-center">

            @foreach ($sanPhams as $sp)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-5 d-flex align-items-stretch">
                <div class="card h-100 w-100">
                    @if($sp->GiaKhuyenMai < $sp->Gia)
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                    @endif
                    <img class="card-img-top" src="{{ asset('image/' . $sp->Anh) }}" height="200px" alt="{{ $sp->TenSanPham }}" />
                    <div class="card-body p-4">
                        <div class="text-center">
                            <a href="{{ route('product.detail', ['id' => $sp->MaSanPham]) }}">
                                <h5 class="fw-bolder">{{ $sp->TenSanPham }}</h5>
                            </a>
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            {{ number_format($sp->Gia, 0, ',', '.') }} VND
                        </div>
                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                        <form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <input type="hidden" name="masanpham" value="{{ $sp->MaSanPham }}">
    <input type="hidden" name="so_luong" value="1">
    <button class="btn btn-outline-dark mt-auto">Add to cart</button>
</form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Phân trang -->
        <div class="d-flex justify-content-center mt-4">
            {!! $sanPhams->links('pagination::bootstrap-5') !!}
        </div>

        @if($sanPhams->isEmpty())
            <p>Không có sản phẩm nào phù hợp với từ khóa hoặc bộ lọc giá.</p>
        @endif
    </div>
</section>
</main>
@endsection