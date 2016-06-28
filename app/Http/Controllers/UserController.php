<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{

      public function perfil(){
       	     return view('perfil',array('user' => Auth::user()));


       }

      public function update_avatar(Request $request){
          
          // handle the user upload of avatar

       	if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename=time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/img/' . $filename));
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();

             return view('perfil',array('user' => Auth::user()));

       	}

}
