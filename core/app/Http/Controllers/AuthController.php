<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    
    public function indexLogin()
    {
    	return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        	
            if(Auth::Attempt($request->only('nim','password'))){
                $role = Auth::user()->role;
        		if($role == 'baak' || $role == 'administrator'){
                    return redirect('admindashboard');
                }elseif($role == 'dosen'){
                    return redirect('dosendashboard');
                }else{
                    return redirect('mhsdashboardabsen');
                }
        	}else{
        		return redirect('login')->with('danger','coba inget-inget lagi NIM dan passwordnya. emang kadang suka lupa, sama kaya dia yang sering lupain kamu');                
        	}
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect('login');
    }
}
