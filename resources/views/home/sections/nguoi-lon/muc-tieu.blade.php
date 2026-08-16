{{-- resources/views/home/sections/nguoi-lon/muc-tieu.blade.php --}}
<section class="relative overflow-hidden bg-surface-alt py-10 lg:py-28">

    <div class="absolute inset-0 pointer-events-none"
         style="background-image: radial-gradient(rgba(249,115,22,.2) 1px, transparent 1px); background-size: 30px 30px; opacity:.25;"></div>

    <div class="relative max-w-7xl mx-auto px-5 lg:px-16">

        <div class="text-center mb-6 lg:mb-14 reveal">
            <div class="inline-flex items-center gap-3 mb-5">
                <div class="h-[2px] w-6 lg:w-10 bg-primary-container rounded-full"></div>
                <div class="bg-primary-container rounded-full px-4 py-2 lg:px-8 lg:py-3">
                    <h2 class="text-white font-black text-base lg:text-2xl uppercase tracking-wide">Mục Tiêu Đào Tạo</h2>
                </div>
                <div class="h-[2px] w-6 lg:w-10 bg-primary-container rounded-full"></div>
            </div>
            <p class="hidden lg:block text-gray-800 font-semibold text-lg">Tiếng Anh thực chiến <span class="text-orange-500">&mdash;</span> phục vụ công việc và cuộc sống hằng ngày</p>
        </div>

        @php
        $goals = [
            ['01', 'menu_book',         'Tích lũy từ vựng phong phú',  'Tích lũy lên đến 5.000+ từ vựng thông dụng về các chủ đề xung quanh cuộc sống và công việc thường ngày.',               'from-orange-400 to-orange-600'],
            ['02', 'record_voice_over', 'Làm chủ cấu trúc câu',        'Làm chủ hàng trăm cấu trúc câu phổ biến trong giao tiếp, giúp bạn tự tin bắt đầu và duy trì cuộc trò chuyện.',           'from-amber-400 to-orange-500'],
            ['03', 'hearing',           'Nâng cao khả năng nghe',      'Nâng cao khả năng nghe hiểu lên đến 80%, phản xạ nhanh trong hội thoại công việc và giao tiếp hàng ngày.',               'from-orange-500 to-red-500'],
            ['04', 'spatial_audio_on',  'Phát âm chuẩn xác',           'Phát âm và ngữ điệu chuẩn xác 90%, giảm thiểu sự hiểu lầm trong giao tiếp.',                                            'from-orange-400 to-amber-600'],
            ['05', 'chat',              'Luyện nói 1:1 hiệu quả',      'Luyện nói 1:1 với giáo viên, tự tin phản xạ và trò chuyện trong đa dạng tình huống thực tế.',                            'from-amber-500 to-orange-600'],
            ['06', 'language',          'Chuẩn CEFR A2-B2',            'Đầu ra của chương trình tương đương chuẩn CEFR A2 đến B2.',                                                               'from-orange-500 to-red-400'],
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
