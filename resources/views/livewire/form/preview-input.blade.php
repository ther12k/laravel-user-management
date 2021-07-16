<div class="grid grid-cols-2">
    <div class="px-4 py-2 font-semibold flex-grow">{{$text}}</div>
    @if(!isset($nppbk)||!isset($nppbk)||$nppbkc->{$name}== ${$name} )
    <div class="px-4 py-2 flex-grow">{{ ${$name} }}</div>
    @else
    <div class="px-4 py-2 flex-grow text-green-700 font-semibold ">{{ ${$name} }}</div>
    @endif
</div>            