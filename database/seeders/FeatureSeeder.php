<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Project */

        Feature::create([
            'name' => ['uz' => "Qo'shnilar", 'ru' => "Соседи"],
            'icon' => url('') . '/dummy-data/' . 'icons/house.png',
            'type' => 'project',
        ]);

        Feature::create([
            'name' => ['uz' => "Shahar markazi", 'ru' => "Центр города"],
            'icon' => url('') . '/dummy-data/' . 'icons/location.png',
            'type' => 'project',
        ]);

        Feature::create([
            'name' => ['uz' => "Hafvsizlik", 'ru' => "Безопасность"],
            'icon' => url('') . '/dummy-data/' . 'icons/keys.png',
            'type' => 'project',
        ]);

        Feature::create([
            'name' => ['uz' => "Shahar markazi", 'ru' => "Центр города"],
            'icon' => url('') . '/dummy-data/' . 'icons/location.png',
            'type' => 'project',
        ]);

        Feature::create([
            'name' => ['uz' => "Qo'shnilar", 'ru' => "Соседи"],
            'icon' => url('') . '/dummy-data/' . 'icons/house.png',
            'type' => 'project',
        ]);

        /* Apartment */

        Feature::create([
            'name' => ['uz' => "Internet", 'ru' => "Интернет"],
            'icon' => url('') . '/dummy-data/' . 'icons/wifi.png',
            'type' => 'apartment',
        ]);

        Feature::create([
            'name' => ['uz' => "Mebel", 'ru' => "Мебель"],
            'icon' => url('') . '/dummy-data/' . 'icons/couch.png',
            'type' => 'apartment',
        ]);

        Feature::create([
            'name' => ['uz' => "Isitish tizimi", 'ru' => "Отопительная система"],
            'icon' => url('') . '/dummy-data/' . 'icons/valve.png',
            'type' => 'apartment',
        ]);

        Feature::create([
            'name' => ['uz' => "Mebel", 'ru' => "Мебель"],
            'icon' => url('') . '/dummy-data/' . 'icons/couch.png',
            'type' => 'apartment',
        ]);

    }
}
