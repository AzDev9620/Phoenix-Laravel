@props(['url'])

<a href="{{ $url }}" class="cursor-pointer focus:outline-none text-white text-sm py-4 px-6 rounded-md bg-gray-800 hover:bg-gray-900 hover:shadow-lg">
    {{ $slot }}
</a>
