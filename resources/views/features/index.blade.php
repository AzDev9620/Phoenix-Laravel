<x-app-layout>
    <x-slot name="title">
        Features
    </x-slot>

    <div class="grid md:grid-cols-2 gap-14">
        <div>
            <div class="bg-white px-16 py-14 rounded-2xl shadow-md">
                <h1 class="font-black mb-4 text-2xl">
                    Project Features
                </h1>
                <div class="flex flex-wrap gap-2">
                    @foreach($project_features as $feature)
                        <div class="border border-gray-600 focus:outline-none font-black hover:bg-gray-100 pt-3 px-5 py-2.5 relative rounded-md text-gray-600 text-sm">
                            <button class="flex items-center font-semibold">
                                <img src="{{ $feature->icon }}" class="h-10 w-auto mr-2"/>
                                {{ $feature->name }}
                            </button>
                            <form method="post" action="{{route('features.destroy', ['feature' => $feature->id])}}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="absolute border-gray-100 hover:bg-gray-300 hover:text-white right-1 rounded-full text-gray-300 top-0.5 w-6">
                                    x
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="bg-white px-16 py-10 rounded-2xl shadow-md mt-6">
                <h1 class="font-black mb-4 text-xl">
                    Add Project Feature
                </h1>
                <form action="{{ route('features.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <input type="hidden" name="type" value="project"/>
                    <div class="gap-3 grid grid-cols-2">
                        @foreach($languages as $language)
                            <div>
                                <x-label>Name - {{$language->code}} <span class="text-indigo-400">*</span></x-label>
                                <x-input type="text" name="name{{'_'.$language->code}}" required></x-input>
                            </div>
                        @endforeach
                    </div>
                    <div class="gap-3 grid grid-cols-2 mt-4">
                        <div>
                            <x-label>Icon <span class="text-indigo-400">*</span></x-label>
                            <input type="file" name="icon" class="border rounded shadow w-full" required/>
                        </div>
                        <div class="flex items-end justify-end">
                            <x-buttons.save></x-buttons.save>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div>
            <div class="bg-white px-16 py-14 rounded-2xl shadow-md">
                <h1 class="font-black mb-4 text-2xl">
                    Apartment Features
                </h1>
                <div class="flex flex-wrap gap-2">
                    @foreach($apartment_features as $feature)
                        <div class="border border-gray-600 focus:outline-none font-black hover:bg-gray-100 pt-3 px-5 py-2.5 relative rounded-md text-gray-600 text-sm">
                            <button class="flex items-center font-semibold">
                                <img src="{{ $feature->icon }}" class="h-10 w-auto mr-2"/>
                                {{ $feature->name }}
                            </button>
                            <form method="post" action="{{route('features.destroy', ['feature' => $feature->id])}}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="absolute border-gray-100 hover:bg-gray-300 hover:text-white right-1 rounded-full text-gray-300 top-0.5 w-6">
                                    x
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="bg-white px-16 py-10 rounded-2xl shadow-md mt-6">
                <h1 class="font-black mb-4 text-xl">
                    Add Apartment Feature
                </h1>
                <form action="{{ route('features.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <input type="hidden" name="type" value="apartment"/>
                    <div class="gap-3 grid grid-cols-2">
                        @foreach($languages as $language)
                            <div>
                                <x-label>Name - {{$language->code}} <span class="text-indigo-400">*</span></x-label>
                                <x-input type="text" name="name_{{$language->code}}" required></x-input>
                            </div>
                        @endforeach
                    </div>
                    <div class="gap-3 grid grid-cols-2 mt-4">
                        <div>
                            <x-label>Icon <span class="text-indigo-400">*</span></x-label>
                            <input type="file" name="icon" class="border rounded shadow w-full" required/>
                        </div>
                        <div class="flex items-end justify-end">
                            <x-buttons.save></x-buttons.save>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

</x-app-layout>
