<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/9
 * Time: 19:32
 */

namespace App\Channels;


use Illuminate\Notifications\Notification;

class SendCloudChannel
{
	public function send($notifiable,Notification $notification)
	{
		$message = $notification->toSendCloud($notifiable);
	}

}