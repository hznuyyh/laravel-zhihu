<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/22
 * Time: 21:12
 */

namespace App\Repositories;

use App\Question;
use App\Topic;

class QuestionRepository
{
	public function selectByIdWithTopicsAndAnswers($id)
	{
		return $question = Question::where('id',$id)->with(['topics','answers'])->first();
	}
	public function create($attributes)
	{
		return Question::create($attributes);
	}
	public  function normalizeTopic(array $topics)
	{
		return collect($topics)->map(function($topic ){
			if(is_numeric($topic)){
				Topic::find($topic)->increment('questions_count');
				return (int)$topic;
			}
			$newTopic = Topic::create(['name'=>$topic,'questions_count'=>1]);
			return $newTopic->id;
		})->toArray();
	}
	
	public function getQuestionById($id){
		return Question::find($id);
	}
	public function getQuestionFeed(){
		return Question::publish()->latest('updated_at')->with('user')->get();
	}
	public function getQuestionCommentsById($id){
		$question = Question::with('comments','comments.user')->where('id',$id)->first();
		return $question->comments;
	}
	


}