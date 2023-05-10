@props(['project'])

<a href="{{ route('projects.show', ['project' => $project->id]) }}" class="bg-white cursor-pointer duration-500 hover:scale-105 max-w-sm pt-7 px-3 rounded-xl shadow-lg transform transition">
  <div class="relative">
    <img class="h-44 rounded-md w-full" src="{{ $project->main_image ?? asset('images/default-project.jpg') }}"/>
  </div>
  <h1 class="mt-4 text-gray-800 text-3xl font-bold cursor-pointer">
      {{ $project->name }}
  </h1>
  <div class="my-4">
    <div class="flex space-x-1 items-center">
      <span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mb-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </span>
      <p>{{ count($project->apartments) }} Apartments</p>
    </div>
  </div>
</a>
