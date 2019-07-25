<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use Charts;
use App\mahasiswa;
use App\User;
use App\pinjamkelas;
use App\ruangan;
use Auth;
class MahasiswaController extends Controller
{
    public function adminDashboard($value='')
    {
         $data = pinjamkelas::select(array(
                    DB::raw("count(ruangan_id) as total"),
                    DB::raw("sum(case when status = 'DITOLAK' then 1 else 0 end) as ditolak"),
                    DB::raw("sum(case when status = 'Menunggu Konfirmasi' then 1 else 0 end) as pending"),
                    DB::raw("sum(case when status = 'DISETUJUI' then 1 else 0 end) as disetujui"),
                ))
                    ->first();
        // chart pie
        $chartpie = Charts::create('pie', 'highcharts')
                      ->title('Presentase Jumlah Peminjam')
                      ->elementLabel('jumlah')
                      ->labels(['Diterima','Ditolak', 'Menunggu Konfirmasi'])
                      ->values([$data->disetujui,$data->ditolak,$data->pending])
                      //->dimensions(1000,500)
                      ->responsive(true);

        //chart bar
         $chartbar = Charts::create('bar', 'highcharts')
                      ->title('Jumlah Detail Peminjam')
                      ->elementLabel('jumlah')
                      ->labels(['Diterima','Ditolak', 'Menunggu Konfirmasi'])
                      ->values([$data->disetujui,$data->ditolak,$data->pending])
                      //->dimensions(1000,500)
                      ->responsive(true);      

        return view('adminDashboard', compact('data','chartpie','chartbar'));
    }

    public function dashboard()
    {
        $data = pinjamkelas::select(array(
                    DB::raw("count(ruangan_id) as total"),
                    DB::raw("sum(case when status = 'DITOLAK' then 1 else 0 end) as ditolak"),
                    DB::raw("sum(case when status = 'Menunggu Konfirmasi' then 1 else 0 end) as pending"),
                    DB::raw("sum(case when status = 'DISETUJUI' then 1 else 0 end) as disetujui"),
                ))
                ->where('mahasiswa_id',Auth::user()->nim)
                ->first();

        $chart = Charts::create('bar', 'highcharts')
              ->title('Pinjaman')
              ->elementLabel('jumlah')
              ->labels(['Diterima','Ditolak', 'Menunggu Konfirmasi'])
              ->values([$data->disetujui,$data->ditolak,$data->pending])
             // ->dimensions(1000,500)
              ->responsive(true);

        return view('mahasiswa.dashboardmahasiswa', compact('data','chart'));
    }
    public function indexMahasiswa(Request $request)
    {
    	DB::statement(DB::Raw('set @row:=0'));
    	$cari = $request->mahasiswacari;
        if($request->has('mahasiswacari')){
            $data = mahasiswa::selectRaw('*,@row:=@row+1 as row')
                    ->where('nim','like','%'.$cari.'%')
                    ->orwhere('nama','like','%'.$cari.'%')
                    ->orwhere('prodi','like','%'.$cari.'%')
                    ->orwhere('semester','like','%'.$cari.'%')
                    ->get();
        	$nim = mahasiswa::orderby('nim','desc')->first();
        	$nimplus = $nim->nim;
        	if($nimplus != 0){
        		$countnim = $nimplus + 1;
        	}else{
        		$countnim = 0110217 + 001;
        	}
        	return view('mahasiswa',compact('data','countnim'));
        }else{
            $data = mahasiswa::selectRaw('*,@row:=@row+1 as row')->get();
            $nim = mahasiswa::orderby('nim','desc')->first();
            $nimplus = $nim->nim;
            if($nimplus != 0){
                $countnim = $nimplus + 1;
            }else{
                $countnim = 0110217 + 001;
            }
            return view('mahasiswa',compact('data','countnim'));
        }

    }

    public function simpanMahasiswa(Request $request)
    {
    	$this->validate($request,[
    		'foto' => 'mimes:jpg,jpeg,png|max:2048'
    	]);
    	//dd($request->all());
    	$user = new User();
    	$user->nim = $request->nim;
    	$user->role = "mahasiswa";
    	$user->password = bcrypt($request->nim);
    	$user->remember_token = str_random(60);
    	$user->save();

    	$data = mahasiswa::create($request->all());
    	//$path = Storage::putFileAs('foto', $request->file('foto'), $request->nim);
    	if ($request->hasFile('foto')){
    		$getFileName = $request->file('foto')->getClientOriginalName();
    		$nameFile = $request->nim.'_'.$getFileName;
    		$request->file('foto')->move('foto/',$nameFile);
    		$data->foto = $nameFile;
    		$data->save();
    	}
    	//dd($name);
    	return redirect('datamahasiswa')->with('success', 'data berhasil ditambahkan');
    }


    public function editMahasiswa($id)
    {
    	$data = mahasiswa::find($id);
    	return view('mahasiswaedit', compact('data'));
    }

    public function updateMahasiswa(Request $request, $id)
    {
        $data = mahasiswa::FindOrFail($id);
        //dd($data->update($request->all()));
        
        /*$this->validate($request,[
            'nim' => 'required|unique:mahasiswa',
        ]);*/
        
           	
    	// hapus foto fisik jika foto didatabase tidak sama dengan foto upload
    	$dbFoto = $data->foto;
    	$fotoTerbaru = $request->file('foto');
	    if($request->hasFile('foto')){
	    	if ($dbFoto != $fotoTerbaru && $dbFoto != 0){
	    		unlink('foto/'.$data->foto);
	    	}
	    }
         $data->update($request->all());
    	// ganti foto fisik dengan yang terbaru
    	if ($request->hasFile('foto')){
    		$gantiFotoFisik = 'foto/'.$data->foto; 
	    	$getFileName = $request->file('foto')->getClientOriginalName();
            $nameFile = $request->nim.'_'.$getFileName;
    		$request->file('foto')->move('foto/',$nameFile);
    		$data->foto = $nameFile;
    		$data->update();
    	}

    	//return redirect('datamahasiswa')->with('success','data berhasil diupdate');
        return redirect()->back()->with('success','data berhasil diupdate');
        
    }

    public function delMahasiswa($id)
    {
    	$data = mahasiswa::find($id);
        //tampilkan nim sesuai id
        $nim = $data->nim;
    	$delFotoFisik = 'foto/'.$data->foto;
    	if(is_file($delFotoFisik)){
    	unlink($delFotoFisik);
    	}
        $data->delete();
        //delete user sesuai nim
        $user = User::where('nim',$nim)->delete();
    	return redirect('/datamahasiswa')->with('success', 'data berhasil di hapus');
    }

    // mahasiswa User

    public function mahasiswaProfile()
    {
        $data = DB::table('mahasiswa')
                ->join('users','users.nim','=','mahasiswa.nim')
                ->where('users.nim','=',Auth::user()->nim)
                ->select('mahasiswa.*', 'mahasiswa.nim as mnim')
                ->first();
        //dd($data->mnim);
        return view('mahasiswa.profile',compact('data'));
    }

    public function mahasiswaRiwayatPinjaman(Request $request)
    {
        $cari = $request->riwayatcari;
        if($request->has('riwayatcari')){
            $data = DB::table('peminjaman')
                    ->Join('ruangan','ruangan.id','=','peminjaman.ruangan_id')
                    ->where('peminjaman.mahasiswa_id','=',Auth::user()->nim)
                    ->where('ruangan','like','%'.$cari.'%')
                    ->orwhere('hari','like','%'.$cari.'%')
                    ->orwhere('peminjaman.status','like','%'.$cari.'%')
                    ->select('peminjaman.*','peminjaman.status as pinjamstatus','ruangan.*','ruangan.id as ruanganid','peminjaman.id as peminjamanid')
                    ->orderby('tanggal','desc')
                    ->paginate(3);
                    return view('mahasiswa.riwayatpinjamanmhs',compact('data'));
        }else{
            $data = DB::table('peminjaman')
                    ->Join('ruangan','ruangan.id','=','peminjaman.ruangan_id')
                    ->where('peminjaman.mahasiswa_id','=',Auth::user()->nim)
                    ->select('peminjaman.*','peminjaman.status as pinjamstatus','ruangan.*','ruangan.id as ruanganid','peminjaman.id as peminjamanid')
                    ->orderby('tanggal','desc')
                    ->paginate(3);
                    //->get();
            return view('mahasiswa.riwayatpinjamanmhs',compact('data'));
        }
    }
}
