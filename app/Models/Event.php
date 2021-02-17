<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'install_date' => 'date',
        'uninstall_date' => 'date',
        'entertainment_date' => 'date',
        'equipment' => 'array',
        'accessories' => 'array',
        'equipment_montage_ground' => 'array',
        'entertainment_el_provider' => 'array',
    ];

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function accessories(): BelongsToMany
    {
        return $this->belongsToMany(Accessories::class);
    }
}
