<div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
        <label for="inline-{{$name}}" class="font-bold mb-1 text-gray-700 block">{{$text}}</label>
    </div>
    <div class="md:w-2/3">
        <input 
        x-init="app()" type="{{ $type ?? 'text' }}" data-format="{{$format}}" data-mask="{{$mask}}"
        class="w-full py-1 px-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
        placeholder="{{ $placeholder ?? 'Input '.$text.'...' }}">
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
			passwordStrengthText: '',
			togglePassword: false,
			password: '',
			gender: 'Male',
			status_pemohon:'sendiri',

			checkPasswordStrength() {
				var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
				var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");

				let value = this.password;

				if (strongRegex.test(value)) {
					this.passwordStrengthText = "Strong password";
				} else if(mediumRegex.test(value)) {
					this.passwordStrengthText = "Could be stronger";
				} else {
					this.passwordStrengthText = "Too weak";
				}
			}
		}
	}
</script>