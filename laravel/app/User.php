<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Naux\Mail\SendCloudTemplate;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'confirmation_token','api_token',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function answers(){
        return $this->hasMany(Answer::class);
    }//一个用户有多个答案
    public function question(){
        return $this->hasMany(Question::class);
    }//一个用户有多个问题
    public function  follows(){
        return $this->belongsToMany(Question::class,'user_question')->withTimestamps();
    }//一个用户可以关注多个问题
    public function followers(){
        return$this->belongsToMany(self::class,'followers','follower_id','followed_id')->withTimestamps();
    }
    public function sendPasswordResetNotification($token)
    {
        $bind_data = [
            'url' => url('password/reset',$token)
        ];

        $template = new SendCloudTemplate('reset_password', $bind_data);

        Mail::raw($template, function ($message)  {
            $message->from('623936780@qq.com', 'laravel-zhihu');

            $message->to($this->email);
        });
    }
    public function owns(Model $model){
        return $this->id == $model->user_id;
    }
    public function followThis($question){
        return $this->follows()->toggle($question);
    }
    public function followThisUser($user)
    {
        return $this->followers()->toggle($user);
    }
    public function followed($question){
        return $this->follows()->where('question_id',$question)->count();
    }
    public function followedUser($user){
        return $this->followers()->where('followed_id',$user)->count();
    }
    public function followersUser()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'follower_id')->withTimestamps();
    }
}

