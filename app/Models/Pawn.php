<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

use App\Models\Weight;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function totalweight(): BelongsTo {
        return $this->belongsTo(Weight::class,"weight");
    }
}
