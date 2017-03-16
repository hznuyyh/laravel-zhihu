<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    //
	public function is_hidden(){
		return $this->is_hidden === 'T';
	}
}
