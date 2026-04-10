<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatBox extends Model
{
    use HasFactory;

    protected $table = 'ChatBox';
    protected $primaryKey = 'MaChat';
    public $timestamps = false;

    protected $fillable = [
        'MaNguoiDung',
        'MaNhanVien',
        'NoiDung',
        'NguoiGui',
        'ThoiGian',
    ];

    // Quan hệ đến người dùng (khách hàng)
    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'MaNguoiDung', 'MaNguoiDung');
    }

    // Quan hệ đến nhân viên
    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'MaNhanVien', 'MaNhanVien');
    }
}
