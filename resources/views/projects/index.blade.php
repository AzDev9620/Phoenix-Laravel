<x-app-layout>
 <x-slot name="title">
     Projects
 </x-slot>

    <div class="mb-8">
        <x-buttons.add url="{{ route('projects.create') }}">
            Add Project
        </x-buttons.add>
    </div>
    <div class="md:px-4 md:grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 space-y-4 md:space-y-0">
        @foreach($projects as $project)
            <x-project-card :project="$project"></x-project-card>
        @endforeach
    </div>

</x-app-layout>
