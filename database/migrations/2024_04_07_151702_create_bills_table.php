<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();

            /// Създаването на запис в таблицата означава, че клиенти са заели дадена маса.
            $table->timestamps();

            /// Всяка сметка се прави за определена маса.
            $table->foreignIdFor(Table::class);

            /// Кога сметката е била затворена. NULL ако още е отворена.
            $table->dateTime('time_closed')
                ->nullable()
                ->default(null);
             
            /// Дали сметката е платена (клиент може да си тръгне без да плаща -
            /// нелегално, но възможно).
            $table->boolean('is_payed')->default(false);

            /// Бакшиш след плащане на сметката.
            $table->decimal('tip_amount')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
