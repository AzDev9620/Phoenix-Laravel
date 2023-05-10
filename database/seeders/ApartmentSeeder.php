<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Feature;
use App\Models\Link;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p1 = Project::find(1);
        $p2 = Project::find(2);

        $a1 = $p1->apartments()->create([
            'name' => [
                'uz' => "3 xona 47m2",
                'ru' => "3 komnat 47m2",
            ],
            'title' => [
                'uz' => "Lorem Ipsum is simply dummy text",
                'ru' => "russkiy Lorem Ipsum is simply dummy text",
            ],
            'about' => [
                'uz' => "survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing",
                'ru' => "russkiy survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing",
            ],
            'rooms_number' => 3,
        ]);
        foreach (Feature::where('type', 'apartment')->get() as $feature) {
            $a1->features()->attach($feature);
        }
        foreach (['2.jpg', '3.jpg', '4.jpg'] as $image) {
            $a1->images()->create([
                'name' => $image,
                'path' => url('') . '/dummy-data/' . $image
            ]);
        }
        foreach (['plan4.png', 'plan2.jpg', 'plan.jpg'] as $index => $plan) {
            $a1->floors()->create([
                'plan' => url('') . '/dummy-data/' . $plan,
                'number' => $index + 1,
            ]);
        }
        $a1->details()->create([
            'name' => [
                'uz' => 'Umumiy maydon',
                'ru' => 'Obshaya ploshad',
            ],
            'value' => [
                'uz' => '33.43 kvm',
                'ru' => '33.43 kvm',
            ],
        ]);
        $a1->details()->create([
            'name' => [
                'uz' => 'Umumiy maydon',
                'ru' => 'Obshaya ploshad',
            ],
            'value' => [
                'uz' => '33.43 kvm',
                'ru' => '33.43 kvm',
            ],
        ]);
        $a1->details()->create([
            'name' => [
                'uz' => 'Umumiy maydon',
                'ru' => 'Obshaya ploshad',
            ],
            'value' => [
                'uz' => '33.43 kvm',
                'ru' => '33.43 kvm',
            ],
        ]);
        foreach (['cabin.jpg' => 'Kabinet', 'garage.jpg' => 'Garage', 'outside.png' => 'Outside'] as $panorama => $name) {
            $a1->panoramas()->create([
                'photo' => url('') . '/dummy-data/' . $panorama,
                'name' => $name,
            ]);
        }
/*        Link::create([
            'panorama_id' => 1,
            'coordinates' => '0,0,0',
            'to_panorama_id' => 2,
        ]);
        Link::create([
            'panorama_id' => 1,
            'coordinates' => '0,0,0',
            'to_panorama_id' => 3,
        ]);
        Link::create([
            'panorama_id' => 3,
            'coordinates' => '0,0,0',
            'to_panorama_id' => 1,
        ]);
        Link::create([
            'panorama_id' => 2,
            'coordinates' => '0,0,0',
            'to_panorama_id' => 3,
        ]);*/



        $a2 = $p2->apartments()->create([
            'name' => [
                'uz' => "2 xona 47m2",
                'ru' => "2 komnat 47m2",
            ],
            'title' => [
                'uz' => "Lorem Ipsum is simply dummy text",
                'ru' => "russkiy Lorem Ipsum is simply dummy text",
            ],
            'about' => [
                'uz' => "survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing",
                'ru' => "russkiy survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing",
            ],
            'rooms_number' => 3,
        ]);
        foreach (Feature::where('type', 'apartment')->get() as $feature) {
            $a2->features()->attach($feature);
        }
        foreach (['2.jpg', '3.jpg', '4.jpg'] as $image) {
            $a2->images()->create([
                'name' => $image,
                'path' => url('') . '/dummy-data/' . $image
            ]);
        }
        foreach (['plan.jpg', 'plan2.jpg', 'plan4.png', 'plan5.png'] as $index => $plan) {
            $a2->floors()->create([
                'plan' => url('') . '/dummy-data/' . $plan,
                'number' => $index + 1,
            ]);
        }
        $a2->details()->create([
            'name' => [
                'uz' => 'Umumiy maydon',
                'ru' => 'Obshaya ploshad',
            ],
            'value' => [
                'uz' => '33.43 kvm',
                'ru' => '33.43 kvm',
            ],
        ]);
        $a2->details()->create([
            'name' => [
                'uz' => 'Umumiy maydon',
                'ru' => 'Obshaya ploshad',
            ],
            'value' => [
                'uz' => '33.43 kvm',
                'ru' => '33.43 kvm',
            ],
        ]);
        $a2->details()->create([
            'name' => [
                'uz' => 'Umumiy maydon',
                'ru' => 'Obshaya ploshad',
            ],
            'value' => [
                'uz' => '33.43 kvm',
                'ru' => '33.43 kvm',
            ],
        ]);

    }
}
