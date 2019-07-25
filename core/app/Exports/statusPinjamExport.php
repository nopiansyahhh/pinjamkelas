<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;
use App\ruangan;
use App\gedung;
use App\pinjamkelas;

class statusPinjamExport implements FromView
{
    public function view(): View
    {
        return view('exportpinjaman', [
            //'data' => pinjamkelas::all(),
            'data' => DB::table('peminjaman')
                    ->Join('ruangan','ruangan.id','=','peminjaman.ruangan_id')
                    ->join('gedung','gedung.id','=','ruangan.gedung_id')
                    ->select('peminjaman.*','peminjaman.status as pinjamstatus','ruangan.*','ruangan.id as ruanganid','peminjaman.id as peminjamanid','gedung')
                    ->orderby('tanggal','asc')
                    ->get()
        ]);
    }
}

