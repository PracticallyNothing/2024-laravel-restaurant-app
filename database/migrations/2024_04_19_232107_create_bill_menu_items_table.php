<?php

use App\Models\Bill;
use App\Models\MenuItem;
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
        Schema::create('bill_menu_item', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignIdFor(Bill::class);
            $table->foreignIdFor(MenuItem::class);
            $table->integer("quantity")->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_menu_items');
    }
};
