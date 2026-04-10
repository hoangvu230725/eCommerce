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
        Schema::create('NoiDungWebsite', function (Blueprint $table) {
            $table->id('MaNoiDung');
            $table->unsignedBigInteger('MaNhanVien')->nullable();
            $table->string('Loai', 50);
            $table->string('TieuDe', 255);
            $table->text('NoiDung')->nullable();


            $table->dateTime('NgayTao')->default(DB::raw('CURRENT_TIMESTAMP'));


            $table->foreign('MaNhanVien')->references('MaNhanVien')->on('NhanVien');
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('NoiDungWebsite');
    }

};

