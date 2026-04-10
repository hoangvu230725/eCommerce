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
        Schema::create('DanhGia', function (Blueprint $table) {
            $table->id('MaDanhGia');
            $table->unsignedBigInteger('MaKhachHang');
            $table->unsignedBigInteger('MaSanPham')->nullable();
            $table->integer('DiemDanhGia');
            $table->text('BinhLuan')->nullable();
            $table->dateTime('NgayTao')->default(DB::raw('CURRENT_TIMESTAMP'));
        
            $table->foreign('MaKhachHang')
                  ->references('MaKhachHang')
                  ->on('KhachHang')
                  ->onDelete('cascade');
        
            $table->foreign('MaSanPham')
                  ->references('MaSanPham')
                  ->on('SanPham')
                  ->onDelete('set null');
        });
        
        
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('DanhGia');
    }
};
