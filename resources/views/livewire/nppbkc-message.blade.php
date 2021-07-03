<div>
    @if (session()->has('message'))
        <div class="text-white px-6 py-4 border-0 rounded relative mb-4 {{$alert?'bg-red-400':'bg-green-400'}}">
            <span class="inline-block align-middle mr-8">
                {{ session('message') }}
            </span>
            <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" wire:click="close_message()">
                <span>×</span>
            </button>
        </div>
        @php
        session()->forget('message');
        @endphp
    @endif
</div>