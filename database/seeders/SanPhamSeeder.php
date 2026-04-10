<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class SanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $sanPhams = [];

        for ($i = 0; $i < 20; $i++) {
            $sanPhams[] = [
                'MaSanPham' => $faker->unique()->numberBetween(1, 100),
                'TenSanPham' => 'Trang phục ' . ($i + 1),
                'MoTa' => $faker->sentence(10),
                'Anh' => 'trangphuc' . $i . '.jpg',
                'Gia' => $faker->numberBetween(100000, 1000000),
                'SoLuongTon' => $faker->numberBetween(50, 200),
                'SoLuongBan' => $faker->numberBetween(5, 50),
                'NgayTao' => Carbon::now(),
                'MaDanhMuc' => $faker->numberBetween(1, 6),
            ];
        }

        DB::table('sanpham')->insert($sanPhams);
    }
}
