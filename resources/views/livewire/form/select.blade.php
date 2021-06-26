<div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
        <label for="inline-{{$name}}" class="font-bold mb-1 text-gray-700 block">{{$text}}</label>
    </div>
    <div class="md:w-2/3 relative">
        <select 
        name="{{$name}}" 
        wire:model="{{$name}}" 
        class="@error($name) border-red-500 @enderror w-full px-2 shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium border rounded-lg appearance-none focus:shadow-outline">
            <option value=""> {{ $placeholder ?? 'Pilih '.$text.'...' }}</option>
            @foreach ($options as $option)
                <option value="{{ $option }}">{{ $option }}</option> 
            @endforeach
        </select>
        @error($name) 
        <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
			{{ $message }}
		</span> 
        @enderror
    </div>
</div>