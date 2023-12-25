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
        Schema::create("sub_routes", function (Blueprint $table) {
            $table->id();
            $table->foreignId("trip_id")
                ->constrained("trips")
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string("origin");
            $table->string("destination");
            $table->decimal("distance")->nullable();
            $table->time("departure_time")->nullable();
            $table->time("arrival_time")->nullable();
            $table->decimal("price")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("sub_routes");
    }
};
