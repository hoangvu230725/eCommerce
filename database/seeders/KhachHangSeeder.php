<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhachHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('KhachHang')->insert([
            [
                'MaNguoiDung' => 1,
                'HoTen' => 'Nguyen Van A',
                'SoDienThoai' => '0123456789',
                'DiaChi' => '123 Đường ABC, Quận 1, TP.HCM',
            ],
            [
                'MaNguoiDung' => 2,
                'HoTen' => 'Tran Thi B',
                'SoDienThoai' => '0987654321',
                'DiaChi' => '456 Đường XYZ, Quận 2, TP.HCM',
            ],
           
        ]);
    }
}
