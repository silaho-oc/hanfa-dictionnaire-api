<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        Language::updateOrCreate(
            ['code' => 'fr'],
            [
                'name' => 'French',
                'native_name' => 'Français',
                'is_active' => true,
            ]
        );
    }
}