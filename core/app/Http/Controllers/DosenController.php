<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\statusHadir;
use DB;
use Auth;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dosenDashboard()
    {
        return view('dosen.dashboard.index');
    }

    public function dataDosen()
    {
        $data = DB::table('users')->where('id',Auth::user()->id)->first();
        return view('dosen.dashboard.data',compact('data'));
    }

    public function dataDosenUpdate(Request $request)
    {
        $data = User::find(Auth::user()->id);
    	if($request->password != ""){
	    		$data->name = $request->name;
	    		$data->nim = $request->nim;
	    		$data->password = bcrypt($request->password);
	    		$data->save();
    	}else{
    			$data->name = $request->name;
	    		$data->nim = $request->nim;
	    		$data->save();
        }
        return redirect()->back()->with('success','berhasil');
    }
    public function dosenMatkul()
    {
        /*$data = DB::table('dosenmatkul')
                ->join('matkul','dosenmatkul.matkul_id','=','matkul.id')
                ->join('users','dosenmatkul.dosen_id','=','users.nim')
                ->get();
        */
        $data = DB::table('krs')
                ->join('dosenmatkul','krs.dosenmatkul_id','=','dosenmatkul.id')
                ->join('matkul','dosenmatkul.matkul_id','=','matkul.id')
                ->select('matkul.*',DB::Raw('count(krs.mahasiswa_id) as jmlmahasiswa'))
                ->where('dosen_id','=',Auth::user()->nim)
                ->groupBy('matkul.nama','matkul.sks','matkul.jam_mulai','matkul.jam_selesai','matkul.id','matkul.hari','matkul.created_at','matkul.updated_at')
                ->orderby('matkul.hari','desc')
                ->get();
        //dd($data);
        return view('dosen.matkul.index',compact('data'));
    }

    public function detailMatkul($id)
    {
        $data = DB::table('absensi')
                ->join('dosenmatkul','dosenmatkul.id','=','absensi.dosenmatkul_id')
                ->join('matkul','matkul.id','=','dosenmatkul.matkul_id')
                ->join('users','users.nim','=','absensi.mahasiswa_id')
                ->select('users.nim','users.name as nama')
                ->where('dosenmatkul.matkul_id','=',$id)
                ->where('absensi.dosen_id','=',Auth::user()->nim)
                ->groupBy('matkul.id','users.nim','users.name')
                ->orderBy('users.name','asc')
                ->get();
                //->toSql();
        //dd($data);

        $data2 = DB::table('krs')
            ->join('dosenmatkul','krs.dosenmatkul_id','=','dosenmatkul.id')
            ->join('matkul','dosenmatkul.matkul_id','=','matkul.id')
            ->join('users','krs.mahasiswa_id','=','users.nim')
            ->join('absensi','krs.mahasiswa_id','=','absensi.mahasiswa_id')
            ->join('users as namadosen','dosenmatkul.dosen_id','=','namadosen.nim')
            //->select('users.name','nim',DB::Raw('count(krs.mahasiswa_id) as jmlmahasiswa'))
            ->select('dosenmatkul.id as dosenmatkulid','matkul.nama as nmatkul','namadosen.nim as dosenid', 'namadosen.name as namadosenya','sks','hari','jam_mulai','jam_selesai','statusbtntap','status_absen','absensi.tanggal as tglabsen')
            ->where('dosenmatkul.matkul_id','=',$id)
            ->where('absensi.dosen_id','=',Auth::user()->nim)
            ->first();
            //->toSql();
        //dd($data2);
        return view('dosen.matkul.detail',compact('data2','data'));
    }

    public function dosenAbsen(Request $request)
    {
        $smatkul = $request->smatkul;
        $stanggal = $request->stanggal;
        $matkul = DB::table('krs')
                ->join('dosenmatkul','krs.dosenmatkul_id','=','dosenmatkul.id')
                ->join('matkul','dosenmatkul.matkul_id','=','matkul.id')
                ->join('users','dosenmatkul.dosen_id','=','users.nim')
                ->select('matkul.nama as nmatkul','matkul.id as matid')
                ->where('users.nim','=',auth::user()->nim)
                ->groupBy('matkul.nama', 'matkul.id')
                ->get();
        $data = "";
        $data2 = "";
        $data3 = "";
        if($request->has('smatkul') && $request->has('stanggal')){
            
            $ambildata = DB::table('krs')
                ->join('dosenmatkul','krs.dosenmatkul_id','=','dosenmatkul.id')
                ->join('matkul','dosenmatkul.matkul_id','=','matkul.id')
                ->join('users as dosennya','dosenmatkul.dosen_id','=','dosennya.nim')
                ->join('users as nmaha','krs.mahasiswa_id','=','nmaha.nim')
                ->select('matkul.nama','dosenmatkul.id as dosenmatkulid','dosennya.nim as dosennim','nmaha.nim as nmahanim')
                ->where('dosennya.nim','=',auth::user()->nim)
                ->where('dosenmatkul.id','=',$smatkul)
                //->groupBy('matkul.nama', 'matkul.id')
                ->get();
            //dd($data2);
            foreach($ambildata as $item) {
                $insert = DB::table('absensi')->updateOrInsert([
                    'dosenmatkul_id' => $item->dosenmatkulid,
                    'dosen_id' =>$item->dosennim,
                    'mahasiswa_id' => $item->nmahanim,
                    'tanggal' => $stanggal,
                ]);

                $absenDosen = DB::table('absen_dosen')->updateOrInsert([
                    'dosenmatkul_id' => $item->dosenmatkulid,
                    'dosen_id' => Auth::user()->nim,
                    'dosen_tanggal_absen' => $stanggal,
                ]);
            } 
            
            $data = DB::table('absensi')
                ->join('dosenmatkul','dosenmatkul.id','=','absensi.dosenmatkul_id')
                ->join('matkul','matkul.id','=','dosenmatkul.matkul_id')
                ->join('users','users.nim','=','absensi.mahasiswa_id')
                ->select('users.nim','users.name as nama','absensi.tanggal as tglabsen','tapin','tapout','status_absen','absensi.id as absenid')
                ->where('dosenmatkul.matkul_id','=',$smatkul)
                ->where('absensi.tanggal','=',$stanggal)
                ->where('absensi.dosen_id','=',Auth::user()->nim)
                ->orderBy('absensi.tanggal','asc')
                ->get();
            
            $data2 = DB::table('krs')
            ->join('dosenmatkul','krs.dosenmatkul_id','=','dosenmatkul.id')
            ->join('matkul','dosenmatkul.matkul_id','=','matkul.id')
            ->join('users','krs.mahasiswa_id','=','users.nim')
            ->join('absensi','krs.mahasiswa_id','=','absensi.mahasiswa_id')
            ->join('users as namadosen','dosenmatkul.dosen_id','=','namadosen.nim')
            //->select('users.name','nim',DB::Raw('count(krs.mahasiswa_id) as jmlmahasiswa'))
            ->select('dosenmatkul.id as dosenmatkulid','matkul.nama as nmatkul','namadosen.nim as dosenid', 'namadosen.name as namadosenya','sks','hari','jam_mulai','jam_selesai','statusbtntap','status_absen','absensi.tanggal as tglabsen','generate_tapin','generate_tapout','status_generate','dosenmatkul.matkul_id as matkulid')
            ->where('dosenmatkul.matkul_id','=',$smatkul)
            ->where('absensi.tanggal','=',$stanggal)
            ->where('absensi.dosen_id','=',Auth::user()->nim)
            ->orderby('absensi.tanggal','desc')
            //->toSql();
            ->first();
        //dd($data2);

            $data3 = DB::table('dosenmatkul')
            ->join('matkul','dosenmatkul.matkul_id','=','matkul.id')
            ->join('absen_dosen','absen_dosen.dosenmatkul_id','=','dosenmatkul.id')
            ->where('dosenmatkul.matkul_id','=',$smatkul)
            ->where('absen_dosen.dosen_tanggal_absen','=',$stanggal)
            ->where('absen_dosen.dosen_id','=',Auth::user()->nim)
            ->first();

            return view('dosen.absen.index',compact('matkul','data','data2','data3','smatkul','stanggal'));
        }else{
            return view('dosen.absen.index',compact('matkul','data','data2','data3','smatkul','stanggal'));
        }    
        
    }

    public function absenDetailDosen(Request $request)
    {
        $smatkul = $request->smatkul;
        $data = "";
        $data2 = "";
        $matkul = DB::table('dosenmatkul')
                ->join('matkul','matkul.id','=','dosenmatkul.matkul_id')
                ->join('users','users.nim','=','dosenmatkul.dosen_id')
                ->select('matkul.nama as nmatkul','matkul.id as matid')
                ->where('dosenmatkul.dosen_id',Auth::user()->nim)
                ->get();
        //dd($matkul);
        if($request->has('smatkul')){
            $data = DB::table('dosenmatkul')
                ->join('matkul','dosenmatkul.matkul_id','=','matkul.id')
                ->join('absen_dosen','absen_dosen.dosenmatkul_id','=','dosenmatkul.id')
                ->where('dosenmatkul.matkul_id','=',$smatkul)
                ->where('absen_dosen.dosen_id','=',Auth::user()->nim)
                ->get();
            //dd($data);
            $data2 = DB::table('dosenmatkul')
                ->join('matkul','dosenmatkul.matkul_id','=','matkul.id')
                ->join('absen_dosen','absen_dosen.dosenmatkul_id','=','dosenmatkul.id')
                ->where('dosenmatkul.matkul_id','=',$smatkul)
                ->where('absen_dosen.dosen_id','=',Auth::user()->nim)
                ->first();
            //dd($data2);
            return view('dosen.absen.absendosen', compact('matkul','smatkul','data','data2'));
        }
        return view('dosen.absen.absendosen', compact('matkul','smatkul','data','data2'));
    }

    public function dosenAbsenTopik(Request $request)
    {
        $data = DB::table('absen_dosen')
                ->where('dosenmatkul_id',$request->smatkul)
                ->where('dosen_tanggal_absen',$request->stanggal)
                ->where('dosen_id',Auth::user()->nim)
                ->update([
                    'dosen_status_absen' =>$request->statushadirdosen,
                    'topik' => $request->dosen_topik
                 ]);
        return redirect()->back()->with('success','Absensi dosen dan topik berhasil di simpan');
        
    }

    public function tapNonAktif($id)
    {
        $data = DB::table('dosenmatkul')->where('matkul_id',$id)->update(['statusbtntap' => 0]);
        return redirect()->back();
    }

    public function tapInAktif($id)
    {
        $data = DB::table('dosenmatkul')->where('matkul_id',$id)->update(['statusbtntap' => 1]);
        return redirect()->back();
    }

    public function tapOutAktif($id)
    {
        $data = DB::table('dosenmatkul')->where('matkul_id',$id)->update(['statusbtntap' => 2]);
        return redirect()->back();
    }

    public function tapAktif($id)
    {
        $data = DB::table('dosenmatkul')->where('matkul_id',$id)->update(['statusbtntap' => 3]);
        return redirect()->back();
    }

    public function statusHadir(Request $request)
    {
        /*$id = $request->input('absenid');
        $data = statusHadir::find($id);
        //dd($data);
        $data->id = $request->absenid;
        $data->status_absen = $request->statushadir;
        $data->save();*/
        
        //dd($request->all());
        foreach ($request->absenid as $key => $value) {
            //dd($value);
            $data = array(
                'id' => $request->absenid[$key],
                'status_absen'=> $request->statushadir[$key],                   
            );
            //dd($request->absenid);         
            /*Cart::where('id',$request->prodId[$key])
            ->update($data);*/
            $save = DB::table('absensi')->where('id',$request->absenid[$key])->update($data); 
            //dd($save);
        }
        return redirect()->back()->with('success','berhasil disimpan');
    }

    public function generateTapIn($id)
    {
        $rand = rand();
        $result = md5($rand);
        $data = DB::table('dosenmatkul')->where('matkul_id',$id)->update(['generate_tapin' => $result]);
        return redirect()->back();
    }

    public function generateTapOut($id)
    {
        $rand = rand();
        $result = md5($rand);
        $data = DB::table('dosenmatkul')->where('matkul_id',$id)->update(['generate_tapout' => $result]);
        return redirect()->back();
    }

    public function genStatusAktif($id)
    {
        $data = DB::table('dosenmatkul')->where('matkul_id',$id)->update(['status_generate' => 1]);
        return redirect()->back();
    }

    public function genStatusDisable($id)
    {
        $data = DB::table('dosenmatkul')->where('matkul_id',$id)->update(['generate_tapin'=> '','generate_tapout'=> '','status_generate' => 0]);
        return redirect()->back();
    }

    public function index()
    {
        //
        $data = User::where('role','dosen')->get();
        //dd($data);
        return view('admindosen.dosenlist', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dosen = new User();
        $dosen->nim = $request->nip;
        $dosen->role = "dosen";
        $dosen->password = bcrypt($request->nip);
        $dosen->name = $request->name;
        $dosen->email = $request->email;
        $dosen->save();

        dd($dosen);
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
