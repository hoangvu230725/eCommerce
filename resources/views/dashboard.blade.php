<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-white">
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
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
                @auth
                    <a href="{{ route('user.info') }}" class="btn-loign ms-2"><i class="bi bi-person fs-4"></i></a>
                @endauth
                <a href="{{ route('cart.cart') }}" class="btn-loign ms-2"><i class="bi bi-cart"></i></a>

                <a class="btn-loign ms-2" href="{{ route('signout') }}"><i class="bi bi-box-arrow-right"></i></a>
            </div>
        </div>
    </nav>

    <!-- Name Store -->
    <div class="namestore">
        <h1>Vivu Fashion</h1>
        <p>Nơi phong cách lên ngôi – Tự tin tỏa sáng!</p>
    </div>

    @yield('content')

    <footer class="ft py-5 text-white bg-dark">
    <div class="container text-center mb-4">
        <p class="m-0">&copy; 2024 Vivu Team. All rights reserved.</p>
    </div>

    <div class="container">
        <div class="row text-center text-md-start">
            <!-- Liên hệ -->
            <div class="col-md-3 mb-3">
                <h5>Liên hệ</h5>
                <ul class="list-unstyled">
                    <li>📞 SDT/Zalo: 09xx.xxx.xxx</li>
                    <li>📧 Email: vivuteam@gmail.com</li>
                    <li>📘 Fanpage: fb.com/vivuteam</li>
                </ul>
            </div>

            <!-- Địa chỉ -->
            <div class="col-md-3 mb-3">
                <h5>Địa chỉ</h5>
                <p>Linh Tây, Thủ Đức, TP. HCM</p>
                <p>Giờ làm việc: 8h - 17h (T2 - T7)</p>
            </div>

            <!-- Hỗ trợ -->
            <div class="col-md-3 mb-3">
                <h5>Hỗ trợ</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white text-decoration-none">Chính sách bảo mật</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Điều khoản sử dụng</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Câu hỏi thường gặp</a></li>
                </ul>
            </div>

            <!-- Mạng xã hội -->
            <div class="col-md-3 mb-3">
                <h5>Kết nối với chúng tôi</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white text-decoration-none">🌐 Website chính thức</a></li>
                    <li><a href="#" class="text-white text-decoration-none">📸 Instagram</a></li>
                    <li><a href="#" class="text-white text-decoration-none">🎥 YouTube</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>




    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>


</html>

