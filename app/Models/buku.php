<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class buku extends Model
{
    use HasFactory;
     protected $table = 'buku';
     protected $primaryKey = 'id_buku';
     protected $fillable = ['id_buku','judul_buku','penerbit','keterangan','tahun_terbit'];

     public function pinjam()
     {
        return $this->hasMany(pinjam::class,'id_buku');
     }

}
