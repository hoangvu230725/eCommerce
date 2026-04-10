<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;




    protected $table = 'SanPham';
    protected $primaryKey = 'MaSanPham';
    public $timestamps = false;
    
    protected $fillable = [
        'TenSanPham', 'MoTa', 'Anh', 'Gia', 'SoLuongTon', 'SoLuongBan', 'NgayTao', 'MaDanhMuc'
    ];



    public function chiTietDonHangs()
    {
        return $this->hasMany(ChiTietDonHang::class, 'MaSanPham', 'MaSanPham');
    }



   

    public function chiTietDonHang()
    {
        return $this->hasMany(ChiTietDonHang::class, 'MaSanPham', 'MaSanPham');
    }

}

