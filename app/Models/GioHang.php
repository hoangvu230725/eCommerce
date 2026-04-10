<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GioHang extends Model
{
    use HasFactory;
    protected $table ='GioHang';
    protected $primaryKey = 'MaGioHang';
    
     protected $fillable= [
        'MaNguoiDung',
        'MaSanPham',
        'SoLuong',
        'TenSanPham',
     ];

     public function sanpham(){
        return $this->belongsTo(SanPham::class, 'MaSanPham', 'MaSanPham');
     }
     public function nguoidung(){
        return $this->belongsTo(NguoiDung::class,'MaNguoiDung','MaNguoiDung');
     }
}
