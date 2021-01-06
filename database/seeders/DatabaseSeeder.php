<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(UserstableSeeder::class);
        $this->call(WarehousesTableSeeder::class);
        $this->call(CliensTableSeeder::class);
        $this->call(ExpenseTypesSeeder::class);
    }
}
