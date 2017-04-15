<?php

namespace App\Http\Controllers;

use App\Repositories\AnswerRepository;
use App\Repositories\CommentRepository;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use Auth;
class CommentsController extends Controller
{
    //
	protected $answer;
	protected $question;
	protected $comment;
	public function __construct(AnswerRepository $answerRepository,QuestionRepository $questionRepository,CommentRepository $commentRepository)
	{
		$this->answer = $answerRepository;
		$this->question = $questionRepository;
		$this->comment = $commentRepository;
	}

	public function answer($id){
		return $this->answer->getAnswerCommentsById($id);
	}
	public function question($id){
		return $this->question->getQuestionCommentsById($id);
	}
	public function store(){
		$model = $this->getModelNameFromType(request('type')); 
		
		return $this->comment->create([
			'commentable_id' => request('model'),
			'commentable_type' => $model,
			'user_id' => request('user'),
			'body' => request('body')
		]);
	} 
	public function getModelNameFromType($type){
		return $type === 'question' ? 'App\Question' :'App\Answer';
	}
}
