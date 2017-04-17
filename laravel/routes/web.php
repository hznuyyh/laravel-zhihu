<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('email/verify/{token}',['as'=>'email.verify','uses'=>'EmailController@verify']);

Route::resource('questions','QuestionController',['name'=>
   ['create'=>'questions.create',
       'show'=>'questions.show',
   ]
]);
Route::get('avatar','UserController@avatar');
Route::post('avatar','UserController@changeAvatar');

Route::post('questions/{question}/answer','AnswerController@store' );
Route::get('questions/{question}/follow','QuestionFollowController@follow');
Route::get('/user/{id}/follow','FollowersController@follow');
Route::get('notifications','NotificationsController@index');
Route::get('/answer/{id}/votes/users','VotesController@users');
Route::post('/answer/{id}/vote','VotesController@follow');
Route::get('/inbox','InboxController@index');
Route::post('/inbox/{dialogId}/store','InboxController@store');
Route::get('/inbox/{dialogId}','InboxController@show');


