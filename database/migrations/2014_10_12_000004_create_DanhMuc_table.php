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
        Schema::create('DanhMuc', function (Blueprint $table) {
            $table->id('MaDanhMuc');
            $table->string('TenDanhMuc');
            $table->text('MoTa')->nullable();
            $table->dateTime('NgayTao')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('DanhMuc');
    }
};
