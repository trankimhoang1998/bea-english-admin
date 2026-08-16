{{-- resources/views/home/partials/ielts.blade.php --}}
<section id="ielts" class="py-8 lg:py-24 bg-surface-alt">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

        {{-- Header --}}
        <div class="text-center mb-6 lg:mb-12 reveal">
            <div class="inline-flex items-center gap-3 mb-5">
                <div class="h-[2px] w-6 lg:w-10 bg-primary-container rounded-full"></div>
                <div class="bg-primary-container rounded-full px-4 py-2 lg:px-8 lg:py-3">
                    <h2 class="text-white font-black text-base lg:text-2xl uppercase tracking-wide">Luyện Thi IELTS</h2>
                </div>
                <div class="h-[2px] w-6 lg:w-10 bg-primary-container rounded-full"></div>
            </div>
            <p class="text-gray-800 font-semibold text-lg">Lộ trình từ mất gốc đến 6.5+ <span class="hidden lg:inline"><span class="text-orange-500">&mdash;</span> Cam kết chất lượng</span></p>
        </div>

        @php
        $sharedFeatures = [
            ['my_location',  'Luyện đề thi thật 100%'],
            ['auto_stories', 'Tặng bộ tài liệu từ vựng IELTS trị giá 990.000 VNĐ'],
            ['description',  'Cam kết chất lượng đầu ra bằng văn bản'],
        ];
        $courses = [
            [
                'type'     => 'Lộ Trình IELTS',
                'icon'     => 'verified',
                'score'    => '0 – 3.5+',
                'scorePct' => 39,
                'level'    => 'Nền Tảng',
                'duration' => '3 tháng',
                'target'   => 'Người mới bắt đầu / mất gốc',
                'gradient' => 'from-orange-300 to-orange-500',
                'features' => array_merge([['school', 'Cam kết đầu ra 0 – 3.5 IELTS']], $sharedFeatures),
            ],
            [
                'type'     => 'Lộ Trình IELTS',
                'icon'     => 'verified',
                'score'    => '3.5 – 4.5+',
                'scorePct' => 50,
                'level'    => 'Cơ Bản',
                'duration' => '4 tháng',
                'target'   => 'Đã có nền tảng cơ bản',
                'gradient' => 'from-orange-400 to-orange-600',
                'features' => array_merge([['school', 'Cam kết đầu ra 3.5 – 4.5 IELTS']], $sharedFeatures),
            ],
            [
                'type'     => 'Lộ Trình IELTS',
                'icon'     => 'verified',
                'score'    => '4.5 – 5.5+',
                'scorePct' => 63,
                'level'    => 'Trung Cấp',
                'duration' => '5 tháng',
                'target'   => 'Hướng đến mục tiêu quốc tế',
                'gradient' => 'from-orange-500 to-red-500',
                'features' => array_merge([['school', 'Cam kết đầu ra 4.5 – 5.5 IELTS']], $sharedFeatures),
            ],
            [
                'type'     => 'Lộ Trình IELTS',
                'icon'     => 'verified',
                'score'    => '5.5 – 6.5+',
                'scorePct' => 79,
                'level'    => 'Nâng Cao',
                'duration' => '6 tháng',
                'target'   => 'Chinh phục mục tiêu điểm cao',
                'gradient' => 'from-amber-500 to-orange-600',
                'features' => array_merge([['school', 'Cam kết đầu ra 5.5 – 6.5 IELTS']], $sharedFeatures),
            ],
            [
                'type'     => 'Luyện Thi Cấp Tốc',
                'icon'     => 'bolt',
                'score'    => 'CẤP TỐC',
                'scorePct' => 80,
                'level'    => 'Intensive',
                'duration' => '4-8 tuần',
                'target'   => 'Thi gấp — Cần điểm nhanh',
                'gradient' => 'from-red-500 to-orange-500',
                'features' => array_merge([['bolt', 'Luyện thi cấp tốc 4-8 tuần']], $sharedFeatures),
            ],
        ];
        @endphp

        {{-- Cards slider --}}
        <div class="relative"
             x-data="{
                 pos: 0, anim: true, timer: null, step: 0, total: 5,
                 init() {
                     this.$nextTick(() => {
                         const card = this.$refs.track.querySelector('[data-card]');
                         if (card) this.step = card.offsetWidth + 20;
                         this.startAuto();
                     });
                 },
                 startAuto() {
                     clearInterval(this.timer);
                     this.timer = setInterval(() => this.advance(), 3200);
                 },
                 stopAuto() { clearInterval(this.timer); },
                 advance() {
                     this.anim = true;
                     this.pos += this.step;
                     if (this.pos >= this.total * this.step) {
                         setTimeout(() => {
                             this.anim = false; this.pos = 0;
                             requestAnimationFrame(() => requestAnimationFrame(() => { this.anim = true; }));
                         }, 520);
                     }
                 },
                 back() { if (this.pos >= this.step) { this.anim = true; this.pos -= this.step; } },
                 fwd()  { this.advance(); this.startAuto(); },
                 touchX: 0,
                 onTouchStart(e) { this.touchX = e.touches[0].clientX; this.stopAuto(); },
                 onTouchEnd(e) {
                     const diff = this.touchX - e.changedTouches[0].clientX;
                     if (Math.abs(diff) > 50) { diff > 0 ? this.fwd() : this.back(); }
                     else { this.startAuto(); }
                 }
             }"
             @mouseenter="stopAuto()"
             @mouseleave="startAuto()"
             @touchstart.passive="onTouchStart($event)"
             @touchend.passive="onTouchEnd($event)">

            {{-- Prev --}}
            <button @click="back()" aria-label="Trước"
                    class="absolute -left-5 top-1/2 -translate-y-1/2 z-10 hidden lg:flex w-10 h-10 rounded-full
                           items-center justify-center bg-white hover:bg-gray-50 border border-gray-200
                           text-gray-600 shadow-md transition-all">
                <span class="material-symbols-outlined text-[20px]">chevron_left</span>
            </button>

            {{-- Next --}}
            <button @click="fwd()" aria-label="Tiếp theo"
                    class="absolute -right-5 top-1/2 -translate-y-1/2 z-10 hidden lg:flex w-10 h-10 rounded-full
                           items-center justify-center bg-white hover:bg-gray-50 border border-gray-200
                           text-gray-600 shadow-md transition-all">
                <span class="material-symbols-outlined text-[20px]">chevron_right</span>
            </button>

            {{-- Track wrapper: overflow-hidden tách khỏi arrow --}}
            <div class="overflow-hidden pt-3 pb-1">
            {{-- Track: 5 real + 5 clones for seamless loop --}}
            <div x-ref="track"
                 class="flex gap-5"
                 :style="`transform: translateX(-${pos}px); transition: transform ${anim ? '0.55s cubic-bezier(0.25,0.46,0.45,0.94)' : '0s'}`">

                @foreach(array_merge($courses, $courses) as $i => $c)
                @php
                    $r    = 38;
                    $circ = round(2 * M_PI * $r, 2);
                    $dash = round($circ * (1 - $c['scorePct'] / 100), 2);
                @endphp
                <div {{ $i < 5 ? 'data-card' : 'aria-hidden="true"' }}
                     class="shrink-0
                            w-[calc(85vw)] sm:w-[calc(50%-10px)] lg:w-[calc(25%-15px)]
                            flex flex-col rounded-3xl overflow-hidden
                            bg-white border border-gray-100
                            shadow-lg shadow-gray-200/80
                            hover:-translate-y-2 transition-transform duration-300">

                    {{-- Gradient header --}}
                    <div class="bg-gradient-to-br {{ $c['gradient'] }} p-5 relative overflow-hidden">
                        <div class="absolute -top-8 -right-8 w-28 h-28 rounded-full bg-white/10"></div>
                        <div class="absolute top-3 right-3 w-14 h-14 rounded-full bg-white/10"></div>

                        {{-- Type badge --}}
                        <div class="inline-flex items-center gap-1.5 bg-black/25 rounded-full px-3 py-1 mb-4 relative">
                            <span class="material-symbols-outlined ms-filled text-white text-[13px]">{{ $c['icon'] }}</span>
                            <span class="text-white text-[10px] font-bold uppercase tracking-widest">{{ $c['type'] }}</span>
                        </div>

                        {{-- Score + ring --}}
                        <div class="flex items-center justify-between relative">
                            <div>
                                <p class="text-white/70 text-[10px] font-semibold uppercase tracking-widest mb-1">Mục tiêu</p>
                                <h3 class="text-white font-black text-[1.55rem] leading-tight">{{ $c['score'] }}</h3>
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="bg-black/20 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $c['level'] }}</span>
                                    <span class="text-white/60 text-[10px]">⏱ {{ $c['duration'] }}</span>
                                </div>
                            </div>

                            {{-- Score progress ring --}}
                            <div class="relative w-[72px] h-[72px] shrink-0">
                                <svg class="w-full h-full -rotate-90" viewBox="0 0 88 88">
                                    <circle cx="44" cy="44" r="{{ $r }}" fill="none"
                                            stroke="rgba(255,255,255,0.18)" stroke-width="5"/>
                                    <circle cx="44" cy="44" r="{{ $r }}" fill="none"
                                            stroke="rgba(255,255,255,0.9)" stroke-width="5"
                                            stroke-dasharray="{{ $circ }}"
                                            stroke-dashoffset="{{ $dash }}"
                                            stroke-linecap="round"/>
                                </svg>
                                <div class="absolute inset-0 flex flex-col items-center justify-center">
                                    <span class="text-white font-black text-base leading-none">{{ $c['scorePct'] }}%</span>
                                    <span class="text-white/60 text-[8px] font-bold tracking-wide mt-0.5">IELTS</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Card body --}}
                    <div class="p-5 flex-1 flex flex-col">

                        {{-- Target learner --}}
                        <div class="flex items-center gap-2 mb-4 pb-4 border-b border-gray-100">
                            <span class="material-symbols-outlined ms-filled text-primary-container text-[15px] shrink-0">person</span>
                            <span class="text-[12px] text-gray-500 font-medium">{{ $c['target'] }}</span>
                        </div>

                        {{-- Features --}}
                        <div class="space-y-2.5 flex-1">
                            @foreach($c['features'] as [$icon, $text])
                            <div class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined ms-filled text-primary-container text-[16px] shrink-0 mt-0.5">{{ $icon }}</span>
                                <span class="text-[12.5px] text-gray-600 leading-relaxed">{{ $text }}</span>
                            </div>
                            @endforeach
                        </div>

                        {{-- CTA --}}
                        <a href="{{ route('home.ielts') }}"
                           class="mt-5 flex items-center justify-center gap-2 py-3 rounded-2xl
                                  bg-primary-container text-white font-bold text-sm uppercase tracking-wide
                                  hover:bg-orange-600 transition-colors">
                            Xem Chi Tiết
                            <span class="material-symbols-outlined text-[17px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            </div>{{-- /overflow-hidden --}}
        </div>


    </div>
</section>
