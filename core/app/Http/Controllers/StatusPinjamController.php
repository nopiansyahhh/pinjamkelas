<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\pinjamkelas;
use App\Exports\statusPinjamExport;
use App\ruangan;
use Excel;

class StatusPinjamController extends Controller
{
    public function indexStatusPinjam(Request $request)
    {
        $cari = $request->statuspinjamsearch;
        if($request->has('statuspinjamsearch')){
        	$data = DB::table('peminjaman')
        			->Join('ruangan','ruangan.id','=','peminjaman.ruangan_id')
                    ->join('gedung','gedung.id','=','ruangan.gedung_id')
        			->select('peminjaman.*','peminjaman.status as pinjamstatus','ruangan.*','ruangan.id as ruanganid','peminjaman.id as peminjamanid','gedung')
                    ->where('mahasiswa_id','like','%'.$cari.'%')
                    ->orwhere('ruangan','like','%'.$cari.'%')
                    ->orwhere('gedung','like','%'.$cari.'%')
        			->orwhere('hari','like','%'.$cari.'%')
                    ->orwhere('tanggal','like','%'.$cari.'%')
                    ->orwhere('peminjaman.status','like','%'.$cari.'%')
                    ->orderby('tanggal','desc')
        			->paginate(10);
        	return view('statuspinjam',compact('data'));
        }else{
            $data = DB::table('peminjaman')
                    ->Join('ruangan','ruangan.id','=','peminjaman.ruangan_id')
                    ->join('gedung','gedung.id','=','ruangan.gedung_id')
                    ->select('peminjaman.*','peminjaman.status as pinjamstatus','ruangan.*','ruangan.id as ruanganid','peminjaman.id as peminjamanid','gedung')
                    ->orderby('tanggal','asc')
                    ->paginate(10);
            return view('statuspinjam',compact('data'));
        }
    }

    public function konfirmDetail($id)
    {
    	$data = DB::table('peminjaman')
    			->leftJoin('ruangan','ruangan.id','=','peminjaman.ruangan_id')
    			->leftJoin('gedung','gedung.id','=','ruangan.gedung_id')
    			->select('peminjaman.*','peminjaman.status as pinjamstatus','ruangan.ruangan','ruangan.hari','ruangan.jamawal','ruangan.jamakhir','peminjaman.id as peminjamanid ','gedung.gedung','peminjaman.status as peminjamanstatus')
    			->where('peminjaman.id',$id)
    			->get();
    	//dd($data);
    	return view('detailkonfirmasi',compact('data'));
    }

    public function konfirmUpdate(Request $request,$id)
    {
    	$data = pinjamkelas::find($id);
    	$data->update($request->all());

    	return redirect('statuspinjam')->with('success','data berhasil di update');
    }

    public function exportStatusPinjaman()
    {
        return Excel::download(new statusPinjamExport,'statuspinjaman.xlsx');
    }
}
