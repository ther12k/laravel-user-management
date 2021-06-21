<div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
        <label for="inline-{{$name}}" class="font-bold mb-1 text-gray-700 block">{{$text}}</label>
    </div>
    <div class="md:w-2/3 relative">
        <select name="{{$name}}" class="w-full px-3 shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium border rounded-lg appearance-none focus:shadow-outline">
            <option value=""> {{ $placeholder ?? 'Pilih '.$text.'...' }}</option>
            @foreach ($options as $option)
                <option value="{{ $option }}">{{ $option }}</option> 
            @endforeach
        </select>
    </div>
</div>