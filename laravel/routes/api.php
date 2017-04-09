<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('api')->get('/topics', function (Request $request) {
    return $topic = \App\Topic::select(['id','name'])
        ->where('name','like','%'.$request->query('q').'%')
        ->get();
});
Route::middleware('api')->post('/questions/follower', function (Request $request) {
    return response()->json(['followed'=>false]);
});
Route::post('/question/follower','QuestionFollowController@follower')->middleware('auth:api');

Route::get('/user/followers/{id}','FollowersController@index');
