<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use NotificationChannels\Telegram\TelegramFile;

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
        return [TelegramChannel::class];
    }

    public function toTelegram() {
        
        $url = url($this->data['url']);
        //dd($url);
        //dd('/storage/'.$this->data['filename']);
        //dd($this->data['content']);
        if(env('APP_ENV')=='local')
            return TelegramMessage::create()->content($this->data['content']);
        return TelegramMessage::create()
            ->content($this->data['content']) // Markdown supported.
            //->file('/storage/'.$this->data['filename'], 'photo'); // local file
            // OR
            // ->file('http://www.domain.com/file.pdf', 'document') // remote file
            //->button('Download',$url) // Inline Button
            ->button('Download',$url); // Inline Button
    }
}
