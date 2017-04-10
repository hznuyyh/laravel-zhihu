<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/10
 * Time: 13:28
 */

namespace App\Mailer;


use Naux\Mail\SendCloudTemplate;
use Mail;
class Mailer
{
	public function sendTo($template,$email,array $data)
	{

		$content = new SendCloudTemplate($template, $data);

		Mail::raw($content, function ($message)  use ($email){
			$message->from('623936780@qq.com', 'laravel-zhihu');

			$message->to($email);
		});
	}
}