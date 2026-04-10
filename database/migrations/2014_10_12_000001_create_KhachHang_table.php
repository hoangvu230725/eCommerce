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
        Schema::create('KhachHang', function (Blueprint $table) {
            $table->id('MaKhachHang');
            $table->unsignedBigInteger('MaNguoiDung');
            $table->string('HoTen', 100)->nullable();
            $table->string('SoDienThoai', 20)->nullable();
            $table->string('DiaChi', 255)->nullable();
        
            $table->foreign('MaNguoiDung')
                  ->references('MaNguoiDung')
                  ->on('NguoiDung')
                  ->onDelete('cascade');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('KhachHang');
    }
};
