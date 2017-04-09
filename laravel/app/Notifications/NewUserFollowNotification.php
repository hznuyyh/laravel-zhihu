<?php

namespace App\Notifications;

use App\Channels\SendCloudChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;
use Mail;
use Naux\Mail\SendCloudTemplate;
class NewUserFollowNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database',SendCloudChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
//    public function toMail($notifiable)
//    {
//        return (new MailMessage)
//                    ->line('The introduction to the notification.')
//                    ->action('Notification Action', url('/'))
//                    ->line('Thank you for using our application!');
//    }

    public function toSendCloud($notifiable)
    {
        $bind_data = [
            'url' => 'http://zhihu.dev','name'=>Auth::user()->name
            ];

        $template = new SendCloudTemplate('followEmail', $bind_data);

        Mail::raw($template, function ($message)  use ($notifiable){
            $message->from('623936780@qq.com', 'laravel-zhihu');

            $message->to($notifiable->email);
        });
    }
    public function toDatabase($notifiable){
        return [
            'name'=>Auth::user()->name,
        ];
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
