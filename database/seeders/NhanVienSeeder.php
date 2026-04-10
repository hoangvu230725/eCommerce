<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB; 



class NhanVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $nhanVienData = [];

        for ($i = 1; $i <= 20; $i++) {
            $nhanVienData[] = [
                'MaNguoiDung' => 1,
                'HoTen' => 'Nhân viên ' . $i,
                'SoDienThoai' => '09000000' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'ChucVu' => $i % 2 == 0 ? 'Nhân viên' : 'Quản lý',
            ];
        }

        DB::table('NhanVien')->insert($nhanVienData);

    }
}
