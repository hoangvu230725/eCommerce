@extends('dashboard')
<style>

.swiper-slide img {
    width: 100%;
    height: 100%;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(195, 203, 204, 0.2);
}

.swiper-container {
    width: 100%;
    height: 70%;
    margin: auto;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
}

.namestore {
    background-color: cadetblue;
    width: 100%;
    height: 300px;
    color: white;
    text-align: center;
    padding: 150px;
}


.product-section {
  text-align: center;
  margin: 40px 0;
  background-color: whitesmoke;
  height: auto;
  font-family: Arial, sans-serif;
  padding: 20px;
}

.product-section h2 {
  color: #2e3c59;
  font-size: 24px;
  margin-bottom: 20px;
}

.product-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 30px;
}

.product-item {
  text-align: center;
  width: 150px;
  position: relative;
}

.product-item img {
  width: 100%;
  height: auto;
  margin-bottom: 10px;
}

.new-label {
  background-color: #a6cf45;
  color: white;
  padding: 3px 8px;
  border-radius: 5px;
  position: absolute;
  top: -10px;
  left: 0;
  font-size: 12px;
}

.product-item p {
  margin: 5px 0;
  font-size: 14px;
}

.price {
  color: #84a90e;
  font-weight: bold;
  font-size: 16px;
}



.image-tt img {
    width: 100%;
    max-width: 500px;
    height: 200px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.content-tt {
    max-width: 500px;
    font-size: 1.1rem;
    line-height: 1.6;
}
</style>

@section('content')
<main>
    @if(count($thongbaos) > 0)
    <marquee behavior="scroll" direction="left" scrollamount="5" class="bg-warning text-dark py-2 px-3 rounded">
        @foreach($thongbaos as $tb)
        <strong>{{ $tb->TieuDe }}:</strong> {{ $tb->NoiDung }} &nbsp;&nbsp;&nbsp;
        @endforeach
    </marquee>
    @endif

    <!-- Swiper Banner -->

    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="image/bg1.jpg" alt="Ảnh 1"></div>
            <div class="swiper-slide"><img src="image/bg2.jpg" alt="Ảnh 2"></div>
            <div class="swiper-slide"><img src="image/bg3.jpg" alt="Ảnh 3"></div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

    <!-- Sản phẩm mới -->
    <div class="product-section mt-3 mb-5">
        <h2><b>Sản Phẩm Mới</b></h2>
        <div class="product-list row">
            @forelse($sanPhamMoi as $sanpham)
            <div class="product-item col">
                <span class="new-label">New</span>
                <img src="{{ asset('image/' . $sanpham->Anh) }}" alt="{{ $sanpham->TenSanPham }}">
                <a href="{{ route('product.detail', ['id' => $sanpham->MaSanPham]) }}">{{ $sanpham->TenSanPham }}</a>
                <p class="price">{{ number_format($sanpham->Gia, 0, ',', '.') }}₫</p>
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center">
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="masanpham" value="{{ $sanpham->MaSanPham }}">
                            <input type="hidden" name="so_luong" value="{{ $sanpham->so_luong }}">
                            <button class="btn btn-outline-dark mt-auto">Add to cart</button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <p>Không có sản phẩm mới nào để hiển thị.</p>
            @endforelse
        </div>
    </div>

  

    <!-- Chat hỗ trợ -->
    <a href="{{ route('chat.form') }}" class="btn btn-outline-primary position-fixed" style="bottom: 20px; right: 20px; z-index: 1000;">
        💬 Hỗ trợ khách hàng
        @if($soTinChuaDoc > 0)
        <span class="badge bg-danger">{{ $soTinChuaDoc }}</span>
        @endif
    </a>

    <script src="{{ asset('js/trangchu.js') }}"></script>
</main>
@endsection
