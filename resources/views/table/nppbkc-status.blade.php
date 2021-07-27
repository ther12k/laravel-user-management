<div class="flex space-x-1">
    @if($status==0)
    <a href="{{route('nppbkc.view',[$id])}}#content" class="p-1 px-2 hover:bg-red-700 bg-red-500 text-white rounded">
        {{nppbkc_status_names($status)}}
    </a>
    @endif
    @if($status==1)
    <a href="{{route('nppbkc.view',[$id])}}#content" class="p-1 px-2 hover:bg-gray-800 bg-gray-600 text-white rounded">
        {{nppbkc_status_names($status)}}
    </a>
    @endif
    @if($status==2)
    <a href="{{route('nppbkc.view',[$id])}}#content" class="p-1 px-2 hover:bg-indigo-700 bg-indigo-500 text-white rounded">
        {{nppbkc_status_names($status)}}
    </a>
    @endif
    @if($status==3)
    <a href="{{route('nppbkc.view',[$id])}}#content" class="p-1 px-2 hover:bg-yellow-700 bg-yellow-500 text-white rounded">
        {{nppbkc_status_names($status)}}
    </a>
    @endif
    @if($status==4)
    <a href="{{route('nppbkc.view',[$id])}}#content" class="p-1 px-2 bg-red-500 text-white rounded">
        {{nppbkc_status_names($status)}}
    </a>
    @endif
    @if($status==5)
    <a href="{{route('nppbkc.view',[$id])}}#content" class="p-1 px-2 bg-green-500 text-white rounded">
        {{nppbkc_status_names($status)}}
    </a>
    @endif
</div>