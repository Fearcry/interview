<?php

namespace Database\Seeders;

use App\Models\Countries;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Countries::create([
            'id' => 1,
            'name' => 'Turkey',
        ]);
    }
}
