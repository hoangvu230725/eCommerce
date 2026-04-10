    <!DOCTYPE html>
    <html lang="vi">
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Thanh Toán - Vivu Fashion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', sans-serif;
        }

    

        
        .payment-form {
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        padding: 40px;
        max-width: 700px;
        margin: 50px auto;
        }
        .payment-form h2 {
        text-align: center;
        font-weight: 700;
        color: #343a40;
        margin-bottom: 30px;
        }
        .form-control, .form-select {
        border-radius: 10px;
        margin-bottom: 20px;
        }

        .total-amount {
        display: flex;
        justify-content: space-between;
        font-weight: bold;
        margin-top: 10px;
        font-size: 18px;
        }

        .btn-order {
        width: 100%;
        padding: 12px;
        font-size: 18px;
        font-weight: bold;
        border-radius: 12px;
        }

        .btn-momo {
        margin-top: 15px;
        width: 100%;
        padding: 12px;
        font-size: 16px;
        background-color: #a50064;
        color: white;
        border-radius: 12px;
        border: none;
        }
        .cart{
        font-family: 'Times New Roman', Times, serif;
        font-size: 1.5em;
        }
        footer {
        margin-top: 60px;
        }
    </style>
    </head>
    <body>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{route('dashboard')}}"><img src="{{ asset('image/Vivu.jpg') }}" width="70" height="70" alt="logo" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        
            
            <div class="cart">

            <li class="nav-item dropdown">
                Thông Tin Nhận Hàng
            </li>
        </div>
        
    </ul>
    
    
</div>
</div>
</nav>

<!-- Payment Form -->


<form class="payment-form" action="{{route('cart.info_user.store')}}" method="POST">
    <div class="container">
        <h2>Xác Nhận Thông Tin</h2>
        @if (session('error'))
        <div class="alert alert-danger">
        {{ session('error') }}
        </div>
        @endif
        @csrf
        <label class="form-label">Họ và Tên</label>
        <input type="text" name="hoten" class="form-control" placeholder="Nhập họ và tên" required maxlength="50">

        <label class="form-label">SĐT</label>
        <input type="tel" name="sdt" class="form-control" placeholder="Nhập số điện thoại" required>
        @error('sdt')
        <div class="text-danger">{{ $message }}</div>
        @enderror
       
            <label class="form-label">Địa Chỉ</label>
            <select id="province" name="province" class="form-select" required>
                <option selected disabled>Chọn tỉnh / thành phố</option>
            </select>
            @error('province')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <select id="district" name="district" class="form-select" required disabled>
                <option selected disabled>Chọn quận / huyện</option>
            </select>
            @error('district')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <select id="ward" name="ward" class="form-select" required disabled>
                <option selected disabled>Chọn phường / xã</option>
            </select>
            @error('ward')
            <div class="text-danger">{{ $message }}</div>
            @enderror
    


    
        <button type="submit" class="btn btn-dark btn-order">Thanh Toán</button>
    </div>
    </form>


    <!-- Footer -->
    <footer class="py-4 bg-dark text-white text-center">
    <div class="container">
        <p class="m-0">© Vivu Fashion 2025. All rights reserved.</p>
    </div>
    </footer>

    <!-- JS -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch('/provinces')
        .then(response => response.json())
        .then(data => {
            const provinceSelect = document.getElementById('province');
            Object.keys(data).forEach(key => {
            const option = document.createElement('option');
            option.value = key;
            option.textContent = data[key].name;
            provinceSelect.appendChild(option);
            });
        });

        document.getElementById('province').addEventListener('change', function() {
        const provinceId = this.value;
        const districtSelect = document.getElementById('district');
        const wardSelect = document.getElementById('ward');

        districtSelect.innerHTML = '<option selected disabled>Đang tải...</option>';
        wardSelect.innerHTML = '<option selected disabled>Chọn phường / xã</option>';
        wardSelect.disabled = true;

        fetch(`/districts/${provinceId}`)
            .then(response => response.json())
            .then(data => {
            districtSelect.innerHTML = '<option selected disabled>Chọn quận / huyện</option>';
            data.forEach(district => {
                const option = document.createElement('option');
                option.value = district.code;
                option.textContent = district.name;
                districtSelect.appendChild(option);
            });
            districtSelect.disabled = false;
            });
        });

        document.getElementById('district').addEventListener('change', function() {
        const districtId = this.value;
        const wardSelect = document.getElementById('ward');
        wardSelect.innerHTML = '<option selected disabled>Đang tải...</option>';

        fetch(`/wards/${districtId}`)
            .then(response => response.json())
            .then(data => {
            wardSelect.innerHTML = '<option selected disabled>Chọn phường / xã</option>';
            data.forEach(ward => {
                const option = document.createElement('option');
                option.value = ward.code;
                option.textContent = ward.name;
                wardSelect.appendChild(option);
            });
            wardSelect.disabled = false;
            });
        });
    });


    </script>

    </body>
    </html>
