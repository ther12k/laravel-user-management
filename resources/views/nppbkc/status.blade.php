
    @if($status==1)
    <span class="px-2 text-gray-600 rounded hover:text-indigo-500">
        {{nppbkc_status_names($status)}}
    </span>
    @endif
    @if($status==2)
    <span class="px-2 text-indigo-500 rounded">
        {{nppbkc_status_names($status)}}
    </span>
    @endif
    @if($status==3)
    <span class="px-2 text-yellow-500 rounded">
        {{nppbkc_status_names($status)}}
    </span>
    @endif
    @if($status==4)
    <span class="px-2 text-red-500 rounded">
        {{nppbkc_status_names($status)}}
    </span>
    @endif
    @if($status==5)
    <span class="px-2 text-green-500 rounded">
        {{nppbkc_status_names($status)}}
    </span>
    @endif