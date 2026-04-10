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
        Schema::create('GioHang', function (Blueprint $table) {
            $table->id('MaGioHang');

            $table->string('TenSanPham')->nullable();
            $table->unsignedBigInteger('MaNguoiDung');
            $table->unsignedBigInteger('MaSanPham');
            $table->integer('SoLuong');
            $table->timestamps();

            $table->foreign('MaNguoiDung')->references('MaNguoiDung')->on('NguoiDung');
            $table->foreign('MaSanPham')->references('MaSanPham')->on('SanPham');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('GioHang');
    }
};
