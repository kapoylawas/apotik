<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Obat;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ObatController extends Controller
{
    public function index()
    {
        $satuan = Satuan::select('id', 'satuan')->get();
        $kategori = Kategori::select('id', 'kategori')->get();
        $data = Obat::join();
        if (request()->ajax()) {
            return datatables()->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = '<button class="edit btn btn-warning btn-sm" id="' . $data->id . '" name="edit" >Edit</button>';
                    $button .= '  <button class="hapus btn btn-danger btn-sm" id="' . $data->id . '" name="hapus" >Hapus</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('owner.obatHome', compact('satuan', 'kategori'));
    }
    
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'nama' => 'required',
            'kode' => 'required|min:8|unique:obats,kode',
            'dosis' => 'required',
            'indikasi' => 'required',
        ];
        
        $text = [
            'nama.required' => 'Kolom nama tidak boleh kosong',
            'kode.required' => 'Kolom kode tidak boleh kosong',
            'kode.min' => 'No Kode Min 8 Digits',
            'kode.unique' => 'No Kode udah terdaftar',
            'dosis.required' => 'Kolom dosis tidak boleh kosong',
            'indikasi.required' => 'Kolom indikasi tidak boleh kosong',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $simpan = Obat::create($request->all());
        if ($simpan) {
            return response()->json(['text' => 'Data Berhasil Disimpan'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Disimpan'], 422);
        }
    }

    public function edits(Request $request)
    {
        // dd($request->all());
        $data = Obat::find($request->id);
        return response()->json($data);
    }

    public function updates(Request $request)
    {
        // dd($request->all());
        $rules = [
            'nama' => 'required',
            'kode' => 'required|min:8',
            'dosis' => 'required',
            'indikasi' => 'required',
        ];

        $text = [
            'nama.required' => 'Kolom nama tidak boleh kosong',
            'kode.required' => 'Kolom kode tidak boleh kosong',
            'kode.min' => 'No Kode Min 8 Digits',
            'dosis.required' => 'Kolom dosis tidak boleh kosong',
            'indikasi.required' => 'Kolom indikasi tidak boleh kosong',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $data = Obat::find($request->id);
        $simpan = $data->update($request->all());
        if ($simpan) {
            return response()->json(['text' => 'Data Berhasil Disimpan'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Disimpan'], 400);
        }
    }

    public function hapus(Request $request)
    {
        $data = Obat::find($request->id);
        $simpan = $data->delete($request->all());
        if ($simpan) {
            return response()->json(['text' => 'Data Berhasil Dihapus'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Dihapus'], 400);
        }
    }
}
