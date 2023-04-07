<?php

namespace App\Listeners;

use App\Events\ProjectStatusUpdated;
use App\Mail\ProjectStatusUpdatedMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class NotifyAdminOnProjectStatusChange
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProjectStatusUpdated $event): void
    {
        Mail::to(User::admin()->first())
            ->send(new ProjectStatusUpdatedMail($event->project));
    }
}
