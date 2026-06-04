eCommerce Website

Đây là dự án website bán hàng online được xây dựng phục vụ cho đồ án môn học.
Website cho phép người dùng xem sản phẩm, thêm vào giỏ hàng và thực hiện thanh toán.

---Công nghệ sử dụng
- Backend: PHP / Laravel
- Frontend: HTML, CSS, JS
- Database: MySQL
- Server: XAMPP / Apache

### 1 Clone Project
git clone https://github.com/hoangvu230725/eCommerce.git
cd eCommerce

### 2 Cài backend
composer install

### 3 Bật Xammpp

### 4 Chạy Database
Tạo database tên: lavarel

Thêm file .env và copy .env example qua .env

php artisan migrate

php artisan db:seed

### 5 Tạo key
php artisan key:generate


### 6 Chạy serve
php artisan serve

### 7 Truy cập
127.0.0.1:8000/login
