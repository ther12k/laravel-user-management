<?php
namespace App\Helpers;
use NotificationChannels\Telegram\TelegramFile;
class TelegramFileWStorage extends TelegramFile
{
    public static function create(string $content = ''): self
    {
        return new self($content);
    }

    public function file($file, string $type, string $filename = null): self
    {
        $this->type = $type;

        if(is_array($file)){
            $storage = $file[0];
            $this->payload['file'] = [
                'filename' => $filename,
                'name'     => $type,
                'contents' => $storage->get($file[1]),
            ];
        }else if ($filename !== null || $this->isReadableFile($file)) {
            $this->payload['file'] = [
                'filename' => $filename,
                'name'     => $type,
                'contents' => $isLocalFile ? fopen($file, 'rb') : $file,
            ];
        } else {
            $this->payload[$type] = $file;
        }

        return $this;
    }
}