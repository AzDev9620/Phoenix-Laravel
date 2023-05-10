<x-app-layout>
    <x-slot name="title">
        {{ __('Apartments') }}
    </x-slot>

    <div class="mb-4 flex justify-between">
        <x-buttons.add url="{{ route('apartments.create') }}">
            Add Apartment
        </x-buttons.add>
    </div>

    <div class="mb-5 md:px-4 md:grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 space-y-4 md:space-y-0">
        @foreach($apartments as $apartment)
            <x-apartment-card :apartment="$apartment"></x-apartment-card>
        @endforeach
    </div>

    {{ $apartments->links() }}

</x-app-layout>
