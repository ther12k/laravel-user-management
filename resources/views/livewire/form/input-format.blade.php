<div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
        <label for="inline-{{$name}}" class="font-bold mb-1 text-gray-700 block">{{$text}}</label>
    </div>
    <div class="md:w-2/3">
        <input 
        name="{{$name}}"
        wire:model.lazy="{{$name}}"
        type="{{ $type ?? 'text' }}" data-format="{{$format}}" data-mask="{{$mask}}"
        class="@error($name) border-red-500 @enderror w-full py-1 px-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
        >
        @error($name) 
        <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
			{{ $message }}
		</span> 
        @enderror
    </div>
</div>
