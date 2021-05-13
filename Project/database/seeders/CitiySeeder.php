<?php

namespace Database\Seeders;

use App\Models\Cities;
use Illuminate\Database\Seeder;

class CitiySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cities::create([
            'country_id' => 1,
            'name' => 'Ankara',
        ]);
        Cities::create([
            'country_id' => 1,
            'name' => 'Istanbul',
        ]);
    }
}
