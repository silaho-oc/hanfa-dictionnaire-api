<?php

namespace App\Services\Importers;

use App\Models\Character;
use App\Models\Entry;
use App\Models\Language;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class EntryJsonImporter
{
    public function import(string $path, string $languageCode = 'fr'): void
    {
        if (!file_exists($path)) {
            throw new RuntimeException("Entries JSON file not found: {$path}");
        }

        $entries = json_decode(file_get_contents($path), true);

        if (!is_array($entries)) {
            throw new RuntimeException("Invalid entries JSON structure: {$path}");
        }

        $language = Language::where('code', $languageCode)->firstOrFail();

        DB::transaction(function () use ($entries, $language) {
            foreach ($entries as $item) {
                $this->importEntry($item, $language);
            }
        });
    }

    private function importEntry(array $item, Language $language): void
    {
        if (empty($item['uuid'])) {
            throw new RuntimeException(
                "Missing UUID for entry: " . ($item['simp'] ?? 'unknown')
            );
        }

        $mainCharacter = mb_substr($item['simp'], 0, 1);

        $character = Character::where('simp', $mainCharacter)->firstOrFail();
        
        /**
         * FOR DEBUGGING
         */

        // $character = Character::where('simp', $mainCharacter)->first();
        // if (! $character) {
        //     Log::error('Character not found', [
        //         'entry_uuid' => $item['uuid'] ?? null,
        //         'entry_simp' => $item['simp'] ?? null,
        //         'main_character' => $mainCharacter,
        //     ]);

        //     throw new RuntimeException(
        //         "Character '{$mainCharacter}' not found for entry '{$item['simp']}'."
        //     );
        // }
        // return;


        $entry = Entry::updateOrCreate(
            [
                'uuid' => $item['uuid'],
            ],
            [
                'character_id' => $character->id,
                'simp' => $item['simp'],
                'trad' => $item['trad'],
                'pinyin' => $item['pinyin'],
                'alpha' => $item['alpha'],
                'label' => $item['label'] ?? [],
            ]
        );

        $this->syncEntryTranslations($entry, $item['fr'] ?? [], $language);
        $this->syncExamples($entry, $item['ex'] ?? [], $language);
    }

    private function syncEntryTranslations(Entry $entry, array $translations, Language $language): void
    {
        $validPositions = [];

        foreach ($translations as $index => $text) {
            $position = $index + 1;
            $validPositions[] = $position;

            $entry->translations()->updateOrCreate(
                [
                    'language_id' => $language->id,
                    'position' => $position,
                ],
                [
                    'text' => $text,
                ]
            );
        }

        $entry->translations()
            ->where('language_id', $language->id)
            ->whereNotIn('position', $validPositions)
            ->delete();
    }

    private function syncExamples(Entry $entry, array $examples, Language $language): void
    {
        $validPositions = [];

        foreach ($examples as $index => $exampleData) {
            $position = $index + 1;
            $validPositions[] = $position;

            $example = $entry->examples()->updateOrCreate(
                [
                    'position' => $position,
                ],
                [
                    'simp' => $exampleData['simp'],
                    'pinyin' => $exampleData['pinyin'],
                ]
            );

            $example->translations()->updateOrCreate(
                [
                    'language_id' => $language->id,
                ],
                [
                    'text' => $exampleData['fr'],
                ]
            );
        }

        $entry->examples()
            ->whereNotIn('position', $validPositions)
            ->delete();
    }
}