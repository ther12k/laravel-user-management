<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use NotificationChannels\Telegram\TelegramFile;

use Storage;

class NppbkcAddedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $arr)
    {
        $this->data = $arr;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class,'mail'];
    }

    public function toTelegram() {
        
        //$url = url($this->data['url']);
        // dd($this->data['content']);
        //dd('/storage/'.$this->data['filename']);
        //dd($this->data['content']);
        // if(env('APP_ENV')=='local')
        //     return TelegramMessage::create()->content($this->data['content']);
        $telegram = null;
        if(isset($this->data['filename'])){
            $telegram = TelegramFile::create()
                ->content($this->data['content'])
                ->file(Storage::get($this->data['filepath']), 'document',$this->data['filename']); // local file;
        }else{
            $telegram = TelegramMessage::create()->content($this->data['content'].' [Lihat]('.$this->data['url'].')');
        }

        if(env('APP_ENV')=='local'){
            return $telegram;
        }
        return $telegram->button('View',$this->data['url']); // Inline Button
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->error()
                    ->greeting('Halo halo')
                    ->subject('Halo halo')
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', $this->data['url'])
                    ->line('Thank you for using our application!');
    }
}
