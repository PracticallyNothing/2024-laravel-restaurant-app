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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Кой е направил резервацията и как можем отново да се свържем с
            // тях при нужда.
            $table->string('person_name');
            $table->string('person_contacts');

            // Резервацията изисква някакъв капацитет на масата.
            $table->integer('desired_capacity');

            // Резервация се прави за дадени дата и час.
            $table->datetime('target_datetime');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
