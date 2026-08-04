{{-- resources/views/home/partials/stats-strip.blade.php --}}
<section class="relative bg-white py-6 lg:py-16 overflow-hidden" aria-label="Thành tích nổi bật">

    <div class="absolute inset-0 pointer-events-none"
         style="background: radial-gradient(ellipse 80% 60% at 50% 120%, rgba(249,115,22,0.06) 0%, transparent 70%)"></div>

    @php
    $stats = [
        ['online_prediction',  100, '%', 'Dạy và học online'],
        ['supervisor_account', 100, '%', 'Giáo viên nước ngoài'],
        ['route',              100, '%', 'Lộ trình cá nhân hóa'],
        ['star',               100, '%', 'Cam kết chất lượng'],
    ];
    @endphp

    <div class="max-w-6xl mx-auto px-6 lg:px-8"
         x-data="counterSection()"
         x-intersect.once="startCounters()">

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-6">

            @foreach($stats as $i => [$icon, $target, $suffix, $label])
            <div class="group relative flex flex-col items-center text-center
                        px-3 py-4 lg:px-6 lg:py-10 cursor-default">

                {{-- Glow bg on hover --}}
                <div class="absolute inset-0 rounded-3xl bg-orange-500/0 group-hover:bg-orange-500/[0.04] transition-colors duration-300"></div>

                {{-- Icon --}}
                <div class="relative mb-3 lg:mb-6">
                    <span class="stat-ring absolute inset-0 rounded-full bg-orange-500/15"
                          style="animation: statRing 2.5s ease-out infinite;"></span>
                    <span class="stat-ring absolute inset-0 rounded-full bg-orange-500/10"
                          style="animation: statRing 2.5s ease-out 0.8s infinite;"></span>
                    <div class="relative w-14 h-14 lg:w-[72px] lg:h-[72px] rounded-2xl
                                bg-gradient-to-br from-orange-400 to-orange-600
                                flex items-center justify-center
                                shadow-lg shadow-orange-500/30
                                group-hover:scale-110 group-hover:shadow-xl group-hover:shadow-orange-500/40
                                transition-all duration-300">
                        <span class="material-symbols-outlined ms-filled text-white text-[22px] lg:text-[32px]">{{ $icon }}</span>
                    </div>
                </div>

                {{-- Counter --}}
                <div class="flex items-end leading-none mb-2 lg:mb-4">
                    <span class="text-[2rem] lg:text-[4.2rem] font-black text-on-background tracking-tight leading-none group-hover:text-orange-500 transition-colors duration-300"
                          x-text="counts[{{ $i }}]">0</span>
                    <span class="text-orange-500 font-black text-[1.2rem] lg:text-[2.4rem] mb-0.5 ml-0.5">{{ $suffix }}</span>
                </div>

                {{-- Label --}}
                <p class="text-[10.5px] lg:text-[12.5px] text-gray-400 font-semibold uppercase tracking-[0.08em] lg:tracking-[0.12em] leading-snug group-hover:text-gray-700 transition-colors duration-300">{{ $label }}</p>

            </div>
            @endforeach

        </div>
    </div>
</section>

<script>
function counterSection() {
    return {
        counts: [0, 0, 0, 0],
        startCounters() {
            @json(array_column($stats, 1)).forEach((target, i) => {
                const duration = 1600;
                const start = performance.now();
                const tick = (now) => {
                    const progress = Math.min((now - start) / duration, 1);
                    const eased = 1 - Math.pow(1 - progress, 3);
                    this.counts[i] = Math.round(target * eased);
                    if (progress < 1) requestAnimationFrame(tick);
                };
                setTimeout(() => requestAnimationFrame(tick), i * 150);
            });
        }
    }
}
</script>
