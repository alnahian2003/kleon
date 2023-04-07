<?php

namespace App\Console\Commands;

use App\Enums\ProjectStatus;
use App\Events\ProjectStatusUpdated;
use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateDelayedProjectsStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'projects:update-delayed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of delayed projects.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pendingDelayedProjects = Project::where([
            ['deadline', '<', now()],
            ['status', ProjectStatus::Pending],
        ])->get();

        foreach ($pendingDelayedProjects as $project) {
            $project->status = ProjectStatus::Delayed;
            $project->saveOrFail();

            event(new ProjectStatusUpdated($project));
            Log::info('Project Status Updated', ['project' => ['project_id' => $project->id, 'status' => $project->status]]);
        }
    }
}
