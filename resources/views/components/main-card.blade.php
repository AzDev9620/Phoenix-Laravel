@props(['number'])

<div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/4 sm:mt-0 cursor-pointer">
    <div class="flex items-center px-5 py-7 shadow-sm rounded-md bg-white hover:shadow-xl hover:scale-105 transform transition-all duration-500">
        <div class="p-3 rounded-full text-indigo-500">
            {{ $icon }}
        </div>

        <div class="mx-5">
            <h4 class="font-semibold text-4xl text-gray-600">
                {{ $number }}
            </h4>
            <div class="text-gray-500 text-xl">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
