<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasUuid;

    protected $casts = [
        'label' => 'array',
    ];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function translations()
    {
        return $this->hasMany(EntryTranslation::class);
    }

    public function examples()
    {
        return $this->hasMany(Example::class);
    }
}