@props(['activePage' => 'home'])

@php
$dropdownItems = [
    ['route' => 'home.khoa-hoc',  'label' => 'Tiếng Anh cho Học Sinh',  'key' => 'hoc-sinh', 'icon' => 'child_care'],
    ['route' => 'home.nguoi-lon', 'label' => 'Tiếng Anh cho Người Lớn', 'key' => 'nguoi-lon','icon' => 'person'],
    ['route' => 'home.ielts',     'label' => 'Luyện thi IELTS',          'key' => 'ielts',    'icon' => 'verified'],
];
$dropdownActive = in_array($activePage, ['hoc-sinh', 'nguoi-lon', 'ielts']);

$activeClass   = 'font-semibold text-primary-container';
$inactiveClass = 'font-medium text-on-surface hover:text-primary-container';
@endphp

<header class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <nav class="flex items-center gap-2 h-20 lg:h-[84px]"
             x-data="{ mobileOpen: false, mobileSubmenuOpen: {{ $dropdownActive ? 'true' : 'false' }} }"
             x-effect="document.body.style.overflow = mobileOpen ? 'hidden' : ''"
             @keydown.escape.window="mobileOpen = false">

            {{-- Mobile hamburger --}}
            <button @click="mobileOpen = !mobileOpen"
                    :aria-expanded="mobileOpen.toString()"
                    aria-controls="mobile-menu"
                    class="lg:hidden p-2 rounded-lg text-on-surface hover:bg-surface-container-low transition-colors"
                    aria-label="Toggle navigation menu">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="w-6 h-6">
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <line x1="3" y1="12" x2="21" y2="12"/>
                    <line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
            </button>

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="shrink-0 mr-2 lg:mr-4">
                <img src="{{ asset('images/logo.png') }}"
                     alt="BEA English"
                     class="h-9 lg:h-14 w-auto object-contain">
            </a>

            {{-- Desktop nav --}}
            <ul class="hidden lg:flex items-center justify-center flex-1">

                {{-- Trang chủ --}}
                <li>
                    <a href="{{ route('home') }}"
                       class="relative group px-4 py-2 text-[16px] block transition-colors duration-200 {{ $activePage === 'home' ? $activeClass : $inactiveClass }}">
                        Trang chủ
                        <span class="pointer-events-none absolute inset-x-4 bottom-1 h-[2px] bg-primary-container rounded-full origin-center transition-transform duration-300 {{ $activePage === 'home' ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    </a>
                </li>

                {{-- Giới thiệu --}}
                <li>
                    <a href="{{ route('home.gioi-thieu') }}"
                       class="relative group px-4 py-2 text-[16px] block transition-colors duration-200 {{ $activePage === 'gioi-thieu' ? $activeClass : $inactiveClass }}">
                        Giới thiệu
                        <span class="pointer-events-none absolute inset-x-4 bottom-1 h-[2px] bg-primary-container rounded-full origin-center transition-transform duration-300 {{ $activePage === 'gioi-thieu' ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    </a>
                </li>

                {{-- Phương pháp --}}
                <li>
                    <a href="{{ route('home.phuong-phap') }}"
                       class="relative group px-4 py-2 text-[16px] block transition-colors duration-200 {{ $activePage === 'phuong-phap' ? $activeClass : $inactiveClass }}">
                        Phương pháp
                        <span class="pointer-events-none absolute inset-x-4 bottom-1 h-[2px] bg-primary-container rounded-full origin-center transition-transform duration-300 {{ $activePage === 'phuong-phap' ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    </a>
                </li>

                {{-- Dropdown: Học tại BeA --}}
                <li class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="relative group flex items-center gap-0.5 px-4 py-2 text-[16px] transition-colors duration-200 {{ $dropdownActive ? 'font-semibold text-primary-container' : 'font-medium text-on-surface hover:text-primary-container' }}"
                            :aria-expanded="open.toString()"
                            aria-haspopup="true">
                        <span>Học tại BeA</span>
                        <span class="material-symbols-outlined text-[16px] transition-transform duration-200"
                              :class="open ? 'rotate-180' : ''">expand_more</span>
                        <span class="pointer-events-none absolute inset-x-4 bottom-1 h-[2px] bg-primary-container rounded-full origin-center transition-transform duration-300 {{ $dropdownActive ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    </button>
                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute top-full left-0 w-64 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-10">
                        @foreach($dropdownItems as $item)
                        <a href="{{ route($item['route']) }}"
                           class="flex items-center gap-3 px-4 py-3 transition-colors group
                                  {{ $activePage === $item['key']
                                      ? 'text-primary-container font-semibold bg-primary-container/5'
                                      : 'text-on-surface hover:bg-primary-container/5 hover:text-primary-container' }}">
                            <span class="material-symbols-outlined ms-filled text-[18px] text-primary-container/60 group-hover:text-primary-container transition-colors shrink-0">{{ $item['icon'] }}</span>
                            <span class="text-[14px]">{{ $item['label'] }}</span>
                        </a>
                        @endforeach
                    </div>
                </li>

                {{-- Tin tức sự kiện --}}
                <li>
                    <a href="{{ route('home.tin-tuc') }}"
                       class="relative group px-4 py-2 text-[16px] block transition-colors duration-200 {{ $activePage === 'tin-tuc' ? $activeClass : $inactiveClass }}">
                        Tin tức sự kiện
                        <span class="pointer-events-none absolute inset-x-4 bottom-1 h-[2px] bg-primary-container rounded-full origin-center transition-transform duration-300 {{ $activePage === 'tin-tuc' ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    </a>
                </li>
            </ul>

            {{-- Desktop CTA --}}
            <div class="hidden lg:flex items-center gap-2 shrink-0 ml-auto">
                <a href="{{ route('login') }}"
                   class="px-6 py-2.5 rounded-full text-[15px] font-semibold text-on-surface border border-gray-300 hover:border-primary-container hover:text-primary-container transition-all duration-200">
                    Login
                </a>
                <a href="#contact"
                   class="px-6 py-[11px] bg-primary-container text-white rounded-full text-[15px] font-semibold hover:bg-primary transition-all duration-200 animate-float-cta">
                    Học thử miễn phí
                </a>
            </div>

            {{-- Mobile CTA --}}
            <a href="#contact"
               class="lg:hidden ml-auto shrink-0 px-3.5 py-2 bg-primary-container text-white rounded-full text-[13px] font-semibold hover:bg-primary transition-all duration-200 animate-float-cta">
                Học thử miễn phí
            </a>

            {{-- Mobile menu backdrop --}}
            <div x-show="mobileOpen"
                 x-transition:enter="transition-opacity ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="mobileOpen = false"
                 class="lg:hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-40"
                 style="display: none;"></div>

            {{-- Mobile menu drawer --}}
            <div id="mobile-menu"
                 x-show="mobileOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="-translate-x-full"
                 class="lg:hidden fixed top-0 left-0 h-full w-3/4 max-w-sm bg-white z-50 overflow-y-auto shadow-2xl"
                 style="display: none;">

                {{-- Drawer header: logo + close --}}
                <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                    <img src="{{ asset('images/logo.png') }}" alt="BEA English" class="h-9 w-auto object-contain">
                    <button @click="mobileOpen = false" aria-label="Đóng menu"
                            class="p-1.5 rounded-lg text-on-surface hover:bg-surface-container-low transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="w-6 h-6">
                            <line x1="6" y1="6" x2="18" y2="18"/>
                            <line x1="18" y1="6" x2="6" y2="18"/>
                        </svg>
                    </button>
                </div>

                <div class="px-5 py-3 flex flex-col gap-0.5">
                    @foreach([
                        ['route' => 'home',             'label' => 'Trang chủ',   'key' => 'home'],
                        ['route' => 'home.gioi-thieu',  'label' => 'Giới thiệu',  'key' => 'gioi-thieu'],
                        ['route' => 'home.phuong-phap', 'label' => 'Phương pháp', 'key' => 'phuong-phap'],
                    ] as $item)
                    <a href="{{ route($item['route']) }}" @click="mobileOpen = false"
                       class="px-3.5 py-2 rounded-lg text-sm transition-colors
                              {{ $activePage === $item['key']
                                  ? 'font-semibold text-primary-container bg-primary-container/5'
                                  : 'font-medium text-on-surface hover:bg-surface-container-low' }}">
                        {{ $item['label'] }}
                    </a>
                    @endforeach

                    {{-- Học tại BeA (toggle) --}}
                    <button @click="mobileSubmenuOpen = !mobileSubmenuOpen"
                            :aria-expanded="mobileSubmenuOpen.toString()"
                            class="flex items-center justify-between px-3.5 py-2 rounded-lg text-sm transition-colors
                                   {{ $dropdownActive ? 'font-semibold text-primary-container' : 'font-medium text-on-surface hover:bg-surface-container-low' }}">
                        Học tại BeA
                        <span class="material-symbols-outlined text-[18px] transition-transform duration-200"
                              :class="mobileSubmenuOpen ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <div x-show="mobileSubmenuOpen"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="flex flex-col gap-0.5 mb-1"
                         style="display: none;">
                        @foreach($dropdownItems as $item)
                        <a href="{{ route($item['route']) }}" @click="mobileOpen = false"
                           class="flex items-center gap-3 px-3.5 py-2 rounded-lg text-sm transition-colors
                                  {{ $activePage === $item['key']
                                      ? 'font-semibold text-primary-container bg-primary-container/5'
                                      : 'font-medium text-on-surface hover:bg-surface-container-low' }}">
                            <span class="material-symbols-outlined ms-filled text-[16px] text-primary-container/60 shrink-0">{{ $item['icon'] }}</span>
                            {{ $item['label'] }}
                        </a>
                        @endforeach
                    </div>

                    {{-- Tin tức sự kiện --}}
                    <a href="{{ route('home.tin-tuc') }}" @click="mobileOpen = false"
                       class="px-3.5 py-2 rounded-lg text-sm transition-colors
                              {{ $activePage === 'tin-tuc'
                                  ? 'font-semibold text-primary-container bg-primary-container/5'
                                  : 'font-medium text-on-surface hover:bg-surface-container-low' }}">
                        Tin tức sự kiện
                    </a>

                    <div class="border-t border-gray-100 mt-2 pt-3 flex flex-col gap-2">
                        <a href="{{ route('login') }}"
                           class="px-4 py-2 text-center rounded-full text-sm font-semibold text-on-surface border border-gray-300 hover:border-primary-container hover:text-primary-container transition-colors">
                            Login
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
