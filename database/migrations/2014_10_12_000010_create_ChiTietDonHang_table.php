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
        Schema::create('ChiTietDonHang', function (Blueprint $table) {
            $table->id('MaChiTietDonHang');
            $table->unsignedBigInteger('MaDonHang');
            $table->unsignedBigInteger('MaSanPham');
            $table->integer('SoLuong');
            $table->decimal('Gia', 10, 2);
        
            $table->foreign('MaDonHang')->references('MaDonHang')->on('DonHang');
            $table->foreign('MaSanPham')->references('MaSanPham')->on('SanPham');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ChiTietDonHang');
    }
};
