<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/25
 * Time: 13:01
 */

namespace App\Repositories;
use App\Answer;

class AnswerRepository
{
	public function create($attributes){

		return  Answer::create($attributes);
	}
	public function getAnswerCommentsById($id){
		$answer = Answer::with('comments','comments.user')->where('id',$id)->first();
		return $answer->comments;
	}
}