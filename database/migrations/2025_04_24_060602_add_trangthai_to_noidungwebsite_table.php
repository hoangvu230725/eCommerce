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
        Schema::table('noidungwebsite', function (Blueprint $table) {
            $table->boolean('TrangThai')->default(false); // false = ẩn, true = hiển thị
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('noidungwebsite', function (Blueprint $table) {
            //
        });
    }
};