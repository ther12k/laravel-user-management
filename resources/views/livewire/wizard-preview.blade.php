<div class="bg-white my-1 px-5 py-2 rounded-t-lg overflow-hidden shadow-lg hover:shadow">
    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
        <span clas="text-green-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
        </span> 
        @if(!isset($nppbkc_id))
        <span class="tracking-wide text-lg">Preview Permohonan</span>
        @else
        <span class="tracking-wide text-lg text-indigo-700">Preview Revisi Permohonan no {{$no_permohonan}} </span>
        @endif
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
        <x-heroicon-o-user class="h-6 w-6"/>
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
        <x-heroicon-o-office-building class="h-6 w-6"/>
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
            @if(!empty($npwp_usaha))
            @include('livewire.form.preview-input',['name'=>'npwp_usaha','text'=>'NPWP Usaha']) 
            @endif
            @include('livewire.form.preview-input',['name'=>'email_usaha','text'=>'Email Usaha']) 
            @include('livewire.form.preview-input',['name'=>'alamat_usaha','text'=>'Alamat Usaha']) 
        </div>
    </div>
    <div class="flex items-center space-x-2 mt-5  font-semibold text-gray-900 leading-8">
        <x-heroicon-o-location-marker class="h-6 w-6"/>
        <span class="tracking-wide">Lokasi</span>
    </div>
    <div class="text-gray-700">
        <div class="grid md:grid-cols-2 text-sm">
            @include('livewire.form.preview-input',['name'=>'jenis_lokasi','text'=>'Jenis Lokasi'])
            @include('livewire.form.preview-input',['name'=>'kegunaan','text'=>'Kegunaan']) 
            @include('livewire.form.preview-input',['name'=>'lokasi','text'=>'Lokasi'])
        </div>
        <div class="grid md:grid-cols-2 text-sm">
            @include('livewire.form.preview-input',['name'=>'province','text'=>'Provinsi'])
            @include('livewire.form.preview-input',['name'=>'regency','text'=>'Kabupaten/Kota'])
            @include('livewire.form.preview-input',['name'=>'district','text'=>'Kecamatan'])
            @include('livewire.form.preview-input',['name'=>'village','text'=>'Kelurahan/Desa'])
            @include('livewire.form.preview-input',['name'=>'rt_rw','text'=>'RT/RW'])
            @include('livewire.form.preview-input',['name'=>'alamat','text'=>'Alamat Lengkap'])
        </div>
        <div class="p-3 text-sm">
            <div id="map" class='h-72' ></div>
        </div>
    </div>
    <div class="flex items-center space-x-2 mt-5  font-semibold text-gray-900 leading-8">
        <x-heroicon-o-briefcase class="h-6 w-6"/>
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

<div class="bg-white my-1 px-5 py-2 rounded-b-lg overflow-hidden shadow-lg hover:shadow">
    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
        <x-heroicon-o-paper-clip class="h-6 w-6"/> <span class="tracking-wide">Lampiran @if(isset($nppbkc_id)) (yang diupdate)@endif</span>
    </div>
    <div class="text-gray-700">
        <div class="grid md:grid-cols-2 text-sm">
            @foreach (nppbkc_file_captions() as $field=>$value)
                @if(isset(${$field}))
                    @if($field=='file_surat_kuasa')
                        @if($status_pemohon=='dikuasakan')
                            @include('livewire.form.preview-file',['name'=>'file_surat_kuasa','text'=>'Surat Kuasa'])   
                        @endif
                    @else
                        @include('livewire.form.preview-file',['name'=> $field,'text'=>$value])
                    @endif
                @endif
            @endforeach
            {{-- @if(isset($file_denah_bangunan))
            @include('livewire.form.preview-file',['name'=>'file_denah_bangunan','text'=>'Denah di dalam Bangunan'])
            @endif

            @if(isset($file_denah_lokasi))
            @include('livewire.form.preview-file',['name'=>'file_denah_lokasi','text'=>'Denah Situasi sekitar lokasi'])
            @endif

            @include('livewire.form.preview-file',['name'=>'file_siup_mb','text'=>'SIUP-MB / SKMB'])
            @include('livewire.form.preview-file',['name'=>'file_itp_mb','text'=>'ITP-MB'])
       
            @include('livewire.form.preview-file',['name'=>'file_nib','text'=>'Nomor Induk Berusaha'])
            @include('livewire.form.preview-file',['name'=>'file_npwp_usaha','text'=>'NPWP Usaha']) --}}
{{--         
        @if($status_pemohon=='dikuasakan'&&isset($file_surat_kuasa))
            @include('livewire.form.preview-file',['name'=>'file_surat_kuasa','text'=>'Surat Kuasa'])    
        @endif
            @include('livewire.form.preview-file',['name'=>'file_npwp_pemilik','text'=>'NPWP Pemilik'])
            @include('livewire.form.preview-file',['name'=>'file_ktp_pemilik','text'=>'KTP Pemilik'])
            @include('livewire.form.preview-file',['name'=>'file_surat_pernyataan','text'=>'Surat Pernyataan']) --}}
            
        </div>
    </div>
</div>

<div class="mb-6 px-1 w-full py-3" ></div>