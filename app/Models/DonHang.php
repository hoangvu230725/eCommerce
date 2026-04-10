<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;

    protected $table = 'DonHang';

    protected $primaryKey = 'MaDonHang';

    protected $fillable = [
        'MaNguoiDung',
        'NgayDatHang',
        'TongTien',
        'TrangThai',
        'MaGiamGia',
    ];

    public $timestamps = false;

    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'MaNguoiDung', 'MaNguoiDung');
    }

    public function maGiamGia()
    {
        return $this->belongsTo(MaGiamGia::class, 'MaGiamGia', 'MaGiamGia');
    }


   
public function chiTietDonHangs()
{
    return $this->hasMany(ChiTietDonHang::class, 'MaDonHang', 'MaDonHang');
}

}