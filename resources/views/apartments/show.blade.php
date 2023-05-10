<x-app-layout>
    <x-slot name="title">
        {{ $apartment->name }}
    </x-slot>
    <div x-data="{ add: {{ session()->get('apartment-add') }} ?? false }">
        <section class="relative bg-white body-font overflow-hidden rounded-2xl text-gray-400">
            <div class="absolute right-11 text-right top-10 flex gap-2">
                <a href="{{route('apartments.edit', ['apartment' => $apartment->id])}}" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-gray-800 hover:bg-gray-900 hover:shadow-lg">
                    Edit
                </a>
                <div x-data="{ showModal : false }">
                    <button @click="showModal = !showModal" type="submit" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-red-500 hover:bg-red-500 hover:shadow-lg">
                        Delete
                    </button>
                    <!-- Modal Background -->
                    <div x-show="showModal" class="fixed text-gray-500 flex items-center justify-center overflow-auto z-50 bg-black bg-opacity-40 left-0 right-0 top-0 bottom-0" x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        <!-- Modal -->
                        <div x-show="showModal" class="bg-white mx-10 p-12 w-2/6 rounded-xl shadow-2xl text-center" @click.away="showModal = false" x-transition:enter="transition ease duration-100 transform" x-transition:enter-start="opacity-0 scale-90 translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease duration-100 transform" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-90 translate-y-1">
                            <span class="font-bold block text-2xl mb-3">Are you sure?</span>
                            <p class="mb-5">Apartment {{ $apartment->name }} will be deleted permanently</p>
                            <div class="space-x-5 mt-5 flex justify-center">
                                <button @click="showModal = !showModal" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-gray-800 hover:bg-gray-900 hover:shadow-lg">
                                    Cancel
                                </button>
                                <form action="{{route('apartments.destroy', ['apartment' => $apartment->id])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-red-500 hover:bg-red-500 hover:shadow-lg">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-5 py-24 pb-11">
                <div class="lg:w-11/12 mx-auto grid lg:grid-cols-2">
                    <div>
                        <h5>Photos</h5>
                        <div class="flex flex-wrap">
                            @foreach($apartment->images as $image)
                                <div class="relative">
                                    <a class="hover:shadow" href="{{ $image->path }}" target="_blank">
                                        <img src="{{ $image->path }}" class="w-48 h-28 rounded m-1"/>
                                    </a>
                                    <form action="{{ route('images.destroy', ['image' => $image->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="absolute font-black hover:bg-gray-300 hover:text-black m-0 p-0 right-2.5 rounded-full text-white top-2 transition w-6">
                                            x
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>

                        <h5 class="mt-6 mb-2">Floors</h5>
                        <div class="flex flex-wrap gap-2.5">
                            @foreach($apartment->floors as $floor)
                                <div class="border border-gray-300 p-2 relative rounded-lg text-center">
                                    <a href="{{$floor->plan}}" target="_blank" class="">
                                        <img class="max-h-28  w-full" src="{{ $floor->plan }}"/>
                                        <h6 class="font-semibold mt-1.5">{{ $floor->number }}</h6>
                                    </a>
                                    <form action="{{ route('floors.destroy', ['floor' => $floor->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="absolute bg-gray-600 font-black hover:bg-gray-800 hover:opacity-90 m-0 opacity-20 p-0 right-2.5 rounded-full text-white top-2 transition w-6">
                                            x
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>

                        <h5 class="mt-6 mb-2">360 Panomaras</h5>
                        <div class="flex flex-wrap gap-4">
                            @foreach($apartment->panoramas as $panorama)
                                <div class="shadow-2xl p-2 rounded-md">
                                    <a href="{{ route('panoramas.show', ['panorama' => $panorama->id]) }}">
                                        <img src="{{ $panorama->photo }}" class="h-20 w-auto">
                                    </a>
                                    <div class="flex justify-between mt-1">
                                        <a href="{{ route('panoramas.show', ['panorama' => $panorama->id]) }}">
                                            <p>{{ $panorama->name }}</p>
                                        </a>
                                        <div x-data="{ showPanoramaModal : false }">
                                            {{--<button @click="showPanoramaModal = !showPanoramaModal" type="button" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-red-500 hover:bg-red-500 hover:shadow-lg">
                                                Delete
                                            </button>--}}
                                            <button @click="showPanoramaModal = !showPanoramaModal" type="button" class="hover:bg-gray-200 hover:text-gray-500 rounded-full transition w-6">
                                                x
                                            </button>
                                            <!-- Modal Background -->
                                            <div x-show="showPanoramaModal" class="fixed text-gray-500 flex items-center justify-center overflow-auto z-50 bg-black bg-opacity-40 left-0 right-0 top-0 bottom-0" x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                                <!-- Modal -->
                                                <div x-show="showPanoramaModal" class="bg-white mx-10 p-12 w-2/6 rounded-xl shadow-2xl text-center" @click.away="showPanoramaModal = false" x-transition:enter="transition ease duration-100 transform" x-transition:enter-start="opacity-0 scale-90 translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease duration-100 transform" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-90 translate-y-1">
                                                    <span class="font-bold block text-2xl mb-3">Are you sure?</span>
                                                    <p class="mb-5">Panotsms {{ $panorama->name }} will be deleted
                                                        and all it's links</p>
                                                    <div class="space-x-5 mt-5 flex justify-center">
                                                        <button @click="showPanoramaModal = !showPanoramaModal" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-gray-800 hover:bg-gray-900 hover:shadow-lg">
                                                            Cancel
                                                        </button>
                                                        <form action="{{route('panoramas.destroy', ['panorama' => $panorama->id])}}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-red-500 hover:bg-red-500 hover:shadow-lg">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="lg:mt-0 mt-6 w-full">
                        <h2 class="title-font text-4xl text-gray-500 tracking-widest">{{ $apartment->name }}</h2>
                        <h1 class="text-3xl title-font font-medium mb-1">{{ $apartment->title }}</h1>
                        <p class="leading-relaxed">{!! $apartment->about !!}</p>

                        <h5 class="mt-4">Features</h5>
                        <div class="flex flex-wrap gap-2.5 mt-1">
                            @foreach($apartment->features as $feature)
                                <div class="border border-gray-600 focus:outline-none font-black hover:bg-gray-100 pt-3 px-5 py-2.5 relative rounded-md text-gray-600 text-sm">
                                    <button class="flex items-center font-semibold">
                                        <img src="{{ $feature->icon }}" class="h-10 w-auto mr-2"/>
                                        {{ $feature->name }}
                                    </button>
                                    <form method="post" action="{{route('features.detach')}}">
                                        @csrf
                                        <input type="hidden" name="apartment_id" value="{{$apartment->id}}">
                                        <input type="hidden" name="feature_id" value="{{$feature->id}}">
                                        <button type="submit" class="absolute border-gray-100 hover:bg-gray-300 hover:text-white right-1 rounded-full text-gray-300 top-0.5 w-6">
                                            x
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>

                        <hr class="my-4">

                        <x-label>Details</x-label>
                        <ul>
                            @foreach($apartment->details as $detail)
                                <li class="flex justify-between">
                                    <div class="flex gap-9 items-center mt-1">
                                        <h5 class="font-black text-gray-500 text-lg">{{ $detail->name }}</h5>
                                        <h6>{{ $detail->value }}</h6>
                                    </div>
                                    <div class="flex justify-center items-center">
                                        <div x-data="{ editModal : false }">
                                            <button @click="editModal = !editModal" type="submit" class="hover:bg-gray-300 hover:text-white rounded-full text-gray-300 p-1 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                            </button>
                                            <!-- Modal Background -->
                                            <div x-show="editModal" class="fixed text-gray-500 flex items-center justify-center overflow-auto z-50 bg-black bg-opacity-40 left-0 right-0 top-0 bottom-0" x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                                <!-- Modal -->
                                                <div x-show="editModal" class="bg-white mx-10 p-12 w-2/6 rounded-xl shadow-2xl" @click.away="editModal = false" x-transition:enter="transition ease duration-100 transform" x-transition:enter-start="opacity-0 scale-90 translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease duration-100 transform" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-90 translate-y-1">
                                                    <form method="post" action="{{route('details.update', ['detail' => $detail->id])}}" autocomplete="off">
                                                        @csrf
                                                        @method('put')
                                                        <span class="font-bold block text-2xl mb-3">Edit Detail</span>
                                                        <div class="grid grid-cols-2 gap-2.5">
                                                            @foreach($languages as $language)
                                                                <div>
                                                                    <x-label class="mt-2">Name
                                                                        - {{$language->code}}</x-label>
                                                                    <x-input name="name_{{$language->code}}" value="{{ $detail->getTranslation('name', $language->code) }}" required></x-input>
                                                                </div>
                                                                <div>
                                                                    <x-label class="mt-2">Value
                                                                        - {{$language->code}}</x-label>
                                                                    <x-input name="value_{{$language->code}}" value="{{ $detail->getTranslation('value', $language->code) }}" required></x-input>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="space-x-5 mt-5 flex justify-end">
                                                            <button type="button" @click="editModal = !editModal" class="focus:outline-none text-white py-2.5 px-5 rounded-md bg-red-500 hover:bg-red-600 hover:shadow-lg flex items-center transition">
                                                                Cancel
                                                            </button>
                                                            <x-buttons.save></x-buttons.save>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <form method="post" action="{{route('details.destroy', ['detail' => $detail->id])}}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="hover:bg-gray-300 hover:text-white rounded-full text-gray-300 w-6">
                                                X
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
                <button @click="add = !add" onclick="{{ session(['apartment-add' => true]) }}" class="mt-16 ml-10 bg-gray-700 border h-12 hover:bg-gray-900 rounded-full text-white transition w-12">
                    +
                </button>
            </div>
        </section>
        @if(session()->get('apartment-add') == true)
            <div x-show="add" class="flex flex-wrap gap-12 mt-10">
                <div class="w-64 h-full bg-white body-font overflow-hidden rounded-2xl text-gray-400 px-6 py-6">
                    <h1 class="font-black mb-5 text-gray-500 text-lg">Add 360 Panorama</h1>
                    <form action="{{ route('panoramas.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
                            <x-label value="Photo"/>
                            <input type="file" name="photo" required class="border rounded shadow w-full"/>
                            <x-label value="Name" class="mt-2"/>
                            <x-input type="text" name="name" required/>
                        </div>
                        <x-buttons.save class="mt-5"></x-buttons.save>
                    </form>
                </div>
                <div class="w-64 h-full bg-white body-font overflow-hidden rounded-2xl text-gray-400 px-6 py-6">
                    <h1 class="font-black mb-5 text-gray-500 text-lg">Add Photos</h1>
                    <form action="{{ route('images.upload') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
                        <div class="mb-3">
                            <x-label value="Photos"/>
                            <input type="file" name="images[]" multiple required class="border rounded shadow w-full"/>
                        </div>
                        <x-buttons.save class="mt-5"></x-buttons.save>
                    </form>
                </div>
                <div class="bg-white h-full body-font overflow-hidden rounded-2xl text-gray-400 p-6 w-64">
                    <h1 class="font-black mb-5 text-gray-500 text-lg">Add Floor</h1>
                    <form action="{{ route('floors.store') }}" method="post" autocomplete="off" class="flex flex-col" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="apartment_id" value="{{$apartment->id}}">

                        <x-label>Number</x-label>
                        <input name="number" type="number" class="border border-gray-50 p-0.5 rounded shadow" required/>

                        <x-label class="mt-4">Plan</x-label>
                        <input name="plan" type="file" class="border rounded shadow" required/>

                        <x-buttons.save class="mt-4"></x-buttons.save>
                    </form>
                </div>
                <div class="bg-white h-full body-font overflow-hidden rounded-2xl text-gray-400 px-6 py-6 text-center">
                    <h1 class="font-black mb-5 text-gray-500 text-lg">Add Details</h1>
                    <form action="{{ route('details.store') }}" method="post" autocomplete="off">
                        @csrf
                        <input type="hidden" name="apartment_id" value="{{$apartment->id}}">
                        <div class="grid grid-cols-2 gap-2.5">
                            @foreach($languages as $language)
                                <div>
                                    <x-label class="mt-2">Name - {{$language->code}}</x-label>
                                    <x-input name="name_{{$language->code}}" required></x-input>
                                </div>
                                <div>
                                    <x-label class="mt-2">Value - {{$language->code}}</x-label>
                                    <x-input name="value_{{$language->code}}" required></x-input>
                                </div>
                            @endforeach
                        </div>
                        <x-buttons.save class="mt-5"></x-buttons.save>
                    </form>
                </div>
                <div class="w-64 h-full bg-white body-font overflow-hidden rounded-2xl text-gray-400 px-6 py-6">
                    <h1 class="font-black mb-5 text-gray-500 text-lg">Add Features</h1>
                    <form action="{{ route('features.attach') }}" method="post" autocomplete="off">
                        @csrf
                        <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
                        <x-select name="features[]" required multiple size="7">
                            @foreach($features as $feature)
                                <option value="{{ $feature->id }}">{{ $feature->name }}</option>
                            @endforeach
                        </x-select>
                        <x-buttons.save class="mt-5"></x-buttons.save>
                    </form>
                </div>

            </div>
        @endif
    </div>

</x-app-layout>
