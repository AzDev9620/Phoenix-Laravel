<x-app-layout>
    <x-slot name="title">
        Edit Apartment
    </x-slot>

    <div class="w-full lg:w-8/12 px-4 mx-auto mt-6">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-2xl bg-white border-0">
            <div class="rounded-t-2xl bg-white mb-0 px-6 py-6 pb-0">
                <div class="text-center flex justify-between">
                    <h6 class="text-blueGray-700 text-xl font-bold">
                        Edit Apartment
                    </h6>
                </div>
            </div>
            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                <form method="post" action="{{ route('apartments.update', ['apartment' => $apartment->id]) }}" autocomplete="off">
                    @csrf
                    @method('put')

                    @foreach($languages as $language)
                        <div class="my-16">
                            <h1 class="bg-indigo-100 font-semibold mb-4 py-3 text-center">{{ $language->name }}</h1>

                            <div class="w-full mb-3">
                                <x-label>Name <span class="text-indigo-400">*</span></x-label>
                                <x-input value="{{$apartment->getTranslation('name', $language->code)}}" class="block mt-1 w-full" type="text" name="name_{{$language->code}}" required/>
                            </div>
                            <div class="w-full mb-3">
                                <x-label>Title <span class="text-indigo-400">*</span></x-label>
                                <x-input value="{{$apartment->getTranslation('title', $language->code)}}" class="block mt-1 w-full" type="text" name="title_{{$language->code}}" required/>
                            </div>

                            <div class="w-full mb-3">
                                <x-label value="About"/>
                                <x-textarea id="editor_{{$language->code}}" name="about_{{$language->code}}" rows="4" required>
                                    {{$apartment->getTranslation('about', $language->code)}}
                                </x-textarea>
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
