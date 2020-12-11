<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserstableSeeder extends Seeder
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
                'name' => 'Romas',
                'email' => 'hello@prodev.lt',
                'email_verified_at' => Carbon::now(),
                'password' => \Illuminate\Support\Facades\Hash::make('J_A2LuxWw9KqneM-B6mPn2aA'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Povilas',
                'email' => 'povilas@noriupramogauti.lt',
                'email_verified_at' => Carbon::now(),
                'password' => \Illuminate\Support\Facades\Hash::make('hxD".C^3Z(*ZGHAY'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        User::insert($data);
    }
}
