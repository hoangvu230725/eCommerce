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
        Schema::create('ChatBox', function (Blueprint $table) {
            $table->id('MaChat');
            $table->unsignedBigInteger('MaNguoiDung');
            $table->unsignedBigInteger('MaNhanVien')->nullable();
            $table->text('NoiDung');
            $table->string('NguoiGui', 10);
            $table->dateTime('ThoiGian')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('MaNguoiDung')->references('MaNguoiDung')->on('nguoidung');
            $table->foreign('MaNhanVien')->references('MaNhanVien')->on('NhanVien');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ChatBox');
    }
};
