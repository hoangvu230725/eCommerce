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
        Schema::create('SanPham', function (Blueprint $table) {
            $table->id('MaSanPham');
            $table->string('TenSanPham');
            $table->text('MoTa')->nullable();
            $table->string('Anh');
            $table->decimal('Gia', 10, 2);
            $table->integer('SoLuongTon');
            $table->integer('SoLuongBan')->default(0);
            $table->dateTime('NgayTao')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('MaDanhMuc')->nullable();
        
            $table->foreign('MaDanhMuc')
                  ->references('MaDanhMuc')
                  ->on('DanhMuc')
                  ->onDelete('set null');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('SanPham');
    }
};
