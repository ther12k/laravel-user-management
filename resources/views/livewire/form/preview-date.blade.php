<div class="grid grid-cols-2">
    <div class="px-4 py-2 font-semibold flex-grow">{{$text}}</div>
    <div class="px-4 py-2 flex-grow">{{ \Carbon\Carbon::parse(${$name})->isoFormat('D MMMM Y')  }}</div>
</div>            