<?php

namespace App\Http\Controllers;

use App\Repositories\MessageRepository;
use Illuminate\Http\Request;
use Auth;
class MessageController extends Controller
{
    //
	protected $message;
	public function __construct(MessageRepository $messageRepository)
	{
		$this->message = $messageRepository;
	}

	public function store()
	{
		$message = $this->message->create([
			'to_user_id' => request('user'),
			'from_user_id'=> request('from'),
			'body'=>request('body'),
			'dialog_id'=>time().Auth::id()
		]);
		if($message) {
			return response()->json([
				'status' => true,
			]);
		}
		return response()->json(['status' => false]);
	}
	
}
