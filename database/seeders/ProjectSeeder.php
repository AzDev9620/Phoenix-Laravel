<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Project 1 */

        $p1 = Project::create([
            'name' => [
                'uz' => "Kislorod",
                'ru' => "Kislorod russkiy",
            ],
            'sub_name' => [
                'uz' => "Lorem Ipsum is simply dummy text of the",
                'ru' => "russkiy Lorem Ipsum is simply dummy text of the",
            ],
            'about' => [
                'uz' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
                'ru' => "Russkiy Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            ],
            'file' => [
                'uz' => url('') . '/dummy-data/' . 'sample_uz.pdf',
                'ru' => url('') . '/dummy-data/' . 'sample_ru.pdf',
            ],
            'main_image' => url('') . '/dummy-data/' . 'kislorod.jpg',
            'second_image' => url('') . '/dummy-data/' . '2.jpg',
        ]);
        foreach (Feature::where('type', 'project')->get() as $feature) {
            $p1->features()->attach($feature);
        }
        foreach (['2.jpg', '3.jpg', '4.jpg'] as $image) {
            $p1->images()->create([
                'name' => $image,
                'path' => url('') . '/dummy-data/' . $image
            ]);
        }
        foreach (['couch.png', 'wifi.png', 'keys.png', 'valve.png'] as $icon) {
            $p1->benefits()->create([
                'icon' => url('') . '/dummy-data/icons/' . $icon,
                'name' => [
                    'uz' => 'Shinam Hususiyat',
                    'ru' => 'Komfortniy Xarakter',
                ],
                'number' => [
                    'uz' => '16%',
                    'ru' => '16%',
                ],
            ]);
        }
        $p1->aspects()->create([
            'name' => [
                'uz' => 'Lorem Ipsum is simply dummy text of the printing',
                'ru' => 'ru Lorem Ipsum is simply dummy text of the printing',
            ]
        ]);
        $p1->aspects()->create([
            'name' => [
                'uz' => 'Qorem Ipsum is simply dummy text of the printing',
                'ru' => 'ru Qorem Ipsum is simply dummy text of the printing',
            ]
        ]);
        $p1->aspects()->create([
            'name' => [
                'uz' => 'WWorem Ipsum is simply dummy text of the printing',
                'ru' => 'ru WWorem Ipsum is simply dummy text of the printing',
            ]
        ]);
        $p1->aspects()->create([
            'name' => [
                'uz' => 'WWorem Ipsum is simply dummy text of the printing',
                'ru' => 'ru WWorem Ipsum is simply dummy text of the printing',
            ]
        ]);


        /* Project 2 */

        $p2 = Project::create([
            'name' => [
                'uz' => "Do'stlar",
                'ru' => "Do'stlar russkiy",
            ],
            'sub_name' => [
                'uz' => "Lorem Ipsum is simply dummy text of the",
                'ru' => "russkiy Lorem Ipsum is simply dummy text of the",
            ],
            'about' => [
                'uz' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
                'ru' => "Russkiy Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            ],
            'file' => [
                'uz' => url('') . '/dummy-data/' . 'sample_uz.pdf',
                'ru' => url('') . '/dummy-data/' . 'sample_ru.pdf',
            ],
            'main_image' => url('') . '/dummy-data/' . 'dostlar.jpg',
            'second_image' => url('') . '/dummy-data/' . '5.jpg',
        ]);
        foreach (Feature::where('type', 'project')->get() as $feature) {
            $p2->features()->attach($feature);
        }
        foreach (['6.jpg', '8.jpg', '9.jpg'] as $image) {
            $p2->images()->create([
                'name' => $image,
                'path' => url('') . '/dummy-data/' . $image
            ]);
        }
        foreach (['couch.png', 'wifi.png', 'keys.png', 'valve.png'] as $icon) {
            $p2->benefits()->create([
                'icon' => url('') . '/dummy-data/icons/' . $icon,
                'name' => [
                    'uz' => 'Shinam Hususiyat',
                    'ru' => 'Komfortniy Xarakter',
                ],
                'number' => [
                    'uz' => '16%',
                    'ru' => '16%',
                ],
            ]);
        }
        $p2->aspects()->create([
            'name' => [
                'uz' => 'WWorem Ipsum is simply dummy text of the printing',
                'ru' => 'ru WWorem Ipsum is simply dummy text of the printing',
            ]
        ]);
        $p2->aspects()->create([
            'name' => [
                'uz' => 'WWorem Ipsum is simply dummy text of the printing',
                'ru' => 'ru WWorem Ipsum is simply dummy text of the printing',
            ]
        ]);
        $p2->aspects()->create([
            'name' => [
                'uz' => 'WWorem Ipsum is simply dummy text of the printing',
                'ru' => 'ru WWorem Ipsum is simply dummy text of the printing',
            ]
        ]);
        $p2->aspects()->create([
            'name' => [
                'uz' => 'WWorem Ipsum is simply dummy text of the printing',
                'ru' => 'ru WWorem Ipsum is simply dummy text of the printing',
            ]
        ]);


    }
}
