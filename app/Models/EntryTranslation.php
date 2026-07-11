<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class EntryTranslation extends Model
{
    use HasUuid;
    
    // ENTRY TRANSLATION BELONGS TO ENTRY
    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }

    // ENTRY TRANSLATION BELONGS TO LANGUAGE
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
