<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ruangan;
use App\gedung;
use App\pinjamkelas;


class PinjamCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('ruangan')
                    ->leftjoin('gedung','gedung.id','=','ruangan.gedung_id')
                    ->select('ruangan.*','ruangan.id as ruanganid','gedung.gedung')
                    ->get();
        return Response($data);

    }

    public function statusPeminjaman()
    {
        $data = DB::table('peminjaman')
                    ->Join('ruangan','ruangan.id','=','peminjaman.ruangan_id')
                    ->join('gedung','gedung.id','=','ruangan.gedung_id')
                    ->select('peminjaman.*','peminjaman.status as pinjamstatus','ruangan.*','ruangan.id as ruanganid','peminjaman.id as peminjamanid','gedung')
                    ->orderby('tanggal','desc')
                    ->get();
        return Response($data);
    }

    public function createPeminjaman(Request $request)
    {
        //
        $insert = new pinjamkelas();
        $insert->ruangan_id = $request->ruangan_id;
        $insert->mahasiswa_id = $request->mahasiswa_id;
        $insert->tanggal = $request->tanggal;
        $insert->ket = $request->ket;
        $insert->status = "Menunggu Konfirmasi";
        $insert->save();
        return Response($insert);
        /*if($insert){
            return Response()->json(['message' => 'Berhasil diinput'],200);    
        }else{
            return Response()->json(['message' => 'Gagal'],500);
        }*/
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
