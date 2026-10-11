<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->location,
            'held_at' => $this->held_at?->toIso8601String(),
            'quota' => $this->quota,
            'price' => $this->price,
            'participants_count' => $this->whenCounted('participants'),
        ];
    }
}
