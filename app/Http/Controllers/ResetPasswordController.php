<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function resetPassword(Request $req){
       $validator= Validator::make($req->all(),[
        'email'=>['required','email'],
        'password'=>['required','min:8'],
     ]);
     if($validator->fails())
     {
        return response()->json(['errors'=>$validator->errors()],422);
     }
      if(User::where('email',$req->email)->doesntExist())
      {
        return response()->json(['errors'=>'Email not found'],404);

      }

      $user=User::where('email','=',$req->email)->first();
    
       $user->password=Hash::make($req->password);

   
       $result=$user->update();
      if($result)
      {
        return response()->json(['message'=>'Password Reset Successfully'],200);

      }
      else{

        return response()->json(['message'=>'Could not reset Password'],200);
      }
   }

    }
