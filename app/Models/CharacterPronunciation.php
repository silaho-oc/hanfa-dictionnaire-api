<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class CharacterPronunciation extends Model
{
    use HasUuid;

    protected $fillable = [
        'uuid',
        'character_id',
        'pinyin',
        'alpha',
        'position',
        'is_primary',
    ];

    protected $casts = [
        'position' => 'integer',
        'is_primary' => 'boolean',
    ];

    // PRONUNCIATION BELONGS TO CHARACTER
    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
