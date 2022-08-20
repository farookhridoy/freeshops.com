<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\NexmoMessage;
use App\Models\User;

class OrderTransectionNotification extends Notification
{
    use Queueable;
    private $order;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
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
         //return ['mail','nexmo'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        
        $user = User::where('role', '2')->first();

        return (new MailMessage)
                    ->subject('New Order Has Been Placed. #'.$this->order->order_no)
                    ->line('Dear '. $user->name)
                    ->line('A new Order has been  placed !. Click to see')
                    ->action($this->order->order_no, route('admin.order.review'))
                    ->line('Thank you for using our application!')
                    ->line('FreeShopps');
    }

    // public function toNexmo($notifiable)
    // {   
    //      
    //     return (new NexmoMessage)
    //     ->content('A new Order has been  placed. Order no #: '.$this->order->order_no);
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
