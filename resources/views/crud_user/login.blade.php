<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }

        .login-form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .container,
        .row {
            height: 100%;
        }

        .card-header {
            background-color: cadetblue;
            color: white;
        }

        .error {
            color: red;
            font-size: 0.875rem;
        }

        .content-right {
            padding: 20px;
        }

        .content-right img {
            width: 100px;
            height: auto;
        }

        .btn-block {
            width: 100%;
        }
    </style>
</head>

<body>
    <main class="login-form">
        <div class="container">
            <div class="row w-100 align-items-center">
                <!-- Cột bên trái -->
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-lg border-0">
                        <h3 class="card-header text-center">Đăng Nhập</h3>
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.authUser') }}" onsubmit="return validateForm()">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="email" placeholder="Email" id="username" class="form-control" name="Email" value="{{ old('Email') }}" required>
                                    <span id="username-error" class="error"></span>
                                    @error('Email')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <input type="password" placeholder="Mật khẩu" id="MatKhau" class="form-control" name="MatKhau" required>
                                    <span id="password-error" class="error"></span>
                                    @error('MatKhau')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                        <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                                </div>
                            </form>

                            <div class="mt-3 text-center">
                                <a href="{{ route('forgetpw') }}" style="color: cadetblue;">Quên mật khẩu?</a>
                            </div>

                            <div class="mt-3 text-center">
                                <label>Đăng nhập bằng Google:</label>
                                <a href="{{ route('google.login') }}"><i class="bi bi-google fs-4 text-danger"></i></a>
                            </div>

                            <div class="mt-3 text-center">
                                <p>Chưa có tài khoản? 
                                    <a href="{{ route('user.createUser') }}" class="text-decoration-none" style="color: cadetblue;">Đăng ký tại đây</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cột bên phải -->
                <div class="col-md-6 col-lg-8 text-center content-right">
                    <img src="{{ asset('image/Vivu.jpg') }}" alt="Logo">
                    <h1 class="mt-3">ViVu Fashion</h1>
                    <p class="mt-3">Chào mừng bạn đến với website của chúng tôi! Bạn có thể đăng nhập bằng tài khoản hoặc sử dụng Google để đăng nhập nhanh chóng. Chúc bạn có trải nghiệm vui vẻ!</p>
                </div>
            </div>
        </div>
    </main>

    <script>
        function validateForm() {
            var username = document.getElementById('username').value.trim();
            var password = document.getElementById('MatKhau').value.trim();

            var usernameError = document.getElementById('username-error');
            var passwordError = document.getElementById('password-error');

            usernameError.textContent = '';
            passwordError.textContent = '';

            if (username === '') {
                usernameError.textContent = 'Email không được để trống.';
                return false;
            } else if (username.length > 50) {
                usernameError.textContent = 'Email tối đa 50 ký tự.';
                return false;
            }

            if (password === '') {
                passwordError.textContent = 'Mật khẩu không được để trống.';
                return false;
            } else if (password.length < 6) {
                passwordError.textContent = 'Mật khẩu tối thiểu 6 ký tự.';
                return false;
            } else if (password.length > 50) {
                passwordError.textContent = 'Mật khẩu tối đa 50 ký tự.';
                return false;
            }

            return true;
        }
    </script>
</body>

</html>
