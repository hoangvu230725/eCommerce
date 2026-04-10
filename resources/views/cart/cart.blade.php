<!DOCTYPE html>
  <html lang="vi">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giỏ Hàng - Vivu Fashion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" rel="stylesheet">
    <style>
      .cart-item {
        background-color: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 20px;
        margin-bottom: 20px;
      }
      .cart-item img { border-radius: 12px; max-height: 80px; object-fit: cover; }
      .product-title { font-weight: 600; font-size: 1.1rem; }
      .price { font-weight: bold; color: #e74c3c; }
      .quantity-input input { width: 50px; text-align: center; border-radius: 8px; }
      .coupon-input { border: 1px solid #ddd; border-radius: 8px; padding: 6px 12px; margin-top: 12px; }
      .summary-box { border-top: 2px solid #eee; padding-top: 20px; margin-top: 30px; }
      .summary-box .btn { border-radius: 10px; padding: 10px 20px; }
      .namestore { text-align: center; padding: 20px; background-color: cadetblue; color:whitesmoke; }
      .namestore h1 { font-weight: bold; }
      .quantity-input { display: flex; justify-content: center; align-items: center; gap: 8px; }
      .cart{
        
        font-size: 1.5em;
        justify-items: center;
        font-family: 'Times New Roman', Times, serif;
   
        
        
      }
    </style>
  </head>
  <body>

    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{route('dashboard')}}"><img src="image/Vivu.jpg" width="70" height="70" alt="logo" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
        
          
          <div class="cart">
            
            <li class="nav-item dropdown">
              Giỏ Hàng
            </li>
          </div>
        
        </ul>
        
        
      </div>
    </div>
  </nav>

  
  <!-- Store Name -->
  <div class="namestore">
    <h1>Vivu Fashion</h1>
    <p>Nơi phong cách lên ngôi – Tự tin tỏa sáng!</p>
  </div>
  
  <!-- Shopping Cart -->
  <div class="container my-5">
    <h2 class="mb-4">Giỏ Hàng Của Bạn</h2>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
  
    @if(session('error'))
      <div class="alert alert-danger">
          {{ session('error') }}
      </div>
    @endif

    @foreach ($cartItems as $item)
      @php
        $subtotal = $item->gia * $item->SoLuong;
      @endphp
      <div class="cart-item row align-items-center">
        <div class="col-md-1 col-2">
          <input type="checkbox" class="form-check-input item-checkbox" data-price="{{ $subtotal }}">
        </div>
        <div class="col-md-2 col-3">
          <img src="{{ asset('image/' . $item->Anh) }}" class="img-fluid">
        </div>
        <div class="col-md-3 col-7">
          <div class="product-title">{{ $item->TenSanPham }}</div>
        </div>
        <div class="col-md-2 col-4 mt-2 mt-md-0">
          <div class="price">{{ number_format($item->gia, 0, ',', '.') }} VND</div>
        </div>
        <div class="col-md-2 col-5 mt-2 mt-md-0">
          <form action="{{ route('cart.update', ['MaGioHang' => $item->MaGioHang]) }}" method="POST" class="d-flex justify-content-center align-items-center gap-2 quantity-form">
            @csrf
            <button type="button" class="btn btn-light btn-decrease">-</button>
            <input name="quantity" class="form-control text-center quantity-input-field" value="{{ $item->SoLuong }}" min="1">
            <button type="button" class="btn btn-light btn-increase">+</button>
        </form>
        </div>
        <div class="col-md-2 col-3 mt-2 mt-md-0 text-end">
          <a href="{{ route('cart.remove', ['MaSanPham' => $item->MaSanPham]) }}" class="btn btn-danger btn-sm">Xóa</a>
        </div>
        
      </div>
    @endforeach

    <!-- Summary -->
    <div class="summary-box row align-items-center mt-5">
      <div class="col-md-6 mb-2">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="selectAll">
          <label class="form-check-label" for="selectAll">Chọn Tất Cả</label>
        </div>
      </div>

      <div class="col-md-3 text-end">
        <strong>Tổng Tiền:</strong>
        <span class="text-danger" id="total-price">0</span> VNĐ
      </div>

      <div class="col-md-3 text-end">
        <button id="buy-now-btn" class="btn btn-dark">Mua Hàng</button>
        
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="py-4 bg-dark text-white text-center">
    <div class="container">
      <p class="m-0">© Vivu Fashion 2025. All rights reserved.</p>
    </div>
  </footer>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script>
    document.querySelectorAll('.quantity-input-field').forEach(input => {
      input.addEventListener('change', function () {
        const form = this.closest('.quantity-form');
        if (form) form.submit();
      });
    });

    document.addEventListener("DOMContentLoaded", function () {
      const itemCheckboxes = document.querySelectorAll('.item-checkbox');
      const selectAll = document.getElementById('selectAll');
      const totalPriceElement = document.getElementById('total-price');
      const buyNowBtn = document.getElementById('buy-now-btn');

      function getTotal() {
        let total = 0;
        itemCheckboxes.forEach(checkbox => {
          if (checkbox.checked) {
            total += parseFloat(checkbox.dataset.price);
          }
        });
        return total;
      }

      function updateTotal() {
        const total = getTotal();
        totalPriceElement.textContent = total.toLocaleString('vi-VN');
      }

      itemCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
          updateTotal();
          selectAll.checked = [...itemCheckboxes].every(cb => cb.checked);
        });
      });

      selectAll.addEventListener('change', function () {
        itemCheckboxes.forEach(cb => cb.checked = this.checked);
        updateTotal();
      });
      if (buyNowBtn) {
    buyNowBtn.addEventListener('click', function () {
      const total = getTotal();
      if (total === 0) {

        Toastify({
          text: "Bạn Chưa Chọn Sản Phẩm, Vui Lòng Chọn Sản Phẩm!",
          duration: 3000, 
          close: true, 
          gravity: "top", 
          position: "center", 
          backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc3a0)"
        }).showToast();
      } else {
        window.location.href = "{{ route('cart.check') }}";
      }
    });
  }

      updateTotal();
    });

    document.addEventListener("DOMContentLoaded", function() {
  const quantityForms = document.querySelectorAll('.quantity-form');

  quantityForms.forEach(function(form) {
    const decreaseBtn = form.querySelector('.btn-decrease');
    const increaseBtn = form.querySelector('.btn-increase');
    const quantityInput = form.querySelector('.quantity-input-field');

    decreaseBtn.addEventListener('click', function() {
      let currentQuantity = parseInt(quantityInput.value) || 1;
      if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
        form.submit();
      }
    });

    increaseBtn.addEventListener('click', function() {
      let currentQuantity = parseInt(quantityInput.value) || 1;
      quantityInput.value = currentQuantity + 1;
      form.submit();
    });
  });
});
  </script>
  </body>
  </html>
