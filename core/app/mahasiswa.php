<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    //
    protected $table = 'mahasiswa';
    protected $fillable = ['nim','nama','email','jk','nohp','prodi','tanggalahir','semester','prodi','alamat','foto','status'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
