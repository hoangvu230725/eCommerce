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
        Schema::create('ThanhToan', function (Blueprint $table) {
            $table->id('MaThanhToan');
            $table->unsignedBigInteger('MaDonHang');
            $table->dateTime('NgayThanhToan')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->decimal('SoTien', 10, 2);
            $table->string('PhuongThuc', 20);

            $table->string('ghichu',255)->nullable();

            $table->foreign('MaDonHang')->references('MaDonHang')->on('DonHang');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ThanhToan');
    }
};
