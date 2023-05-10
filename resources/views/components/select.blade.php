<select {{ $attributes->merge(['class' => 'border-0 overflow-auto relative rounded shadow w-full']) }} >
    {{ $slot }}
</select>
