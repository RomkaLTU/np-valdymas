<?php

namespace Database\Seeders;

use App\Models\Accessories;
use Illuminate\Database\Seeder;

class AccessoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title' => 'Siena balta be langu'],
            ['title' => 'Siena balta su langais'],
            ['title' => 'Konstrukcinė detalė mp7'],
            ['title' => 'Pompa 2kw (geltona)'],
            ['title' => 'Kilimėlis pradžiai'],
            ['title' => 'Prailgintuvas 20m vienfazis'],
        ];

        Accessories::insert($data);
    }
}
