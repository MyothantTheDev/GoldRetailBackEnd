<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Weight;

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

    public function weight() {
        return $this->hasOne(Weight::class,"pawn_id");
    }
}
