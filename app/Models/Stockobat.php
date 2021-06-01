<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stockobat extends Model
{
    use HasFactory;
    protected $fillable = [
        'idObat',
        'masuk',
        'keluar',
        'beli',
        'jual',
        'expired',
        'stock',
        'keteranganStock',
    ];
}
