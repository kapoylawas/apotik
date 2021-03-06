<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Stockobat extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'namaObat',
        'masuk',
        'keluar',
        'beli',
        'jual',
        'expired',
        'stock',
        'keterangan',
        'admin',
    ];

    public static function join()
    {
        $data = DB::table('stockobats')
            ->join('obats', 'obats.id', 'stockobats.namaObat')
            ->join('users', 'users.id', 'stockobats.admin')
            ->select('stockobats.*', 'obats.nama as namaObat', 'users.name as admins');
        return $data;
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
