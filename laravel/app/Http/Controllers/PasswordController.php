<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePasswordRequest;
use Illuminate\Http\Request;
use Hash;
use Auth;
class PasswordController extends Controller
{
    //
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function password(){
		return view('users.password');
	}
	public function update(StorePasswordRequest $request){
		if(Hash::check($request->get('old_password'),Auth::user()->password)){
			Auth::user()->password = bcrypt($request->get('new_password'));
			Auth::user()->save();
			flash('修改成功','success');
			return back();
		}
		//echo "<script>alert('修改失败!');</script>";
		flash('修改失败，请检查密码是否正确','danger');
		return back();
	}
}
