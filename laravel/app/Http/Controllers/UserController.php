<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class UserController extends Controller
{
    //
	public function avatar(){
		return view('users.avatar');
	}
	public function changeAvatar(Request $request){
		$file = $request->file('img');
		$fileName = '/images/avatars/'.md5(time().Auth::id()).'.'.$file->getClientOriginalExtension();
		$file->move('images/avatars',$fileName);

		Auth::user()->avatar = asset($fileName);
		Auth::user()->save();

		return  ['url'=>Auth::user()->avatar];
	}
}
