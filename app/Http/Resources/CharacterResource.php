<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class CharacterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'simp' => $this->simp,
            'trad' => $this->trad,
            'pinyin' => $this->pinyin,
            'alpha' => $this->alpha,
            'standard_level' => $this->standard_level,
            'standard_order' => $this->standard_order,
            'stroke_count' => $this->stroke_count,
            'entries_count' => $this->entries_count,
            'status' => $this->status,
            'completed_at' => $this->completed_at,
            'pronunciations' => CharacterPronunciationResource::collection(
                $this->whenLoaded('pronunciations')
            ),
        ];
    }
}
