<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class NguoiDung extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'NguoiDung'; // Tên bảng
    protected $primaryKey = 'MaNguoiDung'; // Khóa chính

    public $timestamps = false; // Nếu bạn không dùng created_at, updated_at

    protected $fillable = [
        'TenDangNhap',
        'Email',
        'MatKhau',
        'google_id',
        'VaiTro',
    ];

    protected $hidden = [
        'MatKhau',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Override để Laravel dùng đúng cột mật khẩu
     */
    public function getAuthPassword()
    {
        return $this->MatKhau;
    }

    
    public function createEmployees()
    {
        $nguoiDung = NguoiDung::all(); // Lấy tất cả người dùng
        return view('admin.createEmployees', compact('nguoiDung'));
    }
    public function donHang()
    {
        return $this->hasMany(DonHang::class, 'MaNguoiDung', 'MaNguoiDung');
    }

    public function khachHang()
    {
        return $this->hasOne(KhachHang::class, 'MaNguoiDung', 'MaNguoiDung');
    }

    public function nhanVien()
    {
        return $this->hasOne(NhanVien::class, 'MaNguoiDung', 'MaNguoiDung');
    }
}




