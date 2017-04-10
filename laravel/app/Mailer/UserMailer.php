<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/10
 * Time: 13:35
 */

namespace App\Mailer;
use Auth;

class UserMailer extends Mailer
{
	public function followNotifyEmail($email){
		$data = [
			'url' => 'http://zhihu.dev','name'=>Auth::user()->name
		];
		$this->sendTo('followEmail',$email,$data);
	}
	public function passwordRestEmail($email,$token){
		$data = [
			'url' => url('password/reset',$token)
		];
		$this->sendTo('reset_password',$email,$data);
	}
	public function registerEmail($user){
		$data = [
			'url' => route('email.verify',['token'=>$user->confirmation_token]),
			'name'=>$user->name
		];
		$this->sendTo('laravel_zhihu',$user->email,$data);
	}

}