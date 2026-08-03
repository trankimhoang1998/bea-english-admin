{{-- resources/views/home/partials/hero.blade.php --}}
<section class="relative overflow-hidden hero-slider-bg hero-full-height">

    {{-- Decorative circles --}}
    <div class="absolute top-10 left-12 w-28 h-28 rounded-full bg-white/10 pointer-events-none" style="animation: circleFloat1 5s ease-in-out infinite;"></div>
    <div class="absolute bottom-20 left-6 w-44 h-44 rounded-full bg-white/10 pointer-events-none" style="animation: circleFloat2 7s ease-in-out infinite;"></div>
    <div class="absolute top-8 left-1/3 w-14 h-14 rounded-full bg-white/15 pointer-events-none" style="animation: circleFloat3 4s ease-in-out infinite;"></div>
    <div class="absolute top-16 right-72 w-10 h-10 rounded-full bg-white/15 pointer-events-none" style="animation: circleFloat1 4.5s ease-in-out 0.5s infinite;"></div>
    <div class="absolute bottom-10 right-24 w-32 h-32 rounded-full bg-white/10 pointer-events-none" style="animation: circleFloat2 6s ease-in-out 1s infinite;"></div>
    <div class="absolute top-1/3 right-12 w-20 h-20 rounded-full bg-white/10 pointer-events-none" style="animation: circleFloat3 5.5s ease-in-out 0.3s infinite;"></div>
    <div class="absolute bottom-1/3 right-1/3 w-8 h-8 rounded-full bg-white/15 pointer-events-none" style="animation: circleFloat1 3.5s ease-in-out 0.8s infinite;"></div>

    <div x-data="heroSlider()" class="relative h-full flex flex-col">

        {{-- ===== SLIDES ===== --}}
        <div class="flex-1 relative min-h-0">

            {{-- SLIDE 1 --}}
            <div x-show="current === 0"
                 x-transition:enter="hero-fade-enter"
                 x-transition:enter-start="hero-fade-start"
                 x-transition:enter-end="hero-fade-end"
                 x-transition:leave="hero-fade-leave"
                 x-transition:leave-start="hero-fade-end"
                 x-transition:leave-end="hero-fade-start"
                 class="absolute inset-0 flex items-center">
                <div class="max-w-7xl mx-auto px-5 lg:px-16 w-full grid lg:grid-cols-[55%_45%] gap-8 items-center">
                    <div>
                        <p class="slide-badge text-white/80 text-xs lg:text-sm font-medium uppercase tracking-[0.15em] mb-2 lg:mb-5">
                            🎓 Hơn 10 năm kinh nghiệm
                        </p>
                        <h1 class="slide-title text-white font-black text-[1.75rem] lg:text-[3.2rem] uppercase leading-[1.2] mb-3 lg:mb-6">
                            BEA ENGLISH.<br>
                            HƯỚNG TỚI TƯƠNG LAI!
                        </h1>
                        <p class="slide-desc text-white/85 text-sm lg:text-[17px] leading-relaxed mb-5 lg:mb-9 max-w-[520px]">
                            Tiền thân là cộng đồng giáo viên tiếng Anh người Philippines, BeA English đã đồng hành và giúp hàng trăm nghìn học sinh, sinh viên Việt Nam học tập hiệu quả, tự tin chinh phục thành công các chứng chỉ quốc tế như IELTS, TOEIC, Cambridge...
                        </p>
                        <a href="{{ route('home.gioi-thieu') }}"
                           class="slide-btn inline-flex items-center gap-2 px-7 py-2.5 lg:py-3.5 rounded-full border-2 border-white/50 bg-white/10 text-white font-semibold text-sm lg:text-[15px] hover:bg-white hover:text-primary-container transition-all duration-300">
                            Xem thêm <span class="text-lg leading-none">→</span>
                        </a>
                    </div>
                    <div class="flex justify-center items-center slide-image">
                        <div class="relative w-48 h-48 lg:w-80 lg:h-80">
                            <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/25"
                                 style="animation: rotateSlow 14s linear infinite;">
                                <div class="absolute -top-2.5 left-1/2 -translate-x-1/2 w-5 h-5 rounded-full bg-white shadow-lg shadow-white/50"></div>
                                <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-3 h-3 rounded-full bg-white/50"></div>
                            </div>
                            <div class="absolute inset-8 lg:inset-10 rounded-full border border-white/20"
                                 style="animation: rotateCCW 9s linear infinite;">
                                <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 rounded-full bg-white/80 shadow shadow-white/40"></div>
                            </div>
                            <div class="hidden lg:block absolute inset-20 rounded-full border border-white/15"
                                 style="animation: rotateSlow 6s linear infinite;">
                                <div class="absolute -top-1.5 left-1/2 -translate-x-1/2 w-3 h-3 rounded-full bg-white/60"></div>
                            </div>
                            <div class="absolute inset-0 rounded-full pointer-events-none"
                                 class="hero-glow" style="animation: centerGlow 3s ease-in-out infinite;"></div>
                            <div class="absolute w-2 h-2 rounded-full bg-white/35 pointer-events-none" style="top:22px;left:44px;animation:chipFloat 5s ease-in-out infinite;"></div>
                            <div class="absolute w-1.5 h-1.5 rounded-full bg-white/25 pointer-events-none" style="bottom:38px;right:34px;animation:chipFloat 4s ease-in-out 1s infinite;"></div>
                            <div class="absolute w-2.5 h-2.5 rounded-full bg-white/30 pointer-events-none" style="top:56px;right:18px;animation:chipFloat 6s ease-in-out 0.5s infinite;"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-28 h-28 lg:w-44 lg:h-44 rounded-full flex items-center justify-center"
                                     class="hero-orb">
                                    <span class="material-symbols-outlined ms-filled text-white text-[72px] lg:text-[110px]">school</span>
                                </div>
                            </div>
                            <div class="absolute -top-5 -right-10 bg-white rounded-2xl px-3 py-2 lg:px-4 lg:py-2.5 shadow-xl text-xs lg:text-sm font-bold text-primary-container whitespace-nowrap"
                                 style="animation: chipFloat 3s ease-in-out infinite;">
                                ✦ 1,000+ học viên
                            </div>
                            <div class="absolute -bottom-5 -left-10 lg:-left-12 bg-white/20 backdrop-blur-sm rounded-2xl px-3 py-2 lg:px-4 lg:py-2.5 border border-white/30 text-xs lg:text-sm font-semibold text-white whitespace-nowrap"
                                 style="animation: chipFloat 3.6s ease-in-out 0.6s infinite;">
                                IELTS · TOEIC · Cambridge
                            </div>
                            <div class="hidden lg:block absolute top-1/2 -right-16 -translate-y-1/2 bg-white/15 backdrop-blur-sm rounded-xl px-3 py-2 border border-white/25 text-xs font-semibold text-white whitespace-nowrap"
                                 style="animation: chipFloat 4.2s ease-in-out 1.2s infinite;">
                                🏆 10+ năm kinh nghiệm
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SLIDE 2 --}}
            <div x-show="current === 1"
                 x-transition:enter="hero-fade-enter"
                 x-transition:enter-start="hero-fade-start"
                 x-transition:enter-end="hero-fade-end"
                 x-transition:leave="hero-fade-leave"
                 x-transition:leave-start="hero-fade-end"
                 x-transition:leave-end="hero-fade-start"
                 class="absolute inset-0 flex items-center">
                <div class="max-w-7xl mx-auto px-5 lg:px-16 w-full grid lg:grid-cols-[55%_45%] gap-8 items-center">
                    <div>
                        <p class="slide-badge text-white/80 text-xs lg:text-sm font-medium uppercase tracking-[0.15em] mb-2 lg:mb-5">
                            ✨ Phương pháp 6P-BeA
                        </p>
                        <h2 class="slide-title text-white font-black text-[1.75rem] lg:text-[3.2rem] uppercase leading-[1.2] mb-3 lg:mb-6">
                            PHƯƠNG PHÁP<br>
                            GIÁO DỤC SÁNG TẠO
                        </h2>
                        <p class="slide-desc text-white/85 text-sm lg:text-[17px] leading-relaxed mb-5 lg:mb-9 max-w-[520px]">
                            Từ nhiều năm kinh nghiệm giảng dạy trực tiếp, BeA English đã nghiên cứu và phát triển thành công phương pháp đào tạo tiếng Anh 6P-BeA (Personalized – Practice – Partnership – Purposeful – Progress – Practical).
                        </p>
                        <a href="{{ route('home.phuong-phap') }}"
                           class="slide-btn inline-flex items-center gap-2 px-7 py-2.5 lg:py-3.5 rounded-full border-2 border-white/50 bg-white/10 text-white font-semibold text-sm lg:text-[15px] hover:bg-white hover:text-primary-container transition-all duration-300">
                            Xem thêm <span class="text-lg leading-none">→</span>
                        </a>
                    </div>
                    <div class="flex justify-center items-center slide-image">
                        <div class="relative w-48 h-48 lg:w-80 lg:h-80">
                            <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/25"
                                 style="animation: rotateCCW 16s linear infinite;">
                                <div class="absolute -top-2.5 left-1/2 -translate-x-1/2 w-5 h-5 rounded-full bg-white shadow-lg shadow-white/50"></div>
                            </div>
                            <div class="absolute inset-0 rounded-full pointer-events-none"
                                 class="hero-glow" style="animation: centerGlow 3.5s ease-in-out infinite;"></div>
                            {{-- 6P icons orbiting: desktop only (pixel coords fixed 320px) --}}
                            <div class="hidden lg:block orbit-scale" style="animation: rotateSlow 24s linear infinite;">
                                @php
                                    $pIcons = [
                                        ['person',            60,  160],
                                        ['fitness_center',   110,  247],
                                        ['handshake',        210,  247],
                                        ['task_alt',         260,  160],
                                        ['trending_up',      210,   73],
                                        ['workspace_premium',110,   73],
                                    ];
                                @endphp
                                @foreach($pIcons as [$icon, $top, $left])
                                <div style="position:absolute;top:{{ $top }}px;left:{{ $left }}px;transform:translate(-50%,-50%);">
                                    <div style="animation: rotateCCW 24s linear infinite;"
                                         class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-sm border border-white/40 flex items-center justify-center shadow shadow-white/10">
                                        <span class="material-symbols-outlined ms-filled text-white text-[20px]">{{ $icon }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-28 h-28 lg:w-44 lg:h-44 rounded-full flex items-center justify-center"
                                     class="hero-orb">
                                    <span class="material-symbols-outlined ms-filled text-white text-[72px] lg:text-[110px]">lightbulb</span>
                                </div>
                            </div>
                            <div class="absolute -top-5 -right-10 bg-white rounded-2xl px-3 py-2 lg:px-4 lg:py-2.5 shadow-xl text-xs lg:text-sm font-bold text-primary-container whitespace-nowrap"
                                 style="animation: chipFloat 3.2s ease-in-out infinite;">
                                ✦ 6P-BeA Method
                            </div>
                            <div class="absolute -bottom-5 -left-10 lg:-left-12 bg-white/20 backdrop-blur-sm rounded-2xl px-3 py-2 lg:px-4 lg:py-2.5 border border-white/30 text-xs lg:text-sm font-semibold text-white whitespace-nowrap"
                                 style="animation: chipFloat 3.8s ease-in-out 0.7s infinite;">
                                Cá nhân hóa lộ trình học
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SLIDE 3 --}}
            <div x-show="current === 2"
                 x-transition:enter="hero-fade-enter"
                 x-transition:enter-start="hero-fade-start"
                 x-transition:enter-end="hero-fade-end"
                 x-transition:leave="hero-fade-leave"
                 x-transition:leave-start="hero-fade-end"
                 x-transition:leave-end="hero-fade-start"
                 class="absolute inset-0 flex items-center">
                <div class="max-w-7xl mx-auto px-5 lg:px-16 w-full grid lg:grid-cols-[55%_45%] gap-8 items-center">
                    <div>
                        <p class="slide-badge text-white/80 text-xs lg:text-sm font-medium uppercase tracking-[0.15em] mb-2 lg:mb-5">
                            🏆 Cam kết đầu ra
                        </p>
                        <h2 class="slide-title text-white font-black text-[1.75rem] lg:text-[3.2rem] uppercase leading-[1.2] mb-3 lg:mb-6">
                            CHINH PHỤC IELTS<br>
                            CÙNG BEA ENGLISH
                        </h2>
                        <p class="slide-desc text-white/85 text-sm lg:text-[17px] leading-relaxed mb-5 lg:mb-9 max-w-[520px]">
                            Với đội ngũ giáo viên chuyên nghiệp và lộ trình học tập khoa học, BeA English cam kết giúp bạn đạt mục tiêu IELTS trong thời gian ngắn nhất. Hàng trăm học viên đã đạt 6.0 – 7.5+ sau khoá học.
                        </p>
                        <a href="{{ route('home.ielts') }}"
                           class="slide-btn inline-flex items-center gap-2 px-7 py-2.5 lg:py-3.5 rounded-full border-2 border-white/50 bg-white/10 text-white font-semibold text-sm lg:text-[15px] hover:bg-white hover:text-primary-container transition-all duration-300">
                            Xem thêm <span class="text-lg leading-none">→</span>
                        </a>
                    </div>
                    <div class="flex justify-center items-center slide-image">
                        <div class="relative w-48 h-48 lg:w-80 lg:h-80">
                            <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/25"
                                 style="animation: rotateSlow 16s linear infinite;">
                                <div class="absolute -top-2.5 left-1/2 -translate-x-1/2 w-5 h-5 rounded-full bg-white shadow-lg shadow-white/50"></div>
                                <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-3.5 h-3.5 rounded-full bg-white/60"></div>
                            </div>
                            <div class="absolute inset-8 lg:inset-10 rounded-full border border-white/20"
                                 style="animation: rotateCCW 10s linear infinite;">
                                <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 rounded-full bg-white/80 shadow shadow-white/40"></div>
                            </div>
                            <div class="absolute inset-0 rounded-full pointer-events-none"
                                 class="hero-glow" style="animation: centerGlow 2.8s ease-in-out infinite;"></div>
                            <div class="hidden lg:flex absolute top-1/2 -translate-y-1/2 flex-col gap-2" style="right: calc(100% + 14px);">
                                <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-xl px-3 py-2 border border-white/15">
                                    <div class="w-1.5 h-1.5 rounded-full bg-white/40 shrink-0"></div>
                                    <span class="text-white/55 text-xs font-medium whitespace-nowrap">5.0 – 5.5</span>
                                </div>
                                <div class="flex items-center gap-2 bg-white/18 backdrop-blur-sm rounded-xl px-3 py-2 border border-white/25">
                                    <div class="w-2 h-2 rounded-full bg-white/70 shrink-0"></div>
                                    <span class="text-white/80 text-xs font-semibold whitespace-nowrap">6.0 – 6.5</span>
                                </div>
                                <div class="flex items-center gap-2 bg-white/25 backdrop-blur-sm rounded-xl px-3 py-2.5 border border-white/40 shadow-lg"
                                     style="animation: chipFloat 3s ease-in-out infinite;">
                                    <div class="w-2.5 h-2.5 rounded-full bg-white shadow shadow-white/50 shrink-0"></div>
                                    <span class="text-white text-sm font-black whitespace-nowrap">7.0 – 7.5+</span>
                                </div>
                            </div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-28 h-28 lg:w-44 lg:h-44 rounded-full flex items-center justify-center"
                                     class="hero-orb">
                                    <span class="material-symbols-outlined ms-filled text-white text-[72px] lg:text-[110px]">workspace_premium</span>
                                </div>
                            </div>
                            <div class="absolute -top-5 -right-10 bg-white rounded-2xl px-3 py-2 lg:px-4 lg:py-2.5 shadow-xl text-xs lg:text-sm font-bold text-primary-container whitespace-nowrap"
                                 style="animation: chipFloat 3.4s ease-in-out infinite;">
                                ✦ IELTS 6.0 – 7.5+
                            </div>
                            <div class="absolute -bottom-5 -right-12 lg:-right-14 bg-white/20 backdrop-blur-sm rounded-2xl px-3 py-2 lg:px-4 lg:py-2.5 border border-white/30 text-xs lg:text-sm font-semibold text-white whitespace-nowrap"
                                 style="animation: chipFloat 4s ease-in-out 0.5s infinite;">
                                Cam kết hoàn tiền 100%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== BOTTOM CONTROLS ===== --}}
        <div class="pb-5 lg:pb-8 flex flex-col items-center gap-3 shrink-0">
            {{-- Dot navigation --}}
            <div class="flex items-center gap-3">
                <template x-for="n in 3" :key="n">
                    <button @click="goTo(n - 1)"
                            class="rounded-full transition-all duration-300 ease-out"
                            :class="current === n - 1
                                ? 'w-8 h-[10px] bg-white shadow-lg'
                                : 'w-[10px] h-[10px] bg-white/40 hover:bg-white/70'"
                            :aria-label="'Slide ' + n">
                    </button>
                </template>
            </div>
        </div>

        {{-- Arrow buttons --}}
        <button @click="prev()"
                class="absolute left-4 lg:left-6 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/15 hover:bg-white/30 border border-white/30 flex items-center justify-center text-white transition-all duration-200 hover:scale-110">
            <span class="material-symbols-outlined text-[22px]">chevron_left</span>
        </button>
        <button @click="next()"
                class="absolute right-4 lg:right-6 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/15 hover:bg-white/30 border border-white/30 flex items-center justify-center text-white transition-all duration-200 hover:scale-110">
            <span class="material-symbols-outlined text-[22px]">chevron_right</span>
        </button>

    </div>{{-- /x-data --}}
</section>

<style>
    /* Background */
    .hero-slider-bg {
        background: linear-gradient(140deg, #ff8c38 0%, #f97316 45%, #ea580c 100%);
    }
    /* Full-height: subtract header height per breakpoint */
    .hero-full-height {
        height: calc(100vh - 80px); /* mobile: h-20 */
        min-height: 0;
    }
    @media (min-width: 1024px) {
        .hero-full-height {
            height: calc(100vh - 84px); /* desktop: h-[84px] */
            max-height: 720px;
        }
    }

    /* Slide crossfade */
    .hero-fade-enter { transition: opacity 0.65s ease-out; }
    .hero-fade-leave { transition: opacity 0.4s ease-in; }
    .hero-fade-start { opacity: 0; }
    .hero-fade-end   { opacity: 1; }

    /* Content stagger — restart when display:none is toggled by x-show */
    .slide-badge { animation: slideUp 0.55s cubic-bezier(0.22, 1, 0.36, 1) 0.05s both; }
    .slide-title { animation: slideUp 0.65s cubic-bezier(0.22, 1, 0.36, 1) 0.17s both; }
    .slide-desc  { animation: slideUp 0.65s cubic-bezier(0.22, 1, 0.36, 1) 0.30s both; }
    .slide-btn   { animation: slideUp 0.60s cubic-bezier(0.22, 1, 0.36, 1) 0.44s both,
                              heroBtnFloat 2.8s ease-in-out 1.1s infinite; }
    .slide-image { animation: slideRight 0.75s cubic-bezier(0.22, 1, 0.36, 1) 0.20s both; }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(36px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideRight {
        from { opacity: 0; transform: translateX(64px) scale(0.88); }
        to   { opacity: 1; transform: translateX(0) scale(1); }
    }
    @keyframes heroBtnFloat {
        0%, 100% { transform: translateY(0px); }
        50%       { transform: translateY(-6px); }
    }
    @keyframes centerGlow {
        0%, 100% { opacity: 0.5; transform: scale(1); }
        50%       { opacity: 1;   transform: scale(1.18); }
    }
    @keyframes rotateSlow {
        from { transform: rotate(0deg); }
        to   { transform: rotate(360deg); }
    }
    @keyframes rotateCCW {
        from { transform: rotate(0deg); }
        to   { transform: rotate(-360deg); }
    }
    @keyframes chipFloat {
        0%, 100% { transform: translateY(0px); }
        50%       { transform: translateY(-8px); }
    }
    @keyframes circleFloat1 {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33%       { transform: translate(12px, -16px) scale(1.06); }
        66%       { transform: translate(-8px, 10px) scale(0.95); }
    }
    @keyframes circleFloat2 {
        0%, 100% { transform: translate(0, 0) scale(1); }
        40%       { transform: translate(-14px, -12px) scale(1.08); }
        70%       { transform: translate(10px, 18px) scale(0.93); }
    }
    @keyframes circleFloat3 {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50%       { transform: translate(16px, -20px) scale(1.1); }
    }

    /* Orbit container: always 320px coords (desktop only) */
    .orbit-scale {
        position: absolute;
        width: 320px; height: 320px;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
    }

    /* Reusable: central orb circle */
    .hero-orb {
        background: linear-gradient(135deg, rgba(255,255,255,0.25) 0%, rgba(255,255,255,0.08) 100%);
        box-shadow: 0 0 0 1px rgba(255,255,255,0.25), 0 0 80px rgba(255,255,255,0.22), 0 0 30px rgba(255,255,255,0.12);
    }

    /* Reusable: glow pulse overlay */
    .hero-glow {
        background: radial-gradient(circle at center, rgba(255,255,255,0.2) 0%, transparent 55%);
    }
</style>

<script>
function heroSlider() {
    return {
        current: 0,
        timer: null,

        goTo(index) {
            if (index === this.current) return;
            this.current = index;
            this.resetTimer();
        },

        next() { this.goTo((this.current + 1) % 3); },
        prev() { this.goTo((this.current - 1 + 3) % 3); },

        startTimer() {
            this.timer = setInterval(() => this.next(), 8000);
        },

        resetTimer() {
            clearInterval(this.timer);
            this.startTimer();
        },

        init() {
            this.startTimer();
        }
    }
}
</script>
