<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ruangan;
use App\gedung;
use App\pinjamkelas;
use Auth;
use App\User;

class PinjamController extends Controller
{
    public function indexPinjam(Request $request)
    {
        $cari = $request->pinjamsearch;
        if($request->has('pinjamsearch')){
            $data = DB::table('ruangan')
                    ->leftjoin('gedung','gedung.id','=','ruangan.gedung_id')
                    ->where('hari','like','%'.$cari.'%')
                    ->orwhere('ruangan','like','%'.$cari.'%')
                    ->orwhere('gedung','like','%'.$cari.'%')
                    ->orwhere('jamawal','like','%'.$cari.'%')
                    ->select('ruangan.*','ruangan.id as ruanganid','gedung.gedung')
                    ->paginate(10);
    	
        	$gedung = gedung::all();
        	$hari = ['senin','selasa','rabu','kamis','jumat','sabtu','minggu'];
        	return view('pinjamkelas', compact('data','gedung','hari'));
        }else{
            $data = DB::table('ruangan')
                    ->leftjoin('gedung','gedung.id','=','ruangan.gedung_id')
                    ->select('ruangan.*','ruangan.id as ruanganid','gedung.gedung')
                    ->paginate(10);
            //$data = ruangan::all();
            $gedung = gedung::all();
            $hari = ['senin','selasa','rabu','kamis','jumat','sabtu','minggu'];
            return view('pinjamkelas', compact('data','gedung','hari'));
        }
    }

    public function pinjamViewAdd($id)
    {
    	//$data = ruangan::find($id);
    	$data = DB::table('ruangan')
    			->leftjoin('gedung','gedung.id','=','ruangan.gedung_id')
    			->select('ruangan.*','ruangan.id as ruanganid','gedung.gedung')
    			->where('ruangan.id','=',$id)
    			->get();
    	$gedung = gedung::all();
    	return view('pinjamadd',compact('data','gedung'));
    }

    public function pinjamAdd(Request $request, $id)
    {
        $ruangan = ruangan::find($id);
        $ruangId = $ruangan->id;
        $dataPinjam = pinjamkelas::where('ruangan_id',$ruangId)
                        ->where('tanggal',$request->tanggal)
                        ->get();

        //translate hari didatabase ke hari di front end
        $daftar_hari = array(
         'Sunday' => 'minggu',
         'Monday' => 'senin',
         'Tuesday' => 'selasa',
         'Wednesday' => 'rabu',
         'Thursday' => 'kamis',
         'Friday' => 'jumat',
         'Saturday' => 'sabtu',
        );

        
        //menampilkan nama hari dari input tanggal
        $inputTanggal = $request->tanggal;
        $ambil_hari = date('l', strtotime($inputTanggal));

        //nama hari dicocokan dengan hari di table ruangan
        //sebenernya si hari siapa sih, disebut-sebut mulu
        $hari = $daftar_hari[$ambil_hari];
        $hariIni = date('Y-m-d');
        
        if($dataPinjam->isEmpty()){
            if($hari == $ruangan->hari){
                if ($hariIni <= $inputTanggal){    
                    $data = new pinjamkelas;
                    $data->ruangan_id = $id;
                    if(Auth::user()->role == 'mahasiswa'){
                        $data->mahasiswa_id = Auth::User()->nim;
                    }else{
                        $data->mahasiswa_id = $request->nim;
                    }
                    $data->tanggal = $request->tanggal;
                    $data->ket = $request->ket;
                    $data->status = 'Menunggu Konfirmasi';
                    $data->save();
                    return redirect('statuspinjam')->with('success','berhasil mengajukan pinjaman, harap menunggu konfirmasi dari Admin Kampus');
                }else{
                    return redirect()->back()->with('danger','Tanggalnya sudah lewat dong, masih belum bisa move on aja dari masa lalu');
                }
            
            }else{
                return redirect()->back()->with('danger','hari peminjaman berbeda, coba cek lagi hari nya pake fengsui');
            }
        }else{

            foreach($dataPinjam as $datas){

                $tanggalBook = date('Y-m-d', strtotime($datas->tanggal));
                
                if($dataPinjam->count() == 0){
                        if($hari == $ruangan->hari){
                            if ($hariIni <= $inputTanggal){    
                                $data = new pinjamkelas;
                                $data->ruangan_id = $id;
                                if(Auth::user()->role == 'mahasiswa'){
                                    $data->mahasiswa_id = Auth::User()->nim;
                                }else{
                                    $data->mahasiswa_id = $request->nim;
                                }
                                $data->tanggal = $request->tanggal;
                                $data->ket = $request->ket;
                                $data->status = 'Menunggu Konfirmasi';
                                $data->save();
                                return redirect('statuspinjam')->with('success','berhasil mengajukan pinjaman, harap menunggu konfirmasi dari Admin Kampus');
                            }else{
                                return redirect()->back()->with('danger','Tanggalnya sudah lewat dong, masih belum bisa move on aja dari masa lalu');
                            }
                        
                        }else{
                            return redirect()->back()->with('danger','hari peminjaman berbeda, coba cek lagi hari nya pake fengsui');
                        }
                }else{
                    return redirect()->back()->with('danger','Tanggalnya sudah ada yang nikung, makanya booking agak cepet');
                }    
            } 
        } 
    }
}
