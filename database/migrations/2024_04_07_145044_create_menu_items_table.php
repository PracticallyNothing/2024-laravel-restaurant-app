<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\MenuItem;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Артикули в менюто
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            // Име на артикула
            $table->string('name');

            // Цена на артикула в български левове (BGN)
            // TODO(Mario):
            //   В бъдеще можем да поддържаме цени в няколко различни валути.
            $table->decimal('price_bgn');

            $table->foreignIdFor(MenuItem::class, "prev_revision_id")->nullable()->default(null);
            $table->foreignIdFor(MenuItem::class, "next_revision_id")->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
