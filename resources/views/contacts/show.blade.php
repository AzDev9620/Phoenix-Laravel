<x-app-layout>
    <x-slot name="title">
        Contact Notifications
    </x-slot>
    <div class="flex flex-col items-center">
        <div class="mb-6 cursor-pointer underline">
            <a href="{{ url()->previous() }}" class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                </svg>
                All Notifications
            </a>
        </div>
        <div class="shadow-lg rounded-xl w-72 md:w-2/4 p-10 lg:p-16 bg-white relative overflow-hidden">
            <div class="w-full h-full block">
                <div class="flex items-center mb-2 py-2">
                    <div class="bg-indigo-200 font-black h-14 rounded-full text-5xl text-center w-14">
                        <span>{{ substr($contact->name, 0, 1) }}</span>
                    </div>
                    <div class="pl-3">
                        <div class="font-medium text-3xl">
                            {{ $contact->name }}
                        </div>
                        <div class="text-gray-600">
                            {{ $contact->email }}
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <p class="text-gray-400 mb-4 mt-5 text-lg">
                        {{ $contact->message }}
                    </p>
                </div>
                <div class="flex items-center justify-between my-2">
                    <p class="text-blue-600 text-md font-medium mb-2">
                        {{ date('d-m-Y', strtotime($contact->created_at)) }}
                    </p>
                </div>
                <div class="flex items-center justify-between mt-10">
                    <a href="mailto:{{$contact->email}}" class="border hover:shadow p-1 px-4 rounded text-lg">
                        reply
                    </a>
                    <div x-data="{ showModal : false }">
                        <button @click="showModal = !showModal" type="button" class="bg-red-500 hover:bg-red-600 p-2 rounded-full text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                        <div x-show="showModal" class="fixed text-gray-500 flex items-center justify-center overflow-auto z-50 bg-black bg-opacity-40 left-0 right-0 top-0 bottom-0" x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                            <div x-show="showModal" class="bg-white mx-10 p-12 w-2/6 rounded-xl shadow-2xl text-center" @click.away="showModal = false" x-transition:enter="transition ease duration-100 transform" x-transition:enter-start="opacity-0 scale-90 translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease duration-100 transform" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-90 translate-y-1">
                                <span class="font-bold block text-2xl mb-3">Are you sure?</span>
                                <div class="space-x-5 mt-5 flex justify-center">
                                    <button @click="showModal = !showModal" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-gray-800 hover:bg-gray-900 hover:shadow-lg">
                                        Cancel
                                    </button>
                                    <form action="{{route('contacts.destroy', ['contact' => $contact->id])}}" method="post">
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
        </div>
    </div>
</x-app-layout>
