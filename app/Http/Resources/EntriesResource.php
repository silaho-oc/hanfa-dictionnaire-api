<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntriesResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'trad' => $this->trad,
            'simp' => $this->simp,
            'pinyin' => $this->pinyin,
            'alpha' => $this->alpha,

            'labels' => LabelResource::collection(
                $this->whenLoaded('resolvedLabels')
            ),

            'translations' => EntryTranslationResource::collection(
                $this->whenLoaded('translations')
            ),

            'examples' => ExampleResource::collection(
                $this->whenLoaded('examples')
            ),
        ];
    }
}