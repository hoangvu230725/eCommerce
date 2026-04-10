<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaGiamGiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $discounts = [];

        for ($i = 1; $i <= 20; $i++) {
            $discounts[] = [
                'Ma' => 'DISCOUNT' . $i,
                'SoTienGiam' => rand(10000, 50000),
                'NgayHetHan' => now()->addDays(rand(1, 30)),
            ];
        }

        DB::table('MaGiamGia')->insert($discounts);
    }
}
