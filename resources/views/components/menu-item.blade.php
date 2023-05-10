@props(['url'])

<a href="{{ $url }}" {{ $attributes->merge(['class' => 'flex items-center py-3 px-6 hover:bg-gray-800 transition bg-opacity-25 text-gray-100']) }}>
    {{ $icon ?? '' }}
    <span class="mx-3"> {{ $slot }} </span>
</a>
