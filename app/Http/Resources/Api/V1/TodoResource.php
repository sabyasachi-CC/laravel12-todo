<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return ['id' => $this->id, 'user_id' => $this->user_id, 'title' => $this->title, 'description' => $this->description, 'status' => $this->status, 'created_at' => $this->created_at?->toISOString(), 'updated_at' => $this->updated_at?->toISOString(), 'user' => $this->whenLoaded('user', fn () => ['id' => $this->user->id, 'name' => $this->user->full_name, 'email' => $this->user->email])];
    }
}
