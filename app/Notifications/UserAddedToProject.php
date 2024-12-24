<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Project;

class UserAddedToProject extends Notification
{
    use Queueable;

    public $project;
    public $user;

    public function __construct(Project $project, $user)
    {
        $this->project = $project;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // You can add more channels like broadcast if needed
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('You have been added to a project!')
            ->line('Hello ' . $this->user->name . ',')
            ->line('You have been successfully added to the project: ' . $this->project->name)
            ->action('View Project', url('/projects/' . $this->project->id))
            ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'You have been added to the project: ' . $this->project->name,
            'project_id' => $this->project->id,
            'user_id' => $this->user->id,
        ];
    }
}

