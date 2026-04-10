<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <title>Chi Tiết Đơn Hàng</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

  <style>
    .order-details-box {
      max-width: 600px;
      margin: 80px auto;
      padding: 40px 30px;
      border: 1px solid #dee2e6;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
      background-color: #fff;
    }

    .order-details-title {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 30px;
      padding: 15px;
      border: 1px solid #0d6efd;
      color: #0d6efd;
      text-align: center;
      border-radius: 8px;
      background-color: #eaf1ff;
    }

    .order-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .order-item label {
      font-weight: 500;
      width: 45%;
    }

    .order-item input {
      width: 50%;
      background-color: #e9ecef;
      border: 1px solid #ced4da;
      padding: 5px 10px;
      border-radius: 5px;
    }

    .product-details {
      display: flex;
      gap: 20px;
      align-items: flex-start;
      border: 1px solid #dee2e6;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 30px;
      background-color: #f8f9fa;
    }

    .product-details img {
      max-width: 150px;
      border-radius: 10px;
      object-fit: cover;
    }

    .product-info {
      flex: 1;
    }

    .product-info h5 {
      margin-top: 0;
      margin-bottom: 10px;
    }

    .product-info p {
      margin-bottom: 5px;
    }

    .action-buttons {
      margin-top: 40px;
      display: flex;
      justify-content: center;
      gap: 20px;
    }

    .action-buttons a {
      min-width: 200px;
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="{{route('dashboard')}}"><img src="{{ asset('image/Vivu.jpg') }}" width="70" height="70" alt="logo" /></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
       
     
        <li class="nav-item dropdown">
          
        </li>
       
      </ul>
      <form class="d-flex" method="GET" action="{{route('cart.cart')}}">
        <input class="form-control me-2" type="search" placeholder="Tìm kiếm sản phẩm giỏ hàng" value="{{request('search')}}"/>
        <button class="btn btn-outline-dark" type="submit"><i class="bi bi-search"></i></button>
      </form>
      <a href="{{route('signout')}}" class="btn ms-2"><i class="bi bi-person"></i></a>
      <a href="{{route('cart.cart')}}" class="btn ms-2"><i class="bi bi-cart"></i></a>
    </div>
  </div>
</nav>

<!-- ORDER DETAILS -->
<div class="container">
  <div class="order-details-box">
    <div class="order-details-title">CHI TIẾT ĐƠN HÀNG</div>

    <!-- Product Block -->
    @foreach ($orderDetails as $item)
      <div class="product-details">
        <img src="{{ asset('image/' . $item->Anh) }}" alt="{{ $item->TenSanPham }}" />
        <div class="product-info">
          <h5>{{ $item->TenSanPham }}</h5>
          <p>{{ $item->MoTa }}</p>
          <p><strong>Giá:</strong> {{ number_format($item->Gia, 0 , ',','.') }} VNĐ</p>
        </div>
      </div>
    @endforeach

    <!-- Other Info -->
    <div class="order-item">
      <label>Mã đơn hàng</label>
      <input type="text" readonly value="{{ $order->MaDonHang}}" />
    </div>

    <div class="order-item">
      <label>Ngày đặt hàng</label>
      <input type="text" readonly value="{{\Carbon\Carbon::parse($order->NgayDatHang)->format('d/m/Y')}}" />
    </div>

    <div class="order-item">
      <label>Phương thức thanh toán</label>
      <input type="text" readonly value="{{ $order->PhuongThuc ?? 'Thanh Toán Khi Nhận Hàng' }}" />
    </div>

    <div class="order-item">
      <label>Tổng tiền</label>
      <input type="text" readonly value="{{ number_format($order->TongTien, 0 , ',','.') }} VNĐ" />
    </div>

    <div class="order-item">
      <label>Trạng thái đơn hàng</label>
      <input type="text" readonly value="{{ $order->TrangThai }}" />
    </div>
  </div>

  <!-- Action Buttons -->
  <div class="action-buttons">
    <a href="{{route('cart.history_cart', ['date'=> \Carbon\Carbon::parse($order->NgayDatHang)->format('Y-m-d')])}}" class="btn btn-primary"><i class="bi bi-clock-history me-2"></i>Xem Lịch Sử Mua Hàng</a>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
      <i class="bi bi-house-door me-2"></i>Quay Về Trang Chủ
  </a>
  <a href="feedback.html" class="btn btn-success">
      <i class="bi bi-chat-dots me-2"></i>Gửi Phản Hồi
  </a>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
