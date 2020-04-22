<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function indexAdmin()
    {
    	$data = User::whereNotIn('role',['mahasiswa'])->get();
    	//dd($data);
    	return view('adminlist',compact('data'));
    }

    public function simpanAdmin(Request $request)
    {

        $rules = [
            'nim' => 'required|unique:users',
        ];

        $comment = [
            'required' => ':attribute harus diisi',
            'unique' => 'user sudah ada',
        ];
        
        $this->validate($request, $rules, $comment);

    	$data = user::create([
    		'name' => $request->name,
    		'nim' => $request->nim,
    		'password' => bcrypt($request->password),
			'remember_token' => str_random(60),
			'api_token' => str_random(100),
    		'role' => $request->role,

    	]);
    	return redirect()->back()->with('success','admin berhasil ditambahkan');
    }

    public function editAdmin($id)
    {
    	$data = User::find($id);

    	return view('adminlistedit', compact('data'));
    }

    public function updateAdmin(Request $request, $id)
    {
    	$data = User::find($id);
    	if($request->password != ""){
	    		$data->name = $request->name;
	    		$data->nim = $request->nim;
	    		$data->password = bcrypt($request->password);
	    		$data->role = $request->role;
	    		$data->save();
    	}else{
    			$data->name = $request->name;
	    		$data->nim = $request->nim;
	    		$data->role = $request->role;
	    		$data->save();
		}
    	return redirect('/adminlist')->with('success','data berhasil diupdate');
    }

    public function delAdmin($id)
    {
    	$data = User::find($id);
    	$data->delete();

    	return redirect()->back()->with('success','data berhasil dihapus');

    }
}
