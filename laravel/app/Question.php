<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
	protected $table = 'questions';
	protected $fillable = ['title','body','user_id'];
	public function answers(){
		return $this->hasMany(Answer::class);
	}//一个问题有多个答案
	public function topics(){
		return $this->belongsToMany(Topic::class)->withTimestamps();
	}//一个问题属于多个标签
	public function user(){
		return $this->belongsTo(User::class);
	}//一个问题属于一个用户
	public function followers(){
		return $this->belongsToMany(User::class,'user_question')->withTimestamps();
	}
	public function scopePublish($query){
		return $query->where('is_hidden','F');
	}
	public function is_hidden(){
		return $this->is_hidden === 'T';
	}
}
