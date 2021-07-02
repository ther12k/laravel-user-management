<div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
    <label for="inline-{{$name}}" class="font-bold mb-1 text-gray-700 block">{{$text}}</label>
    </div>
    <div class="md:w-2/3 flex"  x-data="{ tooltip: false }">
        @isset($tooltip)
        <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
            <div class="absolute ml-40 lg:ml-14 top-0 z-10 w-64 p-2 px-4 -mt-1 text-sm leading-tight text-white transform -translate-x-1/2 -translate-y-full bg-blue-400 rounded-lg shadow-lg">
                {{$tooltip}}
            </div>
            <svg class="absolute ml-40 lg:ml-14 z-10 w-6 h-6 text-blue-400 transform -translate-x-12 -translate-y-3 fill-current stroke-current" width="8" height="8">
                <rect x="12" y="-10" width="8" height="8" transform="rotate(45)" />
            </svg>
        </div>
        @endif
        <input         
        @isset($tooltip)
        x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" 
        @endif
        name="{{$name}}"
        wire:model.defer="{{$name}}"
        type="{{ $type ?? 'text' }}"
        class="@error($name) border-red-500 @enderror w-full py-1 px-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
        placeholder="{{ $placeholder ?? 'Input '.$text.'...' }}"/>
        @error($name) 
        <span class="error flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
			{{ $message }}
		</span> 
        @enderror
    </div>
</div>