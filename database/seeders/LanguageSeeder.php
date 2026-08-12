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


// $languages = [
//     [
//         'code' => 'fr',
//         'name' => 'French',
//         'native_name' => 'Français',
//     ],
//     [
//         'code' => 'en',
//         'name' => 'English',
//         'native_name' => 'English',
//     ],
//     [
//         'code' => 'zh',
//         'name' => 'Chinese',
//         'native_name' => '中文',
//     ],
// ];

// foreach ($languages as $language) {
//     Language::updateOrCreate(
//         ['code' => $language['code']],
//         [
//             'name' => $language['name'],
//             'native_name' => $language['native_name'],
//             'is_active' => true,
//         ]
//     );
// }