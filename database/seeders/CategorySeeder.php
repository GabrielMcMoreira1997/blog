<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Tecnologia'],
            ['name' => 'Desenvolvimento'],
            ['name' => 'DevOps'],
            ['name' => 'Front-End'],
            ['name' => 'Back-End'],
            ['name' => 'Carreira'],
            ['name' => 'Banco de Dados'],
            ['name' => 'Inteligência Artificial'],
        ];

        DB::table('category')->insert($categories);
    }
}
