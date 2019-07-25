<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gedung extends Model
{
    protected $table = "gedung";
    protected $fillable = ["gedung","status"];

    public function ruangan()
    {
    	//return $this->hasMany('App\ruangan');
    }
}
