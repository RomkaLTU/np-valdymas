<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;

class SellersTableSeeder extends Seeder
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
                'title' => 'NP grupė nuoma',
                'company_name' => 'UAB NP grupė',
                'type' => 'vat_payer',
                'code' => '304758440',
                'vat_code' => 'LT100011465417',
                'address' => 'V.Nagevičiaus g. 3, Vilnius',
                'bank_account' => 'LT897300010154283259',
                'representative' => 'Direktorius Povilas Kelbauskis',
            ],
            [
                'title' => 'Techninis Aptarnavimas ',
                'company_name' => 'UAB „Techninis Aptarnavimas“',
                'type' => 'non_vat_payer',
                'code' => '305661115',
                'vat_code' => '',
                'address' => 'V.Nagevičiaus g. 3, Vilnius',
                'bank_account' => 'LT407300010165635469',
                'representative' => 'Direktorius Povilas Kelbauskis',
            ]
        ];

        Seller::insert($data);
    }
}
