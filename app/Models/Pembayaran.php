<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'faktur',
        'total',
        'diskonBayar',
        'pajakBayar',
        'dibayars',
        'kembaliBayar',
        'statusBayar',
    ];
}
