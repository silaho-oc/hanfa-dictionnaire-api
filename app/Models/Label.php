<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Label extends Model
{
    use HasUuid;

    public function translations(): HasMany
    {
        return $this->hasMany(LabelTranslation::class);
    }
}