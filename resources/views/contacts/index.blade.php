<x-app-layout>
    <x-slot name="title">
        Contact Notifications
    </x-slot>

    <div>
        <div class="px-4 py-5 border-b rounded-t sm:px-6">
            <h3 class="font-black text-3xl">
                Contact Forms
            </h3>
        </div>
        <div class="bg-white shadow overflow-hidden sm:rounded-md mb-4">
            <ul class="divide-y divide-gray-200">
                @foreach($contacts as $contact)
                    <li class="flex justify-between cursor-pointer hover:bg-gray-100">
                        <a href="{{route('contacts.show', ['contact' => $contact->id])}}" class="block w-full">
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center">
                                    <div class="flex font-semibold gap-5 items-baseline text-lg">
                                        <p class=" font-thin text-gray-700 truncate">
                                            {{$contact->name}}
                                        </p>
                                        <p class="text-sm font-thin text-gray-700 truncate">
                                            {{$contact->email}}
                                        </p>
                                    </div>
                                    @if($contact->read_at == null)
                                        <div class="ml-2 flex-shrink-0 flex">
                                            <p class="bg-green-500 font-black inline-flex leading-5 px-2 rounded-full text-white text-xs">
                                                New
                                            </p>
                                        </div>
                                    @else
                                    @endif
                                </div>
                                <div class="mt-2 sm:flex sm:justify-between">
                                    <div class="sm:flex">
                                        <p class="flex items-center text-sm font-light text-gray-500">
                                            {{ date('d-m-Y H:m', strtotime($contact->created_at)) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <form action="{{route('contacts.destroy', ['contact' => $contact->id])}}" method="post" class="p-6">
                            @csrf
                            @method('delete')
                            <button type="submit" class="hover:text-gray-400 p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>

        {{ $contacts->links() }}
    </div>

</x-app-layout>
