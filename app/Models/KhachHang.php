<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    use HasFactory;


    protected $table = 'KhachHang';

    protected $primaryKey = 'MaKhachHang';
    protected $fillable = [
        'MaNguoiDung',
        'HoTen',
        'SoDienThoai',
        'DiaChi',
    ];
    public $timestamps = false;

    public function donHangs()
    {
        return $this->hasMany(DonHang::class, 'MaKhachHang', 'MaKhachHang');
    }
    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'MaNguoiDung', 'MaNguoiDung');
    }
    public function donHang()
    {
        return $this->hasMany(DonHang::class, 'MaKhachHang', 'MaKhachHang');
    }
}

 


