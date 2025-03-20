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
        Schema::create('car_features', function (Blueprint $table) {
            $table->unsignedBigInteger('car_id')->primary()->onDelete('cascade');
            $table->tinyInteger('abs')->default(0);
            $table->tinyInteger('air_conditioning')->default(0);
            $table->tinyInteger('power_windows')->default(0);
            $table->tinyInteger('power_door_locks')->default(0);
            $table->tinyInteger('cruise_control')->default(0);
            $table->tinyInteger('bluetooth_connectivity')->default(0);
            $table->tinyInteger('remote_start')->default(0);
            $table->tinyInteger('gps_navigation')->default(0);
            $table->tinyInteger('heater_seats')->default(0);
            $table->tinyInteger('climate_control')->default(0);
            $table->tinyInteger('rear_parking_sensors')->default(0);
            $table->tinyInteger('leather_seats')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_features');
    }
};
