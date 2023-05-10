<x-app-layout>
    <x-slot name="title">
        Profile
    </x-slot>
    <div class="flex flex-col flex-wrap gap-14 md:flex-row">
        <div class="flex mt-20">
            <div class="card w-96 mx-auto bg-white rounded-xl shadow-xl">
                <img class="w-32 mx-auto rounded-full -mt-20 border-8 border-white" src="{{ asset('images/avatar.jpg') }}">
                <div class="text-center mt-2 text-3xl font-medium">Phoenix Admin</div>
                <form action="{{ route('profile.update') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="px-8 py-4">
                        <x-label>Name</x-label>
                        <x-input name="name" value="{{$user->name}}"></x-input>
                    </div>
                    <div class="px-8 py-4">
                        <x-label>email</x-label>
                        <x-input name="email" value="{{$user->email}}"></x-input>
                    </div>
                    <div class="flex p-4">
                        <div class="w-1/2 text-center">
                        </div>
                        <div class="w-0 border-0">
                        </div>
                        <div class="w-1/2 text-center">
                            <x-buttons.save></x-buttons.save>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="flex mt-11">
            <div class="card w-96 mx-auto bg-white rounded-xl shadow-xl">
                <form method="post" action="{{route('change-password')}}" autocomplete="off">
                    @csrf
                    <h1 class="font-black m-5 mb-2 text-xl">Change Password</h1>
                    <div class="px-8 py-2 pt-4">
                        <x-label>Current Password</x-label>
                        <x-input type="password" name="current_password" required></x-input>
                    </div>
                    <div class="px-8 py-2">
                        <x-label>New Password</x-label>
                        <x-input type="password" name="password" required></x-input>
                    </div>
                    <div class="px-8 py-2">
                        <x-label>Confirm Password</x-label>
                        <x-input type="password" name="confirm_password" required></x-input>
                    </div>
                    <div class="flex p-4">
                        <div class="w-1/2 text-center">
                        </div>
                        <div class="w-0 border-0">
                        </div>
                        <div class="w-1/2 text-center">
                            <x-buttons.save></x-buttons.save>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

</x-app-layout>
