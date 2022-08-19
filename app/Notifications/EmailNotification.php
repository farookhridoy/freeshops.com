<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailNotification extends Notification
{
    use Queueable;
    private $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $user = $this->data['user'];
        $data = $this->data;
        if( array_key_exists('order', $data) ){
            $order = $this->data['order'];
        }
        if( array_key_exists('listing',$data) ){
            $listing = $this->data['listing'];
        }
         if(array_key_exists('msg',$data)){
            $msg = $this->data['msg'];
        }
        if(array_key_exists('pass',$data)){
            $pass = $this->data['pass'];
        }

        return (new MailMessage)
            ->subject($this->data['subject'])
            ->view( 'mail.'.$this->data['view'], get_defined_vars());
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
