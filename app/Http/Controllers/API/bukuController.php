<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\buku;
use Illuminate\Support\Facades\Validator;

class bukuController extends Controller
{
    // menampilkan semua data
    public function index()
    {
        $bukus = buku::all();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $bukus
        ], 200);
    }
    // tampil berdasarkan id
    public function show($id)
    {
        $bukus = buku::where('id_buku',$id)->first();
        if (empty($bukus)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        return response()->json(['pesan' => 'Data Berhasil Ditemukan', 'data' => $bukus], 200);
    }
    // tambah data produk
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            
            'judul_buku' => 'required',
            'penerbit' => 'required',
            'keterangan' => 'required',
            'tahun_terbit' => 'required'
        ]);
        if ($validate->fails()) {
            return response()->json(['pesan' => 'data gagal ditambahkan', 'data' => $validate->errors()->all()], 404);
        }
        $data = buku::create($request->all());
        return response()->json(['pesan' => 'data berhasil ditambahkan', 'data' => $data], 200);
    }
    // update data produk
    public function update(Request $request, $id)
    {
        $bukus = buku::where('id_buku',$id)->first();
        if (empty($bukus)) {
            return response()->json(['pesan' => 'data tidak ditemukan', 'data' => ''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'judul_buku' => 'required',
                'penerbit' => 'required',
                'keterangan' => 'required',
                'tahun_terbit' => 'required'
            ]);
            if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $bukus->update($request->all());
            return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $bukus], 200);
        }
    }
    // Hapus data berdasarkan id
    public function destroy($id)
    {
        $bukus = buku::where('id_buku',$id)->first();
        if (empty($bukus)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        $bukus->delete();
        return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $bukus]);
    }
      // tes relasi
      public function indexRelasi()
      {
          $bukus = buku::with('pinjam')->get();
          return response()->json(['pesan' => 'Data Berhasil ditemukan', 'data' => $bukus], 200);
      }
   
}