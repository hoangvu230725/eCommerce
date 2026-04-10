<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đặt lại mật khẩu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f2f2f2;
        }

        .reset-password-form {
            max-width: 400px;
            margin: 100px auto;
        }

        .card {
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        button[type="submit"] {
            width: 100%;
        }

        .back-to-forgot {
            text-align: center;
            margin-top: 15px;
        }

        .back-to-forgot a {
            color: #007bff;
            text-decoration: none;
        }

        .back-to-forgot a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container reset-password-form">
        <div class="card">
            <h3 class="text-center mb-4">Đặt lại mật khẩu</h3>
            <form action="{{ route('password.reset') }}" method="POST" onsubmit="return validateForm()">
                @csrf
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu mới</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                </div>

                <div id="error-message" class="text-danger mb-3"></div>

                <button type="submit" class="btn btn-primary">Đặt lại mật khẩu</button>
            </form>

            <div class="back-to-forgot">
                <a href="{{ route('forgetpw') }}">Quay lại trang quên mật khẩu</a>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            const password = document.getElementById('password').value;
            const confirm = document.getElementById('password_confirmation').value;
            const error = document.getElementById('error-message');

            if (password.length < 6) {
                error.textContent = "Mật khẩu phải có ít nhất 6 ký tự.";
                return false;
            }

            if (password !== confirm) {
                error.textContent = "Mật khẩu xác nhận không khớp.";
                return false;
            }

            error.textContent = "";
            return true;
        }
    </script>
</body>
</html>
