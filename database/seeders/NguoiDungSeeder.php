<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NguoiDungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('NguoiDung')->insert([
                'TenDangNhap' => 'user' . $i,
                'Email' => 'user' . $i . '@example.com',
                'MatKhau' => Hash::make('123123'),
                'VaiTro' => 'khachhang',
            ]);
        }

        DB::table('NguoiDung')->insert([
            'TenDangNhap' => 'admin',
            'Email' => 'admin@gmail.com',
            'MatKhau' => Hash::make('123123'),
            'VaiTro' => 'admin',
        ]);

        DB::table('NguoiDung')->insert([
            'TenDangNhap' => 'nhanvien',
            'Email' => 'nhanvien@gmail.com',
            'MatKhau' => Hash::make('123123'),
            'VaiTro' => 'nhanvien',
        ]);
            }
}
