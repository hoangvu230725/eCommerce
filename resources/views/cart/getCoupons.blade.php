<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Thanh Toán - Vivu Fashion</title>
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Poppins', sans-serif;
      display: flex;
      flex-direction: column;
      min-height: 100vh; 
    }

    .navbar-brand img {
      border-radius: 8px;
    }

    .navbar .cart {
      font-size: 1.25rem;
      font-weight: 600;
      color: #a50064;
    }

    .payment-form {
      background-color: #ffffff;
      border-radius: 16px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
      padding: 40px;
      max-width: 600px;
      margin: 60px auto;
      text-align: center;
    }

    .payment-form img {
      width: 100px;
      margin-bottom: 20px;
    }

    .payment-form span {
      font-size: 22px;
      color: #d32f2f;
      font-weight: 600;
      margin-bottom: 25px;
      display: block;
    }

    .btn-momo {
      background: #a50064;
      color: white;
      border: none;
      padding: 14px 30px;
      font-size: 16px;
      font-weight: 600;
      border-radius: 10px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-momo:hover {
      background: #cc007a;
      transform: scale(1.03);
    }

    .coupon-item {
        border-radius: 8px;
        margin-bottom: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .coupon-item:hover {
        background-color: #f1f1f1;
    }

    .badge-custom {
        background-color: #007bff;
        color: white;
        font-size: 14px;
    }

    footer {
      background-color: #343a40;
      padding: 20px 0;
      margin-top: auto; 
    }

    footer p {
      margin: 0;
      font-size: 14px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="{{route('dashboard')}}">
      <img src="{{ asset('image/Vivu.jpg') }}" width="60" height="60" alt="logo">
    </a>
    <div class="cart">Chọn Mã Giảm Giá</div>
  </div>
</nav>

<!-- Form ma giam giagia -->
<div class="container mt-5">
  <h2 class="text-center mb-4">Chọn Mã Giảm Giá</h2>
  <div class="list-group">
    @foreach ($coupons as $coupon)
      <a href="{{ route('cart.applyCoupon', ['coupon_code' => $coupon->MaGiamGia]) }}" class="list-group-item list-group-item-action coupon-item">
        <div class="d-flex justify-content-between">
          <div>
            <h5 class="mb-1">{{ $coupon->MaGiamGia }}</h5>
            <p class="mb-0 text-muted">Giảm {{ number_format($coupon->SoTienGiam, 0, ',', '.') }} VNĐ</p>
          </div>
          <span class="badge badge-custom">Áp dụng</span>
        </div>
      </a>
    @endforeach
  </div>
</div>

<!-- Footer -->
<footer class="text-white text-center">
  <div class="container">
    <p>© Vivu Fashion 2025. All rights reserved.</p>
  </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
