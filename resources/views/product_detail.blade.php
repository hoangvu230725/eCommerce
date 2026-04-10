@extends('dashboard')

@section('content')
<main class="container py-5">
    <div class="row">
        <div class="col-md-6 text-center">
            <img src="{{ asset('image/' . $sanpham->Anh) }}" class="img-fluid" alt="{{ $sanpham->TenSanPham }}" style="max-height: 400px;">
        </div>
        <div class="col-md-6">
            <h2>{{ $sanpham->TenSanPham }}</h2>
        
                <p class="fw-bold">{{ number_format($sanpham->Gia, 0, ',', '.') }}₫</p>
         

            <p><strong>Mô tả:</strong> {{ $sanpham->MoTa ?? 'Đang cập nhật...' }}</p>

            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <form action="{{route('cart.add')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="masanpham" value="{{$sanpham ->MaSanPham}}">
                                            <input type="hidden" name="so_luong" value="{{$sanpham ->so_luong}}">
                                           <button class="btn btn-outline-dark mt-auto"> Add to cart</button>
                                        </form>
                                        </div>
                                </div>
        </div>
    </div>
    <hr class="my-5">

<div class="container">
    <h4 class="mb-4">Sản phẩm gợi ý</h4>
    <div class="row">
        @foreach ($goiY as $item)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <a href="{{ route('product.detail', ['id' => $item->MaSanPham]) }}">
                        <img src="{{ asset('image/' . $item->Anh) }}" class="card-img-top" alt="{{ $item->TenSanPham }}" style="height: 200px; object-fit: cover;">
                    </a>
                    <div class="card-body text-center">
                        <h6 class="card-title">{{ $item->TenSanPham }}</h6>
                        <p class="text-danger fw-bold">{{ number_format($item->Gia, 0, ',', '.') }}₫</p>
                        <a href="{{ route('product.detail', ['id' => $item->MaSanPham]) }}" class="btn btn-sm btn-outline-dark">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

</main>
@endsection
