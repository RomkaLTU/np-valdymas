<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class CliensTableSeeder extends Seeder
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
                'name' => 'Jonavos rajono savivaldybės administracija',
                'phone' => '867124328',
                'company_ddress' => 'Jonavos arena',
                'email' => 'kristina.jaskuniene@jkc.lt',
                'type' => 'company',
            ],
            [
                'name' => 'Eventum Group - Renginių organizatoriai',
                'phone' => '861830922',
                'company_ddress' => 'Luokesų dvaras, Molėtų raj. (60km nuo Vilniaus)',
                'email' => 'ruta@eventumgroup.lt',
                'type' => 'company',
                'responsible_person_name' => 'Rūta',
            ],
        ];

        foreach ($data as $data) {
            Client::create($data);
        }
    }
}
