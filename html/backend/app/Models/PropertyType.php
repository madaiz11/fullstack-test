<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyType extends Model
{
    use HasFactory;

    protected $table = 'property_type';
    public $timestamps = false; // Disable timestamps since we don't have these columns
    
    protected $fillable = ['name'];

    public const TYPES = [
        'home',
        'condo',
        'townhouse',
        'land',
        'shophouse',
        'office',
        'apartment',
        'hotel'
    ];

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
} 