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
        Schema::create('NhanVien', function (Blueprint $table) {
            $table->id('MaNhanVien');
            $table->unsignedBigInteger('MaNguoiDung');
            $table->foreign('MaNguoiDung')->references('MaNguoiDung')->on('NguoiDung');
            $table->string('HoTen', 100)->nullable();
            $table->string('SoDienThoai', 20)->nullable();
            $table->string('ChucVu', 50)->nullable();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('NhanVien');
    }
};
