<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/15
 * Time: 15:51
 */

namespace App\Repositories;


use App\Comment;

class CommentRepository
{
	public function create($attributes){

		return  Comment::create($attributes);
	}
}