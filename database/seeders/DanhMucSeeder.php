<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DanhMucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('danhmuc')->insert([

            [
                'MaDanhMuc' => '1',
                'TenDanhMuc' => 'Áo thun',
                'MoTa' => 'Các mẫu áo thun thời trang nam nữ',
                'NgayTao' => Carbon::now(),
            ],
            [
                'MaDanhMuc' => '2',
                'TenDanhMuc' => 'Áo sơ mi',
                'MoTa' => 'Áo sơ mi công sở và thời trang',
                'NgayTao' => Carbon::now(),
            ],
            [
                'MaDanhMuc' => '3',
                'TenDanhMuc' => 'Quần jeans',
                'MoTa' => 'Quần jeans nam nữ cao cấp',
                'NgayTao' => Carbon::now(),
            ],
            [
                'MaDanhMuc' => '4',
                'TenDanhMuc' => 'Quần short',
                'MoTa' => 'Short nam nữ mùa hè',
                'NgayTao' => Carbon::now(),
            ],
            [
                'MaDanhMuc' => '5',
                'TenDanhMuc' => 'Váy đầm',
                'MoTa' => 'Váy đầm thời trang cho nữ',
                'NgayTao' => Carbon::now(),
            ],
            [
                'MaDanhMuc' => '6',
                'TenDanhMuc' => 'Áo khoác',
                'MoTa' => 'Áo khoác giữ ấm, thời trang',
                'NgayTao' => Carbon::now(),
            ],
            
        ]);
    }
}
