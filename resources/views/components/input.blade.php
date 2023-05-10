@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-0 border-gray-100 duration-150 ease-linear focus:outline-none focus:ring focus:border-transparent px-3 py-3 rounded shadow text-sm font-semibold transition-all w-full']) !!}>
