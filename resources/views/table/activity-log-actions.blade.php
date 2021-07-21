@if($id!=null)
<div class="flex justify-around align-middle">
    <a href="{{route('nppbkc.view',[$id])}}"  target="_blank"
        class="p-1 text-indigo-600 hover:bg-indigo-400 hover:text-white rounded">
        {{-- <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg> --}}
        <x-heroicon-o-document-search class="w-6 h-6"/>
    </a>
</div>
@endif