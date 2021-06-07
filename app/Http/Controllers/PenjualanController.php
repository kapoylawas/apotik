<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Penjualan;
use App\Models\Stockobat;

class PenjualanController extends Controller
{

    public function index()
    {
          $obat = Obat::joinStock()->get();
          $tanggals = Carbon::now()->format('Y-m-d');
          $mytime = Carbon::now();
          $tanggal = $mytime->year . $mytime->month;
          $hitung = Penjualan::count();
          if ($hitung == 0) {
              $urut = 100000001;
              $nomer = 'NT' . $tanggal . $urut;
          }
       return view('owner.penjualan', compact('obat','tanggals', 'nomer'));
    //    return view('owner.penjualan');
    }

    public function getDataObat(Request $request)
    {
        $data = Stockobat::find($request->id)->first();

        return response()->json($data);
    }
}
