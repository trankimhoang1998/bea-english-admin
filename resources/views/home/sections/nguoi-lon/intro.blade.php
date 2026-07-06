{{-- resources/views/home/sections/nguoi-lon/intro.blade.php --}}
<section class="relative overflow-hidden bg-white py-20 lg:py-28">

    <div class="absolute inset-0 pointer-events-none opacity-[.22]"
         style="background-image: radial-gradient(rgba(249,115,22,.25) 1px, transparent 1px); background-size: 30px 30px;"></div>
    <div class="absolute -top-40 -right-40 w-[500px] h-[500px] rounded-full pointer-events-none"
         style="background: radial-gradient(circle, rgba(249,115,22,.07) 0%, transparent 65%);"></div>

    <div class="relative max-w-7xl mx-auto px-5 lg:px-16">

        {{-- Header --}}
        <div class="text-center mb-14 reveal">
            <div class="inline-flex items-center gap-3">
                <div class="h-[2px] w-10 bg-primary-container rounded-full"></div>
                <div class="bg-primary-container rounded-full px-8 py-3">
                    <h1 class="text-white font-black text-xl lg:text-2xl uppercase tracking-wide">Tiếng Anh Cho Người Lớn</h1>
                </div>
                <div class="h-[2px] w-10 bg-primary-container rounded-full"></div>
            </div>
        </div>

        {{-- 2-col: text + visual --}}
        <div class="grid lg:grid-cols-[55%_45%] gap-12 lg:gap-16 items-center">

            {{-- LEFT: text --}}
            <div class="reveal">
                <p class="text-gray-600 text-[15px] lg:text-[16px] leading-relaxed mb-5">
                    BeA English mang đến chương trình học tiếng Anh
                    <span class="text-primary-container font-bold">trực tuyến 1:1</span>
                    chất lượng cao dành riêng cho người lớn, được thiết kế bài bản theo phương pháp
                    <span class="text-primary-container font-bold">6P-BeA</span>
                    cùng một lộ trình phát triển toàn diện. Chương trình giúp nâng cao khả năng phản xạ, sử dụng tiếng Anh một cách tự nhiên, trôi chảy trong cuộc sống hằng ngày và trong công việc, tự tin giao tiếp trong mọi tình huống thực tế.
                </p>
                <p class="text-gray-600 text-[15px] lg:text-[16px] leading-relaxed">
                    Chương trình gồm
                    <span class="text-primary-container font-bold">04 cấp độ</span>
                    từ cơ bản đến nâng cao, bao gồm
                    <span class="text-primary-container font-bold">10 khóa học chuyên sâu</span>,
                    phù hợp cả người mới bắt đầu lẫn người muốn nâng cao toàn diện. BeA English cam kết chuẩn đầu ra theo khung tham chiếu ngôn ngữ chung châu Âu
                    <span class="text-primary-container font-bold">CEFR (A2 đến B2)</span>,
                    giúp học viên hiểu được 80% hội thoại thường ngày và phản xạ nhanh trong giao tiếp thực tế.
                </p>
            </div>

            {{-- RIGHT: use-case visual --}}
            <div class="flex justify-center reveal-delay-1 reveal">
                <div class="relative w-full max-w-sm">

                    {{-- Connecting line --}}
                    <div class="absolute left-7 top-6 bottom-6 w-[2px] bg-gradient-to-b from-orange-200 via-orange-400 to-orange-600 pointer-events-none rounded-full"></div>

                    @php
                    $usecases = [
                        ['work',         'work',         'Tiếng Anh Công Việc',  'Email, thuyết trình, họp online với đối tác nước ngoài.',  'from-orange-200 to-orange-300', 'bg-orange-50 border-orange-200',  'A2',  '2.5s', '0s'],
                        ['flight_takeoff','flight_takeoff','Du Lịch Quốc Tế',    'Tự tin giao tiếp, đặt phòng, hỏi đường khi ra nước ngoài.','from-orange-300 to-orange-500', 'bg-orange-50 border-orange-300',  'A2+', '2.8s', '.15s'],
                        ['school',       'school',        'Học Thuật & IELTS',   'Đọc tài liệu, nghiên cứu, luyện thi chứng chỉ quốc tế.',  'from-orange-400 to-orange-600', 'bg-orange-50 border-orange-400',  'B1',  '3.1s', '.3s'],
                        ['language',     'language',      'Giao Tiếp Toàn Diện', 'Trôi chảy tự nhiên — đạt chuẩn CEFR B2.',                 'from-orange-500 to-red-500',    'bg-orange-500 border-orange-500', 'B2',  '3.4s', '.45s'],
                    ];
                    @endphp

                    <div class="flex flex-col gap-3.5">
                        @foreach($usecases as [$iconKey, $icon, $title, $desc, $dotGrad, $cardBg, $cefr, $dur, $delay])
                        @php $isTop = $loop->last; @endphp
                        <div class="relative flex items-center gap-4 {{ $cardBg }} border rounded-2xl px-5 py-4 {{ $isTop ? 'shadow-xl shadow-orange-500/20' : 'shadow-sm' }}"
                             style="animation: hsLevelFloat {{ $dur }} ease-in-out {{ $delay }} infinite; margin-left: {{ ($loop->index) * 8 }}px;">

                            <div class="absolute -left-[1.15rem] w-5 h-5 rounded-full bg-gradient-to-br {{ $dotGrad }} flex items-center justify-center shadow-md shrink-0">
                                <span class="w-2 h-2 rounded-full bg-white block"></span>
                            </div>

                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br {{ $dotGrad }} flex items-center justify-center shadow-md shrink-0 ml-2">
                                <span class="material-symbols-outlined ms-filled text-white text-[18px]">{{ $icon }}</span>
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2 mb-0.5">
                                    <span class="{{ $isTop ? 'text-white' : 'text-on-background' }} font-black text-[13px] lg:text-[14px]">{{ $title }}</span>
                                    <span class="shrink-0 bg-gradient-to-r {{ $dotGrad }} text-white text-[10px] font-black px-2.5 py-0.5 rounded-full">{{ $cefr }}</span>
                                </div>
                                <p class="{{ $isTop ? 'text-white/80' : 'text-gray-500' }} text-[11px] leading-snug">{{ $desc }}</p>
                            </div>

                        </div>
                        @endforeach
                    </div>

                    <div class="absolute -top-5 -right-3 w-12 h-12 rounded-full bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center shadow-xl shadow-orange-500/40" style="animation: centerGlow 3s ease-in-out infinite;">
                        <span class="material-symbols-outlined ms-filled text-white text-[22px]">star</span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
