<div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
    <label for="inline-{{$name}}" class="font-bold mb-1 text-gray-700 block">{{$text}}</label>
    </div>
    <div class="md:w-2/3">
        <input
        wire:ignore
            wire:model.defer="{{$name}}" 
            type="{{ $type ?? 'text' }}"
            @if(isset($id)) id="{{$id}}" @endif
            class="@error($name) border-red-500 @enderror {{$class ?? 'datepicker'}} w-32 py-1 px-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
            placeholder="{{ $placeholder ?? 'Pilih '.$text.'...' }}">
            @error($name) 
            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                {{ $message }}
            </span> 
            @enderror
        </div>
</div>