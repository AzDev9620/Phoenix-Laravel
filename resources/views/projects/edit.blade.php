<x-app-layout>
    <x-slot name="title">
        Edit Project
    </x-slot>

    <div class="w-full lg:w-8/12 px-4 mx-auto mt-6">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-2xl bg-white border-0">
            <div class="rounded-t-2xl bg-white mb-0 px-6 py-6 mb-0 pb-0">
                <div class="text-center flex justify-between">
                    <h6 class="text-blueGray-700 text-xl font-bold">
                        Edit Project
                    </h6>
                </div>
            </div>
            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                <form method="post" action="{{ route('projects.update', ['project' => $project->id]) }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    @foreach($languages as $language)
                        <div class="my-16">
                            <h1 class="bg-indigo-100 font-semibold mb-4 py-3 text-center">{{ $language->name }}</h1>
                            <div class="w-full mb-3">
                                <x-label>Name <span class="text-indigo-400">*</span></x-label>
                                <x-input value="{{$project->getTranslation('name', $language->code)}}" class="block mt-1 w-full" type="text" name="name_{{$language->code}}" required/>
                            </div>
                            <div class="w-full mb-3">
                                <x-label>Sub Name <span class="text-indigo-400">*</span></x-label>
                                <x-input value="{{$project->getTranslation('sub_name', $language->code)}}" class="block mt-1 w-full" type="text" name="sub_name_{{$language->code}}" required/>
                            </div>

                            <div class="w-full mb-3">
                                <x-label value="About"/>
                                <x-textarea id="editor_{{$language->code}}" name="about_{{$language->code}}" rows="4" required>
                                    {{$project->getTranslation('about', $language->code)}}
                                </x-textarea>
                            </div>

                            <div class="w-full mb-3 flex gap-10">
                                <div>
                                    <x-label value="Current File"/>
                                    @if(array_key_exists($language->code, $project->translations['file']))
                                        <a href="{{$project->getTranslation('file', $language->code)}}" target="_blank" class="bg-gray-100 flex gap-1 hover:bg-gray-200 inline-flex px-5 py-0.5 rounded shadow transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </a>
                                    @else
                                        <p>no file</p>
                                    @endif
                                </div>
                                <div>
                                    <x-label value="New File"/>
                                    <input type="file" name="file_{{$language->code}}"/>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="border-t-4 flex gap-3 justify-end pt-6">
                        <x-buttons.cancel></x-buttons.cancel>
                        <x-buttons.save></x-buttons.save>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <x-slot name="script">
        <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
        <script>
            const languages = {!! json_encode($languages) !!};
            languages.forEach(language => {
                ClassicEditor.create(document.querySelector('#editor_' + language.code))
                    .catch(error => {
                        console.log(error);
                    })
            })

        </script>
    </x-slot>

</x-app-layout>
