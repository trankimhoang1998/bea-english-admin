{{-- resources/views/home/sections/khoa-hoc/intro.blade.php --}}
<section class="relative overflow-hidden bg-white py-10 lg:pt-14 lg:pb-28">

    <div class="absolute inset-0 pointer-events-none opacity-[.22]"
         style="background-image: radial-gradient(rgba(249,115,22,.25) 1px, transparent 1px); background-size: 30px 30px;"></div>
    <div class="absolute -top-40 -right-40 w-[500px] h-[500px] rounded-full pointer-events-none"
         style="background: radial-gradient(circle, rgba(249,115,22,.07) 0%, transparent 65%);"></div>

    <div class="relative max-w-7xl mx-auto px-5 lg:px-16">

        {{-- Header --}}
        <div class="text-center mb-6 lg:mb-14 reveal">
            <div class="inline-flex items-center gap-3">
                <div class="h-[2px] w-6 lg:w-10 bg-primary-container rounded-full"></div>
                <div class="bg-primary-container rounded-full px-4 py-2 lg:px-8 lg:py-3">
                    <h1 class="text-white font-black text-base lg:text-2xl uppercase tracking-wide">Tiếng Anh Cho Học Sinh</h1>
                </div>
                <div class="h-[2px] w-6 lg:w-10 bg-primary-container rounded-full"></div>
            </div>
        </div>

        {{-- 2-col: text + visual --}}
        <div class="grid lg:grid-cols-[55%_45%] gap-6 lg:gap-16 items-center">

            {{-- LEFT: text --}}
            <div class="order-2 lg:order-1 reveal">
                <p class="text-gray-600 text-[15px] lg:text-[16px] leading-relaxed mb-5">
                    Chào mừng bạn đến với chương trình học tiếng Anh
                    <span class="text-primary-container font-bold">trực tuyến 1:1</span>
                    đầy năng động dành cho học sinh! Các khóa học của BeA English được thiết kế khoa học, phù hợp với phương pháp
                    <span class="text-primary-container font-bold">6P-BeA</span>
                    cùng một lộ trình học tập phát triển toàn diện 4 kỹ năng
                    <span class="text-primary-container font-bold">Nghe – Nói – Đọc – Viết</span>,
                    nâng cao khả năng phản xạ và giao tiếp tự tin, tối ưu cho việc học online và đảm bảo tiến bộ đều đặn.
                </p>
                <p class="text-gray-600 text-[15px] lg:text-[16px] leading-relaxed">
                    Các khóa học ở nhiều cấp độ, từ cơ bản đến nâng cao, bám sát khung chuẩn
                    <span class="text-primary-container font-bold">Cambridge Young Learners</span>
                    và khung tham chiếu ngôn ngữ chung châu Âu
                    <span class="text-primary-container font-bold">CEFR (A1→A2→B1→B2)</span>.
                    Giúp học viên từng bước chinh phục các chứng chỉ quốc tế như
                    <span class="text-primary-container font-bold">Starters, Movers, Flyers, KET, PET</span> và
                    <span class="text-primary-container font-bold">IELTS</span>.
                </p>
            </div>

            {{-- RIGHT: CEFR level ladder --}}
            <div class="order-1 lg:order-2 flex justify-center reveal-delay-1 reveal">
                <div class="relative w-full max-w-sm">

                    {{-- Connecting line --}}
                    <div class="absolute left-7 top-6 bottom-6 w-[2px] bg-gradient-to-t from-orange-200 via-orange-400 to-orange-600 pointer-events-none rounded-full"></div>

                    @php
                    $levels = [
                        ['Beginner',          'A1 – A2', 'Foundation',                ['Foundation'],                         'from-orange-200 to-orange-300', 'text-orange-600', 'bg-orange-50 border-orange-200',  '2.5s', '0s'],
                        ['Elementary',        'A2',      'Starters · Movers',          ['Starters', 'Movers'],                 'from-orange-300 to-orange-500', 'text-orange-700', 'bg-orange-50 border-orange-300',  '2.8s', '.15s'],
                        ['Intermediate',      'B1',      'Movers · Flyers · KET',      ['Movers', 'Flyers', 'KET'],            'from-orange-400 to-orange-600', 'text-orange-800', 'bg-orange-50 border-orange-400',  '3.1s', '.3s'],
                        ['Upper-Intermediate','B2',      'KET · PET · IELTS',          ['KET', 'PET', 'IELTS'],               'from-orange-500 to-red-500',    'text-white',      'bg-orange-500 border-orange-500',  '3.4s', '.45s'],
                    ];
                    @endphp

                    <div class="flex flex-col gap-3.5">
                        @foreach(array_reverse($levels) as [$level, $cefr, $certs, $chips, $dotGrad, $dotText, $cardBg, $dur, $delay])
                        @php $isTop = $loop->first; @endphp
                        <div class="relative flex items-center gap-4 {{ $cardBg }} border rounded-2xl px-5 py-4 {{ $isTop ? 'shadow-xl shadow-orange-500/20' : 'shadow-sm' }}"
                             style="animation: hsLevelFloat {{ $dur }} ease-in-out {{ $delay }} infinite; margin-left: {{ ($loop->count - 1 - $loop->index) * 8 }}px;">

                            {{-- Dot on line --}}
                            <div class="absolute -left-[1.15rem] w-5 h-5 rounded-full bg-gradient-to-br {{ $dotGrad }} flex items-center justify-center shadow-md shrink-0">
                                <span class="w-2 h-2 rounded-full bg-white block"></span>
                            </div>

                            {{-- Content --}}
                            <div class="ml-2 flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2 mb-1.5">
                                    <span class="{{ $isTop ? 'text-white' : 'text-on-background' }} font-black text-[13px] lg:text-[14px]">{{ $level }}</span>
                                    <span class="shrink-0 bg-gradient-to-r {{ $dotGrad }} text-white text-[10px] font-black px-2.5 py-0.5 rounded-full">{{ $cefr }}</span>
                                </div>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($chips as $chip)
                                    <span class="{{ $isTop ? 'bg-white/20 text-white' : 'bg-white border border-gray-200 text-gray-600' }} text-[10px] font-semibold px-2 py-0.5 rounded-full">{{ $chip }}</span>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>

                    {{-- Trophy top badge --}}
                    <div class="absolute -top-5 -right-3 w-12 h-12 rounded-full bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center shadow-xl shadow-orange-500/40" style="animation: centerGlow 3s ease-in-out infinite;">
                        <span class="material-symbols-outlined ms-filled text-white text-[22px]">workspace_premium</span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
