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
        Schema::create('MaGiamGia', function (Blueprint $table) {
            $table->id('MaGiamGia');
            $table->string('Ma', 50)->unique();
            $table->decimal('SoTienGiam', 10, 2);
            $table->date('NgayHetHan');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('MaGiamGia');
    }
};
