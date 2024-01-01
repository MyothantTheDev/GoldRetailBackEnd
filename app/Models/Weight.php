<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

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
}
