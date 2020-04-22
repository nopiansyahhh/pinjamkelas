<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\gedung;
use App\ruangan;
use Response;
use DB;
class GedungController extends Controller
{
    //
    public function gedungAjax()
    {
        
        DB::statement(DB::raw('set @row:=0'));
        $data = gedung::selectRaw('*,@row:=@row+1 as row')
                ->get();

        return view('gedungajax',compact('data'));
        //return json_encode($data);
    }

    public function gedungAjaxAdd(Request $request)
    {
        //dd($request->all());
        $data = gedung::create($request->all());
        return Response::json($data);
    }

    public function gedungAjaxEdit($id)
    {
        $gedung_id = array('id' => $id);
        $data = gedung::where($gedung_id)->first();
        //dd($data);
        return Response::json($data);
    }

    public function gedungAjaxUpdate(Request $request, $id)
    {
        $data = gedung::find($id);
        $data->update($request->all());
        return Response::json($data);
    }

    public function gedungAjaxDel($id)
    {
        $data = gedung::find($id);
        $data->delete();

        return Response::json($data);
    }

    function indexGedung()
    {
    	$data = gedung::all();
    	//dd($data);
    	return view('gedung', compact('data'));
    }

    public function gedungAdd(Request $request)
    {
    	
    	//dd($request->all());
        $data = gedung::create($request->all());
    	return redirect('datagedung')->with('success','Data '.$request->gedung.' berhasil dimasukkan');
    }

    public function gedungEdit($id)
    {
        $data = gedung::find($id);
        //dd($data);
        return view('gedungedit',compact('data'));
    }
   
    public function gedungUpdate(Request $request, $id)
    {
        $data = gedung::find($id);
        $data->update($request->all());

        $ruangan = DB::table('ruangan')
                    ->where('gedung_id',$id)
                    ->update(['status' => $request->status]);


        return redirect('datagedung')->with('success','data berhasil di update');
    }

    public function gedungDel($id)
    {
    	$data = gedung::find($id);
    	$data->delete();
        $ruangan = ruangan::where('gedung_id',$id)->delete();
    	return redirect('datagedung')->with('success','Data berhasil di Hapus');
    }

}
