<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'Vilniaus sandelys (pagrindinis)',
                'address' => 'Žukausko g. 12',
                'user_id' => 1,
            ]
        ];

        Warehouse::insert($data);
    }
}
