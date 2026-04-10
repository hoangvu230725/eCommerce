<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    use HasFactory;

    protected $table = 'NhanVien';

    protected $primaryKey = 'MaNhanVien';

    protected $fillable = [
        'MaNguoiDung',
        'HoTen',
        'SoDienThoai',
        'ChucVu',
    ];

    public $timestamps = false;

    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'MaNguoiDung', 'MaNguoiDung');
    }
}