<x-app-layout>
    <x-slot name="title">
        Add Apartment
    </x-slot>

    <div class="w-full lg:w-8/12 px-4 mx-auto mt-6">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-2xl bg-white border-0">
            <div class="rounded-t-2xl bg-white mb-0 px-6 py-6">
                <div class="text-center flex justify-between">
                    <h6 class="text-blueGray-700 text-xl font-bold">
                        Add Apartment
                    </h6>
                </div>
            </div>
            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                <form method="post" action="{{ route('apartments.store') }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    @if(isset($project->id))
                        <input type="hidden" name="project_id" value="{{$project->id}}"/>
                    @else
                        <div class="flex flex-col mb-4">
                            <x-label>Project <span class="text-indigo-400">*</span></x-label>
                            <x-select name="project_id">
                                @foreach($projects as $project)
                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </x-select>
                        </div>
                    @endif

                    <div class="relative w-full mb-4">
                        <x-label value="Photos"/>
                        <input type="file" name="images[]" multiple class="border rounded shadow"/>
                    </div>

                    <div class="mt-7">
                        <x-label value="Features"/>
                        <x-select name="features[]" multiple size="7">
                            @foreach($features as $feature)
                                <option value="{{$feature->id}}">{{ $feature->name }}</option>
                            @endforeach
                        </x-select>
                    </div>

                    <div class="relative w-full mb-3 mt-4">
                        <x-label>Number of rooms <span class="text-indigo-400">*</span></x-label>
                        <x-input class="block mt-1 w-full" type="number" name="rooms_number" required/>
                    </div>

                    @foreach($languages as $language)
                        <div class="my-16">
                            <h1 class="bg-indigo-100 font-semibold mb-4 py-3 text-center">{{ $language->name }}</h1>

                            <div class="relative w-full mb-3">
                                <x-label>Name <span class="text-indigo-400">*</span></x-label>
                                <x-input class="block mt-1 w-full" type="text" name="name_{{$language->code}}" required/>
                            </div>
                            <div class="relative w-full mb-3">
                                <x-label>Title <span class="text-indigo-400">*</span></x-label>
                                <x-input class="block mt-1 w-full" type="text" name="title_{{$language->code}}" required/>
                            </div>
                            <div class="relative w-full mb-3">
                                <x-label>About</x-label>
                                <x-textarea id="editor_{{$language->code}}" name="about_{{$language->code}}" rows="4" required></x-textarea>
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
