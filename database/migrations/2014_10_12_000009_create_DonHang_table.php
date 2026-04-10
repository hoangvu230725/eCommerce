<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('DonHang', function (Blueprint $table) {
            $table->id('MaDonHang');
            $table->unsignedBigInteger('MaNguoiDung');
            $table->dateTime('NgayDatHang')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->decimal('TongTien', 10, 2);
            $table->string('TrangThai', 20);
            $table->unsignedBigInteger('MaGiamGia')->nullable();
        
            $table->foreign('MaNguoiDung')->references('MaNguoiDung')->on('NguoiDung');
            $table->foreign('MaGiamGia')->references('MaGiamGia')->on('MaGiamGia');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('DonHang');
    }
};
