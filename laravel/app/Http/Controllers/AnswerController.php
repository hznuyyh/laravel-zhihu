<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnswerController extends Controller
{
    //
	public function store( Request $request,$question){
		dd($request->all());
	}
}
