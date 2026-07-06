{{-- resources/views/home/sections/luyen-thi-ielts/intro.blade.php --}}
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
                    <h1 class="text-white font-black text-xl lg:text-2xl uppercase tracking-wide">Luyện Thi IELTS</h1>
                </div>
                <div class="h-[2px] w-10 bg-primary-container rounded-full"></div>
            </div>
        </div>

        {{-- 2-col: text + visual --}}
        <div class="grid lg:grid-cols-[58%_42%] gap-12 lg:gap-16 items-center">

            {{-- LEFT: text --}}
            <div class="reveal">
                <p class="text-gray-600 text-[15px] lg:text-[16px] leading-relaxed mb-6">
                    Chương trình luyện thi IELTS toàn diện của BeA English sẽ giúp bạn đạt band điểm từ
                    <span class="text-primary-container font-bold">0 lên 6.5+</span>,
                    xây dựng vững chắc từ nền tảng kiến thức đến chiến lược thi hiệu quả. Chương trình gồm
                    <span class="text-primary-container font-bold">04 khóa học</span>
                    theo trình độ tăng dần và
                    <span class="text-primary-container font-bold">01 khóa học cấp tốc</span>
                    để đạt điểm tối đa trong thời gian ngắn. Phù hợp với:
                </p>

                @php
                $audiences = [
                    'Học sinh THCS từ 14 tuổi trở lên, mới tiếp cận với bài thi IELTS và mong muốn đạt band điểm IELTS cao để được miễn thi tốt nghiệp (môn tiếng Anh) hoặc tuyển vào các trường chuyên cấp 3.',
                    'Học sinh cấp THPT cần chứng chỉ IELTS để xét tuyển đầu vào các trường đại học hàng đầu hoặc học tập trong môi trường quốc tế.',
                    'Sinh viên muốn đạt chứng chỉ IELTS làm điều kiện tốt nghiệp hoặc quy đổi điểm học phần tại trường, mong muốn tìm kiếm một công việc trong môi trường quốc tế.',
                    'Người học muốn nâng cao trình độ tiếng Anh, cải thiện kỹ năng ngôn ngữ, tạo lợi thế du học, định cư và cơ hội nghề nghiệp trong môi trường quốc tế.',
                ];
                @endphp
                <ul class="space-y-3.5">
                    @foreach($audiences as $item)
                    <li class="flex items-start gap-3">
                        <span class="shrink-0 w-6 h-6 rounded-full bg-primary-container/10 flex items-center justify-center mt-0.5">
                            <span class="material-symbols-outlined ms-filled text-primary-container text-[14px]">chevron_right</span>
                        </span>
                        <span class="text-gray-600 text-[14.5px] leading-relaxed">{{ $item }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- RIGHT: IELTS band score visual --}}
            <div class="flex justify-center reveal-delay-1 reveal">
                <div class="relative w-full max-w-xs">

                    {{-- Central IELTS badge --}}
                    <div class="relative mx-auto w-36 h-36 rounded-full bg-gradient-to-br from-orange-400 to-red-500 flex flex-col items-center justify-center shadow-2xl shadow-orange-400/40 mb-6" style="animation: centerGlow 3s ease-in-out infinite;">
                        <span class="text-white font-black text-[13px] uppercase tracking-wider leading-none">IELTS</span>
                        <span class="text-white font-black text-[42px] leading-none">6.5</span>
                        <span class="text-white/80 font-bold text-[13px]">& above</span>
                    </div>

                    {{-- Progress steps --}}
                    @php
                    $bands = [
                        ['0 – 3.5',   'Nền tảng',  'from-orange-200 to-orange-300', 'w-full'],
                        ['3.5 – 4.5', 'Cơ bản',    'from-orange-300 to-orange-400', 'w-5/6'],
                        ['4.5 – 5.5', 'Trung cấp', 'from-orange-400 to-orange-500', 'w-4/6'],
                        ['5.5 – 6.5+','Nâng cao',  'from-orange-500 to-red-500',    'w-3/6'],
                    ];
                    @endphp
                    <div class="space-y-2.5">
                        @foreach($bands as $i => [$band, $level, $grad, $w])
                        <div class="flex items-center gap-3">
                            <div class="h-7 {{ $w }} rounded-full bg-gradient-to-r {{ $grad }} flex items-center px-3 shadow-sm" style="animation: hsLevelFloat {{ 2.6 + $i * 0.3 }}s ease-in-out {{ $i * 0.2 }}s infinite;">
                                <span class="text-white font-black text-[11px] whitespace-nowrap">{{ $band }}</span>
                            </div>
                            <span class="text-gray-500 text-[11px] font-semibold shrink-0">{{ $level }}</span>
                        </div>
                        @endforeach
                        <div class="flex items-center gap-3 mt-1">
                            <div class="h-7 w-2/6 rounded-full bg-gradient-to-r from-orange-500 to-red-600 flex items-center px-3 shadow-md" style="animation: hsLevelFloat 3.8s ease-in-out .8s infinite;">
                                <span class="text-white font-black text-[11px] whitespace-nowrap">Cấp tốc</span>
                            </div>
                            <span class="text-gray-500 text-[11px] font-semibold shrink-0">Chạy nước rút</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
