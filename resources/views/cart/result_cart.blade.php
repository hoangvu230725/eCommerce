<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <title>Đặt Hàng Thành Công</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    .success-box {
      max-width: 500px;
      margin: 80px auto;
      border: 1px solid #dee2e6;
      border-radius: 15px;
      padding: 40px 30px;
      box-shadow: 0 0 15px rgba(0,0,0,0.05);
      text-align: center;
      background-color: #fff;
    }

    .error-box{
      max-width: 500px;
      margin: 80px auto;
      border: 1px solid #dee2e6;
      border-radius: 15px;
      padding: 40px 30px;
      box-shadow: 0 0 15px rgba(0,0,0,0.05);
      text-align: center;
      background-color: #fff;
    }
    .success-title {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 30px;
      padding: 15px;
      border: 1px solid #198754;
      display: inline-block;
      color: #198754;
      border-radius: 8px;
      background-color: #e9f9f0;
    }
    .error-title{
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 30px;
      padding: 15px;
      border: 1px solid #f71d2b;
      display: inline-block;
      color: #e65864;
      border-radius: 8px;
      
    }
    .checkmark {
      font-size: 70px;
      color: #28a745;
      margin-bottom: 30px;
    }

    .check_mark{
      font-size: 70px;
      color: #ff0000;
      margin-bottom: 30px;
    }
    .btn-custom {
      min-width: 160px;
      padding: 10px 20px;
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

<!-- SUCCESS CONTENT -->



  <div class="container">
    <div class="success-box">
      <div class="success-title">ĐƠN HÀNG ĐÃ ĐƯỢC ĐẶT</div>
      <div class="checkmark"><i class="bi bi-check2-circle"></i></div>
      
      <div class="d-flex justify-content-center gap-3">
        @if(isset($maDonHang))
        <a href="{{ route('cart.order_detail', ['MaDonHang' => $maDonHang]) }}" class="btn btn-outline-success btn-custom">
          Xem Chi Tiết Đơn Hàng
        </a>
      @endif
        <a href="{{route('dashboard')}}" class="btn btn-success btn-custom">Trang Chủ</a>
      </div>
    </div>
  </div>
  
  
  
  <!--dat khong thanh cong-->



  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>