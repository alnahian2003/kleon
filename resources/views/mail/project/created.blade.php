<x-mail::message>
# {{ $project->title }}

{{ str($project->description)->limit(150, '...') }}

<x-mail::panel>
Offered by: **{{ $project->client->name }}** at **{{ $project->created_at }}**

Budget: **${{ $project->budget }}**

Deadline: **{{ $project->deadline }}**
</x-mail::panel>


<x-mail::button :url="route('projects.show', $project->slug)">
Visit Project
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
