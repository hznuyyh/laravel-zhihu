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
	public function topics(){
		return $this->belongsToMany(Topic::class)->withTimestamps();
	}

}
