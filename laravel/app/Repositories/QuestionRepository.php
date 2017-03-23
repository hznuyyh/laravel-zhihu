<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/22
 * Time: 21:12
 */

namespace App\Repositories;

use App\Questions;
use App\Topic;

class QuestionRepository
{
	public function selectByIdWithTopics($id)
	{
		return $question = Questions::where('id',$id)->with('topics')->first();
	}
	public function create($attributes)
	{
		return Questions::create($attributes);
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
		return Questions::find($id);
	}
	public function getQuestionFeed(){
		return Questions::publish()->latest('updated_at')->with('user')->get();
	}


}