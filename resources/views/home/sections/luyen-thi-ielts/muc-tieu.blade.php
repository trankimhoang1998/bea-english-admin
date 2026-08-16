{{-- resources/views/home/sections/luyen-thi-ielts/muc-tieu.blade.php --}}
<section class="relative overflow-hidden bg-white py-10 lg:py-28">

    <div class="absolute inset-0 pointer-events-none opacity-[.20]"
         style="background-image: radial-gradient(rgba(249,115,22,.25) 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="relative max-w-7xl mx-auto px-5 lg:px-16">

        <div class="text-center mb-6 lg:mb-14 reveal">
            <div class="inline-flex items-center gap-3 mb-5">
                <div class="h-[2px] w-6 lg:w-10 bg-primary-container rounded-full"></div>
                <div class="bg-primary-container rounded-full px-4 py-2 lg:px-8 lg:py-3">
                    <h2 class="text-white font-black text-base lg:text-2xl uppercase tracking-wide">Mục Tiêu Đào Tạo</h2>
                </div>
                <div class="h-[2px] w-6 lg:w-10 bg-primary-container rounded-full"></div>
            </div>
            <p class="hidden lg:block text-gray-800 font-semibold text-lg">Chinh phục IELTS toàn diện <span class="text-orange-500">&mdash;</span> 4 kỹ năng, đúng chiến lược, đúng mục tiêu</p>
        </div>

        @php
        $goals = [
            ['01', 'checklist',         'Hiểu rõ cấu trúc IELTS',          'Hiểu rõ cấu trúc đề thi IELTS, nắm vững cách làm từng dạng bài để tối ưu điểm số.',                                                         'from-orange-400 to-orange-600'],
            ['02', 'hearing',           'Thành thạo Listening & Reading',   'Thành thạo tất cả dạng câu hỏi Listening & Reading, cải thiện khả năng bắt thông tin nhanh, chính xác.',                                     'from-amber-400 to-orange-500'],
            ['03', 'edit_note',         'Nâng band điểm Writing',           'Nâng band điểm Writing, từ viết câu đơn đến bài luận 250+ từ với bố cục rõ ràng, lập luận chặt chẽ.',                                        'from-orange-500 to-red-500'],
            ['04', 'record_voice_over', 'Nâng band điểm Speaking',          'Nâng band điểm Speaking, trả lời mạch lạc, có tính liên kết, dùng từ vựng và ngữ pháp linh hoạt.',                                          'from-orange-400 to-amber-600'],
            ['05', 'spatial_audio_on',  'Cải thiện phát âm',                'Cải thiện phát âm & phản xạ nói, giúp giao tiếp trôi chảy, tự tin khi thi.',                                                                'from-amber-500 to-orange-600'],
            ['06', 'workspace_premium', 'Đạt band điểm mục tiêu',           'Đạt band điểm mục tiêu theo khóa học, với kết quả đo lường theo chuẩn bài thi thật.',                                                        'from-orange-500 to-red-400'],
        ];
        @endphp

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-3 lg:gap-7">
            @foreach($goals as $i => [$num, $icon, $title, $desc, $grad])
            @php $delay = ['', 'reveal-delay-1', 'reveal-delay-2', '', 'reveal-delay-1', 'reveal-delay-2'][$i]; @endphp
            <div class="mt-card reveal {{ $delay }} group bg-white rounded-3xl overflow-hidden border border-gray-200 flex flex-col">
                <div class="h-1.5 bg-gradient-to-r {{ $grad }}"></div>
                <div class="p-4 lg:p-7 flex-1 flex flex-col">
                    <div class="flex items-start justify-between mb-3 lg:mb-5">
                        <div class="w-11 h-11 lg:w-14 lg:h-14 rounded-2xl bg-gradient-to-br {{ $grad }} flex items-center justify-center shadow-lg shadow-orange-500/20 group-hover:scale-110 transition-transform duration-300">
                            <span class="material-symbols-outlined ms-filled text-white text-[20px] lg:text-[26px]">{{ $icon }}</span>
                        </div>
                        <span class="text-[2.2rem] lg:text-[3.5rem] font-black leading-none text-gray-900/[0.05] select-none">{{ $num }}</span>
                    </div>
                    <h3 class="text-on-background font-black text-[15px] lg:text-[16px] leading-snug mb-2 lg:mb-3">{{ $title }}</h3>
                    <p class="text-gray-500 text-[13.5px] lg:text-[14.5px] leading-relaxed flex-1">{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
