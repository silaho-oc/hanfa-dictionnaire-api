<?php

namespace App\Services\Importers;

use App\Models\Character;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class CharacterJsonImporter
{
    public function import(string $path): void
    {
        if (! file_exists($path)) {
            throw new RuntimeException(
                "Characters JSON file not found: {$path}"
            );
        }

        $characters = json_decode(
            file_get_contents($path),
            true
        );

        if (! is_array($characters)) {
            throw new RuntimeException(
                "Invalid characters JSON structure."
            );
        }

        DB::transaction(function () use ($characters) {
            foreach ($characters as $item) {
                $character = Character::updateOrCreate(
                    [
                        'uuid' => $item['uuid'],
                    ],
                    [
                        'simp' => $item['simp'],
                        'trad' => $item['trad'],
                        'pinyin' => $item['pinyin'],
                        'alpha' => $item['alpha'],
                        'standard_level' => $item['standard_level'] ?? null,
                        'standard_order' => $item['standard_order'] ?? null,
                        'stroke_count' => $item['stroke_count'] ?? null,
                        'status' => $item['status'] ?? 'pending',
                        'completed_at' => $item['completed_at'] ?? null,
                    ]
                );

                foreach ($item['pronunciations'] ?? [] as $pronunciation) {
                    $character->pronunciations()->updateOrCreate(
                        [
                            'uuid' => $pronunciation['uuid'],
                        ],
                        [
                            'pinyin' => $pronunciation['pinyin'],
                            'alpha' => $pronunciation['alpha'],
                            'position' => $pronunciation['position'],
                            'is_primary' => $pronunciation['is_primary'] ?? false,
                        ]
                    );
                }
            }
        });
    }
}