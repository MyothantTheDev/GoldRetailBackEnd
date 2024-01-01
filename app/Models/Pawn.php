<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Pawn extends Model
{
    use HasFactory;

    protected $connection = "mongodb";
    protected $collection = "pawns";
    protected $fillable = [
        "name",
        "type",
        "weight",
        "loan",
        "textLoan",
        "remark"
    ] ;
}
