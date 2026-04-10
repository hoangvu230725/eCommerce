<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .forgot-password-form {
            padding-top: 50px;
        }

        .card-header {
            background-color: cadetblue ;
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
        }

        .card-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .text-center a {
            color: #007bff;
            text-decoration: none;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <main class="forgot-password-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Quên mật khẩu</h3>
                        <div class="card-body">
                            <form action="{{ route('password.send-code') }}" method="POST" onsubmit="return validateForm()">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="email" maxlength="50" placeholder="Email" id="email_address" class="form-control" name="email" required autofocus>
                                    <span id="email-error" class="error"></span>
                                    @error('email')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Gửi mã</button>
                                </div>
                            </form>
                            <div class="text-center mt-3">
                                <a href="{{ route('login') }}">Quay trở lại</a>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function validateForm() {
            const emailInput = document.getElementById('email_address');
            const emailError = document.getElementById('email-error');
            const email = emailInput.value.trim();

            emailError.textContent = '';

            if (email === '') {
                emailError.textContent = 'Email không được để trống.';
                return false;
            }

            if (email.length > 50) {
                emailError.textContent = 'Email tối đa 50 kí tự.';
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
