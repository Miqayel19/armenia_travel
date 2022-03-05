<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\ManagerSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ManagerSeeder::class,
            CustomerSeeder::class
        ]);
    }
}
