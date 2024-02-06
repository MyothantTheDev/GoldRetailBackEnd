<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Weight extends Model
{
    use HasFactory;

    protected $connection = "mongodb";
    protected $collection = "weights";
    protected $fillable = [
        "weight1",
        "weight2",
        "weight3",
    ];

    public function pawn(): HasMany {
        return $this->hasMany(Pawn::class, 'weight');
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class, 'weight');
    }

    public function encounters(): HasMany
    {
        return $this->hasMany(Sale::class, 'encount');
    }

    public function gemWeight(): HasMany
    {
        return $this->hasMany(Sale::class, 'gem_weight');
    }
}
