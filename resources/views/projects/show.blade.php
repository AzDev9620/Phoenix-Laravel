<x-app-layout>
    <x-slot name="title">
        {{ $project->name }}
    </x-slot>
    <div x-data="{ add: {{ session()->get('project-add') }} ?? false }">
        <section class="bg-white body-font overflow-hidden rounded-2xl text-gray-400 relative">
            <div class="absolute right-11 text-right top-10 flex gap-2">
                <a href="{{route('projects.edit', ['project' => $project->id])}}" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-gray-800 hover:bg-gray-900 hover:shadow-lg">
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
                            <p class="mb-5">Project {{ $project->name }} will be deleted permanently</p>
                            <div class="space-x-5 mt-5 flex justify-center">
                                <button @click="showModal = !showModal" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-gray-800 hover:bg-gray-900 hover:shadow-lg">
                                    Cancel
                                </button>
                                <form action="{{route('projects.destroy', ['project' => $project->id])}}" method="post">
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
            <div class="px-5 py-20 pb-11 lg:px-12">
                <div class="mx-auto grid lg:grid-cols-2">
                    <div>
                        <div class="flex flex-wrap">
                            <div>
                                <h5>Main Photo</h5>
                                @if($project->main_image)
                                    <div class="relative">
                                        <a href="{{ $project->main_image }}" target="_blank">
                                            <img src="{{ $project->main_image }}" class="w-48 h-28 rounded m-1">
                                        </a>
                                        <form action="{{ route('images.delete') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                                            <input type="hidden" name="image_type" value="main_image">
                                            <button type="submit" class="absolute font-black hover:bg-gray-300 hover:text-black m-0 p-0 right-2.5 rounded-full text-white top-2 transition w-6">
                                                x
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <h5 class="mt-4">Photos</h5>
                        <div class="flex flex-wrap">
                            @foreach($project->images as $image)
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

                        <hr class="mt-6 my-4 w-10/12">
                        <div class="py-3 flex flex-col sm:flex-row gap-10 pr-8">
                            <div>
                                <h5>Details Photo</h5>
                                @if($project->second_image)
                                    <div class="relative">
                                        <a href="{{ $project->second_image }}" target="_blank">
                                            <img src="{{ $project->second_image }}" class="w-full h-28 rounded m-1">
                                        </a>
                                        <form action="{{ route('images.delete') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                                            <input type="hidden" name="image_type" value="second_image">
                                            <button type="submit" class="absolute font-black hover:bg-gray-300 hover:text-black m-0 p-0 right-0 rounded-full text-white top-0.5 transition w-6">
                                                x
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h5>Details</h5>
                                <ul class="list-disc mt-2 space-y-1">
                                    @foreach($project->aspects as $aspect)
                                        <li class="flex justify-between items-center">
                                            <p>{{ $aspect->name }}</p>

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
                                                            <form method="post" action="{{route('aspects.update', ['aspect' => $aspect->id])}}" autocomplete="off">
                                                                @csrf
                                                                @method('put')
                                                                <span class="font-bold block text-2xl mb-3">Edit Detail</span>
                                                                @foreach($languages as $language)
                                                                    <div>
                                                                        <x-label class="mt-4">Name
                                                                            - {{$language->code}}</x-label>
                                                                        <x-input name="name_{{$language->code}}" value="{{$aspect->getTranslation('name', $language->code)}}"></x-input>
                                                                    </div>
                                                                @endforeach
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
                                                <form method="post" action="{{route('aspects.destroy', ['aspect' => $aspect->id])}}">
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

                    </div>

                    <div class="lg:mt-0 mt-6 w-full">
                        <h2 class="title-font text-4xl text-gray-500 tracking-widest">{{ $project->name }}</h2>
                        <h1 class="text-3xl title-font font-medium mb-1">{{ $project->sub_name }}</h1>
                        <p class="leading-relaxed">{!! $project->about !!}</p>

                        <a href="{{ $project->file }}" target="_blank" class="bg-gray-100 flex gap-1 hover:bg-gray-200 inline-flex my-2 p-2 mt-4 rounded shadow transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Project File
                        </a>

                        <!-- Features -->
                        <h5 class="mt-4">Features</h5>
                        <div class="flex flex-wrap gap-2.5 mt-1">
                            @foreach($project->features as $feature)
                                <div class="border border-gray-600 focus:outline-none font-black hover:bg-gray-100 pt-3 px-5 py-2.5 relative rounded-md text-gray-600 text-sm">
                                    <button class="flex items-center font-semibold">
                                        <img src="{{ $feature->icon }}" class="h-10 w-auto mr-2"/>
                                        {{ $feature->name }}
                                    </button>
                                    <form method="post" action="{{route('features.detach')}}">
                                        @csrf
                                        <input type="hidden" name="project_id" value="{{$project->id}}">
                                        <input type="hidden" name="feature_id" value="{{$feature->id}}">
                                        <button type="submit" class="absolute border-gray-100 hover:bg-gray-300 hover:text-white right-1 rounded-full text-gray-300 top-0.5 w-6">
                                            x
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>

                        <hr class="my-4">

                        <!-- Benefits -->
                        <h5 class="mt-4">Benefits</h5>
                        <div class="flex flex-wrap gap-2.5 mt-1">

                            @foreach($project->benefits as $benefit)
                                <div class="relative">
                                    <div class="border border-gray-400 p-4 rounded text-center cursor-pointer hover:bg-gray-100">
                                        <div class="flex justify-center mb-2">
                                            <img class="h-16" src="{{ $benefit->icon }}">
                                        </div>
                                        <h1 class="font-black text-gray-500">{{ $benefit->name }}</h1>
                                        <h5 class="text-xl text-gray-600">{{ $benefit->number }}</h5>
                                    </div>

                                    <div class="absolute right-1 top-1 flex">
                                        <div x-data="{ editBenefitModal : false }">
                                            <button @click="editBenefitModal = !editBenefitModal" type="submit" class="border-gray-100 hover:bg-gray-300 hover:text-white rounded-full text-gray-300 p-1 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                            </button>
                                            <!-- Modal Background -->
                                            <div x-show="editBenefitModal" class="fixed text-gray-500 flex items-center justify-center overflow-auto z-50 bg-black bg-opacity-40 left-0 right-0 top-0 bottom-0" x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                                <!-- Modal -->
                                                <div x-show="editBenefitModal" class="bg-white mx-10 p-12 w-2/6 rounded-xl shadow-2xl" @click.away="editBenefitModal = false" x-transition:enter="transition ease duration-100 transform" x-transition:enter-start="opacity-0 scale-90 translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease duration-100 transform" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-90 translate-y-1">
                                                    <form method="post" action="{{route('benefits.update', ['benefit' => $benefit->id])}}" autocomplete="off" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <span class="font-bold block text-2xl mb-3">Edit Benefit</span>
                                                        <x-label class="">Icon</x-label>
                                                        <input name="icon" type="file" class="border rounded shadow"/>
                                                        <div class="grid grid-cols-2 gap-2.5">
                                                            @foreach($languages as $language)
                                                                <div>
                                                                    <x-label class="mt-4">Name
                                                                        - {{$language->code}}</x-label>
                                                                    <input name="name_{{$language->code}}" value="{{$benefit->getTranslation('name', $language->code)}}" type="text" class="w-full border border-gray-50 p-0.5 rounded shadow" required/>
                                                                </div>
                                                                <div>
                                                                    <x-label class="mt-4">Number
                                                                        - {{$language->code}}</x-label>
                                                                    <input name="number_{{$language->code}}" value="{{$benefit->getTranslation('number', $language->code)}}" type="text" class="w-full border border-gray-50 p-0.5 rounded shadow" required/>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="space-x-5 mt-5 flex justify-end">
                                                            <button type="button" @click="editBenefitModal = !editBenefitModal" class="focus:outline-none text-white py-2.5 px-5 rounded-md bg-red-500 hover:bg-red-600 hover:shadow-lg flex items-center transition">
                                                                Cancel
                                                            </button>
                                                            <x-buttons.save></x-buttons.save>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <form method="post" action="{{route('benefits.destroy', ['benefit' => $benefit->id])}}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="hover:bg-gray-300 hover:text-white rounded-full text-gray-300 w-6">
                                                X
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <button @click="add = !add" onclick="{{ session(['project-add' => true]) }}" class="ml-10 mt-11 bg-gray-700 border h-12 hover:bg-gray-900 rounded-full text-white transition w-12">
                    +
                </button>
            </div>
        </section>

        <!-- Add Section -->
        @if(session()->get('project-add') == true)
            <div x-show="add" class="border-b-4 border-gray-300 flex flex-wrap gap-12 mb-20 mt-10 pb-16">
                <div class="h-full bg-white body-font overflow-hidden rounded-2xl text-gray-400 px-6 py-6">
                    <h1 class="font-black mb-5 text-gray-500 text-lg">Add Details</h1>
                    <form action="{{ route('aspects.store') }}" method="post" autocomplete="off">
                        @csrf
                        <input type="hidden" name="project_id" value="{{$project->id}}">
                        @foreach($languages as $language)
                            <div>
                                <x-label class="mt-4">Name - {{$language->code}}</x-label>
                                <x-input name="name_{{$language->code}}" required></x-input>
                            </div>
                        @endforeach
                        <x-buttons.save class="mt-5"></x-buttons.save>
                    </form>
                </div>
                <div>
                    <div class="bg-white body-font overflow-hidden rounded-2xl text-gray-400 p-6">
                        <h1 class="font-black mb-5 text-gray-500 text-lg">Add Benefits</h1>
                        <form action="{{ route('benefits.store') }}" method="post" autocomplete="off" class="flex flex-col" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="project_id" value="{{$project->id}}">

                            <x-label class="">Icon</x-label>
                            <input name="icon" type="file" class="border rounded shadow" required/>
                            <div class="grid grid-cols-2 gap-2.5">
                                @foreach($languages as $language)
                                    <div>
                                        <x-label class="mt-4">Name - {{$language->code}}</x-label>
                                        <input name="name_{{$language->code}}" type="text" class="border border-gray-50 p-0.5 rounded shadow" required/>
                                    </div>
                                    <div>
                                        <x-label class="mt-4">Number - {{$language->code}}</x-label>
                                        <input name="number_{{$language->code}}" type="text" class="border border-gray-50 p-0.5 rounded shadow" required/>
                                    </div>
                                @endforeach
                            </div>
                            <x-buttons.save class="mt-4"></x-buttons.save>
                        </form>
                    </div>
                </div>
                <div class="w-64 h-full bg-white body-font overflow-hidden rounded-2xl text-gray-400 px-6 py-6">
                    <h1 class="font-black mb-5 text-gray-500 text-lg">Add Photos</h1>
                    <form action="{{ route('images.upload') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <input type="hidden" name="project_id" value="{{$project->id}}">
                        @if(!$project->main_image)
                            <div class="mb-3">
                                <x-label value="Main Photo"/>
                                <input type="file" name="main_image" class="border rounded shadow w-full"/>
                            </div>
                        @endif
                        @if(!$project->second_image)
                            <div class="mb-3">
                                <x-label value="Detail Photo"/>
                                <input type="file" name="second_image" class="border rounded shadow w-full"/>
                            </div>
                        @endif
                        <div class="mb-3">
                            <x-label value="Photos"/>
                            <input type="file" name="images[]" multiple class="border rounded shadow w-full"/>
                        </div>
                        <x-buttons.save class="mt-5"></x-buttons.save>
                    </form>
                </div>

                <div class="w-64 h-full bg-white body-font overflow-hidden rounded-2xl text-gray-400 px-6 py-6">
                    <h1 class="font-black mb-5 text-gray-500 text-lg">Add Features</h1>
                    {{--                    <form action="{{ route('projects.features.attach', ['project' => $project->id]) }}" method="post" autocomplete="off">--}}
                    <form action="{{ route('features.attach') }}" method="post" autocomplete="off">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
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

        <div class=" mt-11">
            <x-buttons.add :url="route('apartments.create.project', ['project' => $project])">Add Apartment</x-buttons.add>
        </div>

        <div class="md:px-4 my-11 md:grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 space-y-4 md:space-y-0">

            @foreach($project->apartments as $apartment)
                <x-apartment-card :apartment="$apartment"></x-apartment-card>
            @endforeach

        </div>
    </div>
</x-app-layout>
