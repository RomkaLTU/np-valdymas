<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
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
                'title' => 'Kliūčių ruožo dalis kalniukai',
                'qty' => 10,
            ],
            [
                'title' => 'Modulinis paviljonas baltas 50m2',
                'qty' => 10,
            ],
        ];

        Equipment::insert($data);
    }
}
