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
    <button class="hover:text-indigo-600 flex outline-none"  x-on:click="$emitUp('editData')">
        <x-heroicon-o-pencil-alt class="h-6 w-6 {{$class}}" />
    </button>
    @endif
    @endcan
</div>