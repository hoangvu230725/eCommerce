<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaGiamGia extends Model
{
    use HasFactory;

    protected $table = 'MaGiamGia';

    protected $primaryKey = 'MaGiamGia';

    protected $fillable = [
        'Ma',
        'SoTienGiam',
        'NgayHetHan',
    ];

    public $timestamps = false;

    public function donHang()
    {
        return $this->hasMany(DonHang::class, 'MaGiamGia', 'MaGiamGia');
    }

}