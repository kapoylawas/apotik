<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
     public function index()
     {
          $data = Supplier::all();
     //     return response()->json($data);
               if (request()->ajax()) {
               return datatables()->of($data)
               ->addColumn('aksi', function ($data)
               {
                    $button = '<button class="edit btn btn-warning btn-sm" id="'.$data->id.'" name="edit" >Edit</button>';
                    $button .= '  <button class="hapus btn btn-danger btn-sm" id="'.$data->id.'" name="hapus" >Hapus</button>';
                    return $button;
               })
               ->rawColumns(['aksi'])
               ->make(true);
               }
          return view('owner.SupplierHome'); 
     }
     // public function getSupplier(){
     //      $data = Supplier::all();
     // //     return response()->json($data);
     //           return datatables()->of($data)
     //           ->addColumn('aksi', function ($data)
     //           {
     //                $button = '<button class="edit btn btn-warning" id="'.$data->id.'" name="edit" >Edit</button>';
     //                $button .= '<button class="hapus btn btn-danger" id="'.$data->id.'" name="hapus" >Hapus</button>';
     //                return $button;
     //           })
     //           ->rawColumns(['aksi'])
     //           ->make(true);
          
     // }
     
     public function store(Request $request)
     {
          // dd($request->all());
          $rules = [
               'nama' => 'required',
               'telp' => 'required|min:12|unique:suppliers,telp',
               'email' => 'required|unique:suppliers,email',
               'rekening' => 'required|unique:suppliers,rekening',
               'alamat' => 'required',
          ];

          $text = [
               'nama.required' => 'Kolom nama tidak boleh kosong',
               'telp.required' => 'Kolom telp tidak boleh kosong',
               'telp.unique' => 'No telp udah terdaftar',
               'telp.min' => 'No telp kurang dari 12 digit',
               'email.required' => 'Kolom email tidak boleh kosong',
               'email.unique' => 'Email udah terdaftar',
               'rekening.required' => 'Kolom rekening tidak boleh kosong',
               'rekening.unique' => 'No Rekening udah terdaftar',
               'alamat.required' => 'Kolom alamat tidak boleh kosong',
          ];

          $validasi = Validator::make($request->all(),$rules, $text);
          if ($validasi->fails()) {
               return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
          }

          $simpan = Supplier::create($request->all());
          if ($simpan) {
               return response()->json(['text' => 'Data Berhasil Disimpan'], 200);
          }else {
               return response()->json(['text' => 'Data Gagal Disimpan'], 422);
          }
     }

     public function edits(Request $request)
     {
          // dd($request->all());
          $data = Supplier::find($request->id);
          return response()->json($data);
     }

     public function updates(Request $request)
     {
          // dd($request->all());
          $rules = [
               'nama' => 'required',
               'telp' => 'required|min:12',
               'email' => 'required',
               'rekening' => 'required',
               'alamat' => 'required',
          ];

          $text = [
               'nama.required' => 'Kolom nama tidak boleh kosong',
               'telp.required' => 'Kolom telp tidak boleh kosong',
               'telp.min' => 'No telp kurang dari 12 digit',
               'email.required' => 'Kolom email tidak boleh kosong',
               'rekening.required' => 'Kolom rekening tidak boleh kosong',
               'alamat.required' => 'Kolom alamat tidak boleh kosong',
          ];

          $validasi = Validator::make($request->all(), $rules, $text);
          if ($validasi->fails()) {
               return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
          }

          $data = Supplier::find($request->id);
          $simpan = $data->update($request->all());
          if ($simpan) {
               return response()->json(['text' => 'Data Berhasil Disimpan'], 200);
          }else {
               return response()->json(['text' => 'Data Gagal Disimpan'], 400);
          }
     }

     public function hapus(Request $request)
     {
          $data = Supplier::find($request->id);
          $simpan = $data->delete($request->all());
          if ($simpan) {
               return response()->json(['text' => 'Data Berhasil Dihapus'], 200);
          }else {
               return response()->json(['text' => 'Data Gagal Dihapus'], 400);
          }
     }
}
