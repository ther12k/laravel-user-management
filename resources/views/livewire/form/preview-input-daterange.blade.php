<div class="grid grid-cols-2">
    <div class="px-4 py-2 font-semibold">{{$text}}</div>
    <div class="px-4 py-2">{{ \Carbon\Carbon::parse(${$name.'_from'})->isoFormat('D MMMM Y') }} - {{ \Carbon\Carbon::parse(${$name.'_to'})->isoFormat('D MMMM Y') }}</div>
</div>            