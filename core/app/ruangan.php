<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ruangan extends Model
{
    protected $table = 'ruangan';
    protected $fillable = ['gedung_id','ruangan','hari','jamawal','jamakhir','status'];

    public function gedung()
    {
    	return $this->belongsTo('App\gedung');
    }
}
