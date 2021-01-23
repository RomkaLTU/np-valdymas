<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Accessories extends Model
{
    use HasFactory;

    public function equipment(): BelongsToMany
    {
        return $this->belongsToMany(Accessories::class);
    }
}
