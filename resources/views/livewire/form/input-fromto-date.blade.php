<div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
    <label for="inline-{{$name}}" class="font-bold mb-1 text-gray-700 block">{{$text}}</label>
    </div>
    <div class="md:w-2/3 md:flex">
        <input type="{{ $type ?? 'text' }}"
            name = "{{$name}}_from"
            class="datepicker w-32 py-1 px-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
            placeholder="Dari Tanggal">
        <span class="py-1 px-2 font-bold mb-1 text-gray-700 block">Sampai</span>
        <input type="{{ $type ?? 'text' }}"
            name = "{{$name}}_to"
            class="datepicker w-32 py-1 px-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
            placeholder="Tanggal">
    </div>
</div>