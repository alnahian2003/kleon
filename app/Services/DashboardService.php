<?php

namespace App\Services;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Collection;

/**
 * Dashboard Analytics
 */
class DashboardService
{
    public function getAllData(): Collection
    {
        $data = [
            'projects_count' => $this->getProjectsCount(),
            'tasks_count' => $this->getTasksCount(),
            'completed_projects_count' => $this->getCompletedProjectsCount(),
            'pending_projects_count' => $this->getPendingProjectsCount(),
            'cancelled_projects_count' => $this->getCancelledProjectsCount(),
            'delayed_projects_count' => $this->getDelayedProjectsCount(),
        ];

        if (auth()->user()->is_admin) {
            $data['users_count'] = $this->getUsersCount();
            $data['clients_count'] = $this->getClientsCount();
            $data['active_users_count'] = $this->getActiveUsersCount();
            $data['inactive_users_count'] = $this->getInactiveUsersCount();
        }

        return collect($data);
    }

    public function getUsersCount(): int
    {
        return User::count();
    }

    public function getActiveUsersCount(): int
    {
        return User::active()->count();
    }

    public function getInactiveUsersCount(): int
    {
        return User::inactive()->count();
    }

    public function getClientsCount(): int
    {
        return User::clients()->count();
    }

    public function getProjectsCount(): int
    {
        return Project::userProjects()->count();
    }

    public function getPendingProjectsCount(): int
    {
        return Project::userProjects()
            ->pendingProjects()
            ->count();
    }

    public function getCompletedProjectsCount(): int
    {
        return Project::userProjects()
            ->completedProjects()
            ->count();
    }

    public function getCancelledProjectsCount(): int
    {
        return Project::userProjects()
            ->cancelledProjects()
            ->count();
    }

    public function getDelayedProjectsCount(): int
    {
        return Project::userProjects()
            ->delayedProjects()
            ->count();
    }

    public function getTasksCount(): int
    {
        return Task::userTasks()->count();
    }
}
