<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExampleTranslationResource extends JsonResource
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
            'text' => $this->text,
            'language' => $this->whenLoaded('language', function () {
                return [
                    'code' => $this->language->code,
                    'name' => $this->language->name,
                    'native_name' => $this->language->native_name,
                ];
            }),
        ];
    }
}