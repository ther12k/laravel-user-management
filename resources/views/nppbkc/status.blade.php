
    @if($status==1)
    <a href="javascript:void(0)" class="px-2 text-gray-600 rounded">
        {{nppbkc_status_names($status)}}
    </a>
    @endif
    @if($status==2)
    <a href="javascript:void(0)" class="px-2 text-indigo-500 rounded">
        {{nppbkc_status_names($status)}}
    </a>
    @endif
    @if($status==3)
    <a href="javascript:void(0)" class="px-2 text-yellow-500 rounded">
        {{nppbkc_status_names($status)}}
    </a>
    @endif
    @if($status==4)
    <a href="javascript:void(0)" class="px-2 text-red-500 rounded">
        {{nppbkc_status_names($status)}}
    </a>
    @endif
    @if($status==5)
    <a href="javascript:void(0)" class="px-2 text-green-500 rounded">
        {{nppbkc_status_names($status)}}
    </a>
    @endif