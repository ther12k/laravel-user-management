@section('title', 'View Data NPPBCK')
@push('styles')
<style>
	[x-cloak] {
		display: none;
	}

</style>
@endpush    
<div x-cloak class="md:flex no-wrap md:-mx-2" id="tabs-id"
x-data="app()" 
>

<div class="w-full md:w-9/12 mx-auto">

	@if(!$isOpen||$status_nppbkc!=2)
	<div class="mb-4 bg-white px-4 py-5">
		@if (session()->has('message'))
		<div id="alert" class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-400">
			<span class="inline-block align-middle mr-8">
				{{ session('message') }}
			</span>
			<button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
				<span>×</span>
			</button>
		</div>
		@endif
		<div class="tab-content tab-space flex">
			<div x-show="true" class="w-2/3">
				<h1 class="flex-auto text-xl font-semibold text-purple-700 mb-4">Permohonan Pemeriksaan Lokasi / NPPBKC </h1>
				<h2 class="flex-auto text-lg font-semibold">No {{$no_permohonan}}</h2>
				<h2>Tanggal Kesiapan Cek :  {{$tanggal_kesiapan_cek_lokasi}}</h2>
				<div class="flex" >
					<div><span>Status : </span> </div>
					
					<div class="hover:text-indigo-600 flex cursor-pointer" wire:click="openModal()">
						@include('nppbkc.status',['status'=>$status_nppbkc]) <x-heroicon-o-pencil-alt class="h-6 w-6" />
					</div>
				</div>
					{{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
				</svg>  --}}
				@can('updateNppbkc')
				<button class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium" 
				>Proses</button>
				@endcan
			</div>
			<div class="w-1/3">
				
			</div>
		</div>
	</div>
	<div class="flex space-x-2">
		<a href="#content" @click="activeTab = 1" :class="activeTab === 1 ? activeClass : inactiveClass">	
			<div class="flex items-center space-x-2 font-semibold leading-8">
				<span clas="text-green-500">
					<x-heroicon-o-user class="h-6 w-6"/>
				</span>
				<span class="hidden lg:block">Data Pemohon</span>
			</div>
		</a>
		<a href="#content" @click="activeTab = 2" :class="activeTab === 2 ? activeClass : inactiveClass">
			<div class="flex items-center space-x-2 font-semibold leading-8">
				<span clas="text-green-500">
					<x-heroicon-o-office-building class="h-6 w-6"/>
				</span>
				<span class="hidden lg:block">Data Usaha</span>
			</div>	
		</a>
		<a href="#content" @click="activeTab = 3" :class="activeTab === 3 ? activeClass : inactiveClass">
			<div class="flex items-center space-x-2 font-semibold leading-8">
				<x-heroicon-o-location-marker class="h-6 w-6"/>
				</span><span class="hidden lg:block">Lokasi</span>
			</div>
		</a>
		<a href="#content" @click="activeTab = 4" :class="activeTab === 4 ? activeClass : inactiveClass">
			<div class="flex items-center space-x-2 font-semibold leading-8">
				<span clas="text-green-500">
					<x-heroicon-o-briefcase class="h-6 w-6"/>
				</span>
				<span class="hidden lg:block">Izin Usaha</span>
			</div>
		</a>
		<a href="#content" @click="activeTab = 5" :class="activeTab === 5 ? activeClass : inactiveClass">
			<div class="flex items-center space-x-2 font-semibold leading-8">
				<span clas="text-green-500">
					<x-heroicon-o-paper-clip class="h-6 w-6"/>
				</span>
				<span class="hidden lg:block">Lampiran</span>
			</div>
		</a>
	</div>
	@endif
	<div class="bg-white mb-6 shadow-lg">
		<div class="px-4 py-5">
			@if(!$isOpen||$status_nppbkc!=2)
				<div x-show="activeTab === 1">
					<div class="lg:hidden items-center space-x-2 font-semibold text-gray-900 leading-8">
						<span class="tracking-wide">Data Pemohon {{ $status_pemohon=='dikuasakan' ?'(Dikuasakan)':''}}</span>
					</div>
					<div class="text-gray-700">
						<div class="grid md:grid-cols-2 text-sm">
							@include('livewire.form.preview-input',['name'=>'nama_pemilik','text'=>'Nama Pemilik'])
							@include('livewire.form.preview-input',['name'=>'telp_pemilik','text'=>'Telp Pemilik']) 
							@include('livewire.form.preview-input',['name'=>'npwp_pemilik','text'=>'NPWP Pemilik']) 
							@include('livewire.form.preview-input',['name'=>'email_pemilik','text'=>'Email Pemilik'])
							@include('livewire.form.preview-input',['name'=>'alamat_pemilik','text'=>'Alamat Pemilik']) 
						</div>
					</div>
				</div>
				<div   x-show="activeTab === 2">
					<div class="lg:hidden items-center space-x-2 font-semibold text-gray-900 leading-8">
						<span class="tracking-wide">Data Usaha</span>
					</div>
					<div class="text-gray-700 flex-1">
						<div class="grid md:grid-cols-2 text-sm">
							@include('livewire.form.preview-input',['name'=>'jenis_usaha_bkc','text'=>'Jenis Usaha BKC'])
							@include('livewire.form.preview-input',['name'=>'jenis_bkc','text'=>'Jenis BKC']) 
						</div>
						<div class="grid md:grid-cols-2 text-sm">
							@include('livewire.form.preview-input',['name'=>'nama_usaha','text'=>'Nama Usaha'])
							@include('livewire.form.preview-input',['name'=>'telp_usaha','text'=>'Telp Usaha']) 
							@include('livewire.form.preview-input',['name'=>'npwp_usaha','text'=>'NPWP Usaha']) 
							@include('livewire.form.preview-input',['name'=>'email_usaha','text'=>'Email Usaha']) 
							@include('livewire.form.preview-input',['name'=>'alamat_usaha','text'=>'Alamat Usaha']) 
						</div>
					</div>
				</div>
				<div x-show="activeTab === 3">
					<div class="lg:hidden items-center space-x-2 font-semibold text-gray-900 leading-8">
						<span class="tracking-wide">Lokasi</span>
					</div>
					<div class="grid lg:grid-cols-2 text-sm">

						<div id="map" class='h-72' ></div>
						<div>
							<div class="flex items-center hover:opacity-75 mr-4 px-4">
								<i class="mr-2"><br>
									<x-heroicon-o-map class="h-6 w-6 text-indigo-500"/>
								<br>
										</i><p></p>
								<a href="http://maps.google.com/maps?q={{$lokasi_latitude}},{{$lokasi_longitude}}" target="_blank" class="mt-1 text-indigo-500 font-bold">Open via google map</a>
							</div>
							@include('livewire.form.preview-input',['name'=>'jenis_lokasi','text'=>'Jenis Lokasi'])
							@include('livewire.form.preview-input',['name'=>'kegunaan','text'=>'Kegunaan']) 
							@include('livewire.form.preview-input',['name'=>'lokasi','text'=>'Lokasi'])
							@include('livewire.form.preview-input',['name'=>'alamat','text'=>'Alamat lengkap lokasi'])
							
						</div>
					</div>
					{{-- <div class="grid md:grid-cols-2 text-sm">
						@include('livewire.form.preview-input',['name'=>'province','text'=>'Provinsi'])
						@include('livewire.form.preview-input',['name'=>'regency','text'=>'Kabupaten/Kota'])
						@include('livewire.form.preview-input',['name'=>'district','text'=>'Kecamatan'])
						@include('livewire.form.preview-input',['name'=>'village','text'=>'Kelurahan/Desa'])
						@include('livewire.form.preview-input',['name'=>'rt_rw','text'=>'RT/RW'])
						@include('livewire.form.preview-input',['name'=>'alamat','text'=>'Alamat Lengkap'])
					</div> --}}
					<div class="p-1 text-sm">
					</div>
				</div>
				<div x-show="activeTab === 4">
					<div class="lg:hidden items-center space-x-2 font-semibold text-gray-900 leading-8">
						<span class="tracking-wide">Izin Usaha</span>
					</div>
					<div class="text-sm">
						@include('livewire.form.preview-input',['name'=>'no_siup_mb','text'=>'Nomor Izin SIUP-MB / SKMB'])
						@include('livewire.form.preview-input-daterange',['name'=>'masa_berlaku_siup_mb','text'=>'Tanggal masa berlaku SIUP-MB / SKMB'])
			
						@include('livewire.form.preview-input',['name'=>'no_itp_mb','text'=>'Nomor Izin ITP-MB'])
						@include('livewire.form.preview-input-daterange',['name'=>'masa_berlaku_itp_mb','text'=>'Tanggal masa berlaku ITP-MB'])
			
						@include('livewire.form.preview-input',['name'=>'no_izin_nib','text'=>'No Izin NIB'])
						@include('livewire.form.preview-input',['name'=>'tanggal_nib','text'=>'Tanggal NIB'])
					</div>
				</div>
				<div x-show="activeTab === 5">
					<div class="lg:hidden items-center space-x-2 font-semibold text-gray-900 leading-8">
						<span class="tracking-wide">Lampiran</span>
					</div>
					<div class="grid md:grid-cols-2 text-sm">
						@foreach ($files as $file )
						<div class="px-4 py-2 font-semibold flex">
							<x-heroicon-o-link class="h-6 w-6 mr-2 p-1"/><a href="{{route('nppbkc.downloadfile',['id'=>$file->id])}}" class="text-indigo-500 hover:text-indigo-700">{{nppbkc_file_captions($file->name)}}</a>
						</div>
						@endforeach
					</div>
				</div>
			@endif
			@if($isOpen&&$status_nppbkc==2)
			<div>
				<div class="p-10">
					<h1 class="flex-auto text-xl font-semibold text-purple-700 mb-4">Penerimaan Permohonan Penerbitan NPPBKC</h1>
					
					@include('livewire.form.textarea',['name'=>'catatan_petugas','text'=>'Catatan Petugas'])
					@foreach ($petugas_files as $name=>$text)

						{{-- @include('livewire.form.upload',['name'=>$name,'text'=>$text]) --}}
						<div class="md:flex md:items-center mb-6">
							<div>
								<label for="{{$name}}" class="font-bold mb-1 text-gray-700 block">{{$text}}</label>
							
								<x-file-attachment class="@error($name) border-red-500 @enderror " wire:model="{{$name}}" 
								:file="${$name}" :preview-h="12" :preview_w="24"/>
								@error($name) 
								<span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
									{{ $message }}
								</span> 
								@enderror
							</div>
						</div>
					@endforeach
					<div class="h-4"></div>
				</div>
			</div>
			@endif
		</div>
	</div>
	<div class="h-1"></div>
	@if($isOpen&&$status_nppbkc==2)
	<!-- Bottom Navigation -->	
	<div class="fixed bottom-0 z-50 left-0 right-0 py-5 bg-white shadow-md">
		<div class="max-w-3xl mx-auto px-4">
			<div class="flex justify-between">
				<div class="w-1/2">
					<button
						wire:click="closeModal()"
						class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-white bg-red-500 hover:bg-red-600 font-medium border" 
					>Kembali</button>
				</div>

				<div class="w-1/2 text-right">
					<button
						class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium" 
					>Proses</button>
				</div>
			</div>
		</div>
	</div>
	<!-- / Bottom Navigation https://placehold.co/300x300/e2e8f0/cccccc -->	
	@endif
	
	@if($isOpen)
		@if($status_nppbkc==1)
		<x-nppbkc-modal>
			<x-slot name="content">
				<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
					<div class="sm:flex sm:items-start">
						<div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
						<!-- Heroicon name: outline/exclamation -->
						<x-heroicon-o-exclamation class="h-6 w-6 text-indigo-600"/>
						</div>
						<div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
							<div class="mt-2">
								<h1>Persetujuan Cek Lokasi</h1>
								<p class="text-sm text-gray-500">
								Apakah Permohonan ini akan disetujui? (pastikan data sudah lengkap)
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
					<button  wire:click.prevent="setuju_cek()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
						Setuju
					</button>
					<button wire:click="closeModal()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
						Cancel
					</button>
				</div>
			</x-slot>
		</x-nppbkc-modal>
		@endif
	@endif
</div>
@push('script')

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>
<script>
    const style = "streets-v11";
	var defaultLocation;
	var loaded = false;
	var skeleton;
	var activeTab = 1;
	function app(){
		return{
			inactiveClass: 'hover:text-purple-600 bg-gray-300 text-gray-600 text-xs font-bold uppercase px-5 py-3 block leading-normal',
			activeClass :'text-purple-600 bg-white text-xs font-bold uppercase px-5 py-3 block leading-normal',
			activeTab :1
		}
	}

	document.addEventListener('livewire:load', function () {
		defaultLocation =  [{{$lokasi_longitude}}, {{$lokasi_latitude}}];
		loadPreviewMap();
	})

	window.addEventListener('showMap', event => {
		defaultLocation =  [{{$lokasi_longitude}}, {{$lokasi_latitude}}];
		loadPreviewMap();
	});

	// 	flatpickr.localize(flatpickr.l10ns.id);
	// 	flatpickr('.datepicker',{
	// 		dateFormat: "d-m-Y", 
	// 	})
	// 	document.querySelectorAll('[data-mask]').forEach(function(e) {
	// 	function format(elem) {
	// 		const val = doFormat(elem.value, elem.getAttribute('data-format'));
	// 		elem.value = doFormat(elem.value, elem.getAttribute('data-format'), elem.getAttribute('data-mask'));
			
	// 		if (elem.createTextRange) {
	// 		var range = elem.createTextRange();
	// 		range.move('character', val.length);
	// 		range.select();
	// 		} else if (elem.selectionStart) {
	// 		elem.focus();
	// 		elem.setSelectionRange(val.length, val.length);
	// 		}
	// 	}
	// 	e.addEventListener('keyup', function() {
	// 		format(e);
	// 	});
	// 	e.addEventListener('keydown', function() {
	// 		format(e);
	// 	});
	// 	format(e)
	// 	});
	// 	if(event&&event.detail.step=='preview'){
	// 		loadPreviewMap();
	// 	}
	// });

	function loadPreviewMap(){
		console.log('render preview map')
		mapboxgl.accessToken = "{{env('MAPBOX_ACCESS_TOKEN')}}";

		map = new mapboxgl.Map({
				container: 'map',
				style: 'mapbox://styles/mapbox/light-v10',
				center: defaultLocation,
				zoom: 13
			});

		map.setStyle(`mapbox://styles/mapbox/${style}`); 
		
		map.addControl(new mapboxgl.NavigationControl());

		marker = new mapboxgl.Marker({
			color: '#F84C4C'
		})
		.setLngLat(defaultLocation)
		.addTo(map)
		marker.getElement().addEventListener('click', event => {
			let a= document.createElement('a');
			a.target= '_blank';
			a.href= 'http://maps.google.com/maps?q='+defaultLocation[1]+','+defaultLocation[0];
			a.click();
		});
	}

</script>
@endpush
