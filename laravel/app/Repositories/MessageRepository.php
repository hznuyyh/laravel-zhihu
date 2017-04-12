<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/11
 * Time: 20:10
 */

namespace App\Repositories;


use App\Message;

class MessageRepository
{
	public function create($attributes)
	{
		return Message::create($attributes);
	}
}