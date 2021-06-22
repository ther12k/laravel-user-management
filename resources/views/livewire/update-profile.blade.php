@section('title', 'Update Profile')

<div x-data="app()" x-cloak>
    <div>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
	<div x-data="app()" x-cloak>
        <div class="max-w-3xl mx-auto">
            <!-- Top Navigation -->
			<div class="border-b-2 py-4">
				<div x-show="step !== 0 && step!==11" class="uppercase tracking-wide text-xs font-bold text-gray-500 mb-1 leading-tight" x-text="`Step: ${step} of 10`"></div>
				<div class="flex flex-col md:flex-row md:items-center md:justify-between">
					<div class="flex-1">
                        <div class="text-lg font-bold text-gray-700 leading-tight">Update Profile</div>
					</div>
				</div>
			</div>
			<!-- /Top Navigation -->
            <!-- Bottom Navigation -->	
            <div class="fixed bottom-0 left-0 right-0 py-5 bg-white shadow-md" x-show="step != 'complete'">
                <div class="max-w-3xl mx-auto px-4">
                    <div class="flex justify-between">
                        <div class="w-1/2">
                            <button
                                class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border" 
                            >Log out</button>
                        </div>

                        <div class="w-1/2 text-right">
                            <button
                                class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium" 
                            >Save</button>
                        </div>
                    </div>
                </div>
            </div>
	<!-- / Bottom Navigation https://placehold.co/300x300/e2e8f0/cccccc -->	
            <!-- Content -->
			<div class="py-10">	
				<div>
					@include('livewire.form.input',['name'=>'pekerjaan','text'=>'Pekerjaan'])
					@include('livewire.form.textarea',['name'=>'alamat','text'=>'Alamat'])
					@include('livewire.form.input',['type'=>'number','name'=>'no_telp','text'=>'No Telp'])
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                        <label for="inline-npwp" class="font-bold mb-1 text-gray-700 block">NPWP</label>
                        </div>
                        <div class="md:w-2/3">
                            <x-file-attachment wire:model="npwp_photo" :file="$npwp_photo" />
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                        <label for="inline-ktp" class="font-bold mb-1 text-gray-700 block">KTP</label>
                        </div>
                        <div class="md:w-2/3">
                            <x-file-attachment wire:model="ktp_photo" :file="$ktp_photo" />
                        </div>
                    </div>
				</div>
			</div>
			<!-- / Content -->
        </div>
    </div>	
</div>

<script>
	function doFormat(x, pattern, mask) {
		var strippedValue = x.replace(/[^0-9]/g, "");
		var chars = strippedValue.split('');
		var count = 0;

		var formatted = '';
		for (var i=0; i<pattern.length; i++) {
			const c = pattern[i];
			if (chars[count]) {
			if (/\*/.test(c)) {
				formatted += chars[count];
				count++;
			} else {
				formatted += c;
			}
			} else if (mask) {
			if (mask.split('')[i])
				formatted += mask.split('')[i];
			}
		}
		return formatted;
	}
	function app() {
		document.querySelectorAll('[data-mask]').forEach(function(e) {
		function format(elem) {
			const val = doFormat(elem.value, elem.getAttribute('data-format'));
			elem.value = doFormat(elem.value, elem.getAttribute('data-format'), elem.getAttribute('data-mask'));
			
			if (elem.createTextRange) {
			var range = elem.createTextRange();
			range.move('character', val.length);
			range.select();
			} else if (elem.selectionStart) {
			elem.focus();
			elem.setSelectionRange(val.length, val.length);
			}
		}
		e.addEventListener('keyup', function() {
			format(e);
		});
		e.addEventListener('keydown', function() {
			format(e);
		});
		format(e)
		});
		return {
			step: 0, 
		}
	}
</script>
