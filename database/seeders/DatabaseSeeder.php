<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use App\Models\User;
use App\Models\Table;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->createMany([
            ['name' => 'Administrator'],
            ['name' => 'Test User', 'email' => 'test@example.com'],
        ]);

        Table::factory()->createMany(10);

        MenuItem::factory()->createMany([
            // Салати
            ['name' => 'Салата Цезар', 'price_bgn' => 8.49 ],
            ['name' => 'Шопска салата', 'price_bgn' => 6.35 ],
            ['name' => 'Зелева салата', 'price_bgn' => 3.99 ],
            // Супи
            ['name' => 'Пилешка супа', 'price_bgn' => 3.50 ],
            ['name' => 'Леща', 'price_bgn' => 4.20 ],
            ['name' => 'Крем супа с червена леща', 'price_bgn' => 3.80 ],
            ['name' => 'Шкембе чорба', 'price_bgn' => 3.80 ],
            // Основни
            ['name' => 'Пиле с броколи, бейби моркови и сметана', 'price_bgn' => 5.10 ],
            ['name' => 'Пържола с пържени картофи', 'price_bgn' => 7.99 ],
            ['name' => 'Пиле по градинарски', 'price_bgn' => 5.69 ],
            ['name' => 'Мусака с кисело мляко', 'price_bgn' => 6.89 ],
        ]);
    }
}
