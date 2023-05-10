<x-app-layout>
    <x-slot name="title">
        Languages
    </x-slot>
    <div class="flex flex-col sm:flex-row gap-10">
        <div>
            <h1 class="font-semibold mb-10 text-4xl">Site Languages</h1>

            <div class="flex flex-col gap-2 w-full">
                @foreach($languages as $language)
                    <div class="relative">
                        <div class="relative p-6 pl-10 pr-28 bg-white flex items-center space-x-6 rounded-lg shadow-md hover:scale-105 transition transform duration-500 cursor-pointer">
                            <div class="bg-indigo-500 flex font-black items-center justify-center p-3 rounded-full text-5xl text-white">
                                <h1>
                                    {{ $language->code }}
                                </h1>
                            </div>
                            <div>
                                <h1 class="text-xl font-bold text-gray-700 mb-2">{{ $language->name }}</h1>
                            </div>
                        </div>
                        <div x-data="{ editModal : false }">
                            <button @click="editModal = !editModal" class="absolute top-0 right-0 bg-red-500 hover:bg-red-600 hover:shadow p-2 rounded text-sm text-white transition">
                                delete
                            </button>
                            <!-- Modal Background -->
                            <div x-show="editModal" class="fixed text-gray-500 flex items-center justify-center overflow-auto z-50 bg-black bg-opacity-40 left-0 right-0 top-0 bottom-0" x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                <!-- Modal -->
                                <div x-show="editModal" class="bg-white text-center mx-10 p-12 w-2/6 rounded-xl shadow-2xl" @click.away="editModal = false" x-transition:enter="transition ease duration-100 transform" x-transition:enter-start="opacity-0 scale-90 translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease duration-100 transform" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-90 translate-y-1">
                                    <form method="post" action="{{route('languages.destroy', ['language' => $language->id])}}">
                                        @csrf
                                        @method('delete')
                                        <span class="font-bold block text-2xl mb-3">Are you sure!?</span>
                                        <span class="font-bold block text-xl mb-3">Language <span class="text-indigo-500 font-black">{{ $language->name  }}</span> will be deleted and all it's content!</span>
                                        <div class="space-x-5 mt-5 flex justify-center">
                                            <button type="button" @click="editModal = !editModal" class="focus:outline-none text-white py-2.5 px-5 rounded-md bg-red-500 hover:bg-red-600 hover:shadow-lg flex items-center transition">
                                                Cancel
                                            </button>
                                            <x-buttons.save></x-buttons.save>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="bg-white lg:w-1/3 md:w-1/2 mt-14 p-6 rounded-lg shadow-md xl:w-1/4 h-full">
            <form action="{{ route('languages.store') }}" method="post" autocomplete="off">
                @csrf
                <h1 class="font-bold mb-6 text-2xl">Add new</h1>
                <div>
                    <x-label>code <span class="text-indigo-400">*</span></x-label>
                    <x-input name="code" required></x-input>
                </div>
                <div class="mt-4 mb-4">
                    <x-label>name <span class="text-indigo-400">*</span></x-label>
                    <x-input name="name" required></x-input>
                </div>
                <div class="text-right">
                    <x-buttons.save></x-buttons.save>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
