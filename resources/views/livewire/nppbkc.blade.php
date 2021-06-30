@section('title', 'View Data NPPBCK')
@push('styles')
<style>
	[x-cloak] {
		display: none;
	}

</style>
@endpush    
<div class="flex flex-wrap" id="tabs-id"
x-data="{ 
    activeTab:1,
    inactiveClass: 'hover:text-purple-600 bg-gray-200 text-gray-600 bg-white text-xs font-bold uppercase px-5 py-3 block leading-normal',
    activeClass : 'text-purple-600 bg-white text-xs font-bold uppercase px-5 py-3 block leading-normal'
 }" 
>
    <div class="w-full">
        <div class="flex space-x-2">
            <a href="#" @click="activeTab = 1" :class="activeTab === 1 ? activeClass : inactiveClass">
                <div class="flex">
                <svg class="h-4 space-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </span><span class="hidden md:block">Data Pemohon</span>
                </div>
            </a>
            <a href="#" @click="activeTab = 2" :class="activeTab === 2 ? activeClass : inactiveClass">Data Usaha</a>
        </div>
      <div class="flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg">
        <div class="px-4 py-5 flex-auto">
          <div class="tab-content tab-space">
            <div class="block" id="tab-profile" x-show="activeTab === 1">
              <p>
                Collaboratively administrate empowered markets via
                plug-and-play networks. Dynamically procrastinate B2C users
                after installed base benefits.
                <br />
                <br />
                Dramatically visualize customer directed convergence
                without revolutionary ROI.
              </p>
            </div>
            <div class="hidden" id="tab-settings" x-show="activeTab === 2">
              <p>
                Completely synergize resource taxing relationships via
                premier niche markets. Professionally cultivate one-to-one
                customer service with robust ideas.
                <br />
                <br />
                Dynamically innovate resource-leveling customer service for
                state of the art customer service.
              </p>
            </div>
            <div class="hidden" id="tab-options" x-show="activeTab === 3">
              <p>
                Efficiently unleash cross-media information without
                cross-media value. Quickly maximize timely deliverables for
                real-time schemas.
                <br />
                <br />
                Dramatically maintain clicks-and-mortar solutions
                without functional solutions.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@push('script')

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>
<script>
    const style = "streets-v11";
	var lokasi_longitude;
	var lokasi_latitude;
	var defaultLocation =  [106.697, -6.313];
	var loaded = false;
	var skeleton;
	function app() {
		console.log('init app');
		return {
			skeleton : false,
			lokasi_longitude : @entangle($lokasi_longitude),
			lokasi_latitude : @entangle($lokasi_latitude),
		}
	}
	window.addEventListener('render', event=>{
        loadPreviewMap()
    });

	// 	flatpickr.localize(flatpickr.l10ns.id);
	// 	flatpickr('.datepicker',{
	// 		dateFormat: "d-m-Y", 
	// 	})
	// 	document.querySelectorAll('[data-mask]').forEach(function(e) {
	// 	function format(elem) {
	// 		const val = doFormat(elem.value, elem.getAttribute('data-format'));
	// 		elem.value = doFormat(elem.value, elem.getAttribute('data-format'), elem.getAttribute('data-mask'));
			
	// 		if (elem.createTextRange) {
	// 		var range = elem.createTextRange();
	// 		range.move('character', val.length);
	// 		range.select();
	// 		} else if (elem.selectionStart) {
	// 		elem.focus();
	// 		elem.setSelectionRange(val.length, val.length);
	// 		}
	// 	}
	// 	e.addEventListener('keyup', function() {
	// 		format(e);
	// 	});
	// 	e.addEventListener('keydown', function() {
	// 		format(e);
	// 	});
	// 	format(e)
	// 	});
	// 	if(event&&event.detail.step=='preview'){
	// 		loadPreviewMap();
	// 	}
	// });

	function loadPreviewMap(){
		console.log('render preview map')
		mapboxgl.accessToken = "{{env('MAPBOX_ACCESS_TOKEN')}}";

		map = new mapboxgl.Map({
				container: 'map',
				style: 'mapbox://styles/mapbox/light-v10',
				center: defaultLocation,
				zoom: 13
			});

		map.setStyle(`mapbox://styles/mapbox/${style}`); 
		
		map.addControl(new mapboxgl.NavigationControl());

		marker = new mapboxgl.Marker({
			color: '#F84C4C'
		})
		.setLngLat(defaultLocation)
		.addTo(map)
		marker.getElement().addEventListener('click', event => {
			let a= document.createElement('a');
			a.target= '_blank';
			a.href= 'http://maps.google.com/maps?q='+defaultLocation[1]+','+defaultLocation[0];
			a.click();
		});
	}

</script>
@endpush
