<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/16
 * Time: 15:21
 */

namespace App;


use Illuminate\Database\Eloquent\Collection;
use Auth;

class MessageCollection extends Collection
{
	public function markAsRead(){
		$this->each(function($message){
			if($message->to_user_id == Auth::id())
				$message->markAsRead();
		});
			
			
	}
}