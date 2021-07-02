<div class="mb-6">
    <div class="px-4 py-2 font-semibold">{{$text}}</div>
    @if(${$name})
    <div class="px-4">
        <div class="w-64 mr-4 flex-shrink-0 shadow-xs rounded-lg" >
            @if(collect(['jpg', 'png', 'jpeg', 'webp'])->contains(${$name}->getClientOriginalExtension()))
                <div class="relative pb-32 overflow-hidden rounded-lg border border-gray-100">
                    <img src="{{ ${$name}->temporaryUrl() }}" class="w-full h-full absolute object-cover rounded-lg">
                </div>
            @else
                <div class="w-16 h-16 bg-gray-100 text-blue-500 flex items-center justify-center rounded-lg border border-gray-100">
                    <svg class="h-12 w-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            @endif
        </div>
        <div>
            {{-- <div class="text-sm font-medium truncate w-40 md:w-auto">{{ ${$name}->getClientOriginalName() }}</div> --}}
            <div class="flex items-center space-x-1">
                {{-- <div class="text-xs text-gray-500">{{ Str::bytesToHuman(${$name}->getSize()) }}</div> --}}
                <div class="text-gray-400 text-xs">&bull;</div>
                <div class="text-xs text-gray-500 uppercase">{{ ${$name}->getClientOriginalExtension() }}</div>
            </div>
        </div>
    </div>
    @endif
</div>         