<div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
        <label for="inline-{{$name}}" class="font-bold mb-1 text-gray-700 block">{{$text}}</label>
    </div>
    <div class="md:w-2/3 md:flex">
        <input 
            type="{{ $type ?? 'text' }}"
            wire:model.defer="{{$name}}_from"
            name = "{{$name}}_from"
            class="@error($name) border-red-500 @enderror datepicker w-32 py-1 px-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
            placeholder="Dari Tanggal">
        <span class="py-1 px-2 font-bold mb-1 text-gray-700 block">Sampai</span>
        <input 
            type="{{ $type ?? 'text' }}"
            wire:model.defer="{{$name}}_to"
            name = "{{$name}}_to"
            class="@error($name) border-red-500 @enderror datepicker w-32 py-1 px-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
            placeholder="Tanggal">
    </div>
</div>
<div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
    </div>
    <div class="md:w-2/3">
    @error($name.'_from') 
    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
        {{ $message }}
    </span> 
    @enderror
    @error($name.'_to') 
    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
        {{ $message }}
    </span> 
    @enderror
    </div>
</div>