{{-- resources/views/home/partials/gioi-thieu-hero.blade.php --}}
<section class="gt-section relative overflow-hidden pt-8 lg:pt-0">

    {{-- Animated gradient background --}}
    <div class="absolute inset-0 gt-bg pointer-events-none"></div>

    {{-- Light beam top-right --}}
    <div class="absolute -top-40 -right-40 w-[520px] h-[520px] rounded-full pointer-events-none"
         style="background: radial-gradient(circle at 70% 30%, rgba(255,255,255,.30) 0%, transparent 60%); animation: gtBeam 7s ease-in-out infinite alternate;"></div>

    {{-- Glow orb bottom-left --}}
    <div class="absolute -bottom-40 -left-40 w-[480px] h-[480px] rounded-full pointer-events-none"
         style="background: radial-gradient(circle, rgba(255,200,80,.16) 0%, transparent 65%); animation: circleFloat2 10s ease-in-out infinite;"></div>

    {{-- Dot grid --}}
    <div class="absolute inset-0 pointer-events-none"
         style="background-image: radial-gradient(rgba(255,255,255,.28) 1px, transparent 1px); background-size: 26px 26px; opacity:.18;"></div>

    {{-- Floating particles --}}
    @for($p = 0; $p < 6; $p++)
    <div class="absolute rounded-full pointer-events-none gt-particle gt-p{{ $p }}"></div>
    @endfor

    {{-- Content --}}
    <div class="relative max-w-7xl mx-auto px-5 lg:px-16 flex items-center">
        <div class="w-full grid grid-cols-1 lg:grid-cols-[60%_40%] gap-8 lg:gap-12 items-center py-10 lg:py-0">

            {{-- LEFT: Text --}}
            <div class="order-2 lg:order-1">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2.5 bg-black/20 border border-white/25 backdrop-blur-sm rounded-full px-4 py-1.5 mb-5 gt-in-badge">
                    <span class="w-2 h-2 rounded-full bg-white gt-dot-blink"></span>
                    <span class="text-white/90 text-[11px] lg:text-[12px] font-bold uppercase tracking-[0.18em]">Hơn 10 năm kinh nghiệm</span>
                </div>

                {{-- Title --}}
                <h1 class="font-black uppercase leading-[1.1] mb-5 gt-in-title"
                    style="font-size: clamp(1.35rem, 3.8vw, 2.75rem);">
                    <span class="text-white">BEA ENGLISH.</span><br>
                    <span class="gt-shine-text">Hướng tới tương lai!</span>
                </h1>

                {{-- Para 1 --}}
                <p class="text-white leading-relaxed mb-4 gt-in-p1"
                   style="font-size: clamp(13px, 1.3vw, 15px);">
                    BeA English, tiền thân là cộng đồng giáo viên tiếng Anh người Philippines – những người đang giảng dạy tại các trường học, trung tâm ngoại ngữ ở Việt Nam và các quốc gia khác trên thế giới. Với mong muốn được góp phần phổ cập tiếng Anh chất lượng, BeA English đã đồng hành và giúp hàng trăm nghìn học sinh, sinh viên Việt Nam học tập hiệu quả, tự tin sử dụng tiếng Anh và chinh phục thành công các chứng chỉ quốc tế như IELTS, TOEIC, Cambridge...
                </p>

                {{-- Para 2 --}}
                <p class="text-white leading-relaxed mb-7 gt-in-p2"
                   style="font-size: clamp(13px, 1.3vw, 15px);">
                    Với uy tín đã được khẳng định, cùng nền tảng kinh nghiệm, chuyên môn vững chắc, phương pháp giáo dục hiệu quả từ nhiều năm dạy học trực tiếp. BeA English đã chuyển mình sang mô hình dạy học 1 kèm 1 trực tuyến (online 1:1), cá nhân hóa từng bài học, giúp học viên kết nối với giáo viên quốc tế mọi lúc, mọi nơi. Khoảng cách không còn là rào cản, thay vào đó là sự tập trung tuyệt đối vào chất lượng và hiệu quả học tập.
                </p>

                {{-- CTA --}}
                <div class="hidden lg:block gt-in-cta">
                    <a href="#contact"
                       class="inline-flex items-center gap-2.5 bg-white text-orange-600 font-black uppercase tracking-widest rounded-full shadow-2xl shadow-black/20 hover:bg-orange-50 hover:scale-105 active:scale-95 transition-all duration-200"
                       style="font-size: clamp(11px, 1.2vw, 13px); padding: clamp(12px, 1.4vw, 14px) clamp(24px, 2.8vw, 32px);">
                        Học thử miễn phí
                        <span class="material-symbols-outlined text-[16px] gt-arrow">arrow_forward</span>
                    </a>
                </div>
            </div>

            {{-- RIGHT: Visual --}}
            <div class="flex justify-center items-center gt-in-visual order-1 lg:order-2">
                <div class="gt-visual-wrap relative">

                    {{-- Outer ring, dashed CW --}}
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-white/15"
                         style="animation: rotateSlow 22s linear infinite;">
                        <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-6 h-6 rounded-full bg-white shadow-lg shadow-white/50"></div>
                        <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-3 h-3 rounded-full bg-white/40"></div>
                        <div class="absolute top-1/2 -right-2.5 -translate-y-1/2 w-4 h-4 rounded-full bg-white/60"></div>
                    </div>

                    {{-- Middle ring, CCW --}}
                    <div class="absolute inset-[13%] rounded-full border border-white/20"
                         style="animation: rotateCCW 15s linear infinite;">
                        <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-3.5 h-3.5 rounded-full bg-white/75 shadow shadow-white/40"></div>
                        <div class="absolute -bottom-1.5 left-1/2 -translate-x-1/2 w-2 h-2 rounded-full bg-white/50"></div>
                    </div>

                    {{-- Radial glow --}}
                    <div class="absolute inset-0 rounded-full pointer-events-none hero-glow"
                         style="animation: centerGlow 3.5s ease-in-out infinite;"></div>

                    {{-- Ping ring --}}
                    <div class="absolute inset-[30%] rounded-full pointer-events-none"
                         style="border: 1.5px solid rgba(255,255,255,.4); animation: gtPing 2.8s ease-out infinite;"></div>

                    {{-- Center orb --}}
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-44 h-44 rounded-full flex items-center justify-center hero-orb shadow-2xl">
                            <span class="material-symbols-outlined ms-filled text-white text-[88px]">language</span>
                        </div>
                    </div>

                    {{-- 🇻🇳 badge --}}
                    <div class="absolute -top-3 -left-10 bg-white rounded-xl px-3 py-1.5 shadow-xl flex items-center gap-2"
                         style="animation: chipFloat 3.2s ease-in-out infinite;">
                        <span class="text-xl">🇻🇳</span>
                        <div>
                            <p class="text-[10px] font-black text-gray-800 leading-none">Việt Nam</p>
                            <p class="text-[9px] text-gray-400">Học viên</p>
                        </div>
                    </div>

                    {{-- 🇵🇭 badge --}}
                    <div class="absolute -top-3 -right-10 bg-white rounded-xl px-3 py-1.5 shadow-xl flex items-center gap-2"
                         style="animation: chipFloat 3.7s ease-in-out 0.5s infinite;">
                        <span class="text-xl">🇵🇭</span>
                        <div>
                            <p class="text-[10px] font-black text-gray-800 leading-none">Philippines</p>
                            <p class="text-[9px] text-gray-400">Giáo viên</p>
                        </div>
                    </div>

                    {{-- IELTS chip --}}
                    <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 bg-white/15 backdrop-blur-md border border-white/25 rounded-xl px-3.5 py-2 whitespace-nowrap"
                         style="animation: chipFloat 4.2s ease-in-out 0.3s infinite;">
                        <p class="text-white font-bold text-[11px]">IELTS · TOEIC · Cambridge</p>
                    </div>

                    {{-- 10+ chip --}}
                    <div class="absolute top-1/2 -translate-y-1/2 -right-14 bg-white/12 backdrop-blur-md border border-white/20 rounded-xl px-3 py-2 whitespace-nowrap"
                         style="animation: chipFloat 5s ease-in-out 1.2s infinite;">
                        <p class="text-white font-bold text-[11px]">🏆 10+ năm</p>
                    </div>

                    {{-- 5+ chip --}}
                    <div class="absolute top-1/2 -translate-y-1/2 -left-14 bg-white/12 backdrop-blur-md border border-white/20 rounded-xl px-3 py-2 whitespace-nowrap"
                         style="animation: chipFloat 4.6s ease-in-out 0.8s infinite;">
                        <p class="text-white font-bold text-[11px]">⭐ 5+ năm</p>
                    </div>

                    {{-- 3+ chip --}}
                    <div class="absolute top-[72%] -left-4 bg-white/12 backdrop-blur-md border border-white/20 rounded-xl px-3 py-2 whitespace-nowrap"
                         style="animation: chipFloat 3.6s ease-in-out 1.6s infinite;">
                        <p class="text-white font-bold text-[11px]">🎯 3+ năm</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
.gt-section {
    display: flex;
    align-items: center;
}
@media (min-width: 1024px) {
    .gt-section {
        height: calc(100vh - 84px);
        max-height: 720px;
    }
}

.gt-bg {
    background: linear-gradient(140deg, #ff8c38 0%, #f97316 45%, #ea580c 100%);
}
@keyframes gtBeam {
    from { opacity: .2; transform: scale(1)    rotate(0deg);   }
    to   { opacity: .4; transform: scale(1.12) rotate(-12deg); }
}

.gt-visual-wrap { width: 190px; height: 190px; }
@media (min-width: 1024px) {
    .gt-visual-wrap { width: 320px; height: 320px; }
}

.gt-dot-blink { animation: gtDotBlink 1.6s ease-in-out infinite; }
@keyframes gtDotBlink {
    0%, 100% { opacity: 1; }
    50%       { opacity: .2; }
}

.gt-shine-text {
    background: linear-gradient(100deg, #fff 0%, #fff 30%, #ffd5a0 48%, #fff 65%, #fff 100%);
    background-size: 280% 100%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: gtShine 3.5s linear infinite;
}
@keyframes gtShine {
    from { background-position: 200% center; }
    to   { background-position: -200% center; }
}

@keyframes gtPing {
    0%   { transform: scale(1);   opacity: .5; }
    80%  { transform: scale(2.6); opacity: 0;  }
    100% { transform: scale(2.6); opacity: 0;  }
}

.gt-particle { background: rgba(255,255,255,.5); animation: gtParticle linear infinite; }
.gt-p0 { width:3px; height:3px; top:12%; left:8%;  animation-duration:7s;  animation-delay:0s;   }
.gt-p1 { width:2px; height:2px; top:60%; left:15%; animation-duration:9s;  animation-delay:1.5s; }
.gt-p2 { width:3px; height:3px; top:25%; left:38%; animation-duration:6s;  animation-delay:0.8s; }
.gt-p3 { width:2px; height:2px; top:78%; left:52%; animation-duration:8s;  animation-delay:2s;   }
.gt-p4 { width:3px; height:3px; top:18%; left:72%; animation-duration:10s; animation-delay:0.3s; }
.gt-p5 { width:2px; height:2px; top:45%; left:88%; animation-duration:7s;  animation-delay:1.8s; }
@keyframes gtParticle {
    0%   { transform: translateY(0);     opacity: .5; }
    50%  { transform: translateY(-22px); opacity: 1;  }
    100% { transform: translateY(0);     opacity: .5; }
}

.gt-in-badge  { opacity:0; animation: gtInUp  .55s cubic-bezier(.22,1,.36,1) .05s both; }
.gt-in-title  { opacity:0; animation: gtInUp  .60s cubic-bezier(.22,1,.36,1) .15s both; }
.gt-in-p1     { opacity:0; animation: gtInUp  .60s cubic-bezier(.22,1,.36,1) .27s both; }
.gt-in-p2     { opacity:0; animation: gtInUp  .60s cubic-bezier(.22,1,.36,1) .38s both; }
.gt-in-cta    { opacity:0; animation: gtInUp  .60s cubic-bezier(.22,1,.36,1) .48s both; }
.gt-in-visual { opacity:0; animation: gtInVis .80s cubic-bezier(.22,1,.36,1) .25s both; }
@keyframes gtInUp {
    from { opacity:0; transform: translateY(30px); }
    to   { opacity:1; transform: translateY(0);    }
}
@keyframes gtInVis {
    from { opacity:0; transform: translateX(44px) scale(.88); }
    to   { opacity:1; transform: translateX(0)    scale(1);   }
}

a:hover .gt-arrow { animation: gtArrow .35s ease-in-out infinite alternate; }
@keyframes gtArrow {
    from { transform: translateX(0); }
    to   { transform: translateX(4px); }
}
</style>
