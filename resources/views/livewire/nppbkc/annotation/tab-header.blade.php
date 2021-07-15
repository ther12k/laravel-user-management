<div>
    @if($show&&$show!=='false')
    <a href="#content" :class="activeClass" x-show="activeTab===6">
        <div class="flex items-center space-x-2 font-semibold leading-8">
            <span clas="text-green-500">
                <x-heroicon-o-annotation class="h-6 w-6"/>
            </span>
            <span class="hidden xl:block">Catatan</span>
        </div>
    </a>
    <a href="#content" x-on:click="activeTab = 6" :class="inactiveClass" x-show="activeTab !== 6">
        <div class="flex items-center space-x-2 font-semibold leading-8">
            <span clas="text-green-500">
                <x-heroicon-o-annotation class="h-6 w-6"/>
            </span>
            <span class="hidden xl:block">Catatan</span>
        </div>
    </a>
    @endif
</div>