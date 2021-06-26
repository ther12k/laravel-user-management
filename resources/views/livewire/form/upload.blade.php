<div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
    <label for="inline-{{$name}}" class="font-bold mb-1 text-gray-700 block">{{$text}}</label>
    </div>
    <div class="md:w-2/3">
        <x-file-attachment class="@error($name) border-red-500 @enderror " wire:model="{{$name}}" :file="${$name}" />
        @error($name) 
        <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
			{{ $message }}
		</span> 
        @enderror
    </div>
</div>