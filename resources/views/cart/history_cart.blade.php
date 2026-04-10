<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lịch Sử Mua Hàng</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .readonly-input {
      background-color: #f0f0f0;
      border: 1px solid #ccc;
    }
    .order-box {
      max-width: 700px;
      margin: 30px auto;
      padding: 30px;
      border: 1px solid #ccc;
      border-radius: 10px;
      background-color: #ffffff;
    }
    .navbar-nav .nav-link {
  color: black !important;
}
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">

            <a class="navbar-brand" href="{{ route('dashboard') }}"><img src="{{ asset('image/Vivu.jpg') }}"
                    width="70px" height="70px"></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Trang Chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('product') }}">Sản Phẩm</a></li>

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Danh Mục</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('product') }}">Tất cả sản phẩm</a></li>
                            <li><hr class="dropdown-divider" /></li>
                            @foreach ($danhMucs as $dm)
                                <li><a class="dropdown-item" href="{{ route('products.category', ['id' => $dm->MaDanhMuc]) }}">{{ $dm->TenDanhMuc }}</a></li>
                            @endforeach

                        </ul>
                    </li>

                 


                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('gopy.index') }}">Góp ý</a>
                    </li>

                </ul>
                <form class="d-flex" method="GET" action="{{ route('product.search') }}">
                    <input class="form-control me-2" type="search" name="query" maxlength="50" placeholder="Tìm kiếm" value="{{ request()->query('query') }}">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
                @auth
                    <a href="{{ route('user.info') }}" class="btn-loign ms-2"><i class="bi bi-person fs-4"></i></a>
                @endauth
                <a href="{{ route('cart.cart') }}" class="btn-loign ms-2"><i class="bi bi-cart"></i></a>

                <a class="btn-loign ms-2" href="{{ route('signout') }}"><i class="bi bi-box-arrow-right"></i></a>
            </div>
        </div>
    </nav>
<!-- Lịch Sử Mua Hàng -->
<div class="container mt-5">
  <div class="order-box shadow-sm">
    <h4 class="text-center mb-4">LỊCH SỬ MUA HÀNG</h4>
    
    <!-- Bộ lọc -->
    <form action="{{ route('cart.history_cart') }}" method="GET" class="mb-4 d-flex justify-content-end align-items-center">
      <label for="filterDate" class="form-label me-2 mb-0">Bộ Lọc:</label>
      <input type="date" class="form-control w-auto" id="filterDate" name="date" value="{{ $selectedDate }}">
      <button class="btn btn-primary ms-2" type="submit">Lọc</button>
    </form>
    
    @if($orders->isEmpty())
    <p class="text-center">Không Có Đơn Hàng Nào Trong Ngày Đã Chọn</p>
    @else
    @foreach($orders as $order)

    <!-- Thông tin đơn hàng -->
    <div class="mb-3 row">
      <label class="col-sm-4 col-form-label">Mã đơn hàng:</label>
      <div class="col-sm-8">
        <input type="text" readonly class="form-control readonly-input" value="{{$order->MaDonHang}}">
      </div>
    </div>

    <div class="mb-3 row">
      <label class="col-sm-4 col-form-label">Ngày đặt hàng:</label>
      <div class="col-sm-8">
        <input type="text" readonly class="form-control readonly-input" value="{{\Carbon\Carbon::parse($order->NgayDatHang)->format('d/m/Y')}}">
      </div>
    </div>

    <div class="mb-3 row">
      <label class="col-sm-4 col-form-label">Tổng tiền:</label>
      <div class="col-sm-8">
        <input type="text" readonly class="form-control readonly-input" value="{{number_format($order->TongTien , 0, ',','.')}} VNĐ">
      </div>
    </div>

    <div class="mb-3 row">
      <label class="col-sm-4 col-form-label">Trạng thái đơn hàng:</label>
      <div class="col-sm-8">
        <input type="text" readonly class="form-control readonly-input" value="{{$order->TrangThai}}">
      </div>
    </div>
    <hr>
    @endforeach
    @endif
    <!-- Nút quay lại -->
    <div class="text-center mt-4">
      <a href="{{route('dashboard')}}" class="btn btn-secondary">Quay Về Trang Chủ</a>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function filterOrders() {
    const selectedDate = document.getElementById('filterDate').value;
    if (selectedDate) {
      const [year, month, day] = selectedDate.split("-");
      alert(`Bạn đã chọn ngày ${day}/${month}/${year}`);

    } else {
      alert("Vui lòng chọn ngày cần lọc!");
    }
  }
</script>
</body>
</html>
