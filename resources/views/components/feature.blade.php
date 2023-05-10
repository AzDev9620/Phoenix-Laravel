@props(['feature', 'url'])

<div>
    <div class="border border-gray-600 focus:outline-none font-black hover:bg-gray-100 pt-3 px-5 py-2.5 relative rounded-md text-gray-600 text-sm">
        <button  class="flex items-center font-semibold">
            <img src="{{ $feature->icon }}" class="h-10 w-auto mr-2"/>
            {{ $feature->name }}
        </button>
        <form>
            <button class="absolute border-gray-100 hover:bg-gray-300 hover:text-white right-1 rounded-full text-gray-300 top-0.5 w-6">
                x
            </button>
        </form>
    </div>
</div>
