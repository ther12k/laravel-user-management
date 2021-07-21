{{-- <header class="sticky top-0 z-50"> --}}
<header id="header">  
  <nav x-data="{ open: false }" class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <!-- Mobile menu button-->
          <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" @click="open = !open" aria-expanded="false" x-bind:aria-expanded="open.toString()">
            <span class="sr-only">Open main menu</span>
            <svg x-description="Icon when menu is closed.

Heroicon name: outline/menu" x-state:on="Menu open" x-state:off="Menu closed" class="block h-6 w-6" :class="{ 'hidden': open, 'block': !(open) }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
</svg>
            <svg x-description="Icon when menu is open.

Heroicon name: outline/x" x-state:on="Menu open" x-state:off="Menu closed" class="hidden h-6 w-6" :class="{ 'block': open, 'hidden': !(open) }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
</svg>
          </button>
        </div>
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
          <div class="flex-shrink-0 flex items-center">
            <img class="w-16" src="{{asset('images/logo-512.png')}}" alt="">
            <span class="text-white ml-4">NPPBKC</span>  
          </div>
          <div class="hidden sm:block sm:ml-10 items-center">
            <div class="flex space-x-4">
              <a href="{{ Request::route()->getName()!=='home' ? route('home'):'#'}}" 
                class="{{ Request::route()->getName() =='home' ? 'bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium ' : 'text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700 hover:text-white' }}" >Dashboard</a>
              @can('addNppbkc')
               <a href="{{ Request::route()->getName()!=='nppbkc.add' ? route('nppbkc.add'):'#'}}" 
                class="{{ Request::route()->getName()=='nppbkc.add' ? 'bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium ' : 'text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700 hover:text-white' }}" >Permohonan</a>
              @endcan
              @can('manageUser')
               <a href="{{ Request::route()->getName()!=='users' ? route('users'):'#'}}" 
                class="{{ Request::route()->getName()=='users' ? 'bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium ' : 'text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700 hover:text-white' }}" >User</a>
              @endcan
              @can('viewActivityLog')
               <a href="{{ Request::route()->getName()!=='activity-log' ? route('activity-log'):'#'}}" 
                class="{{ Request::route()->getName()=='activity-log' ? 'bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium ' : 'text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700 hover:text-white' }}" >Log</a>
              @endcan
                {{-- <a href="#" class=" text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700 hover:text-white" x-state:on="Current" x-state:off="Default" aria-current="page" x-state-description="Current: &quot;bg-gray-900 text-white&quot;, Default: &quot;text-gray-300 hover:bg-gray-700 hover:text-white&quot;">Dashboard</a>
              
                <a href="#" class=" text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700 hover:text-white" x-state:on="Current" x-state:off="Default" aria-current="page" x-state-description="Current: &quot;bg-gray-900 text-white&quot;, Default: &quot;text-gray-300 hover:bg-gray-700 hover:text-white&quot;">Test</a> --}}
                {{-- <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" x-state-description="undefined: &quot;bg-gray-900 text-white&quot;, undefined: &quot;text-gray-300 hover:bg-gray-700 hover:text-white&quot;">Team</a>
              
                <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" x-state-description="undefined: &quot;bg-gray-900 text-white&quot;, undefined: &quot;text-gray-300 hover:bg-gray-700 hover:text-white&quot;">Projects</a>
              
                <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" x-state-description="undefined: &quot;bg-gray-900 text-white&quot;, undefined: &quot;text-gray-300 hover:bg-gray-700 hover:text-white&quot;">Calendar</a> --}}
              
            </div>
          </div>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
          {{-- <button class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
            <span class="sr-only">View notifications</span>
            <svg class="h-6 w-6" x-description="Heroicon name: outline/bell" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
</svg>
          </button> --}}

          <!-- Profile dropdown -->
          <div x-data="Components.menu({ open: false })" x-init="init()" @keydown.escape.stop="open = false; focusButton()" @click.away="onClickAway($event)" class="ml-3 relative z-50">
            <div>
              <button type="button" class="bg-gray-800 flex text-sm rounded-full focus:outline-none " id="user-menu-button" x-ref="button" @click="onButtonClick()" @keyup.space.prevent="onButtonEnter()" @keydown.enter.prevent="onButtonEnter()" aria-expanded="false" aria-haspopup="true" x-bind:aria-expanded="open.toString()" @keydown.arrow-up.prevent="onArrowUp()" @keydown.arrow-down.prevent="onArrowDown()">
                {{-- <span class="sr-only">Open user menu</span> --}}
                {{-- <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> --}}
                @php
                    $bgcolor = '#f0e9e9';
                    $color = '#8b5d5d';
                    if(\Auth::user()->role!='user'){
                        $color = '#ffffff';
                        $bgcolor = '#8BC34A';
                    }
                    $avatar = new LasseRafn\InitialAvatarGenerator\InitialAvatar();
                    echo $avatar->name(Auth::user()->name)->background($bgcolor)->color($color)
                        ->width(36)->rounded()->generateSvg()->toXMLString(); 
                @endphp 
                {{-- <img class="h-8 w-8 rounded-full" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt=""> --}}
              </button>
            </div>
            
              <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" x-ref="menu-items" x-description="Dropdown menu, show/hide based on menu state." x-bind:aria-activedescendant="activeDescendant" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" @keydown.arrow-up.prevent="onArrowUp()" @keydown.arrow-down.prevent="onArrowDown()" @keydown.tab="open = false" @keydown.enter.prevent="open = false; focusButton()" @keyup.space.prevent="open = false; focusButton()" style="display: none;">
                {{-- <a href="#" class="block px-4 py-2 text-sm text-gray-700" x-state:on="Active" x-state:off="Not Active" :class="{ 'bg-gray-100': activeIndex === 0 }" role="menuitem" tabindex="-1" id="user-menu-item-0" @mouseenter="activeIndex = 0" @mouseleave="activeIndex = -1" @click="open = false; focusButton()">Your Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700" :class="{ 'bg-gray-100': activeIndex === 1 }" role="menuitem" tabindex="-1" id="user-menu-item-1" @mouseenter="activeIndex = 1" @mouseleave="activeIndex = -1" @click="open = false; focusButton()">Settings</a> --}}
                <a class="block px-4 py-2 text-sm text-gray-700" :class="{ 'bg-gray-100': activeIndex === 2 }" role="menuitem" tabindex="-1" id="user-menu-item-2" @mouseenter="activeIndex = 2" @mouseleave="activeIndex = -1" @click="open = false; focusButton()" href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                  {{ csrf_field() }}
                </form>
              </div>
            
          </div>
        </div>
      </div>
    </div>

    <div x-description="Mobile menu, show/hide based on menu state." class="sm:hidden" id="mobile-menu" x-show="open" style="display: none;">
      <div class="px-2 pt-2 pb-3 space-y-1">
        
        <a href="#" class="{{ Request::path() ==  '/'  ? 'bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium ' : 'text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700 hover:text-white' }}" >Dashboard</a>
        <a href="#" class="{{ Request::path() ==  '/nppbkc-wizard' ? 'bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium ' : 'text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700 hover:text-white' }}" >Permohonan</a>

      </div>
    </div>
  </nav>
</header>
<script>
  window.Components = {}, window.Components.listbox = function(t) {
    return {
        init() {
            this.optionCount = this.$refs.listbox.children.length, this.$watch("activeIndex", (t => {
                this.open && (null !== this.activeIndex ? this.activeDescendant = this.$refs.listbox.children[this.activeIndex].id : this.activeDescendant = "")
            }))
        },
        activeDescendant: null,
        optionCount: null,
        open: !1,
        activeIndex: null,
        selectedIndex: 0,
        get active() {
            return this.items[this.activeIndex]
        },
        get [t.modelName || "selected"]() {
            return this.items[this.selectedIndex]
        },
        choose(t) {
            this.selectedIndex = t, this.open = !1
        },
        onButtonClick() {
            this.open || (this.activeIndex = this.selectedIndex, this.open = !0, this.$nextTick((() => {
                this.$refs.listbox.focus(), this.$refs.listbox.children[this.activeIndex].scrollIntoView({
                    block: "nearest"
                })
            })))
        },
        onOptionSelect() {
            null !== this.activeIndex && (this.selectedIndex = this.activeIndex), this.open = !1, this.$refs.button.focus()
        },
        onEscape() {
            this.open = !1, this.$refs.button.focus()
        },
        onArrowUp() {
            this.activeIndex = this.activeIndex - 1 < 0 ? this.optionCount - 1 : this.activeIndex - 1, this.$refs.listbox.children[this.activeIndex].scrollIntoView({
                block: "nearest"
            })
        },
        onArrowDown() {
            this.activeIndex = this.activeIndex + 1 > this.optionCount - 1 ? 0 : this.activeIndex + 1, this.$refs.listbox.children[this.activeIndex].scrollIntoView({
                block: "nearest"
            })
        },
        ...t
    }
}, window.Components.menu = function(t = {
    open: !1
}) {
    return {
        init() {
            this.items = Array.from(this.$el.querySelectorAll('[role="menuitem"]')), this.$watch("open", (() => {
                this.open && (this.activeIndex = -1)
            }))
        },
        activeDescendant: null,
        activeIndex: null,
        items: null,
        open: t.open,
        focusButton() {
            this.$refs.button.focus()
        },
        onButtonClick() {
            this.open = !this.open, this.open && this.$nextTick((() => {
                this.$refs["menu-items"].focus()
            }))
        },
        onButtonEnter() {
            this.open = !this.open, this.open && (this.activeIndex = 0, this.activeDescendant = this.items[this.activeIndex].id, this.$nextTick((() => {
                this.$refs["menu-items"].focus()
            })))
        },
        onArrowUp() {
            if (!this.open) return this.open = !0, this.activeIndex = this.items.length - 1, void(this.activeDescendant = this.items[this.activeIndex].id);
            0 !== this.activeIndex && (this.activeIndex = -1 === this.activeIndex ? this.items.length - 1 : this.activeIndex - 1, this.activeDescendant = this.items[this.activeIndex].id)
        },
        onArrowDown() {
            if (!this.open) return this.open = !0, this.activeIndex = 0, void(this.activeDescendant = this.items[this.activeIndex].id);
            this.activeIndex !== this.items.length - 1 && (this.activeIndex = this.activeIndex + 1, this.activeDescendant = this.items[this.activeIndex].id)
        },
        onClickAway(t) {
            if (this.open) {
                const e = ["[contentEditable=true]", "[tabindex]", "a[href]", "area[href]", "button:not([disabled])", "iframe", "input:not([disabled])", "select:not([disabled])", "textarea:not([disabled])"].map((t => `${t}:not([tabindex='-1'])`)).join(",");
                this.open = !1, t.target.closest(e) || this.focusButton()
            }
        }
    }
}, window.Components.popoverGroup = function() {
    return {
        __type: "popoverGroup",
        init() {
            let t = e => {
                document.body.contains(this.$el) ? e.target instanceof Element && !this.$el.contains(e.target) && window.dispatchEvent(new CustomEvent("close-popover-group", {
                    detail: this.$el
                })) : window.removeEventListener("focus", t, !0)
            };
            window.addEventListener("focus", t, !0)
        }
    }
}, window.Components.popover = function({
    open: t = !1,
    focus: e = !1
} = {}) {
    const i = ["[contentEditable=true]", "[tabindex]", "a[href]", "area[href]", "button:not([disabled])", "iframe", "input:not([disabled])", "select:not([disabled])", "textarea:not([disabled])"].map((t => `${t}:not([tabindex='-1'])`)).join(",");
    return {
        __type: "popover",
        open: t,
        init() {
            e && this.$watch("open", (t => {
                t && this.$nextTick((() => {
                    ! function(t) {
                        const e = Array.from(t.querySelectorAll(i));
                        ! function t(i) {
                            void 0 !== i && (i.focus({
                                preventScroll: !0
                            }), document.activeElement !== i && t(e[e.indexOf(i) + 1]))
                        }(e[0])
                    }(this.$refs.panel)
                }))
            }));
            let t = i => {
                if (!document.body.contains(this.$el)) return void window.removeEventListener("focus", t, !0);
                let n = e ? this.$refs.panel : this.$el;
                if (this.open && i.target instanceof Element && !n.contains(i.target)) {
                    let t = this.$el;
                    for (; t.parentNode;)
                        if (t = t.parentNode, t.__x instanceof this.constructor) {
                            if ("popoverGroup" === t.__x.$data.__type) return;
                            if ("popover" === t.__x.$data.__type) break
                        } this.open = !1
                }
            };
            window.addEventListener("focus", t, !0)
        },
        onEscape() {
            this.open = !1, this.restoreEl && this.restoreEl.focus()
        },
        onClosePopoverGroup(t) {
            t.detail.contains(this.$el) && (this.open = !1)
        },
        toggle(t) {
            this.open = !this.open, this.open ? this.restoreEl = t.currentTarget : this.restoreEl && this.restoreEl.focus()
        }
    }
}, window.Components.radioGroup = function({
    initialCheckedIndex: t = 0
} = {}) {
    return {
        value: void 0,
        init() {
            this.value = Array.from(this.$el.querySelectorAll("input"))[t]?.value
        }
    }
};
</script>