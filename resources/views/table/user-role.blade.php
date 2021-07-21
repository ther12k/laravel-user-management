<div class="ml-4">
    @if($role=='user')
    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-900">
    User Biasa
    </span>
    @elseif($role=='officer')
    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-700">
        Petugas
    </span>
    @elseif($role=='admin')
    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-900">
    Admin
    </span>
    @endif
</div>