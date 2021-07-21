@section('title', 'Update password')

<div>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="{{ route('home') }}">
            <x-logo :w="32" />
        </a>

        <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
            Update password
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
            <p class="mt-2 text-sm text-green-600 text-center">{{$message}}</p>
            <form wire:submit.prevent="updatePassword">
                <div class="mt-6">
                    <label for="oldPassword" class="block text-lg font-medium text-gray-700 leading-5">
                        Password Lama
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.defer="oldPassword" id="old_password" type="password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('oldPassword') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('oldPassword')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 leading-5">
                        Password Baru
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.defer="password" id="password" type="password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 leading-5">
                        Konfirmasi Password Baru
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input wire:model.defer="passwordConfirmation" id="password_confirmation" type="password" required class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 appearance-none rounded-md focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('passwordConfirmation')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6 flex space-x-2">
                    <a href="{{route('home')}}" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-gray-600 border border-transparent rounded-md hover:bg-gray-500 focus:outline-none focus:gray-indigo-700 focus:ring-indigo active:bg-gray-700 transition duration-150 ease-in-out">
                        Back</a>
                    @include('livewire.form.loading-button',['text'=>__('Update password'),'target'=>'updatePassword'])
                </div>
            </form>
        </div>
    </div>
</div>
