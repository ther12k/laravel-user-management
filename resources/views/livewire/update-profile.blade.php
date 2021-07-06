@section('title', 'Update Profile')
@push('styles')
<style>
	[x-cloak] {
		display: none;
	}

</style>
@endpush   
<div>
    <div>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
	<div>
        <div class="max-w-3xl mx-auto">
            <!-- Top Navigation -->
			<div class="border-b-2 py-4">
				<div x-show="step !== 0 && step!==11" class="uppercase tracking-wide text-xs font-bold text-gray-500 mb-1 leading-tight" x-text="`Step: ${step} of 10`"></div>
				<div class="flex flex-col md:flex-row md:items-center md:justify-between">
					<div class="flex-1">
                        <div class="text-lg font-bold text-gray-700 leading-tight">Update Profile</div>
					</div>
				</div>
			</div>
			<!-- /Top Navigation -->
            <!-- Bottom Navigation -->	
            <div class="fixed bottom-0 left-0 right-0 py-5 bg-white shadow-md z-50" x-show="step != 'complete'">
                <div class="max-w-3xl mx-auto px-4">
                    <div class="flex justify-between">
                        <div class="w-1/2">
                            <button
								wire:click="logout"
                                class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border" 
                            >Log out</button>
                        </div>

                        <div class="w-1/2 text-right">
                            <button
								wire:click="update"
                                class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium" 
                            >Save</button>
                        </div>
                    </div>
                </div>
            </div>
	<!-- / Bottom Navigation https://placehold.co/300x300/e2e8f0/cccccc -->	
            <!-- Content -->
			<div class="py-10">	
				<div>
					@include('livewire.form.input',['name'=>'nama','text'=>'Nama','nama'=>$nama])
					@include('livewire.form.input',['name'=>'pekerjaan','text'=>'Pekerjaan','pekerjaan'=>$pekerjaan])
					@include('livewire.form.textarea',['name'=>'alamat','text'=>'Alamat','alamat'=>$alamat])
					@include('livewire.form.input',['type'=>'number','name'=>'no_telp','text'=>'No Telp','no_telp'=>$no_telp])
                    {{-- <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                        <label for="inline-npwp" class="font-bold mb-1 text-gray-700 block">NPWP</label>
                        </div>
                        <div class="md:w-2/3">
                            <x-file-attachment wire:model="npwp_photo" :file="$npwp_photo" />
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                        <label for="inline-ktp" class="font-bold mb-1 text-gray-700 block">KTP</label>
                        </div>
                        <div class="md:w-2/3">
                            <x-file-attachment wire:model="ktp_photo" :file="$ktp_photo" />
                        </div>
                    </div> --}}
					<div class="grid md:grid-cols-2 mb-6">
                        <div class="p-2">
                        <label for="inline-file_npwp" class="font-bold mb-1 text-gray-700 block">NPWP</label>
                            <x-file-attachment wire:model="file_npwp" :file="$file_npwp" />
							@include('livewire.form.error-span',['name'=>'file_npwp'])
                        </div>
                        <div class="p-2">
                        <label for="inline-file_ktp" class="font-bold mb-1 text-gray-700 block">KTP</label>
                            <x-file-attachment wire:model="file_ktp" :file="$file_ktp" />
							@include('livewire.form.error-span',['name'=>'file_ktp'])
                        </div>

						
                    </div>
					<div class="grid md:grid-cols-2 mb-6">
                        <div class="p-2">
                        <label for="inline-file_registrasi_pengusaha_bkc" class="font-bold mb-1 text-gray-700 block">Data Registrasi Pengusaha BKC (Download format registrasi di <a href="">Link</a>)</label>
                            <x-file-attachment wire:model="file_registrasi_pengusaha_bkc" :file="$file_registrasi_pengusaha_bkc" />
							@include('livewire.form.error-span',['name'=>'file_registrasi_pengusaha_bkc'])
                        </div>
                    </div>
				</div>
			</div>
			<!-- / Content -->
        </div>
    </div>	
</div>