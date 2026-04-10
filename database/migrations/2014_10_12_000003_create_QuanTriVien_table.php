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
        Schema::create('QuanTriVien', function (Blueprint $table) {
            $table->id('MaQuanTri');
            $table->unsignedBigInteger('MaNguoiDung');
            $table->foreign('MaNguoiDung')->references('MaNguoiDung')->on('NguoiDung');
            $table->string('HoTen', 100)->nullable();
            $table->string('SoDienThoai', 20)->nullable();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('QuanTriVien');
    }
};
