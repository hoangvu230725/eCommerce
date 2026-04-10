<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $statuses = ['Đang xử lý', 'Đã giao hàng', 'Đã hủy']; 

        for ($i = 1; $i <= 10; $i++) { 
            DB::table('DonHang')->insert([
                'MaNguoiDung' => rand(1, 5), 
                'NgayDatHang' => now()->subDays(rand(0, 30)), 
                'TongTien' => rand(100000, 1000000), 
                'TrangThai' => $statuses[array_rand($statuses)], 
            ]);
        }
    }
}
