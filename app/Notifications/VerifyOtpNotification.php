<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\NexmoMessage;
use App\Models\User;

class VerifyOtpNotification extends Notification
{
    use Queueable;
    private $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
         $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //return ['mail','nexmo'];
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
        return (new MailMessage)
                    ->subject('Verify OTP From FreeShopps')
                    ->line('Dear '. $this->user->name)
                    ->line('We take your privacy seriously, just want to make sure this is you, please click on the link below to verify and complete the sign in process')
                    ->action('Click to Verify Your signing process', route('verify.otp.form',$this->user->otp_verify_code))
                    ->line('Do not attempted to signing? It is likely someone else just type in your email address by accident . Feel free to ignore this option.')
                    ->line('Thank you for using our application!');
    }

    // public function toNexmo($notifiable)
    // {
    //     return (new NexmoMessage)
    //     ->content('FreeShopps Code: '.$this->user->otp_verify_code);
    // }

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
