<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
class UserFacebookController extends Controller
{
    public function redirect(){
      return Socialite::driver('facebook')->redirect();
    }
    public function handleCallback(){
      try{
      $user=Socialite::driver('facebook')->user();
      $result=User::where('email',$user->email)->first();
        if($result)
        {
          if($result->facebook_id==$user->id){
           return redirect('/userdashboard')->with('email',$user->email);

          }
          else
          {
          $result->facebook_id=$user->id;
          $result->update();
          return redirect('/googlelogin');

          }
        }
        else
        {
          return response()->json(['Error'=>'User Not Found'],404);
        }

      
 
      }
      catch(Exception $exception)
      {
        return response()->json(['error'=>$exception]);
      }
    }
}
