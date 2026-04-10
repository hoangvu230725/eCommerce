<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('NguoiDung', function (Blueprint $table) {
            $table->id('MaNguoiDung'); // ID tự tăng
            $table->string('TenDangNhap', 50);
            $table->string('MatKhau', 255);
            $table->string('Email', 100)->unique();
            $table->enum('VaiTro', ['admin', 'nhanvien', 'khachhang'])->default('khachhang');
            $table->timestamp('NgayTao')->useCurrent();
            $table->string('google_id')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('NguoiDung');
    }
};
