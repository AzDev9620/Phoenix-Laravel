<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'code' => 'uz',
            'name' => "O'zbekcha",
        ]);

        Language::create([
            'code' => 'ru',
            'name' => "Русский",
        ]);
    }
}
