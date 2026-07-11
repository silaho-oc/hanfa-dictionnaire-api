<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntryResource extends JsonResource
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

            'trad' => $this->trad,
            'simp' => $this->simp,
            'pinyin' => $this->pinyin,
            'alpha' => $this->alpha,

            // Stored as stable keys:
            // ["idiomatic_expression", "figurative"]
            'labels' => $this->labels ?? [],

            'character' => $this->whenLoaded('character', function () {
                return [
                    'uuid' => $this->character->uuid,
                    'trad' => $this->character->trad,
                    'simp' => $this->character->simp,
                    'pinyin' => $this->character->pinyin,
                    'alpha' => $this->character->alpha,
                ];
            }),

            'translations' => EntryTranslationResource::collection(
                $this->whenLoaded('translations')
            ),

            'examples' => ExampleResource::collection(
                $this->whenLoaded('examples')
            ),

            // Useful later for offline synchronization.
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}