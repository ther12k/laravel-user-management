<div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
        <label for="inline-{{$name}}" class="font-bold mb-1 text-gray-700 block">{{$text}}</label>
    </div>
    <div class="md:w-2/3">
        <input type="{{ $type ?? 'text' }}" data-format="{{$format}}" data-mask="{{$mask}}"
        class="w-full py-2 px-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
        placeholder="{{$placeholder}}">
    </div>
</div>