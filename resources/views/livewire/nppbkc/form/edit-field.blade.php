<div 
    x-data="
        {
             isEditing: false,
             isVal: '{{ $isVal }}',
             focus: function() {
                const textInput = this.$refs.textInput;
                textInput.focus();
                textInput.select();
             }
        }
    "
    x-cloak
>
    <div class="grid grid-cols-2" >
        
        <div class="px-4 font-semibold flex-grow">Nama Pemilik</div>
        <div x-show=!isEditing class="w-full">
            <span
            class="text-gray-700 bg-gray-200 border-gray-600 p-1"
                x-bind:class="{ 'text-gray-800': isVal }"
                x-on:click="isEditing = true; $nextTick(() => focus())"
            >{{ $value }}</span>
        </div>
        <div x-show=isEditing>
            <div class="flex-grow" >
                <input shadowless
                            type="text"
                            class="px-1 border border-gray-400 text-sm shadow-inner bg-gray-200"
                            placeholder="Edit..."
                            x-ref="textInput"
                            wire:model.lazy="newVal"
                            x-on:keydown.enter="isEditing = false"
                            x-on:keydown.escape="isEditing = false"
                />
                <button type="button" class="px-1 ml-2 text-3xl" title="Cancel" x-on:click="isEditing = false">x</button>
                <button
                    type="submit"
                    class="px-1 ml-1 text-3xl font-bold text-green-600"
                    title="Save"
                    x-on:click="isEditing = false"
                >✓</button>
            </div>
            <div>
                <small class="text-xs text-gray-600">Enter untuk simpan, Esc cancel</small>
            </div>
        </div>
    </div>
</div>