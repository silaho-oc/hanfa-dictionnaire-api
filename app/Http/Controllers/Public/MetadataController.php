<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\Entry;
use App\Models\EntryTranslation;
use App\Models\ExampleTranslation;
use Carbon\Carbon;

class MetadataController extends Controller
{
    // GET METADATA
    public function metadata()
    {
        $languageCode = 'fr';

        return response()->json([
            'dictionary_version' => config('dictionary.version'),
            'dictionary_version_name' => config('dictionary.version_name'),
            'dictionary_updated_at' => Carbon::parse(
                Entry::max('updated_at')
            )->locale('fr')->translatedFormat('j F Y'),
            'about' => config('hanfa.about'),
            'terms' => config('hanfa.terms'),
            'policies' => config('hanfa.policies'),
            'legal' => config('hanfa.legal'),
            'dictionary_statistics' => [
                'characters' => Character::count(),
                'entries' => Entry::count(),
                'french_translations' => EntryTranslation::whereHas(
                    'language', fn ($query) => $query->where('code', $languageCode)
                )->count(),
                'french_example_translations' => ExampleTranslation::whereHas(
                    'language', fn ($query) => $query->where('code', $languageCode)
                )->count(),
            ],
        ]);
    }
}
