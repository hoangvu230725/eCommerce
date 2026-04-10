<!DOCTYPE html>
<html lang="en">

<head>
    <title>Vivu Admin</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css'); }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-responsive.min.css'); }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/uniform.css'); }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css'); }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/matrix-style.css'); }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/matrix-media.css'); }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!--Header-part-->
    <div id="header">
        <h1><a href="{{ route('dashboard') }}"><img src="{{ asset('image/logo_vivu.png');}}" alt=""></a></h1>
    </div>
    <!--close-Header-part-->

    <!--top-Header-menu-->
    <div id="user-nav" class=" navbar-inverse">
        <ul class="nav">
            <li class="dropdown" id="profile-messages">
                <a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle">
                    <i class="icon icon-user"></i>
                    <span class="text">Chào mừng Admin</span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li>

                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!--start-top-search-->
    <div id="search">
        <form action="{{ route('admin.search') }}" method="get">
            <input name="keyword" type="text" placeholder="Tìm kiếm" />
            <button type="submit" class="tip-bottom" title="Search">
                <i class="icon-search icon-white"></i>
            </button>
        </form>
    </div>
    <!--close-top-search-->
    <!--sidebar-menu-->
    <div id="sidebar"> <a href="#" class="visible-phone"><i class="icon
                    icon-th"></i>Tables</a>
        <ul>
            <li><a href="{{route('admin.reports')}}"><i class="icon icon-home"></i> <span>Doanh thu</span></a>
            </li>
            <li> <a href="{{route('users.list')}}"><i class="icon icon-th-list"></i>
                    <span>Người dùng</span></a></li>
            <li> <a href="{{route('admin.discounts')}}"><i class="icon icon-th-list"></i>
                    <span>Mã giảm giá</span></a></li>
            <li> <a href="{{route('admin.invoices')}}"><i class="icon icon-th-list"></i>
                    <span>Hóa đơn</span></a></li>
             <li> <a href="{{ route('admin.noidung.index') }}"><i class="icon icon-th-list"></i>
                        <span>Thông báo</span></a></li>

                <li>
                    <a href="{{ route('admin.chat.list') }}">
                        <i class="icon icon-th-list"></i>
                        <span>Hỗ trợ khách hàng</span>
                        @php
                        use App\Http\Controllers\ChatController;
                        $soTin = ChatController::getUnreadCount();
                        @endphp
                        @if ($soTin > 0)
                        <span class="badge bg-danger">{{ $soTin }}</span>
                        @endif
                    </a>
                </li>
                 <li> <a href="{{ route('admin.orders') }}"><i class="icon icon-th-list"></i>
                        <span>Đơn hàng</span></a></li>
             
        </ul>
    </div>

    @yield('content')


    <footer class="footer">
        <div class="container">
            <div class="text-center">
                <p>Vivu Admin</p>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>

