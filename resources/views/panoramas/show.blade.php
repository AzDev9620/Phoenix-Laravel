<x-app-layout>
    <x-slot name="title">
        {{ $panorama->name }} | 360 Panorama
    </x-slot>

    <div class="mb-4 underline">
        <a href="{{ route('apartments.show', ['apartment' => $panorama->apartment_id]) }}" class="cursor-pointer flex">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
            </svg>
            back
        </a>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 h-3/4 lg:col-span-9">
            <div id="panorama" class="h-screen-h w-auto overflow-hidden rounded-2xl"></div>
        </div>
        <div class="col-span-2 h-96">
            <h1 class="text-center font-semibold mb-4 text-2xl">{{ $panorama->name }}</h1>
            <div class="w-64 h-full bg-white body-font overflow-hidden rounded-2xl text-gray-400 px-6 py-6">
                <h1 class="font-black mb-5 text-gray-500 text-lg">Add Panorama Links</h1>
                <form action="{{ route('links.store') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" name="panorama_id" value="{{$panorama->id}}">
                        <x-label value="Coordinates" class="mt-2"/>
                        <x-input type="text" id="coordinates" name="coordinates" required/>
                        <x-label value="To" class="mt-2"/>
                        <x-select required name="to_panorama_id" size="5" class="appearance-none">
                            @foreach($apartments_panoramas as $apartments_panorama)
                                <option value="{{$apartments_panorama->id}}">{{ $apartments_panorama->name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <x-buttons.save class="mt-3"></x-buttons.save>
                </form>
            </div>
            <div class="w-64 mt-5 bg-white body-font overflow-hidden rounded-2xl text-gray-400 px-6 py-6">
                <h1 class="border-b font-black mb-2 text-gray-700">Links</h1>
                <ul>
                    @foreach($panorama->links as $link)
                        <li class="flex hover:shadow justify-between p-1 transition">
                            <div>
                                {{ \App\Models\Panorama::find($link->to_panorama_id)->name }}
                            </div>
                            <div>
                                <form action="{{ route('links.destroy', ['link' => $link->id]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="rounded-full hover:bg-gray-100 w-6">x</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script src="https://pchen66.github.io/js/three/three.min.js"></script>
        <script src="https://rawgit.com/pchen66/panolens.js/dev/build/panolens.min.js"></script>
        <script>
            const pnrm = {!! json_encode($panorama) !!};
            // console.log(pnrm)
            const pano = document.querySelector('#panorama')
            const panorama = new PANOLENS.ImagePanorama(pnrm.photo);
            // const panorama2 = new PANOLENS.ImagePanorama('https://www.envano.com/wp-content/themes/envano/legacy/alex/augmented-reality/360-tour/img/panorama.jpg');
            // panorama.link(panorama2, new THREE.Vector3(4993.90, 13.80, 106.00))
            const viewer = new PANOLENS.Viewer({container: pano, output: 'console'});
            viewer.add(panorama);

            /**
             * Output infospot attach position in developer console by holding down Ctrl button
             */
            PANOLENS.Viewer.prototype.outputInfospotPosition = function () {

                var intersects, point, panoramaWorldPosition, outputPosition;

                intersects = this.raycaster.intersectObject(this.panorama, true);

                if (intersects.length > 0) {

                    point = intersects[0].point;
                    panoramaWorldPosition = this.panorama.getWorldPosition();

                    // Panorama is scaled -1 on X axis
                    outputPosition = new THREE.Vector3(
                        -(point.x - panoramaWorldPosition.x).toFixed(2),
                        (point.y - panoramaWorldPosition.y).toFixed(2),
                        (point.z - panoramaWorldPosition.z).toFixed(2)
                    );

                    switch (this.options.output) {

                        case 'console':
                            console.info(outputPosition.x + ', ' + outputPosition.y + ', ' + outputPosition.z);
                            break;

                        case 'overlay':
                            this.outputDivElement.textContent = outputPosition.x + ', ' + outputPosition.y + ', ' + outputPosition.z;
                            break;

                        default:
                            break;

                    }
                }
            };

            panorama.addEventListener("click", function (e) {
                /* put coordinates to input field when clicked */
                if (e.intersects.length > 0) return;
                const a = viewer.raycaster.intersectObject(viewer.panorama, true)[0].point;

                const field = document.querySelector('#coordinates')
                field.value = a.x + ', ' + a.y + ', ' + a.z
            });

        </script>
    </x-slot>
</x-app-layout>
