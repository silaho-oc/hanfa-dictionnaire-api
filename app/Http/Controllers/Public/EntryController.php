<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\EntriesResource;
use App\Models\Entry;
use App\Models\Label;
use Illuminate\Support\Facades\Log;

class EntryController extends Controller
{

    // DISPLAY ALL ENTRIES
    public function entries()
    {
        $languageCode = 'fr';

        $entries = Entry::query()
            ->with([
                'translations.language',
                'examples.translations.language',
            ])
            ->get();

        $labelKeys = $entries
            ->pluck('label')
            ->filter()
            ->flatten()
            ->filter(fn ($key) => is_string($key))
            ->unique()
            ->values();

        $labelsByKey = Label::query()
            ->whereIn('key', $labelKeys)
            ->with([
                'translations' => function ($query) use ($languageCode): void {
                    $query
                        ->whereHas(
                            'language',
                            fn ($languageQuery) =>
                                $languageQuery->where('code', $languageCode)
                        )
                        ->with('language:id,code,name,native_name');
                },
            ])
            ->get()
            ->keyBy('key');

        $entries->each(function (Entry $entry) use ($labelsByKey): void {
            $resolvedLabels = collect($entry->label ?? [])
                ->map(fn (string $key) => $labelsByKey->get($key))
                ->filter()
                ->values();

            $entry->setRelation('resolvedLabels', $resolvedLabels);
        });

        $resource = EntriesResource::collection($entries);

        // Log::info(
        //     'Entries resource:' . PHP_EOL .
        //     json_encode(
        //         $resource->resolve(),
        //         JSON_PRETTY_PRINT
        //         | JSON_UNESCAPED_UNICODE
        //         | JSON_UNESCAPED_SLASHES
        //         | JSON_THROW_ON_ERROR
        //     )
        // );

        return $resource;
    }
}