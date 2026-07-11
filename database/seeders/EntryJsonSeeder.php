<?php

namespace Database\Seeders;

use App\Services\Importers\EntryJsonImporter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use RuntimeException;

class EntryJsonSeeder extends Seeder
{
    public function run(): void
    {
        $directory = storage_path(
            'app/hanfa/entries/1-1to50'
        );

        if (! File::isDirectory($directory)) {
            throw new RuntimeException(
                "Entries directory not found: {$directory}"
            );
        }

        $importer = app(EntryJsonImporter::class);

        foreach (File::files($directory) as $file) {
            if (strtolower($file->getExtension()) !== 'json') {
                continue;
            }

            $this->command?->info(
                "Importing {$file->getFilename()}..."
            );

            $importer->import($file->getPathname(), 'fr');
        }
    }
}