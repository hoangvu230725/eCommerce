<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xác minh mã</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .verify-code-form {
            max-width: 400px;
            margin: 100px auto;
        }

        .card {
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
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

        .alert {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container verify-code-form">
        <div class="card">
            <h3 class="text-center mb-4">Xác minh mã</h3>

            @if(session('error'))
                <div class="alert alert-danger text-center">{{ session('error') }}</div>
            @endif

            <form action="{{ route('password.verify') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="token" class="form-label">Nhập mã xác minh</label>
                    <input type="text" name="token" id="token" class="form-control" placeholder="Nhập mã từ email" required>
                </div>
                <button type="submit" class="btn btn-primary">Xác minh</button>
            </form>

            <div class="back-to-forgot">
                <a href="{{ route('forgetpw') }}">Quay lại trang quên mật khẩu</a>
            </div>
        </div>
    </div>
</body>
</html>
