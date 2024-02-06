<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $connection = "mongodb";
    protected $collection = "sales";

    protected $fillable = ['buyer','price','gold','fee','gem','polish','total','discount','net',
    'weight','encount','gem_weight'
    ];

    public function totalweight(): BelongsTo
    {
        return $this->belongsTo(Weight::class, 'weight');
    }

    public function encounts(): BelongsTo
    {
        return $this->belongsTo(Weight::class, 'encount');
    }

    public function gemWeight(): BelongsTo
    {
        return $this->belongsTo(Weight::class, 'gem_weight');
    }
}
