{{-- resources/views/home/sections/khoa-hoc/muc-tieu.blade.php --}}
<section class="relative overflow-hidden bg-surface-alt py-10 lg:py-28">

    <div class="absolute inset-0 pointer-events-none"
         style="background-image: radial-gradient(rgba(249,115,22,.2) 1px, transparent 1px); background-size: 30px 30px; opacity:.25;"></div>

    <div class="relative max-w-7xl mx-auto px-5 lg:px-16">

        {{-- Header --}}
        <div class="text-center mb-6 lg:mb-14 reveal">
            <div class="inline-flex items-center gap-3 mb-5">
                <div class="h-[2px] w-6 lg:w-10 bg-primary-container rounded-full"></div>
                <div class="bg-primary-container rounded-full px-4 py-2 lg:px-8 lg:py-3">
                    <h2 class="text-white font-black text-base lg:text-2xl uppercase tracking-wide">Mục Tiêu Đào Tạo</h2>
                </div>
                <div class="h-[2px] w-6 lg:w-10 bg-primary-container rounded-full"></div>
            </div>
            <p class="hidden lg:block text-gray-800 font-semibold text-lg">Định hướng phát triển toàn diện <span class="text-orange-500">&mdash;</span> từng bước chinh phục tiếng Anh</p>
        </div>

        @php
        $goals = [
            ['01', 'menu_book',         'Nền tảng vững chắc',   'Xây dựng nền tảng vững chắc với 6.000+ từ vựng, hàng trăm cấu trúc câu phổ biến trong học tập và cuộc sống.',                                      'from-orange-400 to-orange-600'],
            ['02', 'record_voice_over', '4 kỹ năng toàn diện',  'Phát triển toàn diện 4 kỹ năng Nghe – Nói – Đọc – Viết, luyện phát âm chuẩn, tăng phản xạ và thuyết trình tự tin.',                              'from-amber-400 to-orange-500'],
            ['03', 'workspace_premium', 'Chứng chỉ quốc tế',    'Chuẩn bị cho kỳ thi Cambridge (Starters, Movers, Flyers, KET, PET, IELTS), đạt điểm cao với phương pháp luyện thi hiệu quả.',                    'from-orange-500 to-red-500'],
            ['04', 'chat',              'Giao tiếp tự tin',      'Cải thiện kỹ năng giao tiếp qua tình huống thực tế, tự tin trò chuyện với giáo viên bản ngữ và bạn bè quốc tế.',                                'from-orange-400 to-amber-600'],
            ['05', 'psychology',        'Tư duy phản biện',      'Rèn luyện tư duy phản biện, kỹ năng suy luận và tư duy logic bằng tiếng Anh, hỗ trợ học tập ở các cấp độ cao hơn.',                            'from-amber-500 to-orange-600'],
            ['06', 'language',          'Mục tiêu IELTS 6.0+',  'Hướng đến mục tiêu IELTS 6.0+, tạo lợi thế du học và cơ hội nghề nghiệp trong môi trường quốc tế.',                                             'from-orange-500 to-red-400'],
        ];
        @endphp

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-3 lg:gap-7">
            @foreach($goals as $i => [$num, $icon, $title, $desc, $grad])
            @php $delay = ['', 'reveal-delay-1', 'reveal-delay-2', '', 'reveal-delay-1', 'reveal-delay-2'][$i]; @endphp
            <div class="mt-card reveal {{ $delay }} group bg-white rounded-3xl overflow-hidden border border-gray-200 flex flex-col">

                {{-- Gradient strip --}}
                <div class="h-1.5 bg-gradient-to-r {{ $grad }}"></div>

                <div class="p-4 lg:p-7 flex-1 flex flex-col">
                    {{-- Icon row --}}
                    <div class="flex items-start justify-between mb-3 lg:mb-5">
                        <div class="w-11 h-11 lg:w-14 lg:h-14 rounded-2xl bg-gradient-to-br {{ $grad }} flex items-center justify-center shadow-lg shadow-orange-500/20 group-hover:scale-110 transition-transform duration-300">
                            <span class="material-symbols-outlined ms-filled text-white text-[20px] lg:text-[26px]">{{ $icon }}</span>
                        </div>
                        <span class="text-[2.2rem] lg:text-[3.5rem] font-black leading-none text-gray-900/[0.05] select-none">{{ $num }}</span>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-on-background font-black text-[15px] lg:text-[16px] leading-snug mb-2 lg:mb-3">{{ $title }}</h3>

                    {{-- Body --}}
                    <p class="text-gray-500 text-[12.5px] lg:text-[13.5px] leading-relaxed flex-1">{{ $desc }}</p>
                </div>

            </div>
            @endforeach
        </div>

    </div>
</section>
