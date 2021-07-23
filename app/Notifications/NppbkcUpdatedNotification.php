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
        return [TelegramChannel::class,'mail'];
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
            $telegram = TelegramMessage::create()->content($this->data['content']);
        }

        if(env('APP_ENV')=='local'){
            return $telegram;
        }
        return $telegram->button('View',$this->data['url']); // Inline Button
    }

    public function toMail($notifiable)
    {
        $storagePath = Storage::disk('local')->getAdapter()->getPathPrefix();
        $data = $this->data;
        if(!isset($data['message'])){
            $data['message']='Bersamaan dengan email ini, kami mengirimkan attachment salinan surat permohonan anda,'.
                                'selanjutnya silahkan pantau permohonan anda melalui link dibawah ini';
        };
        $mail = (new MailMessage)
                    ->greeting($data['greeting'])
                    ->subject($data['text'])
                    ->line($data['message']);
        if(isset($data['error'])){
            $mail = $mail->error();
        }
        if(isset($data['url'])){
            $mail = $mail->action(isset($data['url_title'])?$data['url_title']:'Cek Permohonan', $data['url']);
        } 
        if(isset($data['add_message'])){
            $mail = $mail->line($data['add_message']);
        }
        if(isset($this->data['filename'])){
            $mail = $mail->attach($storagePath.$data['filepath'], [
                'as' => $data['filename'],
                'mime' => 'application/pdf',
            ]);

            // $mail = $mail->attachFromStorage($data['filepath'], $data['filename'], [
            //     'mime' => 'application/pdf'
            // ]);
        }
        return $mail;
    }
}
