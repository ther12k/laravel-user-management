@section('title', 'Perekaman Data NPPBCK')
@push('styles')
<style>
	[x-cloak] {
		display: none;
	}
/* 
	[type="checkbox"] {
		box-sizing: border-box;
		padding: 0;
	}

	.form-checkbox,
	.form-radio {
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		-webkit-print-color-adjust: exact;
		color-adjust: exact;
		display: inline-block;
		vertical-align: middle;
		background-origin: border-box;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		flex-shrink: 0;
		color: currentColor;
		background-color: #fff;
		border-color: #e2e8f0;
		border-width: 1px;
		height: 1.4em;
		width: 1.4em;
	}

	.form-checkbox {
		border-radius: 0.25rem;
	}

	.form-radio {
		border-radius: 50%;
	}

	.form-checkbox:checked {
		background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M5.707 7.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L7 8.586 5.707 7.293z'/%3e%3c/svg%3e");
		border-color: transparent;
		background-color: currentColor;
		background-size: 100% 100%;
		background-position: center;
		background-repeat: no-repeat;
	}
	
	.form-radio:checked {
		background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e");
		border-color: transparent;
		background-color: currentColor;
		background-size: 100% 100%;
		background-position: center;
		background-repeat: no-repeat;
	} */
</style>
@endpush
<div x-data="app()" x-cloak class="container mx-auto p-5">
	<div class="max-w-3xl mx-auto">
		@if($step=='complete')
		<div x-show="step == 'complete'">
			<div class="bg-white rounded-lg p-5 flex items-center shadow justify-between">
				<div>
					<svg class="mb-4 h-20 w-20 text-green-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>

					@if(!isset($nppbkc_id))
					<h2 class="text-2xl mb-4 text-gray-800 text-center font-bold">Input Permohonan Success</h2>
					@else
					<h2 class="text-2xl mb-4 text-indigo-800 text-center font-bold">Revisi Permohonan Success</h2>
					@endif

					<div class="text-gray-600 mb-8">
						<p>Terima Kasih Telah Menggunakan Layanan BC Palangkaraya.<br/>
						Bersama ini kami sampaikan tanda terima permohonan yang telah anda lakukan dengan data-data sebagai berikut:
						</p> 
						<p class="py-2">
							<table border="0">
								<tr>
									<td class="w-52">Jenis Layanan</td>
									<td class="w-1">:</td>
									<td class="w-64">NPPBKC Online</td>
								</tr>
								<tr>
									<td class="w-52">Tanda Terima</td>
									<td class="w-1">:</td>
									<td class="w-72">
										<a href="{{$surat_permohonan_lokasi_url}}" target="_blank" class="flex font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
											<x-heroicon-o-download class="w-6 h-6" />
											<span class="ml-1">{{$no_permohonan}}</span>	 
										</a> 
									</td>
								</tr>
								<tr>
									<td class="w-52">Tanggal</td>
									<td class="w-1">:</td>
									<td class="w-64">{{\Carbon\Carbon::parse($created_at)->isoFormat('D MMMM Y');}}</td>
								</tr>
							</table>
						</p>
						<p class="py-2">Selanjutnya Saudara dapat memonitoring permohonan pada halaman utama.</p>
					</div>
					<button
						onclick="window.location='{{ route("home") }}'"
						class="w-40 block mx-auto focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium" 
						{{-- class="w-40 block mx-auto focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border"  --}}
					>Back to home</button>
				</div>
			</div>
		</div>
		@endif
		<div x-show.transition="step != 'complete'">	
			<!-- Top Navigation -->
			<div class="border-b-2 py-1" x-show="step!=='preview'">
				<div x-show="step !== 0 && step!=='preview'" class="uppercase tracking-wide text-xs font-bold text-gray-500 mb-1 leading-tight" x-text="`Step: ${step} of 10`"></div>
				{{-- <div x-show="step==='preview'" class="uppercase tracking-wide text-xs font-bold text-gray-500 mb-1 leading-tight">Preview Sebelum Kirim</div> --}}
				
				<div class="flex flex-col md:flex-row md:items-center md:justify-between">
					<div class="flex-1">
						<div x-show="step === 0" class="flex">
							<x-heroicon-o-exclamation class="h-6 w-6 mr-1"/><div class="text-lg font-bold text-gray-700 leading-tight">DISCLAIMER</div>
						</div>
						<div x-show="step === 1">
							<div class="text-lg font-bold text-gray-700 leading-tight">Data Pemohon</div>
						</div>
						<div x-show="step === 2">
							<div class="text-lg font-bold text-gray-700 leading-tight">Barang Kena Cukai (BKC)</div>
						</div>

						<div x-show="step === 3">
							<div class="text-lg font-bold text-gray-700 leading-tight">Data Usaha</div>
						</div>
						<div x-show="step === 4">
							<div class="text-lg font-bold text-gray-700 leading-tight">Lokasi</div>
						</div>
						<div x-show="step === 5">
							<div class="text-lg font-bold text-gray-700 leading-tight">Detail Lokasi 1 of 2</div>
						</div>
						<div x-show="step === 6">
							<div class="text-lg font-bold text-gray-700 leading-tight">Detail Lokasi 2 of 2</div>
						</div>
						<div x-show="step === 7">
							<div class="text-lg font-bold text-gray-700 leading-tight">Izin Usaha Dari Instansi Terkait</div>
						</div>
						<div x-show="step === 8">
							<div class="text-lg font-bold text-gray-700 leading-tight">Tanggal Pemeriksaan</div>
						</div>
						<div x-show="step === 9">
							<div class="text-lg font-bold text-gray-700 leading-tight">Lampiran 1 of 2</div>
						</div>
						<div x-show="step === 10">
							<div class="text-lg font-bold text-gray-700 leading-tight">Lampiran 2 of 2</div>
						</div>
						<div x-show="step === 11">
							<div class="text-lg font-bold text-gray-700 leading-tight">Preview</div>
						</div>
					</div>

					<div class="flex items-center md:w-64" x-show.transition="step !== 'complete' && step !== 0 && step!=='preview'">
						
						<div class="w-full bg-gray-300 rounded-full mr-2">
							<div class="rounded-full bg-green-500 text-xs leading-none h-2 text-center text-white" :style="'width: '+ parseInt(step / 10 * 100) +'%'"></div>
						</div>
						<div class="text-xs w-10 text-gray-600" x-text="parseInt(step / 10 * 100) +'%'"></div>
						
					</div>
				</div>
			</div>
			<!-- /Top Navigation -->
			<div wire:loading.delay class="p-5 justify-center " wire:target="stepCheck,back,preview,complete,stepCheckWMap">
				@include('livewire.form.skeleton')
			</div>
			{{-- <div wire:loading.delay class="py-5" wire:target="stepCheckWMap">
				@include('livewire.form.skeleton')
			</div>
			<div wire:loading.delay class="py-5" wire:target="preview">
				@include('livewire.form.skeleton')
			</div>
			<div wire:loading.delay class="py-5" wire:target="complete">
				@include('livewire.form.skeleton')
			</div>
			<div wire:loading.delay class="py-5" wire:target="back">
				@include('livewire.form.skeleton')
			</div> --}}
			<!-- Step Content -->
			<div wire:loading.remove wire:target="stepCheck,back,stepCheckWMap,preview,complete" class="py-5">
				@if($step==0)
				<div x-show.transition.in="step === 0">
					<div class="mb-6 py-5">
						@if(!isset($nppbkc_id))
						@include('livewire.form.disclaimer')
						@else
						@include('livewire.form.disclaimer-edit',['no'=>$no_permohonan])
						@endif
					</div>
				</div>
				@endif
				<div x-show.transition.in="step === 1">
					<div class="md:flex md:items-center mb-6">
						<div class="md:w-1/3">
							<label for="inline-status_pemohon" class="font-bold mb-1 text-gray-700 block">Status Permohonan</label>
						</div>
						<div class="md:w-2/3">
							<div class="flex">
								<label
									class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-2 shadow-sm mr-4">
									<div class="text-teal-600 mr-3">
										<input type="radio" x-model="status_pemohon" wire:model="status_pemohon" value="sendiri" class="form-radio focus:outline-none focus:shadow-outline" />
									</div>
									<div class="select-none text-gray-700">Sendiri</div>
								</label>

								<label
									class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-2 shadow-sm">
									<div class="text-teal-600 mr-3">
										<input type="radio" x-model="status_pemohon" wire:model="status_pemohon" value="dikuasakan" class="form-radio focus:outline-none focus:shadow-outline" />
									</div>
									<div class="select-none text-gray-700">Dikuasakan</div>
								</label>
							</div>
						</div>
					</div>

					{{-- @error('nama_pemilik') <span class="w-full py-1 px-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
					>{{ $message }}</span> @enderror --}}
					@include('livewire.form.input',[$errors,'errors',$errors,'name'=>'nama_pemilik','text'=>'Nama Pemilik'])
					@include('livewire.form.textarea',['name'=>'alamat_pemilik','text'=>'Alamat Pemilik'])
					@include('livewire.form.input',['type'=>'number','name'=>'telp_pemilik','text'=>'No Telp'])
					@include('livewire.form.input-format',['type'=>'text','name'=>'npwp_pemilik',
											'text'=>'NPWP Pemilik',
											'format'=>'**.***.***.*-***.***',
											'mask'=>'xx.xxx.xxx.x-xxx.xxx'
											])
					@include('livewire.form.input',['type'=>'email','name'=>'email_pemilik','text'=>'Email Pemilik'])
					<div class="mb-6 py-5" x-show="step===1"></div>
				</div>
				@if($step==2)
				<div x-show.transition.in="step === 2">
					@include('livewire.form.select',['name'=>'jenis_usaha_bkc','text'=>'Jenis Usaha Barang Kena Cukai (BKC)',
							'options'=>[
								'Pengusaha Pabrik',
								'Pengusaha Tempat Penyimpanan',
								'Importir',
								'Penyalur',
								'Pengusaha Tempat Penjualan Eceran'
								]
							])
					@include('livewire.form.select',['name'=>'jenis_bkc','text'=>'Jenis Barang Kena Cukai (BKC)',
						'options'=>[
								'Hasil Tembakau',
								'Hasil Pengolahan Tembakau Lainnya',
								'Minuman Mengandung Etil Alkohol',
								'Etil Alkohol'
							]
						])
				</div>
				@endif
				@if($step==3)
				<div x-show.transition.in="step === 3">
					@if($nppbkc_id==null)
					@include('livewire.form.input',['type'=>'text','name'=>'no_permohonan','text'=>'No Permohonan','tooltip'=>'Jika dikosongkan, no permohonan akan otomatis digenerate oleh sistem'])
					@endif
					@include('livewire.form.input',['name'=>'nama_usaha','text'=>'Nama Usaha'])
					@include('livewire.form.textarea',['name'=>'alamat_usaha','text'=>'Alamat Usaha'])
					@include('livewire.form.input-format',['type'=>'text','name'=>'npwp_usaha',
											'text'=>'NPWP Usaha',
											'format'=>'**.***.***.*-***.***',
											'mask'=>'xx.xxx.xxx.x-xxx.xxx'
											])
					@include('livewire.form.input',['type'=>'number','name'=>'telp_usaha','text'=>'No Telp Usaha'])
					@include('livewire.form.input',['type'=>'email','name'=>'email_usaha','text'=>'Email Usaha'])
					<div class="mb-6 py-5" x-show="step===3"></div>
				</div>
				@endif
				@if($step==4)
				<div x-show.transition.in="step === 4">
					@include('livewire.form.select',['name'=>'jenis_lokasi','text'=>'Jenis Lokasi',
							'options'=>[
									'Pabrik',
									'Tempat Penyimpanan',
									'Tempat Usaha Importir',
									'Tempat Penjualan Eceran'
								]
							])

					@include('livewire.form.select',['name'=>'kegunaan','text'=>'Kegunaan',
								'options'=>[
									'Membuat Barang Kena Cukai',
									'Mengemas Barang Kena Cukai',
									'Menyimpan Bahan Baku atau Bahan Penolong',
									'Menimbun Barang Kena Cukai yang Selesai Dibuat',
									'Menimbun Barang Kena Cukai yang Sudah Dilunasi Cukainya'
								]
							])
				</div>
				@endif
				<div x-show.transition.in="step === 5">
					@include('livewire.form.location-select')			
				</div>
				@if($step==6)
				<div x-show.transition.in="step === 6">
					@include('livewire.form.input',['name'=>'rt_rw','text'=>'RT / RW'])
					@include('livewire.form.textarea',['name'=>'alamat','text'=>'Alamat Lengkap'])
					{{-- @include('livewire.form.input',['name'=>'lokasi_geo','text'=>'Koordinat Lokasi']) --}}
					
					<div class="md:flex mb-6">
						<div class="md:w-1/3">
							<label for="inline-geocoder" class="font-bold mb-1 text-gray-700 block">Cari Lokasi</label>
						</div>
						<div class="md:w-2/3">
							<div id="geocoder" class="geocoder h-10"></div>
							<div wire:ignore id="map" class='h-72' ></div>
						</div>
					</div>
					<div class="mb-6 py-5" x-show="step===6"></div>
				</div>
				@endif
				@if($step==7||$step==8)
				<div x-show.transition.in="step === 7">
					@include('livewire.form.input',['name'=>'no_siup_mb','text'=>'Nomor Izin SIUP-MB / SKMB'])
					@include('livewire.form.input-daterange',['name'=>'masa_berlaku_siup_mb','text'=>'Tanggal masa berlaku'])

					@include('livewire.form.input',['name'=>'no_itp_mb','text'=>'Nomor Izin ITP-MB'])
					@include('livewire.form.input-daterange',['name'=>'masa_berlaku_itp_mb','text'=>'Tanggal masa berlaku'])

					@include('livewire.form.input',['name'=>'no_izin_nib','text'=>'No Izin NIB'])
					@include('livewire.form.input-date',['name'=>'tanggal_nib','text'=>'Tanggal NIB'])
					<div class="mb-6 py-2" x-show="step===7"></div>
				</div>
				@endif
				@if($step==8)
				<div x-show.transition.in="step === 8">
					@include('livewire.form.input-date',['name'=>'tanggal_kesiapan_cek_lokasi','text'=>'Tanggal kesiapan cek lokasi','class'=>'datepicker-mindate'])
				</div>
				@endif
				@if($step==9)
				<div x-show.transition.in="step === 9">
					<div class="grid md:grid-cols-2 mb-6">
                        <div class="p-2">
                        <label for="inline-file_denah_bangunan" class="font-bold mb-1 text-gray-700 block">Denah di dalam Bangunan</label>
                        
                            <x-file-attachment wire:model="file_denah_bangunan" :file="$file_denah_bangunan" />
							@include('livewire.form.error-span',['name'=>'file_denah_bangunan'])
                        </div>
                        <div class="p-2">
                        <label for="inline-file_denah_lokasi" class="font-bold mb-1 text-gray-700 block">Denah Situasi sekitar lokasi</label>
                            <x-file-attachment wire:model="file_denah_lokasi" :file="$file_denah_lokasi" />
							@include('livewire.form.error-span',['name'=>'file_denah_lokasi'])
                        </div>
                    </div>
					<div class="grid md:grid-cols-2 mb-6">
                        <div class="p-2">
                        	<label for="inline-file_siup_mb" class="font-bold mb-1 text-gray-700 block">SIUP-MB / SKMB</label>
                            <x-file-attachment wire:model="file_siup_mb" :file="$file_siup_mb" />
							@include('livewire.form.error-span',['name'=>'file_siup_mb'])
                        </div>
                        <div class="p-2">
                        	<label for="inline-file_itp_mb" class="font-bold mb-1 text-gray-700 block">ITP-MB</label>
                            <x-file-attachment wire:model="file_itp_mb" :file="$file_itp_mb" />
							@include('livewire.form.error-span',['name'=>'file_itp_mb'])
                        </div>
                    </div>
					{{-- <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                        <label for="inline-file_izin_instansi" class="font-bold mb-1 text-gray-700 block">Izin Instansi Terkait</label>
                        </div>
                        <div class="md:w-2/3">
                            <x-file-attachment wire:model="file_izin_instansi" :file="$file_izin_instansi" />
                        </div>
                    </div> --}}

					<div class="grid md:grid-cols-2 mb-6">
                        <div class="p-2">
                        	<label for="inline-file_nib" class="font-bold mb-1 text-gray-700 block">Nomor Induk Berusaha</label>
                            <x-file-attachment wire:model="file_nib" :file="$file_nib" />
							@include('livewire.form.error-span',['name'=>'file_nib'])
                        </div>
						<div class="p-2">
                        	<label for="inline-file_npwp_usaha" class="font-bold mb-1 text-gray-700 block">NPWP Usaha</label>
                            <x-file-attachment wire:model="file_npwp_usaha" :file="$file_npwp_usaha" />
							@include('livewire.form.error-span',['name'=>'file_npwp_usaha'])
                        </div>
                    </div>
					<div class="mb-6 py-5" x-show="step===9"></div>
				</div>
				@endif
				@if($step==10)
				<div x-show.transition.in="step === 10">
					@if($status_pemohon!=='sendiri')
					<div class="grid md:grid-cols-2 mb-6">
                        <div class="">
                        	<label for="inline-file_surat_kuasa" class="font-bold mb-1 text-gray-700 block">Surat Kuasa</label>
                            <x-file-attachment wire:model="file_surat_kuasa" :file="$file_surat_kuasa" />
							@include('livewire.form.error-span',['name'=>'file_surat_kuasa'])
                        </div>
                    </div>
					@endif
					<div class="grid md:grid-cols-2 mb-6">
                        <div class="p-2">
							<label for="inline-file_npwp_pemilik" class="font-bold mb-1 text-gray-700 block">NPWP Pemilik</label>
                            <x-file-attachment wire:model="file_npwp_pemilik" :file="$file_npwp_pemilik" />
							@include('livewire.form.error-span',['name'=>'file_npwp_pemilik'])
                        </div>
                        <div class="p-2">
                        	<label for="inline-file_ktp_pemilik" class="font-bold mb-1 text-gray-700 block">KTP Pemilik</label>
                            <x-file-attachment wire:model="file_ktp_pemilik" :file="$file_ktp_pemilik" />
							@include('livewire.form.error-span',['name'=>'file_ktp_pemilik'])
                        </div>
                    </div>
					<div class="grid md:grid-cols-2 mb-6">
                        <div class="p-2">
                        	<label for="inline-file_surat_pernyataan" class="font-bold mb-1 text-gray-700 block">Surat Pernyataan</label>
                            <x-file-attachment wire:model="file_surat_pernyataan" :file="$file_surat_pernyataan" />
							@include('livewire.form.error-span',['name'=>'file_surat_pernyataan'])
                        </div>
                        {{-- <div class="p-2">
                        	<label for="inline-file_data_registrasi" class="font-bold mb-1 text-gray-700 block">Data Registrasi</label>
                            <x-file-attachment wire:model="file_data_registrasi" :file="$file_data_registrasi" />
							@include('livewire.form.error-span',['name'=>'file_data_registrasi'])
                        </div> --}}
                    </div>
					<div class="mb-6 py-5" x-show="step===10||step==='preview'"></div>
				</div>
				@endif
				@if($step=='preview')
				<div x-show.transition.in="step === 'preview'">
					@include('livewire.wizard-preview')
				</div>
				@endif
			</div>
			<!-- / Step Content -->
		</div>
	</div>	
	<!-- Bottom Navigation -->	
	<div class="fixed bottom-0 z-50 left-0 right-0 py-5 bg-white shadow-md" x-show="step != 'complete'">
		<div class="max-w-3xl mx-auto px-4">
			<div class="flex justify-between">
				<div>
					<button
						wire:loading.attr="disabled"
						x-show="step > 1 || step==='preview'"
						wire:click="back()"
						class="flex w-32  justify-center focus:outline-none  py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border" 
					>
                    @include('livewire.form.loading-text',['text'=>__('Kembali'),'target'=>'back'])
					</button>
					<button
						wire:loading.attr="disabled"
						x-show="step === 1"
						wire:click="back()"
						class="flex w-32  justify-center focus:outline-none  py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border" 
					>
                    @include('livewire.form.loading-text',['text'=>__('Disclaimer'),'target'=>'back'])
					</button>
				</div>

				<div>
					<button
					wire:loading.attr="disabled"
						x-show="step < 10 && step!==6"
						wire:click="stepCheck()"
						class="flex w-432 justify-center focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium" 
					>
                    @include('livewire.form.loading-text',['text'=>__('Selanjutnya'),'target'=>'stepCheck'])
					</button>
					<button
					wire:loading.attr="disabled"
						x-show="step === 6"
						wire:click="stepCheckWMap(defaultLocation)"
						class="flex w-32  justify-center focus:outline-none  border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium" 
					>
					@include('livewire.form.loading-text',['text'=>__('Selanjutnya'),'target'=>'stepCheckWMap'])
					</button>
					<button
						wire:click="preview()"
						x-show="step === 10"
						class="flex w-32  justify-center focus:outline-none  border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium" 
					>
				
					@include('livewire.form.loading-text',['text'=>__('Preview'),'target'=>'preview'])
					</button>
					<button
						wire:loading.attr="disabled"
						wire:click="complete()"
						x-show="step === 'preview'"
						class="flex w-32  justify-center focus:outline-none  border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium" 
					>

					@include('livewire.form.loading-text',['text'=>__('Complete'),'target'=>'complete'])
					</button>
				</div>
			</div>
		</div>
	</div>
	<!-- / Bottom Navigation https://placehold.co/300x300/e2e8f0/cccccc -->	
</div>
@push('script')

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>

<script>
	var lokasi_longitude;
	var lokasi_latitude;
	var defaultLocation =  [106.697, -6.313];
	var loaded = false;
	var skeleton;

	//light-v10, outdoors-v11, satellite-v9, streets-v11, dark-v10
	const style = "streets-v11"
	var map;
	var marker;
	function doFormat(x, pattern, mask) {
		var strippedValue = x.replace(/[^0-9]/g, "");
		var chars = strippedValue.split('');
		var count = 0;

		var formatted = '';
		for (var i=0; i<pattern.length; i++) {
			const c = pattern[i];
			if (chars[count]) {
			if (/\*/.test(c)) {
				formatted += chars[count];
				count++;
			} else {
				formatted += c;
			}
			} else if (mask) {
			if (mask.split('')[i])
				formatted += mask.split('')[i];
			}
		}
		return formatted;
	}
	function app() {
		console.log('init app');
		return {
			step : @entangle('step'),
			skeleton : false,
			lokasi_longitude : @entangle($lokasi_longitude),
			lokasi_latitude : @entangle($lokasi_latitude),
			status_pemohon:@entangle('status_pemohon')
		}
	}

	window.addEventListener('showMap', event => {
		console.log('listener show map');
		skeleton = true;
		if(lokasi_longitude&&lokasi_longitude!==''){
			defaultLocation =  [lokasi_longitude,lokasi_latitude];
		}
		loadMap();
		loadGeocoder(event.detail.geocodertext);
		if(lokasi_longitude&&lokasi_longitude!==''){
			marker.setLngLat([lokasi_longitude,lokasi_latitude])
		}
	});

	// window.addEventListener('lokasi_updated', event => {
	// 	console.log('listener lokasi map updated');
	// 	loadGeocoder(event.detail.geocodertext);
	// });

	window.addEventListener('render', event=>{
		console.log('remove datepicker if exists');
		var elements = document.getElementsByClassName('flatpickr-calendar');
		while(elements.length > 0){
			elements[0].parentNode.removeChild(elements[0]);
		}
		var datepickers = document.getElementsByClassName('datepicker');
		if(datepickers.length>0){
			console.log('initiate datepicker');
			console.log('create flatpickr');
			flatpickr.localize(flatpickr.l10ns.id);
			flatpickr('.datepicker',{
				dateFormat: "d-m-Y", 
			});
			flatpickr('.datepicker-mindate',{
				dateFormat: "d-m-Y", 
				minDate:"today"
			})
		}
		console.log('initiate format mask');
		document.querySelectorAll('[data-mask]').forEach(function(e) {
		function format(elem) {
			const val = doFormat(elem.value, elem.getAttribute('data-format'));
			elem.value = doFormat(elem.value, elem.getAttribute('data-format'), elem.getAttribute('data-mask'));
			
			if (elem.createTextRange) {
			var range = elem.createTextRange();
			range.move('character', val.length);
			range.select();
			} else if (elem.selectionStart) {
			elem.focus();
			elem.setSelectionRange(val.length, val.length);
			}
		}
		e.addEventListener('keyup', function() {
			format(e);
		});
		e.addEventListener('keydown', function() {
			format(e);
		});
		format(e)
		});
		if(event&&event.detail.step=='preview'){
			loadPreviewMap();
		}
	});

	function loadMap(){
		console.log('render map')
		mapboxgl.accessToken = "{{env('MAPBOX_ACCESS_TOKEN')}}";

		map = new mapboxgl.Map({
				container: 'map',
				style: 'mapbox://styles/mapbox/light-v10',
				center: defaultLocation,
				zoom: 13
			});
		//  map.addControl(
		//      geocoder
		//  );
 
		map.addControl(new mapboxgl.NavigationControl());

		 //light-v10, outdoors-v11, satellite-v9, streets-v11, dark-v10
		// const style = "outdoors-v11"
		map.setStyle(`mapbox://styles/mapbox/${style}`); 
		
		marker = new mapboxgl.Marker({
			color: '#F84C4C', // color red
			draggable: true
		})
		.setLngLat(defaultLocation)
		.addTo(map)
		marker.on('dragend',function(e){
			var lngLat = e.target.getLngLat();
			defaultLocation=[lngLat['lng'],lngLat['lat']]
			console.log(defaultLocation);
			lokasi_longitude = defaultLocation[0];
			lokasi_latitude = defaultLocation[1];
			//@this.lokasi_geo = defaultLocation
			//Livewire.emit('setLokasiGeo', defaultLocation)
		})
		skeleton = false;
	}

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

	function loadGeocoder(geocodeText){
		var geocoder = new MapboxGeocoder({
			defaultLocation:defaultLocation,
			accessToken: mapboxgl.accessToken,
			mapboxgl: mapboxgl,
			marker: false,
			placeholder: 'Masukan kata kunci...',
			zoom:21
		});

		geocoder.on('result', e => {
			defaultLocation=e.result.center
			//@this.lokasi_geo = defaultLocation
			//console.log(defaultLocation)
			//Livewire.emit('setLokasiGeo', defaultLocation)
			lokasi_longitude = defaultLocation[0];
			lokasi_latitude = defaultLocation[1];
			marker.setLngLat(defaultLocation);
			// marker = new mapboxgl.Marker({
			// 	draggable: true
			// })
			// .setLngLat(e.result.center)
			// .addTo(map)
			// marker.on('dragend',function(e){
			// 	var lngLat = e.target.getLngLat();
			// 	defaultLocation=[lngLat['lng'],lngLat['lat']]
			// 	console.log(defaultLocation);
			// 	lokasi_longitude = defaultLocation[0];
			// 	lokasi_latitude = defaultLocation[1];
			// 	//@this.lokasi_geo = defaultLocation
			// 	//Livewire.emit('setLokasiGeo', defaultLocation)
			// })
		})
		
		el = document.getElementById('geocoder');
		while (el.hasChildNodes()) {  
			el.removeChild(el.firstChild);
		}
		
		el.appendChild(geocoder.onAdd(map));
		if(geocodeText!==''){
			console.log('geocoder : '+geocodeText);
			geocoder.query(geocodeText); 
		}
	}
</script>
@endpush