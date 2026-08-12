<?php

namespace Database\Seeders;

use App\Services\Importers\CharacterJsonImporter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use RuntimeException;

class CharacterJsonSeeder extends Seeder
{
    public function run(): void
    {
        $directory = storage_path(
            'app/hanfa/characters'
        );

        if (! File::isDirectory($directory)) {
            throw new RuntimeException(
                "Characters directory not found: {$directory}"
            );
        }

        $importer = app(CharacterJsonImporter::class);

        foreach (File::files($directory) as $file) {
            if (strtolower($file->getExtension()) !== 'json') {
                continue;
            }

            $this->command?->info(
                "Importing {$file->getFilename()}..."
            );

            $importer->import(
                $file->getPathname()
            );
        }
    }
}