<?php

namespace Database\Seeders;

use App\Services\Importers\CharacterJsonImporter;
use Illuminate\Database\Seeder;

class CharacterJsonSeeder extends Seeder
{
    public function run(): void
    {
        app(CharacterJsonImporter::class)->import(
            storage_path('app/hanfa/characters.json')
        );
    }
}