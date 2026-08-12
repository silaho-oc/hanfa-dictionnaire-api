<?php

namespace App\Http\Controllers;

use App\Http\Resources\CharacterResource;
use App\Http\Resources\EntriesResource;
use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    /**
     * Return the list of dictionary characters.
     *
     * Characters are ordered according to Hanfa's editorial structure:
     *
     * 1. standard level;
     * 2. stroke count;
     * 3. standard order.
     */
    public function characters(Request $request)
    {
        $characters = Character::query()
            ->with('pronunciations')
            ->orderBy('standard_level')
            ->orderBy('stroke_count')
            ->orderBy('standard_order')
            ->get();

        return CharacterResource::collection($characters);
    }

    /**
     * Return one character using its UUID.
     */
    public function show(string $uuid)
    {
        $character = Character::query()
            ->with('pronunciations')
            ->where('uuid', $uuid)
            ->firstOrFail();

        return new CharacterResource($character);
    }

    /**
     * Return dictionary entries associated with one character.
     */
    public function entries(string $uuid)
    {
        $character = Character::query()
            ->where('uuid', $uuid)
            ->firstOrFail();

        $entries = $character
            ->entries()
            ->with([
                'resolvedLabels',
                'translations.language',
                'examples.translations.language',
            ])
            ->get();

        return EntriesResource::collection($entries);
    }
}