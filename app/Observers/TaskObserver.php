<?php

namespace App\Observers;

use App\Models\Task;
use App\Models\User;
use App\Notifications\NewTaskCreatedForProject;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        User::admin()->first()
            ->notify(new NewTaskCreatedForProject($task));
    }
}
