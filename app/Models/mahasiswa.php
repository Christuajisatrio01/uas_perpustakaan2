<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';
    public $timestamps = true;
    protected $fillable = ['id_mahasiswa','nim_mahasiswa','nama_mahasiswa','no_hp','alamat_mahasiswa'];

    public function pinjam()
    {
       return $this->hasMany(pinjam::class,'id_mahasiswa');
    }
}
