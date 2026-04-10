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
        Schema::create('HoaDonNhanVien', function (Blueprint $table) {
            $table->id('MaHoaDon');
            $table->unsignedBigInteger('MaNhanVien');
            $table->unsignedBigInteger('MaDonHang');
            $table->dateTime('NgayTao')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->decimal('TongTien', 10, 2);
        
            $table->foreign('MaNhanVien')->references('MaNhanVien')->on('NhanVien');
            $table->foreign('MaDonHang')->references('MaDonHang')->on('DonHang');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('HoaDonNhanVien');
    }
};
