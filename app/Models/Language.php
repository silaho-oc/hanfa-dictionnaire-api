<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasUuid;
    
    // LANGUAGE HAS MANY ENTRY TRANSLATIONS
    public function entryTranslations()
    {
        return $this->hasMany(EntryTranslation::class);
    }

    // LANGUAGE HAS MANY EXAMPLE TRANSLATIONS
    public function exampleTranslations()
    {
        return $this->hasMany(ExampleTranslation::class);
    }

    // LANGUAGE HAS MANY LABEL TRANSLATIONS
    public function labelTranslations()
    {
        return $this->hasMany(LabelTranslation::class);
    }
}
