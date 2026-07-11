<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class ExampleTranslation extends Model
{
    use HasUuid;
    
    // EXAMPLE TRANSLATION BELONGS TO EXAMPLE
    public function example()
    {
        return $this->belongsTo(Example::class);
    }

    // EXAMPLE TRANSLATION BELONGS TO LANGUAGE
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
