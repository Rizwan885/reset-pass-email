<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function userLogin(Request $req){
               $validator=Validator::make($req->all(),[
        'email'=>['required','email'],
        'password'=>['required']
     ]);
    //  dd($req->all());


     if($validator->fails())
    {
        return response()->json(['error'=>$validator->errors()],422);
     } 
     else
     {
        if(Auth::attempt(['email'=>$req->email,'password'=>$req->password]))
        {
            $user=Auth::user();
            $token=$user->createToken('usertoken')->accessToken;
            return response()->json(['token'=>$token]);
        }
        else
        {
            return response()->json(['error'=>"Invalid Credentials"],400);

        }
     }
    
    }
    
}
