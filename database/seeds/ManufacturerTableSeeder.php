<?php

use Illuminate\Database\Seeder;
use App\Manufacturer;

class ManufacturerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manufacturers = ['Muthaiga Industrials', 'Other'];

        foreach ($manufacturers as $manufacturer) {
             Manufacturer::create(['name' => $manufacturer]);
        }
    }
}
