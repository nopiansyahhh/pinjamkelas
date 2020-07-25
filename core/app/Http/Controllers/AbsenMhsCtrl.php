<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Charts;

class AbsenMhsCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboardmhs()
    {
        {
            /*$data = pinjamkelas::select(array(
                        DB::raw("count(ruangan_id) as total"),
                        DB::raw("sum(case when status_absen = 'hadir' then 1 else 0 end) as hadir"),
                        DB::raw("sum(case when status_absen = 'sakit' then 1 else 0 end) as sakit"),
                        DB::raw("sum(case when status_absen = 'mangkir' then 1 else 0 end) as mangkir"),
                    ))
                    ->where('mahasiswa_id',Auth::user()->nim)
                    ->first();*/
                $data = DB::table('absensi')
                        ->select(array(
                            DB::raw("count(mahasiswa_id) as total"),
                            DB::raw("sum(case when status_absen = 0 then 1 else 0 end) as belumabsen"),
                            DB::raw("sum(case when status_absen = 'hadir' then 1 else 0 end) as hadir"),
                            DB::raw("sum(case when status_absen = 'sakit' then 1 else 0 end) as sakit"),
                            DB::raw("sum(case when status_absen = 'mangkir' then 1 else 0 end) as mangkir")
                        ))
                        ->where('mahasiswa_id',Auth::user()->nim)
                        ->first();
                //dd($data);
    
            $chart = Charts::create('bar', 'highcharts')
                  ->title('Absensi')
                  ->elementLabel('')
                  ->labels(['hadir','sakit', 'mangkir'])
                  ->values([$data->hadir,$data->sakit,$data->mangkir])
                 // ->dimensions(1000,500)
                  ->responsive(true);
    
            return view('mahasiswa.dashboardabsen', compact('data','chart'));
        }
    }
    public function index(Request $request)
    {
        $smatkul = $request->smatkul;
        $data = "";
        $data2 = "";
        //$matkul = DB::table('matkul')->get();
        $matkul = DB::table('krs')
                ->join('dosenmatkul','krs.dosenmatkul_id','=','dosenmatkul.id')
                ->join('matkul','dosenmatkul.matkul_id','=','matkul.id')
                ->join('users','krs.mahasiswa_id','=','users.nim')
                ->select('matkul.nama as nmatkul','matkul.id as matid')
                ->where('users.nim','=',auth::user()->nim)
                ->get();

        if($request->has('smatkul')){
            /*select absensi.dosenmatkul_id, absensi.dosen_id, absensi.mahasiswa_id, absensi.tanggal, absensi.tapin, absensi.tapout, matkul.nama, users.name FROM absensi
            INNER JOIN dosenmatkul on dosenmatkul.id = absensi.dosenmatkul_id
            INNER JOIN matkul on matkul.id = dosenmatkul.matkul_id
            INNER JOIN users on users.nim = absensi.mahasiswa_id*/

            $data = DB::table('absensi')
                ->join('dosenmatkul','dosenmatkul.id','=','absensi.dosenmatkul_id')
                ->join('matkul','matkul.id','=','dosenmatkul.matkul_id')
                ->join('users','users.nim','=','absensi.mahasiswa_id')
                ->select('users.nim','users.name as nama','absensi.tanggal as tglabsen','tapin','tapout','status_absen')
                ->where('dosenmatkul.matkul_id','=',$smatkul)
                ->where('absensi.mahasiswa_id','=',Auth::user()->nim)
                ->orderBy('absensi.tanggal','asc')
                ->get();

           /* $data = DB::table('krs')
                ->join('dosenmatkul','krs.dosenmatkul_id','=','dosenmatkul.id')
                ->join('matkul','dosenmatkul.matkul_id','=','matkul.id')
                ->join('users','krs.mahasiswa_id','=','users.nim')
                ->join('absensi','krs.mahasiswa_id','=','absensi.mahasiswa_id')
                ->select('users.nim','users.name as nama','absensi.tanggal as tglabsen','tapin','tapout','status_absen','matkul.nama as nmatkul','sks','hari','jam_mulai','jam_selesai')
                ->where('dosenmatkul.matkul_id','=',$smatkul)
                ->where('absensi.mahasiswa_id','=',Auth::user()->nim)
                ->orderBy('absensi.tanggal','asc')
                //->toSql();
                ->get();*/
            //dd($data);

            $data2 = DB::table('krs')
                ->join('dosenmatkul','krs.dosenmatkul_id','=','dosenmatkul.id')
                ->join('matkul','dosenmatkul.matkul_id','=','matkul.id')
                ->join('users','krs.mahasiswa_id','=','users.nim')
                ->join('absensi','krs.mahasiswa_id','=','absensi.mahasiswa_id')
                ->join('users as namadosen','dosenmatkul.dosen_id','=','namadosen.nim')
                //->select('users.name','nim',DB::Raw('count(krs.mahasiswa_id) as jmlmahasiswa'))
                ->select('matkul.nama as nmatkul','namadosen.nim as dosenid', 'namadosen.name as namadosenya','sks','hari','jam_mulai','jam_selesai','statusbtntap','status_absen','absensi.tanggal as tglabsen','generate_tapin','generate_tapout','status_generate','dosenmatkul.matkul_id as matkulid')
                ->where('dosenmatkul.matkul_id','=',$smatkul)
                ->where('absensi.mahasiswa_id','=',Auth::user()->nim)
                ->orderby('absensi.tanggal','desc')
                //->toSql();
                ->first();
            //dd($data2);
            return view('mahasiswa.absenmahasiswa',compact('data','data2','matkul','smatkul'));
        }else{
            return view('mahasiswa.absenmahasiswa',compact('data','data2','matkul','smatkul'));
        }
       
    }

    public function tapin(Request $request)
    {
        $tgl = date('Y-m-d');
        $data = DB::table('absensi')
                ->where('dosen_id','=',$request->dosen)
                ->where('mahasiswa_id','=',auth::user()->nim)
                ->where('tanggal','=',$tgl)
                ->update(
                    ['tapin'=>date('H:i:00'),'status_absen' => 'belum tapout']
                );
        return redirect()->back()->with('success','Tap In Berhasil');
    }

    public function tapout(Request $request)
    {
        $tgl = date('Y-m-d');
        $data = DB::table('absensi')
                ->where('dosen_id','=',$request->dosen)
                ->where('mahasiswa_id','=',auth::user()->nim)
                ->where('tanggal','=',$tgl)
                ->update(
                    ['tapout'=>date('H:i:00'),'status_absen' => 'hadir']
                );
        return redirect()->back()->with('success','Tap Out Berhasil');
    }

    public function absenTokenIn(Request $request,$id)
    {
        $tgl = date('Y-m-d');
        $data = DB::table('dosenmatkul')->where('matkul_id',$id)->first();
        if($data->generate_tapin == $request->gentapin){
            $save = DB::table('absensi')
                ->where('dosen_id','=',$request->dosen)
                ->where('mahasiswa_id','=',auth::user()->nim)
                ->where('tanggal','=',$tgl)
                ->update(
                    ['tapin'=>date('H:i:00'),'status_absen' => 'belum tapout']
                );
            return redirect()->back()->withInput()->with('success','Tap In Berhasil');
        }else{
            return redirect()->back()->withInput()->with('error','token tidak sama');
        }
    }

    public function absenTokenOut(Request $request,$id)
    {
        $tgl = date('Y-m-d');
        $data = DB::table('dosenmatkul')->where('matkul_id',$id)->first();
        if($data->generate_tapout == $request->gentapout){
            $save = DB::table('absensi')
                ->where('dosen_id','=',$request->dosen)
                ->where('mahasiswa_id','=',auth::user()->nim)
                ->where('tanggal','=',$tgl)
                ->update(
                    ['tapout'=>date('H:i:00'),'status_absen' => 'hadir']
                );
            return redirect()->back()->withInput()->with('success','Tap Out Berhasil');
        }else{
            return redirect()->back()->withInput()->with('errorr','token tidak sama');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
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
