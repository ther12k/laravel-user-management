@if($verified!=null)
<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
    Verified
</span>
@else
<span class="px-2 cursor-pointer inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 hover:bg-red-800 hover:text-gray-800 text-red-800" onclick='Livewire.emit("openModal", "user-modal",@json(["id"=>$id,"action"=>"verify"]))'>
    Not verified
</span>
@endif