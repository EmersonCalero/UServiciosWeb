<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Llama al Seeder que acabamos de configurar
        $this->call(ExamenSeeder::class);
    }
}
