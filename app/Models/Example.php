<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
    use HasUuid;
    
    // EXAMPLE BELONGS TO ENTRY
    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }

    // EXAMPLE HAS MANY TRANSLATIONS
    public function translations()
    {
        return $this->hasMany(ExampleTranslation::class);
    }
}
