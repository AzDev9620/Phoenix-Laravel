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
        $this->call([
            /* dummy data */
            /*FeatureSeeder::class,
            LanguageSeeder::class,
            ProjectSeeder::class,
            ApartmentSeeder::class,*/
            /* dummy data */
            UserSeeder::class,
        ]);
    }
}
