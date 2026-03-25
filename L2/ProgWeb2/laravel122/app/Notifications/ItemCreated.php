<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ItemCreated extends Notification
{
    use Queueable;

    // On passe le type ('livre' ou 'vidéo'), le titre, et l'URL d'édition
    public function __construct(
        public string $type, 
        public string $title, 
        public string $editUrl
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject("Nouvel ajout : {$this->title}")
                    ->line("Un(e) nouveau/nouvelle {$this->type} a été ajouté(e) :")
                    ->line($this->title)
                    ->action('Éditer dans le Back-Office', $this->editUrl);
    }
}

?>