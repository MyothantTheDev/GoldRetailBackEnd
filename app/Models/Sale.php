<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $connection = "mongodb";
    protected $collection = "sales";

    protected $fillable = ['price','gold','fee','gem','polish','total','discount','net',
    'weight','encount','gem_weight'
    ];
}
