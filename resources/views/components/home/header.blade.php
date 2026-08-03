@props(['activePage' => 'home'])

@php
$dropdownItems = [
    ['route' => 'home.khoa-hoc',  'label' => 'Tiếng Anh cho Học Sinh',  'key' => 'hoc-sinh', 'icon' => 'child_care'],
    ['route' => 'home.nguoi-lon', 'label' => 'Tiếng Anh cho Người Lớn', 'key' => 'nguoi-lon','icon' => 'person'],
    ['route' => 'home.ielts',     'label' => 'Luyện thi IELTS',          'key' => 'ielts',    'icon' => 'verified'],
];
$dropdownActive = in_array($activePage, ['hoc-sinh', 'nguoi-lon', 'ielts']);

$activeClass   = 'font-semibold text-primary-container underline decoration-primary-container decoration-2 underline-offset-[6px]';
$inactiveClass = 'font-medium text-on-surface hover:text-primary-container';
@endphp

<header class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <nav class="flex items-center gap-2 h-20 lg:h-[84px]"
             x-data="{ mobileOpen: false }">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="shrink-0 mr-4">
                <img src="{{ asset('images/logo.png') }}"
                     alt="BEA English"
                     class="h-12 lg:h-14 w-auto object-contain">
            </a>

            {{-- Desktop nav --}}
            <ul class="hidden lg:flex items-center justify-center flex-1">

                {{-- Trang chủ --}}
                <li>
                    <a href="{{ route('home') }}"
                       class="px-4 py-2 text-[16px] block transition-all duration-200 hover:-translate-y-0.5 {{ $activePage === 'home' ? $activeClass : $inactiveClass }}">
                        Trang chủ
                    </a>
                </li>

                {{-- Giới thiệu --}}
                <li>
                    <a href="{{ route('home.gioi-thieu') }}"
                       class="px-4 py-2 text-[16px] block transition-all duration-200 hover:-translate-y-0.5 {{ $activePage === 'gioi-thieu' ? $activeClass : $inactiveClass }}">
                        Giới thiệu
                    </a>
                </li>

                {{-- Phương pháp --}}
                <li>
                    <a href="{{ route('home.phuong-phap') }}"
                       class="px-4 py-2 text-[16px] block transition-all duration-200 hover:-translate-y-0.5 {{ $activePage === 'phuong-phap' ? $activeClass : $inactiveClass }}">
                        Phương pháp
                    </a>
                </li>

                {{-- Dropdown: Học tại BeA --}}
                <li class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center gap-0.5 px-4 py-2 text-[16px] transition-all duration-200 hover:-translate-y-0.5 {{ $dropdownActive ? 'font-semibold text-primary-container' : 'font-medium text-on-surface hover:text-primary-container' }}"
                            :aria-expanded="open.toString()"
                            aria-haspopup="true">
                        <span class="{{ $dropdownActive ? 'underline decoration-primary-container decoration-2 underline-offset-[6px]' : '' }}">Học tại BeA</span>
                        <span class="material-symbols-outlined text-[16px] transition-transform duration-200"
                              :class="open ? 'rotate-180' : ''">expand_more</span>
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
                       class="px-4 py-2 text-[16px] block transition-all duration-200 hover:-translate-y-0.5 {{ $activePage === 'tin-tuc' ? $activeClass : $inactiveClass }}">
                        Tin tức sự kiện
                    </a>
                </li>
            </ul>

            {{-- Desktop CTA --}}
            <div class="hidden lg:flex items-center gap-2 shrink-0 ml-auto">
                <a href="{{ route('login') }}"
                   class="px-6 py-2.5 rounded-full text-[15px] font-semibold text-on-surface border border-gray-300 hover:border-primary-container hover:text-primary-container transition-all duration-200">
                    Đăng nhập
                </a>
                <a href="{{ route('home.gioi-thieu') }}#contact"
                   class="px-6 py-[11px] bg-primary-container text-white rounded-full text-[15px] font-semibold hover:bg-primary transition-all duration-200 animate-float-cta">
                    Học thử miễn phí
                </a>
            </div>

            {{-- Mobile hamburger --}}
            <button @click="mobileOpen = !mobileOpen"
                    :aria-expanded="mobileOpen.toString()"
                    aria-controls="mobile-menu"
                    class="lg:hidden ml-auto p-2 rounded-lg text-on-surface hover:bg-surface-container-low transition-colors"
                    aria-label="Toggle navigation menu">
                <span class="material-symbols-outlined" x-text="mobileOpen ? 'close' : 'menu'">menu</span>
            </button>

            {{-- Mobile menu --}}
            <div id="mobile-menu"
                 x-show="mobileOpen"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="lg:hidden absolute top-full left-0 right-0 bg-white border-b border-gray-100 shadow-lg">
                <div class="px-6 py-4 flex flex-col gap-1">
                    @foreach([
                        ['route' => 'home',             'label' => 'Trang chủ',       'key' => 'home'],
                        ['route' => 'home.gioi-thieu',  'label' => 'Giới thiệu',      'key' => 'gioi-thieu'],
                        ['route' => 'home.phuong-phap', 'label' => 'Phương pháp',     'key' => 'phuong-phap'],
                        ['route' => 'home.tin-tuc',     'label' => 'Tin tức sự kiện', 'key' => 'tin-tuc'],
                    ] as $item)
                    <a href="{{ route($item['route']) }}" @click="mobileOpen = false"
                       class="px-4 py-3 rounded-lg text-sm transition-colors
                              {{ $activePage === $item['key']
                                  ? 'font-semibold text-primary-container bg-primary-container/5'
                                  : 'font-medium text-on-surface hover:bg-surface-container-low' }}">
                        {{ $item['label'] }}
                    </a>
                    @endforeach
                    <div class="pl-2 border-l-2 border-primary-container/20 ml-2 flex flex-col gap-1">
                        @foreach($dropdownItems as $item)
                        <a href="{{ route($item['route']) }}" @click="mobileOpen = false"
                           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-colors
                                  {{ $activePage === $item['key']
                                      ? 'font-semibold text-primary-container bg-primary-container/5'
                                      : 'font-medium text-on-surface hover:bg-surface-container-low' }}">
                            <span class="material-symbols-outlined ms-filled text-[16px] text-primary-container/60 shrink-0">{{ $item['icon'] }}</span>
                            {{ $item['label'] }}
                        </a>
                        @endforeach
                    </div>
                    <div class="border-t border-gray-100 mt-2 pt-3 flex flex-col gap-2">
                        <a href="{{ route('login') }}"
                           class="px-4 py-2.5 text-center rounded-full text-sm font-semibold text-on-surface border border-gray-300 hover:border-primary-container hover:text-primary-container transition-colors">
                            Đăng nhập
                        </a>
                        <a href="{{ route('home.gioi-thieu') }}#contact" @click="mobileOpen = false"
                           class="px-4 py-2.5 text-center rounded-full text-sm font-semibold bg-primary-container text-white hover:bg-primary transition-colors">
                            Học thử miễn phí
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
