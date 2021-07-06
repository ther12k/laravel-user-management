<x-nppbkc-modal>
    <x-slot name="content">
        @if($status_nppbkc==1)
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                <x-heroicon-o-exclamation class="h-6 w-6 text-indigo-600"/>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <div class="mt-2" >
                        <h1 class="flex-auto text-xl font-semibold text-purple-700 mb-4">Persetujuan Cek Lokasi</h1>
                        <p class="text-sm text-gray-500" wire:loading.remove.delay>
                        Apakah Permohonan ini akan disetujui? (pastikan data sudah lengkap)
                        </p>

                    </div>
                    <div class="mt-2" >
                        @include('livewire.form.textarea',['name'=>'catatan_petugas','text'=>'Catatan Petugas'])
                    </div>
                    <div wire:loading.delay class="py-5">
                        @include('livewire.form.skeleton')
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button wire:click.prevent="setuju_cek()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                Setuju
            </button>
            <button wire:click.prevent="setuju_cek()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                Ditolak
            </button>
            <button wire:click="$emit('closeModal')" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
        </div>
        @endif
        @if($status_nppbkc==2)
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <h1 class="text-xl font-semibold text-purple-700 mb-4">Penerimaan Permohonan Penerbitan NPPBKC</h1>
			<div wire:loading.remove.delay>

                @include('livewire.form.textarea',['name'=>'catatan_petugas','text'=>'Catatan Petugas'])
                @include('livewire.form.input',['name'=>'no_ba','text'=>'Nomor Berita Acara'])
                @include('livewire.form.input-date',['name'=>'tanggal_ba','text'=>'Tanggal Berita Acara'])
                
                <div class="md:flex mb-6">
                @foreach ($petugas_files as $name=>$text)

                    {{-- @include('livewire.form.upload',['name'=>$name,'text'=>$text]) --}}
                        <div class="md:w-1/3 w-full">
                            <label for="{{$name}}" class="font-bold mb-1 text-gray-700 block">{{$text}}</label>
                        
                            <x-file-attachment class="@error($name) border-red-500 @enderror " wire:model="{{$name}}" 
                            :file="${$name}" :preview-h="12" :preview_w="24"/>
                            @error($name) 
                            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                {{ $message }}
                            </span> 
                            @enderror
                        </div>
                @endforeach
                </div>

            </div>
            <div wire:loading.delay class="py-5">
                @include('livewire.form.skeleton')
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button wire:click.prevent="complete()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                Setuju
            </button>
            <button wire:click="$emit('closeModal')" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
        </div>
        @endif
        @if($status_nppbkc>=3)
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                <x-heroicon-o-exclamation class="h-6 w-6 text-red-600"/>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <div class="mt-2">
                        <h1 class="flex-auto text-xl font-semibold text-red-700 mb-4">Keputusan</h1>
                        <p class="text-sm text-gray-500">
                        Apakah Permohonan ini akan disetujui atau tidak?
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button wire:click.prevent="keputusan(1)" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                Disetujui
            </button>
            <button wire:click.prevent="keputusan(0)" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                Tidak Disetujui
            </button>
            <button wire:click="$emit('closeModal')" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
        </div>
        @endif
        </div>
    </x-slot>
</x-nppbkc-modal>