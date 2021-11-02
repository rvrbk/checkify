<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = [
            ['name' => 'Apartment Appelscha', 'location' => '52.955586584851304, 6.341360498102204'],
            ['name' => 'Apartment El Cajon', 'location' => '32.82343261545838, -116.92229580261817']
        ];

        foreach ($units as $unit) {
            $u = new Unit();

            $u->uid = uniqid();
            $u->name = $unit['name'];
            $u->location = $unit['location'];

            $u->save();
        }
    }
}
