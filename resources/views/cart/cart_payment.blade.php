<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Xác Nhận Thanh Toán</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f5f5f5;
      font-family: 'Segoe UI', sans-serif;
    }

    .checkout-container {
      background: #fff;
      border-radius: 14px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
      max-width: 850px;
      margin: 50px auto;
      padding: 30px 40px;
    }

    .section-title {
      font-size: 1.3rem;
      font-weight: 600;
      margin-bottom: 15px;
      color: #444;
    }

    .divider {
      border-top: 1px solid #ddd;
      margin: 25px 0;
    }

    .info-box p {
      margin: 0 0 5px;
      font-size: 15px;
    }

    .info-box strong {
      color: #333;
    }

    .order-summary {
      background-color: #f9f9f9;
      padding: 15px 20px;
      border-radius: 10px;
      margin-top: 20px;
    }

    .total {
      font-size: 18px;
      font-weight: bold;
      color: #d92525;
    }

    .btn-submit {
      margin-top: 30px;
      width: 100%;
      font-weight: bold;
      font-size: 17px;
      padding: 12px;
      border-radius: 10px;
    }

    .select-icon {
      margin-right: 8px;
    }


    
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
    <div class="container">
      <a class="navbar-brand" href="{{route('dashboard')}}">
        <img src="image/Vivu.jpg" width="70" height="70" alt="logo" class="rounded-circle" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active text-dark" href="{{route('dashboard')}}">
              <i class="bi bi-house-door"></i> Trang Chủ
            </a>
          </li>
         
      </div>
    </div>
  </nav>  
 
<div class="checkout-container">
  <h2 class="text-center mb-4">Xác Nhận Đơn Hàng</h2>

  @php $info = session('info_checkout'); @endphp

  <!-- Thông Tin Khách Hàng -->
  <div class="info-box mb-4">
    <div class="section-title"><i class="bi bi-person-circle"></i> Thông Tin Nhận Hàng</div>
    <p>Họ và tên: <strong>{{$info['HoTen']}}</strong></p>
    <p>Số điện thoại: <strong>{{$info['SoDienThoai']}}</strong></p>
    <p>Địa chỉ: <strong>{{$info['DiaChi']}}</strong></p>
    <a href="{{route('cart.info_user.store')}}" class="text-decoration-underline small text-primary">[Chỉnh sửa]</a>
  </div>

  <form action="{{route('cart.payment.submit')}}" method="POST">
    @csrf
    <input type="hidden" name="hoten" value="{{$info['HoTen']}}">
    <input type="hidden" name="sodienthoai" value="{{$info['SoDienThoai']}}">
    <input type="hidden" name="diachi" value="{{$info['DiaChi']}}">

    <!-- Phương Thức Thanh Toán -->
    <div class="mb-3">
      <label for="paymentMethod" class="form-label section-title"><i class="bi bi-credit-card"></i> Chọn Phương Thức Thanh Toán</label>
      <select class="form-select" id="paymentMethod" name="paymentMethod" required>
        <option disabled selected>-- Vui lòng chọn --</option>
        <option value="cod">Thanh toán khi nhận hàng (COD)</option>
        <option value="momo">Ví MoMo</option>
      </select>
      @if(isset($payment_method_error) && $payment_method_error)
        <div class="alert alert-warning" id="payment-method-alert">
            {{ $payment_method_error }}
        </div>
      @endif
    </div>
    <div class="col-12 mt-4">
      <label for="coupon_code" class="form-label section-title"><i class="bi bi-tags"></i> Mã Giảm Giá</label>
      <div class="input-group">
        <a href="{{ route('cart.getCoupons') }}" class="btn btn-primary">Chọn mã giảm giá</a>
      </div>
    </div>
    <!-- Ghi Chú -->
    <div class="mb-3">
      <label class="form-label section-title"><i class="bi bi-pencil-square"></i> Ghi chú đơn hàng</label>
      <textarea class="form-control" name="ghichu" rows="3" placeholder="Thêm ghi chú nếu cần..."></textarea>
    </div>

    <!-- Tóm tắt đơn hàng -->
    <div class="order-summary">
      <div class="d-flex justify-content-between">
        <span>Tổng tiền</span>
        <span class="total">{{ number_format($total_after, 0, ',', '.') }} VNĐ</span>
      </div>
      @if (isset($appliedCoupon))
        <div class="d-flex justify-content-between">
          <span>Mã giảm giá ({{ $appliedCoupon }})</span>
          <span class="text-success">-{{ number_format($discount, 0, ',', '.') }} VNĐ</span>
        </div>
      @endif
    </div>

    <!-- Nút Đặt Hàng -->
    <button type="submit" class="btn btn-danger btn-submit mt-4">Xác Nhận Đặt Hàng</button>
  </form>
</div>

<!-- Footer -->
<footer class="text-center text-muted mt-5 mb-3 small">
  © 2025 Vivu Fashion. All rights reserved.
</footer>

<script>
  
  history.pushState(null, null, location.href);
  window.onpopstate = function () {
    history.pushState(null, null, location.href);
    alert("Bạn không thể quay lại trong lúc thanh toán. Vui lòng hoàn tất thanh toán!");
  };

  // Chặn người dùng rời khỏi trang
  window.addEventListener('beforeunload', function (e) {
    e.preventDefault();
    e.returnValue = "Bạn có chắc chắn muốn rời khỏi trang? Thanh toán chưa hoàn tất!";
  });

  // Tùy chọn: Hiển thị cảnh báo khi người dùng cố gắng thay đổi URL
  window.addEventListener('hashchange', function () {
    alert("Bạn không thể thay đổi URL trong lúc thanh toán!");
    location.href = "{{ route('cart.payment.submit') }}"; // Điều hướng lại về trang thanh toán
  });


  document.addEventListener('DOMContentLoaded', function () {
    const couponSelect = document.getElementById('coupon_code');
    const totalElement = document.querySelector('.total');

    couponSelect.addEventListener('change', function () {
      const selectedCoupon = couponSelect.value;

      // Gửi yêu cầu AJAX để tính tổng tiền
      fetch('{{ route('cart.payment.submit') }}',
        body: JSON.stringify({ coupon_code: selectedCoupon })
      })
      .then(response => response.json())
      .then(data => {
        // Cập nhật tổng tiền trên giao diện
        totalElement.textContent = `${data.total_after_discount.toLocaleString()} VNĐ`;
      })
     
    });
  });
</script>
</body>
</html>
