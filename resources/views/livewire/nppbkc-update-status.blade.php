<div>
    <h1 class="flex-auto text-xl font-semibold text-purple-700 mb-4">Permohonan Pemeriksaan Lokasi / NPPBKC </h1>
    <h2 class="flex-auto text-lg font-semibold">No {{$nppbkc->no_permohonan}}</h2>
    @if($nppbkc->status_nppbkc<3)
    <h2>Tanggal Kesiapan Cek :  {{$nppbkc->tanggal_kesiapan_cek_lokasi}}</h2>
    @endif
    <div class="flex" >
        <div><span>Status : </span> </div>
        <button class="hover:text-indigo-600 flex outline-none" onclick='Livewire.emit("openModal", "nppbkc-modal",@json(["id"=>$nppbkc->id]))'>
            @php
                $class=$nppbkc->status_nppbkc;
                switch ($nppbkc->status_nppbkc){
                    case 1:$class='text-gray-600 hover:text-indigo-500';break;
                    case 2:$class='text-indigo-600 hover:text-yellow-500';break;
                    case 3:$class='text-yellow-600 hover:text-gray-500';break;
                    case 4:$class='text-red-600 hover:text-green-500';break;
                    case 5:$class='text-green-600';
                }
            @endphp
            <span class="px-2 rounded {{$class}}">
                {{nppbkc_status_names($nppbkc->status_nppbkc)}}
            </span>
            <x-heroicon-o-pencil-alt class="h-6 w-6 {{$class}}" />
        </button>
    </div>
    @if($nppbkc->status_nppbkc>1)
    <button class="flex-auto text-sm font-semibold text-purple-700 mb-4 outline-none" @if($nppbkc->status_nppbkc>2) @click="activeTab = 6" @endif>
            Diupdate oleh {{$nppbkc->updatedBy->name}} ({{$nppbkc->updated_at}}) 
    </button>
    @endif
</div>