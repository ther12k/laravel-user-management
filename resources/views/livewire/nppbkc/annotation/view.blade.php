<div x-show="activeTab === 6" style="display: none;">
    <div class="xl:hidden items-center space-x-2 font-semibold text-gray-900 leading-8">
        <span class="tracking-wide">Catatan Petugas</span>
    </div>
    @if(isset($catatan_petugas)&&!empty($catatan_petugas))
    <div class="px-5">
        <q class="italic text-gray-600">{{$catatan_petugas}}</q>
    </div>
    @endif
    <div class="grid md:grid-cols-2 text-sm mt-4">
@if(isset($files))
        @foreach ($files as $file )
        <div class="px-4 py-2 font-semibold flex">
            <x-heroicon-o-link class="h-6 w-6 mr-2 p-1"/><a href="{{route('nppbkc.download-file',['id'=>$file->key])}}" class="text-indigo-500 hover:text-indigo-700">{{$file->title}}</a>
        </div>
        @endforeach
@endif
    </div>
</div>