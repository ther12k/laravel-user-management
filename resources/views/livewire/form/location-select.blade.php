<div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
        <label for="inline-province_id" class="font-bold mb-1 text-gray-700 block">Provinsi</label>
    </div>
    <div class="md:w-2/3 relative">
        <livewire:province-select
        name="province_id"
        placeholder="Pilih Provinsi"
        :value="request('province_id')"
        />
        @error('province_id') 
        <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
			{{ $message }}
		</span> 
        @enderror
    </div>
</div>
<div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
        <label for="inline-regency_id" class="font-bold mb-1 text-gray-700 block">Kabupaten/Kota</label>
    </div>
    <div class="md:w-2/3 relative">
        <livewire:regency-select
            name="regency_id"
            placeholder="Pilih Kabupaten/Kota"
            :value="request('regency_id')"
            :depends-on="['province_id']"
            :depends-on-values="['province_id' => request('province_id')]"
        />
        @error('regency_id') 
        <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
			{{ $message }}
		</span> 
        @enderror
    </div>
</div>
<div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
        <label for="inline-district_id" class="font-bold mb-1 text-gray-700 block">Kecamatan</label>
    </div>
    <div class="md:w-2/3 relative">
        <livewire:district-select
            name="district_id"
            placeholder="Pilih Kecamatan"
            :value="request('district_id')"
            :depends-on="['regency_id']"
            :depends-on-values="['regency_id' => request('regency_id')]"
            />
        @error('district_id') 
        <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
			{{ $message }}
		</span> 
        @enderror
    </div>
</div>

<div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
        <label for="inline-village_id" class="font-bold mb-1 text-gray-700 block">Kelurahan/Desa</label>
    </div>
    <div class="md:w-2/3 relative">
            <livewire:village-select
            name="village_id"
            placeholder="Pilih Kelurahan/Desa"
            :value="request('village_id')"
            :depends-on="['district_id']"
            :depends-on-values="['district_id' => request('district_id')]"
            {{-- :wait-for-dependencies-to-show="true" --}}
            />
        @error('village_id') 
        <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
			{{ $message }}
		</span> 
        @enderror
    </div>
</div>
