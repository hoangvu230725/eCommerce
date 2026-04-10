<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    use HasFactory;

    protected $table = 'DanhMuc';
    public $timestamps = false; 
    protected $primaryKey = 'MaDanhMuc'; // Khóa chính
    
    protected $fillable = [
        'TenDanhMuc',
        'MoTa',
        'NgayTao',
    ];
    protected $casts = [
        'NgayTao' => 'datetime',
    ];
}

