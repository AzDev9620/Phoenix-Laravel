@props(['apartment'])

<a href="{{ route('apartments.show', ['apartment' => $apartment->id]) }}" class="max-w-sm cursor-pointer hover:shadow-2xl hover:scale-105 transform transition-all duration-500">
    <div class="bg-white relative shadow-lg hover:shadow-xl transition duration-500 rounded-lg">
{{--        @dump(asset('images/floor-blan-icon.png'))--}}
{{--        <img class="rounded-t-lg" src="https://fpg.roomsketcher.com/image/project/3d/20/luxury-hotel-room-floor-plan-with-twin-beds-floor-plan.jpg?w=500&h=500"/>--}}
        <img class="h-64 rounded-t-lg w-full" src="{{ $apartment->floors->isEmpty() ? asset('images/floor-plan-icon.png') : $apartment->floors[0]->plan }}">
        <div class="py-6 px-8 rounded-lg bg-white h-full">
            <h1 class="text-gray-700 font-bold text-2xl mb-3 hover:text-gray-900 hover:cursor-pointer">{{ $apartment->name }}</h1>
            <p class="text-gray-700 tracking-wide">{{ $apartment->title }}</p>
            <div class="mt-4">
                <div class="flex space-x-1 items-center">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mb-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </span>
                    <p>{{ count($apartment->floors) }} Floors</p>
                </div>
                <div class="flex space-x-1 items-center">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mb-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
              </span>
                    <p>{{ $apartment->rooms_number }} Rooms</p>
                </div>
            </div>
        </div>
    </div>
</a>
