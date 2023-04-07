<x-mail::message>
# Project Status Updated to {{ $project->status->name }}

A project status has been updated since offered by {{ $project->client->name }} at {{ $project->created_at }}.

Here's an overview of current status of the project:

<x-mail::panel>
**Project Name:** "{{ str($project->title)->limit(60, '...') }}"

**Client Name:** {{ $project->client->name }}

**Budget:** ${{ $project->budget }}

**Last Updated:** {{ $project->updated_at }}

**Deadline:** {{ $project->deadline }} ({{ $project->status->name }})
</x-mail::panel>

<x-mail::button url="{{ route('projects.show', $project->slug) }}">
View Project
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
