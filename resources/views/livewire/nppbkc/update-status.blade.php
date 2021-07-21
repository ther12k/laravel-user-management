<div>
    <h1 class="flex-auto text-xl font-semibold text-purple-700 mb-4">Permohonan Pemeriksaan Lokasi / NPPBKC </h1>
    <h2 class="flex-auto text-lg font-semibold">No : {{$nppbkc->no_permohonan}}</h2>
    @if($nppbkc->status_nppbkc>2)
    <h3 class="flex-auto text-lg font-semibold">Tgl BA : {{\Carbon\Carbon::parse($nppbkc->tanggal_ba_cek_lokasi)->isoFormat('D MMMM Y')}}</h3>
    @else
    <h2>Tanggal Kesiapan Cek :  {{$nppbkc->tanggal_kesiapan_cek_lokasi}}</h2>
    @endif
    <div class="flex" >
        <div><span>Status : </span> </div>

        @php
            $class=$nppbkc->status_nppbkc;
            switch ($nppbkc->status_nppbkc){
                case 0:$class='text-red-500';break;
                case 1:$class='text-gray-600 hover:text-indigo-500';break;
                case 2:$class='text-indigo-600 hover:text-yellow-500';break;
                case 3:$class='text-yellow-600 hover:text-gray-500';break;
                case 4:$class='text-red-600';break;
                case 5:$class='text-green-600';
            }
        @endphp
        @can('updateStatusNppbkc')
            @if($nppbkc->status_nppbkc>3||$nppbkc->status_nppbkc==0)
                <span class="px-2 rounded {{$class}}">
                    {{nppbkc_status_names($nppbkc->status_nppbkc)}}
                </span>
            @else
                <button class="hover:text-indigo-600 flex outline-none" 
                    {{-- x-on:click="$wire.updateStatus()" --}}
                    onclick='Livewire.emit("openModal", "nppbkc.modal",@json(["id"=>$nppbkc->id]))'>
                    <span class="px-2 rounded {{$class}}">
                        {{nppbkc_status_names($nppbkc->status_nppbkc)}}
                    </span>
                    <x-heroicon-o-pencil-alt class="h-6 w-6 {{$class}}" />
                </button>
                <svg wire:loading.delay class="animate-spin mt-1 ml-1 mr-3 h-5 w-5 {{$class}}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            @endif
        @else
            <span class="px-2 rounded {{$class}}">
                {{nppbkc_status_names($nppbkc->status_nppbkc)}}
            </span>
        @endcan
    </div>
    @if($nppbkc->status_nppbkc>1)
    <button class="flex-auto text-sm font-semibold text-purple-700 mb-4 outline-none" @if($nppbkc->status_nppbkc>2) x-on:click="activeTab = 6" @endif>
            Diupdate @can('viewAllNppbkc')oleh {{$nppbkc->updatedBy->name}}, @endcan{{\Carbon\Carbon::parse($nppbkc->updated_at)->isoFormat('HH:mm D MMMM Y')}}
    </button>
    @endif
    
    @cannot('viewAllNppbkc')
    @if($nppbkc->status_nppbkc==0)
    <a class="hover:text-indigo-600 flex outline-none"  href="{{route('nppbkc.edit', [$nppbkc->id] )}}">
        Revisi <x-heroicon-o-pencil-alt class="h-6 w-6 {{$class}}" />
    </a>
    @endif
    @endcan
</div>