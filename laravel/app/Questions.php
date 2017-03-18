<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    //
	protected $fillable = ['title','body','user_id'];
	public function is_hidden(){
		return $this->is_hidden === 'T';
	}
}
