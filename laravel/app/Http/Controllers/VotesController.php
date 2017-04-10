<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;
use Auth;
class VotesController extends Controller
{
    //
	public function byId($id){
		return Answer::find($id);
	}
	public function users($id)
	{
		$user = Auth::user();
		$answer = $this->byId($id);
//		echo $user;
//		echo $answer;
		$is = $user->voteFor($id);
		
		if(count($is['attached'])>0){
			$answer->increment('votes_count');
			return back();
		}
		$answer->decrement('votes_count');
		return back();

	}
	public function vote(){

	}

}
