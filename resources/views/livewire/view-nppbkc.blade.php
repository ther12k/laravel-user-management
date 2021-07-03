@section('title', 'View Data NPPBCK')
@push('styles')
<style>
	[x-cloak] {
		display: none;
	}

</style>
@endpush    
<div>
    <div class="bg-white my-1 px-5 py-2 rounded-t-lg overflow-hidden shadow-lg hover:shadow">
        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
            <span clas="text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
            </span>
            <span class="tracking-wide text-lg">Preview Permohonan</span>
        </div>
    </div>
    <div class="bg-white my-1 px-5 py-2 overflow-hidden shadow-lg hover:shadow">
        
    {{-- <div class="flex flex-row justify-between">
    
        <a class="p-2 py-2  border-b-4 border-green-400  hover:border-gray-400" 
          href="#" x-on:click.prevent="tab='#tab1'">Data Pemohon</a>
          
        <a class="p-2 py-2  border-b-4 border-gray-500  hover:border-green-400"
          href="#" x-on:click.prevent="tab='#tab2'">Data Usaha</a>
          
        <a class="p-2 py-2  border-b-4 border-gray-500  hover:border-green-400"
          href="#" x-on:click.prevent="tab='#tab3'">Lokasi</a>
    
        <a class="p-2 py-2  border-b-4 border-gray-500  hover:border-green-400" 
            href="#" x-on:click.prevent="tab='#tab3'">Izin</a>
        <a class="p-2 py-2  border-b-4 border-gray-500  hover:border-green-400"
          href="#" x-on:click.prevent="tab='#tab3'">Lampiran</a>
          
    </div> --}}
        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
            <span clas="text-green-500">
                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </span>
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
        <div class="flex items-center space-x-2 mt-5  font-semibold text-gray-900 leading-8">
            <span clas="text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </span>
            <span class="tracking-wide">Data Usaha</span>
        </div>
        <div class="text-gray-700">
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
        <div class="flex items-center space-x-2 mt-5  font-semibold text-gray-900 leading-8">
            <span clas="text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
            </span>
            <span class="tracking-wide">Lokasi</span>
        </div>
        <div class="text-gray-700">
            <div class="grid md:grid-cols-2 text-sm">
                @include('livewire.form.preview-input',['name'=>'jenis_lokasi','text'=>'Jenis Lokasi'])
                @include('livewire.form.preview-input',['name'=>'kegunaan','text'=>'Kegunaan']) 
                @include('livewire.form.preview-input',['name'=>'lokasi','text'=>'Lokasi'])
            </div>
            {{-- <div class="grid md:grid-cols-2 text-sm">
                @include('livewire.form.preview-input',['name'=>'province','text'=>'Provinsi'])
                @include('livewire.form.preview-input',['name'=>'regency','text'=>'Kabupaten/Kota'])
                @include('livewire.form.preview-input',['name'=>'district','text'=>'Kecamatan'])
                @include('livewire.form.preview-input',['name'=>'village','text'=>'Kelurahan/Desa'])
                @include('livewire.form.preview-input',['name'=>'rt_rw','text'=>'RT/RW'])
                @include('livewire.form.preview-input',['name'=>'alamat','text'=>'Alamat Lengkap'])
            </div> --}}
            <div class="p-3 text-sm">
                <div id="map" class='h-72' ></div>
            </div>
        </div>
        <div class="flex items-center space-x-2 mt-5  font-semibold text-gray-900 leading-8">
            <span clas="text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                
            </span>
            <span class="tracking-wide">Izin Usaha Dari Instansi Terkait</span>
        </div>
        <div class="text-gray-700">
            <div class="text-sm">
                @include('livewire.form.preview-input',['name'=>'no_siup_mb','text'=>'Nomor Izin SIUP-MB / SKMB'])
                @include('livewire.form.preview-input-daterange',['name'=>'masa_berlaku_siup_mb','text'=>'Tanggal masa berlaku SIUP-MB / SKMB'])
    
                @include('livewire.form.preview-input',['name'=>'no_itp_mb','text'=>'Nomor Izin ITP-MB'])
                @include('livewire.form.preview-input-daterange',['name'=>'masa_berlaku_itp_mb','text'=>'Tanggal masa berlaku ITP-MB'])
    
                
            </div>
            <div class="grid md:grid-cols-2 text-sm">
                @include('livewire.form.preview-input',['name'=>'no_izin_nib','text'=>'No Izin NIB'])
                @include('livewire.form.preview-input',['name'=>'tanggal_nib','text'=>'Tanggal NIB'])
            </div>
        </div>
    </div>
{{--     
    <div class="bg-white my-1 px-5 py-2 rounded-b-lg overflow-hidden shadow-lg hover:shadow">
        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
            <span clas="text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                  </svg>
            </span>
            <span class="tracking-wide">Lampiran</span>
        </div>
        <div class="text-gray-700">
            <div class="grid md:grid-cols-2 text-sm">
                @include('livewire.form.preview-file',['name'=>'file_denah_bangunan','text'=>'Denah di dalam Bangunan'])
                @include('livewire.form.preview-file',['name'=>'file_denah_lokasi','text'=>'Denah Situasi sekitar lokasi'])
            
                @include('livewire.form.preview-file',['name'=>'file_siup_mb','text'=>'SIUP-MB / SKMB'])
                @include('livewire.form.preview-file',['name'=>'file_itp_mb','text'=>'ITP-MB'])
           
                @include('livewire.form.preview-file',['name'=>'file_nib','text'=>'Nomor Induk Berusaha'])
                @include('livewire.form.preview-file',['name'=>'file_npwp_usaha','text'=>'NPWP Usaha'])
            
            @if($status_pemohon=='dikuasakan')
                @include('livewire.form.preview-file',['name'=>'file_surat_kuasa','text'=>'Surat Kuasa'])    
            
            @endif
                @include('livewire.form.preview-file',['name'=>'file_npwp_pemilik','text'=>'NPWP Pemilik'])
                @include('livewire.form.preview-file',['name'=>'file_ktp_pemilik','text'=>'KTP Pemilik'])
                @include('livewire.form.preview-file',['name'=>'file_surat_pernyataan','text'=>'Surat Pernyataan'])
                @include('livewire.form.preview-file',['name'=>'file_data_registrasi','text'=>'Data Registrasi'])
                
            </div>
        </div>
    </div> --}}
    
    <div class="mb-6 px-1 w-full py-3" ></div>
</div>
@push('script')

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>

<script>
    const style = "streets-v11";
	var lokasi_longitude;
	var lokasi_latitude;
	var defaultLocation =  [106.697, -6.313];
	var loaded = false;
	var skeleton;
	function app() {
		console.log('init app');
		return {
			skeleton : false,
			lokasi_longitude : @entangle($lokasi_longitude),
			lokasi_latitude : @entangle($lokasi_latitude),
		}
	}
	window.addEventListener('render', event=>{
        loadPreviewMap()
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
