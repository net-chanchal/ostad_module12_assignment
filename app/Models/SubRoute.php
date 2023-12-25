<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubRoute extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "trip_id",
        "origin",
        "destination",
        "distance",
        "departure_time",
        "arrival_time",
        "price",
    ];
}
