<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Thanh Toán - Vivu Fashion</title>
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Poppins', sans-serif;
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

    footer {
      margin-top: 80px;
      background-color: #343a40;
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
    <div class="cart">Xác Nhận Thanh Toán MOMO</div>
  </div>
</nav>

<!-- Form Thanh Toán -->
<form action="{{ url('/momo_payment') }}" method="post" class="payment-form pt-3">
  @csrf
  <img src="https://upload.wikimedia.org/wikipedia/vi/f/fe/MoMo_Logo.png" alt="MoMo Logo">
  <input type="hidden" name="total_momo" value="{{ $total_after }}">
  <span>{{ number_format($total_after, 0, ',', '.') }} VNĐ</span>
  <button type="submit" class="btn-momo" name="payUrl">
    <i class="bi bi-credit-card-2-front-fill me-2"></i>Thanh toán MOMO
  </button>
</form>

<!-- Footer -->
<footer class="py-4 text-white text-center">
  <div class="container">
    <p>© Vivu Fashion 2025. All rights reserved.</p>
  </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
