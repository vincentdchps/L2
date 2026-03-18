<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookDeleted extends Notification
{
    use Queueable;

    public function __construct(public string $bookTitle) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => "Votre livre '{$this->bookTitle}' a été supprimé par l'administration."
        ];
    }
}

?>
