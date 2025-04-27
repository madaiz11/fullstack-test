<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyAttribute extends Model
{
    use HasFactory;

    protected $table = 'property_attributes';
    public $timestamps = false;
    
    protected $fillable = [
        'property_id',
        'name',
        'amount',
    ];

    public const ATTRIBUTES = [
        'airconditioner',
        'wardroberoom',
        'lift',
        'parking',
        'fitness',
        'jagucci',
        'swimmingpool',
        'park area',
        'cctv',
        'shuttle service'
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
} 