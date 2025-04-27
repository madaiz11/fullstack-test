<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    protected $table = 'location';
    public $timestamps = false;
    
    protected $fillable = [
        'full_name',
        'zipcode',
        'province',
        'sub_district',
        'district',
    ];

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
} 