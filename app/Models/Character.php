<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasUuid;

    // CHARACTER HAS MANY ENTRIES
    public function entries()
    {
        return $this->hasMany(Entry::class);
    }
}
