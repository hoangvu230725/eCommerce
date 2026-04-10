<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoiDungWebsite extends Model
{
    use HasFactory;
    protected $table = 'noidungwebsite';
    protected $primaryKey = 'MaNoiDung';
    public $timestamps = true;

    protected $fillable = [
        'TieuDe',
        'NoiDung',
        'Loai'
    ];
}
