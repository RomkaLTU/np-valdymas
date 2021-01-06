<?php

namespace Database\Seeders;

use App\Models\ExpenseType;
use Illuminate\Database\Seeder;

class ExpenseTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title' => 'Kuras'],
            ['title' => 'Montažas'],
            ['title' => 'Demontažas'],
            ['title' => 'Renginys'],
            ['title' => 'Sandėlio darbai'],
        ];

        ExpenseType::insert($data);
    }
}
