<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\pinjam;
use Illuminate\Support\Facades\Validator;

class pinjamController extends Controller
{
    // tampil
    public function index()
    {
        $datas = pinjam::all();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $datas
        ], 200);
    }
    // tampil berdasarkan id
    public function show($id)
    {
        $data = pinjam::where('id_pinjam',$id)->first();
        if (empty($data)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        return response()->json(['pesan' => 'Data Berhasil Ditemukan', 'data' => $data], 200);
    }
    // create
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'id_buku' => 'required',
            'id_mahasiswa' => 'required',
            'buku_pinjaman' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'required',
        ]);
        if ($validasi->fails()) {
            return response()->json(['pesan' => 'data gagal ditambahkan', 'data' => $validasi->errors()->all()], 404);
        }
        $data = pinjam::create($request->all());
        return response()->json(['pesan' => 'data berhasil ditambahkan', 'data' => $data], 200);
    }
    // update
    public function update(Request $request, $id)
    {
        $pinjams = pinjam::where('id_pinjam',$id)->first();
        if (empty($pinjams)) {
            return response()->json(['pesan' => 'data tidak ditemukan', 'data' => ''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
            'id_buku' => 'required',
            'id_mahasiswa' => 'required',
            'buku_pinjaman' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'required',
            ]);
            if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $pinjams->update($request->all());
            return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $pinjams], 200);
        }
    }
    // Hapus
    public function destroy($id)
    {
        $pinjams = pinjam::where('id_pinjam',$id)->first();
        if (empty($pinjams)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        $pinjams->delete();
        return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $pinjams]);
    }
    // tes relasi
    public function relasi_pinjam()
    {
        $pinjams = pinjam::with('mahasiswa','buku')->get();
        return response()->json(['pesan' => 'Data Berhasil ditemukan', 'data' => $pinjams], 200);
    }
}