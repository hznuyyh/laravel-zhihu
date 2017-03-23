<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    //
	protected $table = 'questions';
	protected $fillable = ['title','body','user_id'];
	public function is_hidden(){
		return $this->is_hidden === 'T';
	}
	public function answers(){
		return $this->hasMany(Answer::class);
	}
	public function topics(){
		return $this->belongsToMany(Topic::class)->withTimestamps();
	}
	public function user(){
		return $this->belongsTo(User::class);
	}
	public function scopePublish($query){
		return $query->where('is_hidden','F');
	}
}
