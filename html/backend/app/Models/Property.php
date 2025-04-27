<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

    protected $table = 'property';
    
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'title',
        'description',
        'size_w',
        'size_h',
        'price',
        'date_listed',
        'status',
        'location_id',
        'property_type_id',
    ];

    protected $casts = [
        'date_listed' => 'datetime',
        'size_w' => 'float',
        'size_h' => 'float',
        'price' => 'integer',
    ];

    public const STATUS_FORSALE = 'forsale';
    public const STATUS_SOLD = 'sold';

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid();
            }
        });
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function propertyType(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(PropertyAttribute::class);
    }
} 