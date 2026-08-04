{{-- resources/views/home/sections/phuong-phap/6p.blade.php --}}

@php
$methods = [
    ['P1','Personalized','Cá nhân hóa',        'person_pin',    'from-orange-400 to-orange-600', 'Học đúng năng lực – Tiến bộ đúng cách',            ['Mỗi học viên là một hành trình riêng.', 'BeA English xây dựng lộ trình học riêng biệt dựa trên trình độ, mục tiêu (học tập, giao tiếp, IELTS...) và tốc độ tiếp thu của từng học viên.']],
    ['P2','Practice',    'Luyện tập thực chiến','fitness_center','from-amber-400 to-orange-500', 'Luyện đều 4 kỹ năng – Tự tin giao tiếp',           ['Học không chỉ để biết, mà để dùng.', 'Giáo viên luôn tạo cơ hội cho học viên luyện nói, phản xạ giao tiếp, làm bài tập ứng dụng thực tế ngay trong mỗi buổi học.']],
    ['P3','Partnership', 'Giáo viên đồng hành', 'handshake',     'from-orange-500 to-red-500',   'Thầy giỏi – Trò tự tin – Kết quả vững vàng',       ['Học viên không đơn độc.', 'Giáo viên quốc tế đồng hành sát sao trong từng buổi học, đưa ra phản hồi cá nhân, gợi ý điều chỉnh và động viên tinh thần học tập.']],
    ['P4','Purposeful',  'Học có mục tiêu rõ ràng','my_location','from-orange-400 to-amber-600', 'Có định hướng – Có động lực – Có kết quả',         ['Mỗi buổi học đều có "đích đến".', 'Học viên hiểu rõ mình học để làm gì, cần đạt gì sau mỗi buổi, mỗi tuần và từng giai đoạn cụ thể.']],
    ['P5','Progress',    'Theo dõi & đo lường tiến bộ','trending_up','from-amber-500 to-orange-600','Biết mình đang ở đâu – Biết cần đi đâu tiếp', ['Không để sự cố gắng trở nên mơ hồ.', 'BeA English có hệ thống đánh giá tiến trình định kỳ, báo cáo kết quả học theo tuần/tháng, giúp học viên và phụ huynh nhìn rõ từng bước tiến.']],
    ['P6','Practical',   'Ứng dụng thực tế',    'build',         'from-orange-500 to-red-400',   'Học để dùng – Dùng được ngay',                     ['Học gắn với đời sống, học tập và công việc.', 'Các bài học được thiết kế theo ngữ cảnh thực tế: giao tiếp hằng ngày, phỏng vấn, thuyết trình, học thuật, du học...']],
];
@endphp

{{-- ── INTRO ── --}}
<section class="relative overflow-hidden bg-white py-10 lg:py-28">
    <div class="absolute inset-0 pointer-events-none opacity-[.22]"
         style="background-image: radial-gradient(rgba(249,115,22,.25) 1px, transparent 1px); background-size: 30px 30px;"></div>
    <div class="absolute -bottom-40 -left-40 w-[500px] h-[500px] rounded-full pointer-events-none"
         style="background: radial-gradient(circle, rgba(249,115,22,.07) 0%, transparent 65%);"></div>

    <div class="relative max-w-7xl mx-auto px-5 lg:px-16">

        {{-- Header --}}
        <div class="text-center mb-6 lg:mb-14 reveal">
            <div class="inline-flex items-center gap-3">
                <div class="h-[2px] w-6 lg:w-10 bg-primary-container rounded-full"></div>
                <div class="bg-primary-container rounded-full px-4 py-2 lg:px-8 lg:py-3">
                    <h1 class="text-white font-black uppercase tracking-wide">
                        <span class="lg:hidden text-base">Phương Pháp 6P – BeA</span>
                        <span class="hidden lg:inline text-2xl">Phương Pháp Đào Tạo 6P – BEA English</span>
                    </h1>
                </div>
                <div class="h-[2px] w-6 lg:w-10 bg-primary-container rounded-full"></div>
            </div>
        </div>

        {{-- 2-col: text + visual --}}
        <div class="grid lg:grid-cols-[55%_45%] gap-6 lg:gap-16 items-center">

            {{-- LEFT: text --}}
            <div class="order-2 lg:order-1 reveal">
                <p class="text-gray-600 text-[15px] lg:text-[16px] leading-relaxed mb-6">
                    Từ nhiều năm kinh nghiệm giảng dạy trực tiếp, BeA English đã nghiên cứu và phát triển thành công phương pháp đào tạo tiếng Anh
                    <span class="text-primary-container font-bold">6P-BeA English</span>
                    (Personalized – Practice – Partnership – Purposeful – Progress – Practical). Đây là phương pháp được xây dựng dựa trên nền tảng các mô hình giảng dạy nổi tiếng thế giới như Callan, Sparta, Semi-Sparta... nhưng đã được tinh chỉnh để phù hợp với văn hóa, thói quen và tâm lý của học sinh, sinh viên Việt Nam, cũng như mô hình đào tạo
                    <span class="text-primary-container font-bold">1 kèm 1 trực tuyến (1:1 online)</span>
                    của BeA English.
                </p>
                <p class="text-gray-600 text-[15px] lg:text-[16px] leading-relaxed">
                    Trọng tâm của phương pháp là tập trung vào việc cá nhân hóa người học, học có mục tiêu rõ ràng, học để tự tin sử dụng trong thực tế, qua đó giúp học viên thoát khỏi lối học mẹo, học tủ, học trước quên sau và thực sự làm chủ tiếng Anh trong cuộc sống.
                </p>
            </div>

            {{-- RIGHT: 6P diagram --}}
            <div class="order-1 lg:order-2 flex justify-center items-center reveal-delay-1 reveal">
                <div class="pp-diagram relative" style="width:320px;height:320px;">

                    {{-- Outer ring --}}
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-orange-200 pointer-events-none" style="animation: rotateSlow 28s linear infinite;"></div>
                    <div class="absolute inset-6 rounded-full border border-orange-100 pointer-events-none" style="animation: rotateCCW 20s linear infinite;"></div>

                    {{-- Center badge --}}
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-28 h-28 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 flex flex-col items-center justify-center shadow-2xl shadow-orange-400/40" style="animation: centerGlow 3s ease-in-out infinite;">
                            <span class="text-white font-black text-2xl leading-none">6P</span>
                            <span class="text-white/80 text-[10px] font-bold uppercase tracking-wider mt-0.5">BeA</span>
                        </div>
                    </div>

                    {{-- 6 nodes orbiting --}}
                    @php
                    $nodes = [
                        ['P1','person_pin',   'Personalized', 0],
                        ['P2','fitness_center','Practice',    60],
                        ['P3','handshake',    'Partnership', 120],
                        ['P4','my_location',  'Purposeful',  180],
                        ['P5','trending_up',  'Progress',    240],
                        ['P6','build',        'Practical',   300],
                    ];
                    $r = 130; // radius px
                    @endphp
                    @foreach($nodes as [$p,$icon,$en,$deg])
                    @php
                        $rad = deg2rad($deg);
                        $x   = round($r * cos($rad));
                        $y   = round($r * sin($rad));
                    @endphp
                    <div class="absolute flex flex-col items-center gap-1 pp-node"
                         style="left:calc(50% + {{ $x }}px); top:calc(50% + {{ $y }}px); transform:translate(-50%,-50%); animation: chipFloat {{ 3 + ($deg/60)*0.4 }}s ease-in-out {{ ($deg/60)*0.3 }}s infinite;">
                        <div class="w-11 h-11 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center shadow-lg shadow-orange-400/35">
                            <span class="material-symbols-outlined ms-filled text-white text-[18px]">{{ $icon }}</span>
                        </div>
                        <span class="text-[9px] font-black text-gray-600 uppercase bg-white border border-gray-200 rounded-full px-2 py-0.5 shadow-sm whitespace-nowrap">{{ $p }}</span>
                    </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>
</section>

{{-- ── 6P TABS ── --}}
<section class="bg-surface-alt py-16 lg:py-24"
         x-data="{ tab: 0 }">
    <div class="max-w-7xl mx-auto px-5 lg:px-16">

        {{-- Tab pills --}}
        <div class="flex flex-wrap justify-center gap-2 mb-12">
            @foreach($methods as $i => [$p,$en,$vi,$icon,$grad])
            <button @click="tab = {{ $i }}"
                    :class="tab === {{ $i }}
                        ? 'bg-primary-container text-white shadow-md shadow-orange-400/30 scale-105'
                        : 'bg-white text-gray-500 border border-gray-200 hover:border-orange-300 hover:text-gray-800'"
                    class="flex items-center gap-2 px-5 py-2.5 rounded-full font-black text-[13px] uppercase tracking-wide transition-all duration-200 cursor-pointer">
                <span :class="tab === {{ $i }} ? 'bg-white/25 text-white' : 'bg-gray-100 text-gray-500'"
                      class="w-7 h-7 rounded-full flex items-center justify-center text-[11px] font-black transition-colors shrink-0">{{ $p }}</span>
                <span class="hidden sm:inline">{{ $en }}</span>
            </button>
            @endforeach
        </div>

        {{-- Panels (instant switch — no jank) --}}
        @foreach($methods as $i => [$p,$en,$vi,$icon,$grad,$tag,$points])
        <div x-show="tab === {{ $i }}" class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">

            {{-- Visual --}}
            <div class="{{ $i % 2 === 0 ? 'order-2 lg:order-1' : 'order-2' }}
                        flex items-center justify-center rounded-3xl bg-white min-h-[260px] lg:min-h-[300px]
                        relative overflow-hidden border border-gray-100 shadow-sm">
                <div class="absolute inset-0 pointer-events-none"
                     style="background: radial-gradient(circle at 50% 50%, rgba(249,115,22,.06) 0%, transparent 65%);"></div>
                <div class="relative flex flex-col items-center">
                    <div class="w-28 h-28 rounded-3xl bg-gradient-to-br {{ $grad }} flex items-center justify-center shadow-xl shadow-orange-500/20 pp-icon mb-2">
                        <span class="material-symbols-outlined ms-filled text-white" style="font-size:58px;">{{ $icon }}</span>
                    </div>
                    <span class="text-gray-200 font-black leading-none select-none" style="font-size:5rem;">{{ $p }}</span>
                </div>
                <div class="absolute w-52 h-52 rounded-full border-2 border-dashed border-orange-100 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none" style="animation: rotateSlow 20s linear infinite;"></div>
                <div class="absolute w-36 h-36 rounded-full border border-orange-100 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none" style="animation: rotateCCW 14s linear infinite;"></div>
            </div>

            {{-- Text --}}
            <div class="{{ $i % 2 === 0 ? 'order-1 lg:order-2' : 'order-1' }}">
                <div class="inline-flex items-center gap-3 mb-5">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br {{ $grad }} flex items-center justify-center shadow-lg shadow-orange-500/20 shrink-0">
                        <span class="text-white font-black text-xl">{{ $p }}</span>
                    </div>
                    <div>
                        <p class="text-gray-400 text-[11px] font-bold uppercase tracking-widest leading-none mb-1">{{ $en }}</p>
                        <h2 class="text-on-background font-black text-base lg:text-2xl leading-tight">{{ $vi }}</h2>
                    </div>
                </div>

                <div class="space-y-3.5 mb-6">
                    @foreach($points as $pt)
                    <div class="flex items-start gap-3">
                        <span class="w-5 h-5 rounded-full bg-primary-container/15 flex items-center justify-center shrink-0 mt-0.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary-container block"></span>
                        </span>
                        <p class="text-gray-600 text-[14.5px] leading-relaxed">{{ $pt }}</p>
                    </div>
                    @endforeach
                </div>

                <div class="flex items-center gap-3 bg-orange-50 border-l-4 border-primary-container rounded-xl px-5 py-4">
                    <span class="text-xl shrink-0">🎯</span>
                    <p class="text-primary-container font-bold text-[14px]">{{ $tag }}</p>
                </div>
            </div>

        </div>
        @endforeach

        {{-- Dot nav --}}
        <div class="flex justify-center gap-2 mt-10">
            @foreach($methods as $i => [$p])
            <button @click="tab = {{ $i }}"
                    :class="tab === {{ $i }} ? 'bg-primary-container w-8' : 'bg-gray-300 w-2'"
                    class="h-2 rounded-full transition-all duration-300 cursor-pointer"></button>
            @endforeach
        </div>

    </div>
</section>
