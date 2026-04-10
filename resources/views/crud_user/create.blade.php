<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .signup-form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        .row {
            width: 100%;
        }
        .col-md-4 {
            margin: 0 auto;
        }
        .error {
            color: red;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
<main class="signup-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="title text-center mb-3">
                    <h1>ViVu Fashion</h1>
                    <p>Uy tín, tạo nên thương hiệu !!</p>
                </div>
                <div class="card shadow-lg border-0">
                    <h3 class="card-header text-center" style="background-color: cadetblue; color: white;">Đăng ký tài khoản</h3>
                    <div class="card-body">
                        <form action="{{ route('user.postUser') }}" method="POST" onsubmit="return kiemTraForm()">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Tên đăng nhập" id="TenDangNhap" class="form-control" name="TenDangNhap" required autofocus>
                                <span id="loi-ten" class="error"></span>
                                @error('TenDangNhap')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" placeholder="Email" id="Email" class="form-control" name="Email" required>
                                <span id="loi-email" class="error"></span>
                                @error('Email')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Mật khẩu" id="MatKhau" class="form-control" name="MatKhau" required>
                                <span id="loi-mk" class="error"></span>
                                @error('MatKhau')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
                            </div><br>
                            <div class="text-center">
                                <a href="{{ route('login') }}">Đã có tài khoản? Đăng nhập</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function kiemTraForm() {
        const ten = document.getElementById('TenDangNhap').value.trim();
        const email = document.getElementById('Email').value.trim();
        const mk = document.getElementById('MatKhau').value.trim();

        let hopLe = true;

        document.getElementById('loi-ten').textContent = '';
        document.getElementById('loi-email').textContent = '';
        document.getElementById('loi-mk').textContent = '';

        if (ten.length === 0) {
            document.getElementById('loi-ten').textContent = 'Vui lòng nhập tên đăng nhập.';
            hopLe = false;
        } else if (ten.length > 50) {
            document.getElementById('loi-ten').textContent = 'Tên đăng nhập không quá 50 ký tự.';
            hopLe = false;
        }

        if (email.length === 0) {
            document.getElementById('loi-email').textContent = 'Vui lòng nhập email.';
            hopLe = false;
        } else if (email.length > 50) {
            document.getElementById('loi-email').textContent = 'Email không quá 50 ký tự.';
            hopLe = false;
        }

        if (mk.length === 0) {
            document.getElementById('loi-mk').textContent = 'Vui lòng nhập mật khẩu.';
            hopLe = false;
        } else if (mk.length > 50) {
            document.getElementById('loi-mk').textContent = 'Mật khẩu không quá 50 ký tự.';
            hopLe = false;
        }

        return hopLe;
    }
</script>

</body>
</html>
