<?php

namespace App\Observers;

use App\Mail\NewProjectCreated;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProjectObserver
{
    /**
     * Handle the Project "created" event.
     */
    public function created(Project $project): void
    {
        /*
            Log the action if the project has been created by the admin,
            but refrain from sending an email.
            */
        if ($project->client->is_admin) {
            Log::info('Custom Project Created by Admin', ['project' => $project]);
        } else {
            Mail::to(User::admin()->first())
                ->send(new NewProjectCreated($project));
        }
    }
}
