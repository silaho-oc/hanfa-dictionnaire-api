<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CharacterPronunciationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'pinyin' => $this->pinyin,
            'alpha' => $this->alpha,
            'position' => $this->position,
            'is_primary' => $this->is_primary,
        ];
    }
}