<header class="flex justify-between items-center py-4 px-6 bg-white border-b-4 border-indigo-600">
    <div class="flex items-center">
        <button @click="sidebarOpen = !sidebarOpen" class="mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>


    <div class="flex items-center">
        <div>
            {{--@foreach($notifications as $notification)
                <p>{{ $notification->email }}</p>
            @endforeach--}}
        </div>
        <div class="mr-5">
            @foreach($available_locales as $available_locale)
                @if($available_locale === $current_locale)
                    <span class="ml-2 mr-2 text-gray-700">{{ $available_locale->name }}</span>
                @else
                    <a class="border font-semibold hover:bg-indigo-50 ml-1 ml-2 mr-2 rounded" href="{{ url('/') }}/language/{{ $available_locale->code }}">
                        <span>{{ $available_locale->name }}</span>
                    </a>
                @endif
            @endforeach
        </div>
        <div x-data="{ dropdownOpen: false }" class="relative">
            <button @click="dropdownOpen = ! dropdownOpen"
                    class="relative block h-8 w-8 rounded-full overflow-hidden shadow focus:outline-none">
                <img class="h-full w-full object-cover"
                     src="{{ asset('images/avatar.jpg') }}">
            </button>

            <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"
                 style="display: none;"></div>

            <div x-show="dropdownOpen"
                 class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10"
                 style="display: none;">
                <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Profile</a>
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button type="submit" class="block min-w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </div>
</header>
