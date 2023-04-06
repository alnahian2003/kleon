<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'description' => $this->description,
            'budget' => $this->budget,
            'status' => $this->status,
            'deadline' => $this->deadline,
            'created_at' => $this->created_at,
            'tasks' => TaskResource::collection($this->tasks),
            'client' => ClientResource::make($this->client),
        ];
    }
}
