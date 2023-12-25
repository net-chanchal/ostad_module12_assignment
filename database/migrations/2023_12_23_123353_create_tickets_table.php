<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId("passenger_id")
                ->constrained("passengers")
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId("trip_id")
                ->constrained("trips")
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId("sub_route_id")
                ->nullable()
                ->constrained("sub_routes")
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->string("ticket_number")->index();
            $table->integer("seat_number");
            $table->date("booking_date");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
