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
        Schema::create('gopy', function (Blueprint $table) {
            $table->id('MaGopY');
            $table->unsignedBigInteger('MaNguoiDung'); // hoặc MaKhachHang nếu bạn dùng bảng đó
            $table->string('TieuDe');
            $table->text('NoiDung');
            $table->timestamps();

            $table->foreign('MaNguoiDung')->references('MaNguoiDung')->on('nguoidung')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gopy');
    }
};