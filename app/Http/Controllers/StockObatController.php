<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Stockobat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StockObatController extends Controller
{
    public function index()
    {
        $obat = Obat::where('ready', 'N')->get();
        $stock = Stockobat::join()->get();
        if (request()->ajax()) {
            return datatables()->of($stock)
                ->addColumn('aksi', function ($stock) {
                    $button = '<button class="edit btn btn-warning btn-sm" id="' . $stock->id . '" name="edit" >Edit</button>';
                    $button .= '  <button class="hapus btn btn-danger btn-sm" id="' . $stock->id . '" name="hapus" >Hapus</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('owner.stockObat', compact('obat'));
    }

    public function store(Request $request)
    {

        $rules = [
            'namaObat' => 'required',
            'beli' => 'required',
            'jual' => 'required',
            'expired' => 'required',
            'keterangan' => 'required',
        ];

        $text = [
            'namaObat.required' => 'Pilih nama obat telebih dahulu',
            'beli.required' => 'Kolom beli tidak boleh kosong',
            'jual.required' => 'Kolom jual tidak boleh kosong',
            'expired.required' => 'Tanggal expired tidak boleh kosong',
            'keterangan.required' => 'Kolom keterangan tidak boleh kosong',

        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $data = new Stockobat();
        $data->namaObat = $request->namaObat;
        $data->masuk = $request->masuk;
        $data->keluar = $request->keluar;
        $data->stock = $request->stock;
        $data->beli = $request->beli;
        $data->jual = $request->jual;
        $data->expired = $request->expired;
        $data->keterangan = $request->keterangan;
        $data->admin = Auth::user()->id;
        $data->save();

        $simpan = $data->save();
        if ($simpan) {
            DB::table('obats')->where('id', $request->namaObat)->update(['ready' => 'Y']);
            return response()->json(['text' => 'Data Berhasil Disimpan'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Disimpan'], 422);
        }
    }

    public function getObat(Request $request)
    {
        $data = Stockobat::where('namaObat', $request->id)->first();
        $null = [
            'stock' => 0
        ];
        if ($data != null) {
            return response()->json(['data' => $data]);
        } else {
            return response()->json(['data' => $null]);
        }
    }

    public function edits(Request $request)
    {
        $id = $request->id;
        $data = Stockobat::join()
            ->where('stockobats.id', $id)
            ->first();

        return response()->json($data);
        // $data = Stockobat::find($request->id);
        // return response()->json($data);
    }

    public function updates(Request $request)
    {

        $datas = [
            'namaObat' => $request->namaObat,
            'masuk' => $request->masuk,
            'keluar' => $request->keluar,
            'beli' => $request->beli,
            'jual' => $request->jual,
            'expired' => $request->expired,
            'stock' => $request->stock,
            'keterangan' => $request->keterangan,
            'admin' => Auth::user()->id,
        ];
        $data = Stockobat::find($request->id);
        $simpan = $data->update($datas);
        if ($simpan) {
            return response()->json(['text' => 'Data Berhasil Diupdate'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Diupdate'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Stockobat::find($request->id);
        $simpan = $data->delete($request->all());
        if ($simpan) {
            DB::table('obats')->where('id', $request->namaObat)->update(['ready' => 'N']);
            return response()->json(['text' => 'Data Berhasil Dihapus'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Dihapus'], 400);
        }
    }

    public function getDataObat(Request $request)
    {
        $data = Stockobat::find($request->id)->first();
        
        return response()->json($data);
    }
}
