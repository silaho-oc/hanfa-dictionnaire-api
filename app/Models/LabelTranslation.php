<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LabelTranslation extends Model
{
    use HasUuid;

    public function label(): BelongsTo
    {
        return $this->belongsTo(Label::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}