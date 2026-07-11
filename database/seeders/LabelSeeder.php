<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Language;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabelSeeder extends Seeder
{
    public function run(): void
    {
        $french = Language::where('code', 'fr')->firstOrFail();

        $labels = [
            [
                'key' => 'idiomatic_expression',
                'code' => 'expr. idiom.',
                'name' => 'Expression idiomatique',
            ],
            [
                'key' => 'figurative',
                'code' => 'fig.',
                'name' => 'Figuré',
            ],
            [
                'key' => 'familiar',
                'code' => 'fam.',
                'name' => 'Familier',
            ],
            [
                'key' => 'pejorative',
                'code' => 'péj.',
                'name' => 'Péjoratif',
            ],
            [
                'key' => 'technical',
                'code' => 'tech.',
                'name' => 'Technique',
            ],
            [
                'key' => 'literary',
                'code' => 'litt.',
                'name' => 'Littéraire',
            ],
            [
                'key' => 'slang',
                'code' => 'arg.',
                'name' => 'Argot',
            ],
            [
                'key' => 'classical',
                'code' => 'class.',
                'name' => 'Classique',
            ],
            [
                'key' => 'dialectal',
                'code' => 'dial.',
                'name' => 'Dialectal',
            ],
            [
                'key' => 'historical',
                'code' => 'hist.',
                'name' => 'Historique',
            ],
            [
                'key' => 'classifier',
                'code' => 'classif.',
                'name' => 'Classificateur',
            ],
            [
                'key' => 'religious',
                'code' => 'relig.',
                'name' => 'Religieux',
            ],
            [
                'key' => 'political',
                'code' => 'pol.',
                'name' => 'Politique',
            ],
            [
                'key' => 'economics',
                'code' => 'écon.',
                'name' => 'Économie',
            ],
            [
                'key' => 'legal',
                'code' => 'jur.',
                'name' => 'Juridique',
            ],
            [
                'key' => 'medical',
                'code' => 'méd.',
                'name' => 'Médical',
            ],
            [
                'key' => 'computing',
                'code' => 'inform.',
                'name' => 'Informatique',
            ],
            [
                'key' => 'military',
                'code' => 'mil.',
                'name' => 'Militaire',
            ],
            [
                'key' => 'poetic',
                'code' => 'poét.',
                'name' => 'Poétique',
            ],
            [
                'key' => 'dated',
                'code' => 'vieilli.',
                'name' => 'Vieilli',
            ],
            [
                'key' => 'rare',
                'code' => 'rare.',
                'name' => 'Rare',
            ],
            [
                'key' => 'proper_name',
                'code' => 'onom.',
                'name' => 'Onomastique',
            ],
            [
                'key' => 'sports',
                'code' => 'sport.',
                'name' => 'Sport',
            ],
            [
                'key' => 'grammar',
                'code' => 'gramm.',
                'name' => 'Grammaire',
            ],
            [
                'key' => 'mathematics',
                'code' => 'math.',
                'name' => 'Mathématiques',
            ],
            [
                'key' => 'physics',
                'code' => 'phys.',
                'name' => 'Physique',
            ],
            [
                'key' => 'chemistry',
                'code' => 'chim.',
                'name' => 'Chimie',
            ],
            [
                'key' => 'biology',
                'code' => 'bio.',
                'name' => 'Biologie',
            ],
            [
                'key' => 'animal',
                'code' => 'animal.',
                'name' => 'Animal',
            ],
        ];

        DB::transaction(function () use ($labels, $french) {
            foreach ($labels as $data) {
                $label = Label::updateOrCreate(
                    ['key' => $data['key']],
                    []
                );

                $label->translations()->updateOrCreate(
                    [
                        'language_id' => $french->id,
                    ],
                    [
                        'code' => $data['code'],
                        'name' => $data['name'],
                    ]
                );
            }
        });
    }
}