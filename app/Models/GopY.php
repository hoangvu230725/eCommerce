<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GopY extends Model
{
    use HasFactory;
    protected $table = 'gopy';
    protected $primaryKey = 'MaGopY';

    protected $fillable = [
        'MaNguoiDung',
        'TieuDe',
        'NoiDung',
    ];

    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'MaNguoiDung', 'MaNguoiDung');
    }
}