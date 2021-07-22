<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
{{-- @if (trim($slot) === 'Laravel') --}}
<img src="{{asset('images/logo-512.png',parse_url(url('/'), PHP_URL_SCHEME) == 'HTTPS')}}" class="logo" alt="NPPBKC Logo">
{{-- @else --}}
{{-- {{ $slot }} --}}
{{-- @endif --}}
</a>
</td>
</tr>
