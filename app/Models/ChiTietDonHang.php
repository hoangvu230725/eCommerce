<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    use HasFactory;

  


    protected $table = 'ChiTietDonHang'; // Tên bảng
    protected $primaryKey = 'MaChiTietDonHang'; // Khóa chính


    public $timestamps = false;

    protected $fillable = [
        'MaDonHang',
        'MaSanPham',
        'SoLuong',
        'Gia',
    ];


    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'MaSanPham', 'MaSanPham');
    }



    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'MaDonHang', 'MaDonHang');
    }
}


    


