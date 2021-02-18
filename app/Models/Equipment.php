<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Equipment extends Model
{
    use HasFactory;

    public function accessories(): BelongsToMany
    {
        return $this->belongsToMany(Accessories::class);
    }

    public function assemblyconsignment(): HasMany
    {
        return $this->hasMany(AssemblyConsignmentNote::class);
    }

    public function dismantlingconsignment(): HasMany
    {
        return $this->hasMany(DismantlingConsignmentNote::class);
    }
}
