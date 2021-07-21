<x-nppbkc-modal>
    <x-slot name="content" >
@if($action=='add')
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                <x-heroicon-o-user-add class="h-6 w-6 text-indigo-600"/>
                </div>
                <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left w-full px-5">
                    <div class="mt-2" >
                        <h1 class="flex-auto text-xl font-semibold text-purple-700 mb-4">Tambah User</h1>
                    </div>
                    <div class="mt-2" >
                        @include('livewire.form.input',['name'=>'name','text'=>'Nama'])
                        @include('livewire.form.input',['name'=>'email','type'=>'email','text'=>'E-mail'])
                        @include('livewire.form.input',['name'=>'password','text'=>'Password'])
                      
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label for="inline-role" class="font-bold mb-1 text-gray-700 block">Role</label>
                            </div>
                            <div class="md:w-2/3 relative">
                                <select wire:model="role" class="rounded-lg text-gray-700">
                                    <option value="user">User Biasa</option>
                                    <option value="officer">Petugas</option>
                                    <option value="admin">Admin</option>
                                </select>
                                @error('role') 
                                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                    {{ $message }}
                                </span> 
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button wire:click.prevent="add()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                <svg wire:loading.delay wire:target="add" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span wire:loading.remove.delay wire:target="add">Simpan</span><span wire:loading.delay wire:target="add">{{ __('Processing') }}</span>&nbsp;
            </button>
            <button wire:click="$emit('closeModal')" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
        </div>
@endif

@if($action=='edit')
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                <x-heroicon-o-pencil-alt class="h-6 w-6 text-indigo-600"/>
                </div>
                <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left w-full px-5">
                    <div class="mt-2" >
                        <h1 class="flex-auto text-xl font-semibold text-purple-700 mb-4">Edit User {{$name}}</h1>
                    </div>
                    <div class="mt-2" >
                        @include('livewire.form.input',['name'=>'name','text'=>'Nama'])
                        @include('livewire.form.input',['name'=>'email','type'=>'email','text'=>'E-mail'])
                        @include('livewire.form.input',['name'=>'password','text'=>'Password'])
                      
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label for="inline-role" class="font-bold mb-1 text-gray-700 block">Role</label>
                            </div>
                            <div class="md:w-2/3 relative">
                                <select wire:model="role" class="rounded-lg text-gray-700">
                                    <option value="user">User Biasa</option>
                                    <option value="officer">Petugas</option>
                                    <option value="admin">Admin</option>
                                </select>
                                @error('role') 
                                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                    {{ $message }}
                                </span> 
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button wire:click.prevent="edit()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                <svg wire:loading.delay wire:target="edit" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span wire:loading.remove.delay wire:target="edit">Simpan</span><span wire:loading.delay wire:target="edit">{{ __('Processing') }}</span>&nbsp;
            </button>
            <button wire:click="$emit('closeModal')" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
        </div>
@endif
 
@if($action=='resend')
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                <x-heroicon-o-mail class="h-6 w-6 text-green-600"/>
                </div>
                <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left w-full px-5">
                    <div class="mt-2" >
                        <h1 class="flex-auto text-xl font-semibold text-green-700 mb-4">Resend email activation : {{$name}}</h1>
                    </div>
                    <div class="mt-2" >
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button wire:click.prevent="resend()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 
            bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                <svg wire:loading.delay wire:target="resend" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span wire:loading.remove.delay wire:target="resend">Resend</span><span wire:loading.delay wire:target="resend">{{ __('Processing') }}</span>&nbsp;
            </button>
            <button wire:click="$emit('closeModal')" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
        </div>
@endif

@if($action=='verify')
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                <x-heroicon-o-bell class="h-6 w-6 text-green-600"/>
                </div>
                <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left w-full px-5">
                    <div class="mt-2" >
                        <h1 class="flex-auto text-xl font-semibold text-green-700 mb-4">Verify : {{$name}}</h1>
                    </div>
                    <div class="mt-2" >
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button wire:click.prevent="verify()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 
            bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                <svg wire:loading.delay wire:target="verify" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span wire:loading.remove.delay wire:target="verify">Verify</span><span wire:loading.delay wire:target="verify">{{ __('Processing') }}</span>&nbsp;
            </button>
            <button wire:click="$emit('closeModal')" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
        </div>
@endif

@if($action=='delete')
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                <x-heroicon-o-x class="h-6 w-6 text-red-600"/>
                </div>
                <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left w-full px-5">
                    <div class="mt-2" >
                        <h1 class="flex-auto text-xl font-semibold text-red-700 mb-4">Hapus user : {{$name}}</h1>
                    </div>
                    <div class="mt-2" >
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button wire:click.prevent="delete()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 
            bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                <svg wire:loading.delay wire:target="delete" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span wire:loading.remove.delay wire:target="delete">Hapus</span><span wire:loading.delay wire:target="delete">{{ __('Processing') }}</span>&nbsp;
            </button>
            <button wire:click="$emit('closeModal')" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
        </div>
@endif
    </x-slot>
</x-nppbkc-modal>