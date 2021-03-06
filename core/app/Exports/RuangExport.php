<?php

namespace App\Exports;

use App\ruangan;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class RuangExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return ruangan::all();
        $data = DB::table('ruangan')
        			->join('gedung','gedung.id','=','ruangan.gedung_id')
        			->select('gedung','ruangan','hari','jamawal','jamakhir','ruangan.status as stat')
        			->get();
        return $data;
    }
}
