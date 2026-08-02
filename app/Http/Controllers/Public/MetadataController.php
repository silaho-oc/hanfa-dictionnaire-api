<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MetadataController extends Controller
{
    //
    public function metadata()
    {
        $charactersCount = Character::count();
        // Log::info($charactersCount);

        return response()->json([
            'dictionary_version' => config('dictionary.version'),
            'about' => config('hanfa.about'),
            'charactersCount' => $charactersCount,
        ]);
    }
}
