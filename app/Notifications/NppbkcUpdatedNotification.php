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

class NppbkcUpdatedNotification extends Notification
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
        
        //$url = url($this->data['url']);
        // dd($this->data);
        //dd('/storage/'.$this->data['filename']);
        //dd($this->data['content']);
        $telegram = null;
        $storagePath = Storage::disk('local')->getAdapter()->getPathPrefix();
        if(isset($this->data['filename'])){
            $telegram = TelegramFile::create()
                ->content($this->data['content'])
                ->document($storagePath.$this->data['filepath'],$this->data['filename']);
                // ->document(Storage::get('/'.$this->data['filepath']),$this->data['filename']); // local file;
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
        $data = $this->data;
        $mail = (new MailMessage)
                    ->greeting($data['greeting'])
                    ->subject($data['subject'])
                    ->line($data['message']);
        if(isset($data['red'])){
            $mail = $mail->error();
        }
        if(isset($data['url'])){
            $mail = $mail->action($data['url_title'], $data['url']);
        } 
        if(isset($data['add_message'])){
            $mail = $mail->line($data['add_message']);
        }
        return $mail;
    }
}
