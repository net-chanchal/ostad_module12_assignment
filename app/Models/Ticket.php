<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        "passenger_id",
        "trip_id",
        "sub_route_id",
        "ticket_number",
        "seat_number",
        "booking_date",
    ];


    /**
     * @return BelongsTo
     */
    public function passenger(): BelongsTo
    {
        return $this->belongsTo(Passenger::class, "passenger_id");
    }

    /**
     * @return BelongsTo
     */
    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class, "trip_id")->with(["bus", "route"]);
    }

    /**
     * @return BelongsTo
     */
    public function subRoute(): BelongsTo
    {
        return $this->belongsTo(SubRoute::class, "sub_route_id");
    }
}
