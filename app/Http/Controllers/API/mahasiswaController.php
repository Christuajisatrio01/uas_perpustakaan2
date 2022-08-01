<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\mahasiswa;
use Illuminate\Support\Facades\Validator;

class mahasiswaController extends Controller
{
    // menampilkan semua data
    public function index()
    {
        $mahasiswas = mahasiswa::all();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $mahasiswas
        ], 200);
    }
    // tampil berdasarkan id
    public function show($id)
    {
        $mahasiswas = mahasiswa::where('id_mahasiswa',$id)->first();
        if (empty($mahasiswas)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        return response()->json(['pesan' => 'Data Berhasil Ditemukan', 'data' => $mahasiswas], 200);
    }
    // tambah data produk
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nim_mahasiswa' => 'required',
            'nama_mahasiswa' => 'required',
            'no_hp' => 'required',
            'alamat_mahasiswa' => 'required'
        ]);
        if ($validate->fails()) {
            return response()->json(['pesan' => 'data gagal ditambahkan', 'data' => $validate->errors()->all()], 404);
        }
        $data = mahasiswa::create($request->all());
        return response()->json(['pesan' => 'data berhasil ditambahkan', 'data' => $data], 200);
    }
    // update data produk
    public function update(Request $request, $id)
    {
        $mahasiswas = mahasiswa::where('id_mahasiswa',$id)->first();
        if (empty($mahasiswas)) {
            return response()->json(['pesan' => 'data tidak ditemukan', 'data' => ''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'nim_mahasiswa' => 'required',
                'nama_mahasiswa' => 'required',
                'no_hp' => 'required',
                'alamat_mahasiswa' => 'required'
            ]);
            if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $mahasiswas->update($request->all());
            return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $mahasiswas], 200);
        }
    }
    // Hapus data berdasarkan id
    public function destroy($id)
    {
        $mahasiswas = mahasiswa::where('id_mahasiswa',$id)->first();
        if (empty($mahasiswas)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        $mahasiswas->delete();
        return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $mahasiswas]);
    }
        // tes relasi
        public function indexRelasi()
        {
            $bukus = mahasiswa::with('pinjam')->get();
            return response()->json(['pesan' => 'Data Berhasil ditemukan', 'data' => $bukus], 200);
        }
   
}