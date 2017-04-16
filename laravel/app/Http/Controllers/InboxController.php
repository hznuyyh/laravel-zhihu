<?php

namespace App\Http\Controllers;

use App\Message;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\Request;
use Auth;
class InboxController extends Controller
{
    //
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(){
		$messages =Message::where('to_user_id',Auth::id())->orWhere('from_user_id',Auth::id())
		->with('fromUser','toUser')
		->get();
		//return $messages;
		return view('inbox.index',['messages'=>$messages->groupBy('dialog_id')]);
	}
	public function show($dialogId){
		$messages = Message::where('dialog_id',$dialogId)->get();
		//return $messages;
		$messages->markAsRead();
		return view('inbox.show',compact('messages','dialogId'));
	}
	public function store($dialogId){
		$message = Message::where('dialog_id',$dialogId)->first();
		$toUserId = $message->from_user_id === Auth::id() ? $message->to_user_id : $message->from_user_id;
		$newMessage = Message::create([
			'from_user_id' => Auth::id(),
			'to_user_id'=>$toUserId,
			'body'=>request('body'),
			'dialog_id'=>$dialogId
		]);
		$newMessage->toUser->notify(new NewMessageNotification($newMessage));
		return back();	
	}
}
