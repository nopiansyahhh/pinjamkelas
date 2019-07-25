<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pinjamkelas extends Model
{
    protected $table = 'peminjaman';
    protected $fillable = ['ruang_id','mahasiswa_id','tanggal','ket','kettolak','status'];

    protected $dates = ['tanggal'];
}
