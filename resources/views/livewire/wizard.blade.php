@section('title', 'Perekaman Data NPPBCK')

<div x-data="app()" x-cloak>
	<div class="max-w-3xl mx-auto">
		<div x-show.transition="step === 'complete'">
			<div class="bg-white rounded-lg p-5 flex items-center shadow justify-between">
				<div>
					<svg class="mb-4 h-20 w-20 text-green-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>

					<h2 class="text-2xl mb-4 text-gray-800 text-center font-bold">Input Permohonan Success</h2>

					<div class="text-gray-600 mb-8">
						<p>Kasih Telah Menggunakan Layanan BC Palangkaraya.<br/>
						Bersama ini kami sampaikan tanda terima permohonan yang telah anda lakukan dengan data-data sebagai berikut:
						</p> 
						<p class="py-2">
							Jenis Layanan	: NPPBKC Online<br/>
							Tanda Terima	: xxxxxx <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">(download)</a> <br/>
							Tanggal		: (tanggal permohonan)<br/>
						</p>
						<p class="py-2">Selanjutnya Saudara dapat memonitoring permohonan dengan memasukan nomor tanda terima pada menu monitoring permohonan pada halaman utama.</p>
					</div>

					<button
						@click="step = 1"
						class="w-40 block mx-auto focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border" 
					>Back to home</button>
				</div>
			</div>
		</div>

		<div x-show.transition="step != 'complete'">	
			<!-- Top Navigation -->
			<div class="border-b-2 py-4">
				<div x-show="step !== 0 && step!=='preview'" class="uppercase tracking-wide text-xs font-bold text-gray-500 mb-1 leading-tight" x-text="`Step: step of 10`"></div>
				<div x-show="step==='preview'" class="uppercase tracking-wide text-xs font-bold text-gray-500 mb-1 leading-tight">Preview Sebelum Kirim</div>
				
				<div class="flex flex-col md:flex-row md:items-center md:justify-between">
					<div class="flex-1">
						<div x-show="step === 0">
							<div class="text-lg font-bold text-gray-700 leading-tight">DISCLAIMER</div>
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

			<!-- Step Content -->
			<div class="py-5">	
				<div x-show.transition.in="step === 0">
					<div class="mb-6 py-5">
						@include('livewire.form.disclaimer')
					</div>
				</div>
				<div x-show.transition.in="step === 1||step == 'preview'">
					<div class="md:flex md:items-center mb-6">
						<div class="md:w-1/3">
							<label for="status_pemohon" class="font-bold mb-1 text-gray-700 block">Status Permohonan</label>
						</div>
						<div class="md:w-2/3">
							<div class="flex">
								<label
									class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-2 shadow-sm mr-4">
									<div class="text-teal-600 mr-3">
										<input type="radio" x-model="status_pemohon" value="sendiri" class="form-radio focus:outline-none focus:shadow-outline" />
									</div>
									<div class="select-none text-gray-700">Sendiri</div>
								</label>

								<label
									class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-2 shadow-sm">
									<div class="text-teal-600 mr-3">
										<input type="radio" x-model="status_pemohon" value="dikuasakan" class="form-radio focus:outline-none focus:shadow-outline" />
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
				<div x-show.transition.in="step === 2||step == 'preview'">
					@include('livewire.form.select',['name'=>'jenis_usaha_bkc','text'=>'Jenis Usaha BKC',
							'options'=>[
								'Pengusaha Pabrik',
								'Pengusaha Tempat Penyimpanan',
								'Importir',
								'Penyalur',
								'Pengusaha Tempat Penjualan Eceran'
								]
							])
					@include('livewire.form.select',['name'=>'jenis_bkc','text'=>'Jenis BKC',
						'options'=>[
								'Hasil Tembakau',
								'Hasil Pengolahan Tembakau Lainnya',
								'Minuman Mengandung Etil Alkohol',
								'Etil Alkohol'
							]
						])
				</div>
				<div x-show.transition.in="step === 3||step == 'preview'">
					@include('livewire.form.input',['name'=>'nama_usaha','text'=>'Nama Usaha'])
					@include('livewire.form.textarea',['name'=>'alamat_usaha','text'=>'Alamat Usaha'])
					@include('livewire.form.input',['type'=>'number','name'=>'telp_usaha','text'=>'No Telp Usaha'])
					@include('livewire.form.input-format',['type'=>'text','name'=>'npwp_usaha',
											'text'=>'NPWP Usaha',
											'format'=>'**.***.***.*-***.***',
											'mask'=>'xx.xxx.xxx.x-xxx.xxx'
											])
					@include('livewire.form.input',['type'=>'email','name'=>'email_usaha','text'=>'Email Usaha'])
					<div class="mb-6 py-5" x-show="step===3"></div>
				</div>
				<div x-show.transition.in="step === 4||step == 'preview'">

					@include('livewire.form.select',['name'=>'jenis_lokasi','text'=>'Jenis Lokasi',
							'options'=>[
									'Pabrik',
									'Tempat Penyimpanan',
									'Tempat Usaha Importir',
									'Tempat Penjualan Eceran'
								]
							])

					@include('livewire.form.textarea',['name'=>'lokasi','text'=>'Lokasi'])

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
				<div x-show.transition.in="step === 5||step == 'preview'">
					@include('livewire.form.location-select')
							
				</div>
				<div x-show.transition.in="step === 6||step == 'preview'">
					@include('livewire.form.input',['name'=>'rt_rw','text'=>'RT / RW'])
					@include('livewire.form.textarea',['name'=>'alamat','text'=>'Alamat Lengkap'])
					@include('livewire.form.input',['name'=>'lokasi_geo','text'=>'Koordinat Lokasi'])
				</div>
				<div x-show.transition.in="step === 7||step == 'preview'">
					@include('livewire.form.input',['name'=>'no_siup_mb','text'=>'Nomor Izin SIUP-MB / SKMB'])
					@include('livewire.form.input-fromto-date',['name'=>'masa_berlaku_siup_mb','text'=>'Tanggal masa berlaku'])

					@include('livewire.form.input',['name'=>'no_itp_mb','text'=>'Nomor Izin ITP-MB'])
					@include('livewire.form.input-fromto-date',['name'=>'masa_berlaku_itp_mb','text'=>'Tanggal masa berlaku'])

					@include('livewire.form.input',['name'=>'no_izin_nib','text'=>'No Izin NIB'])
					@include('livewire.form.input-date',['name'=>'tanggal_nib','text'=>'Tanggal NIB'])
				
				</div>
				<div x-show.transition.in="step === 8||step == 'preview'">
					@include('livewire.form.input-date',['name'=>'tanggal_kesiapan_cek_lokasi','text'=>'Tanggal kesiapan cek lokasi'])
				</div>
				<div x-show.transition.in="step === 9||step == 'preview'">
					<div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                        <label for="inline-file_denah_bangunan" class="font-bold mb-1 text-gray-700 block">Denah di dalam Bangunan</label>
                        </div>
                        <div class="md:w-2/3">
                            <x-file-attachment wire:model="file_denah_bangunan" :file="$file_denah_bangunan" />
                        </div>
                    </div>
					<div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                        <label for="inline-file_denah_lokasi" class="font-bold mb-1 text-gray-700 block">Denah Situasi sekitar lokasi</label>
                        </div>
                        <div class="md:w-2/3">
                            <x-file-attachment wire:model="file_denah_lokasi" :file="$file_denah_lokasi" />
                        </div>
                    </div>
					<div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                        <label for="inline-file_izin_instansi" class="font-bold mb-1 text-gray-700 block">Izin Instansi Terkait</label>
                        </div>
                        <div class="md:w-2/3">
                            <x-file-attachment wire:model="file_izin_instansi" :file="$file_izin_instansi" />
                        </div>
                    </div>
					<div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                        <label for="inline-file_surat_kuasa" class="font-bold mb-1 text-gray-700 block">Surat Kuasa</label>
                        </div>
                        <div class="md:w-2/3">
                            <x-file-attachment wire:model="file_surat_kuasa" :file="$file_surat_kuasa" />
                        </div>
                    </div>
					<div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                        <label for="inline-file_nib" class="font-bold mb-1 text-gray-700 block">Nomor Induk Berusaha</label>
                        </div>
                        <div class="md:w-2/3">
                            <x-file-attachment wire:model="file_nib" :file="$file_nib" />
                        </div>
                    </div>
					<div class="mb-6 py-5" x-show="step===9"></div>
				</div>

				<div x-show.transition.in="step === 10||step == 'preview'">
					<div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                        <label for="inline-file_npwp_usaha" class="font-bold mb-1 text-gray-700 block">NPWP Usaha</label>
                        </div>
                        <div class="md:w-2/3">
                            <x-file-attachment wire:model="file_npwp_usaha" :file="$file_npwp_usaha" />
                        </div>
                    </div>
					<div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                        <label for="inline-file_npwp_pemilik" class="font-bold mb-1 text-gray-700 block">NPWP Pemilik</label>
                        </div>
                        <div class="md:w-2/3">
                            <x-file-attachment wire:model="file_npwp_pemilik" :file="$file_npwp_pemilik" />
                        </div>
                    </div>
					<div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                        <label for="inline-file_ktp_pemilik" class="font-bold mb-1 text-gray-700 block">KTP Pemilik</label>
                        </div>
                        <div class="md:w-2/3">
                            <x-file-attachment wire:model="file_ktp_pemilik" :file="$file_ktp_pemilik" />
                        </div>
                    </div>
					<div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                        <label for="inline-file_surat_pernyataan" class="font-bold mb-1 text-gray-700 block">Surat Pernyataan</label>
                        </div>
                        <div class="md:w-2/3">
                            <x-file-attachment wire:model="file_surat_pernyataan" :file="$file_surat_pernyataan" />
                        </div>
                    </div>
					<div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                        <label for="inline-file_data_registrasi" class="font-bold mb-1 text-gray-700 block">Data Registrasi</label>
                        </div>
                        <div class="md:w-2/3">
                            <x-file-attachment wire:model="file_data_registrasi" :file="$file_data_registrasi" />
                        </div>
                    </div>
					<div class="mb-6 py-5" x-show="step===10||step==='preview'"></div>
				</div>

				<div x-show.transition.in="step === 11">
					@include('livewire.wizard-preview')
				</div>
			</div>
			<!-- / Step Content -->
		</div>
	</div>

	<!-- Bottom Navigation -->	
	<div class="fixed bottom-0 left-0 right-0 py-5 bg-white shadow-md" x-show="step != 'complete'">
		<div class="max-w-3xl mx-auto px-4">
			<div class="flex justify-between">
				<div class="w-1/2">
					<button
						wire:loading.attr="disabled"
						x-show="step > 1"
						wire:click="back()"
						class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border" 
					>Previous</button>
					<button
						wire:loading.attr="disabled"
						x-show="step === 1"
						wire:click="back()"
						class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border" 
					>Disclaimer</button>
				</div>

				<div class="w-1/2 text-right">
					<button
					wire:loading.attr="disabled"
						x-show="step < 10"
						wire:click="stepCheck()"
						class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium" 
					>Next</button>
					<button
						wire:click="step = 'preview'"
						x-show="step === 10"
						class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-gray-500 hover:bg-gray-600 font-medium" 
					>Preview</button>
					<button
						wire:loading.attr="disabled"
						wire:click="step = 'complete'"
						x-show="step === 'preview'"
						class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium" 
					>Complete</button>
				</div>
			</div>
		</div>
	</div>
	<!-- / Bottom Navigation https://placehold.co/300x300/e2e8f0/cccccc -->	
</div>

<script>
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

		return {
			step : @entangle('step'),
			status_pemohon:'sendiri'
		}
	}
</script>
