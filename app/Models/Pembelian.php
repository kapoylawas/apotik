<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $fillable = [
        'faktur',
        'jual',
        'item',
        'qtyBeli',
        'totalKotor',
        'diskonBeli',
        'totalBersih',
        'tanggal',
        'ketranganBeli',
        'pajakBeli',
    ];
}
}
