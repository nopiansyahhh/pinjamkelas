<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\statusPinjamExport;
use Excel;
use App\ruangan;
use App\gedung;

class RuanganController extends Controller
{
    public function indexRuangan(Request $request)
    {
        $cari = $request->ruangansearch;
        if($request->has('ruangansearch')){
            $data = DB::table('ruangan')
                    ->leftjoin('gedung','gedung.id','=','ruangan.gedung_id')
                    ->where('hari','like','%'.$cari.'%')
                    ->orwhere('ruangan','like','%'.$cari.'%')
                    ->orwhere('gedung','like','%'.$cari.'%')
                    ->orwhere('jamawal','like','%'.$cari.'%')
                    ->select('ruangan.*','ruangan.id as ruanganid','gedung.gedung')
                    ->paginate(10);
            //dd($data);
            //$data = ruangan::all();
            $gedung = gedung::all();
            $hari = ['senin','selasa','rabu','kamis','jumat','sabtu','minggu'];

            return view('ruangan', compact('data','gedung','hari'));
        }else{
        	$data = DB::table('ruangan')
        			->leftjoin('gedung','gedung.id','=','ruangan.gedung_id')
        			->select('ruangan.*','ruangan.id as ruanganid','gedung.gedung')
        			->paginate(10);
        	//$data = ruangan::all();
        	$gedung = gedung::all();
        	$hari = ['senin','selasa','rabu','kamis','jumat','sabtu','minggu'];

        	return view('ruangan', compact('data','gedung','hari'));
        }
    }

    public function ruanganAdd(Request $request)
    {
    	$rules = [
            'gedung_id' => 'required',
            'ruangan' => 'required',
            'jamawal' => 'required|date_format:H:i',
            'jamakhir' => 'required|date_format:H:i|after:jamawal',
        ];
        $pesanCustom = [
            'required' => ':attribute harus diisi',
            'after' => 'jam selesai masih salah',
        ];
        $this->validate($request, $rules, $pesanCustom);

    	$data = ruangan::create($request->all());
    	return redirect('dataruangan')->with('success','data berhasil ditambahkan');
    }

    public function ruanganEdit($id)
    {
    	//$data = $request->all();
    	//dd($data);
    	$data = ruangan::find($id);
    	$gedung = gedung::all();
    	$hari = ['senin','selasa','rabu','kamis','jumat','sabtu','minggu'];
    	return view('ruanganedit', compact('data','gedung','hari'));
    }

    public function ruanganupdate(Request $request, $id)
    {
        $rules = [
            'gedung_id' => 'required',
            'ruangan' => 'required',
            'jamawal' => 'required|date_format:H:i:s',
            'jamakhir' => 'required|date_format:H:i:s|after:jamawal',
        ];
        $pesanCustom = [
            'required' => ':attribute harus diisi',
            'after' => 'jam selesai masih salah',
        ];

        $this->validate($request, $rules, $pesanCustom);

    	$data = ruangan::find($id);
    	$data->update($request->all());
    	return redirect('dataruangan')->with('success','data berhasil diupdate');

    }

    public function ruanganDel($id)
    {
    	$data = ruangan::find($id);
    	$data->delete();
    	return redirect('dataruangan')->with('success','data berhasil dihapus');
    }

    public function exportStatusPinjaman()
    {
        return Excel::download(new statusPinjamExport,'StatusPinjam.xlsx');
    }

}

