<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
class usercontroller extends Controller
{
    public function login(Request $request)
    {
    if(User::where('email','=',$request['email'])->where('active','=',0)->where('status','=',2)->first()===null)
    {
         if(Auth::attempt(['email'=>$request['email'],'password'=>$request['password'],'active'=>0]))
       	 {
       	    
       	  	$data['msg'] = 'Login successfully!!';
			$data['status'] = 1;
			 $data['data'] =User::where('email','=',$request['email'])->get()->toArray();
       	 }
       	 else
       	 {
            $data['msg'] = 'Invalid email or password!!';
            $data['status'] = 0;
            $data['data'] = 'null'; 
       	 }
    }
    else{
            $data['msg']='Inactive account';
            $data['status'] = 2;
            $data['data'] = 'null';
    }
    
		return json_encode($data);
    }
}
