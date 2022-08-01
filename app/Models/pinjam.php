<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pinjam extends Model
{
    use HasFactory;
    protected $table = 'pinjam';
    protected $primaryKey = 'id_pinjam';
    public $timestamps = true;
    protected $fillable = ['id_pinjam','id_buku','id_mahasiswa','buku_pinjaman','tanggal_pinjam','tanggal_kembali'];

    public function mahasiswa()
    {
       return $this->belongsTo(mahasiswa::class,'id_mahasiswa');
    }
    public function buku()
    {
       return $this->belongsTo(buku::class,'id_buku');
    }
}
