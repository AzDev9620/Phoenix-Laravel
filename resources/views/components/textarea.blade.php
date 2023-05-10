<textarea type="text" {!! $attributes->merge(['class' => 'border border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150']) !!}>
    {{ $slot }}
</textarea>
