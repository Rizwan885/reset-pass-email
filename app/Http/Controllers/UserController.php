<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class UserController extends Controller
{
    public function userRegister(Request $req)
   {
      $input=$req->all();
          $validator=Validator::make($req->all(),[
        'name'=>['required'],
        'email'=>['required','email'],
        'password'=>['required']
     ]);

     if($validator->fails())
     {
        return response()->json(['error'=>$validator->errors()],422);
     }    
   try {
    $exist=User::where('email',$req->email)->first();
    if($exist)
    {
        return response()->json(['Error'=>'User Already Registered'],500);
    }
    else
    {
    $user=new User();
     $user->name=$req->name;
     $user->email=$req->email;
     $user->password=Hash::make($req->password);;
     $result=$user->save();
     if($result)
     {
    
        return response()->json(['message'=>'Registered Successfully'],201);
     }
     else
     {
        return response()->json(['message'=>'Cannot Create User'],400);

     }
    }

      
   } catch (\Throwable $th) {

        return response()->json(['error'=>$th],500);
   }
    

   }
   
   //----------------------User Info--------------------------
   public function userInfo(){
      $user=Auth::guard('api')->user();
      // $data=User::where('id','2')->first();
      $data=User::where('email',$user->email)->first();
      if($data)
      {
         return response()->json(['data'=>$data],200);
      }
      else
      {
         return response()->json(['error'=>'Record Not Found'],404);

      }
   }
     
   //----------------------User Info--------------------------

   //----------------------Reset Password Link--------------------------

   public function resetPassEmail(Request $req){
      $validated=Validator::make($req->all(),[
            "email"=>['required','email'],
        ]);
        if($validated->fails())
        {
            return response()->json(['Error',$validated->errors()],422);
        }    
        else
        {

          $user= User::where('email',$req->email)->first();
           if(!$user)
           {
            return response()->json(['error'=>'Record Not Found'],404);
           }
           else
           { 
            $token=Str::random(20);
            return  Mail::to('rizwanminhas7860@gmail.com')->send(new ResetPasswordEmail($user,$token));
            return response()->json(['message'=>'Check your email to reset password'],200);

           }
        }
   }


   //----------------------Reset Password Link--------------------------
  }



