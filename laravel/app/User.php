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
        'name', 'email', 'password', 'avatar', 'confirmation_token',
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
    }
    public function question(){
        return $this->hasMany(Questions::class);
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


}

