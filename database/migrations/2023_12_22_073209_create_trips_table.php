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
        Schema::create("trips", function (Blueprint $table) {
            $table->id();
            $table->foreignId("bus_id")
                ->constrained("buses")
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId("route_id")
                ->constrained("routes")
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->time("departure_time")->nullable();
            $table->time("arrival_time")->nullable();
            $table->set("days", ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]);
            $table->decimal("price")->nullable();
            $table->boolean("status")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("trips");
    }
};
