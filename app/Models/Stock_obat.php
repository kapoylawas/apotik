<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock_obat extends Model
{
    use HasFactory;
    protected $fillable = [
        'masuk',
        'keluar',
        'beli',
        'jual',
        'expired',
        'stock',
        'keteranganStock',
    ];
}
