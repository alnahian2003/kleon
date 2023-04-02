<x-mail::message>
# Task: {{ $task->title }}

Assigned at: {{ $task->created_at }}

@if ($task->comment)    
*Comment: {{ $task->comment }}*
@endif

@if ($task->project()->exists())  
<x-mail::panel>
Project: {{ str($task->project->title)->limit(100, "...") }}

Client: {{ $task->project->client->name }}

Status: {{ $task->project->status }}
</x-mail::panel>
@endif

<x-mail::button url="{{ route('projects.show', $task->project->slug) }}">
    View Task
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
