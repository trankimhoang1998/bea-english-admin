{{-- resources/views/home/partials/free-trial.blade.php --}}
<section id="about" class="py-12 lg:py-24 bg-surface-alt">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Title pill --}}
        <div class="flex items-center justify-center gap-3 mb-10 reveal">
            <div class="h-[2px] flex-1 max-w-[60px] sm:max-w-[80px] bg-primary-container rounded-full shrink-0"></div>
            <div class="bg-primary-container rounded-full px-6 sm:px-10 py-3 sm:py-4 text-center">
                <h2 class="text-white font-black text-base sm:text-xl lg:text-2xl uppercase tracking-wide leading-snug">
                    Học Thử Trải Nghiệm Miễn Phí
                </h2>
            </div>
            <div class="h-[2px] flex-1 max-w-[60px] sm:max-w-[80px] bg-primary-container rounded-full shrink-0"></div>
        </div>

        {{-- Feature 2×2 --}}
        <div class="grid sm:grid-cols-2 gap-3 mb-4">
            @foreach([
                ['online_prediction', '6P-BeA',                    'Phương pháp đào tạo tiếng anh hiệu quả', 'tiến bộ sau từng buổi học.'],
                ['supervisor_account','Cá nhân hóa lộ trình học',  'dựa trên trình độ, mục tiêu và tốc độ tiếp thu của học viên.', ''],
                ['manage_search',     'Phát triển tư duy nói',     'phản xạ giao tiếp như người bản ngữ.', ''],
                ['school',            'Chương trình học gắn trực tiếp', 'với đời sống, học tập và công việc.', ''],
            ] as [$icon, $highlight, $text, $text2])
            <div class="flex items-start gap-3 bg-white rounded-2xl px-4 sm:px-6 py-4 sm:py-5 shadow-sm border border-gray-100 reveal">
                <div class="shrink-0 w-11 h-11 rounded-full bg-primary-container flex items-center justify-center shadow-md shadow-primary-container/25">
                    <span class="material-symbols-outlined ms-filled text-white text-[20px]">{{ $icon }}</span>
                </div>
                <p class="text-[14px] text-gray-600 leading-relaxed pt-1">
                    <span class="font-bold text-primary-container">{{ $highlight }}</span>{{ $text ? ', ' . $text : '' }}{{ $text2 ? ' ' . $text2 : '' }}
                </p>
            </div>
            @endforeach
        </div>

        {{-- Callout --}}
        <div class="flex items-start gap-3 bg-gray-100 rounded-2xl px-4 sm:px-6 py-4 sm:py-5 mb-8 border-l-4 border-primary-container reveal">
            <span class="material-symbols-outlined ms-filled text-primary-container text-[24px] shrink-0 mt-0.5">chevron_right</span>
            <p class="text-[15px] text-gray-700 leading-relaxed">
                Tham gia ngay <span class="font-bold text-primary-container">"Buổi học thử miễn phí"</span> với giáo viên nước ngoài của BeA English để trải nghiệm phương pháp học tiếng Anh hiệu quả và nhận ngay các phần quà thiết thực.
            </p>
        </div>

        {{-- Gift cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-7">
            @foreach([
                ['VOUCHER',           'Giảm học phí trực tiếp',     '300.000 VNĐ'],
                ['BỘ PHẦN MỀM OXFORD','Luyện ngữ pháp (5 cấp độ)', '4.000.000 VNĐ'],
                ['BỘ TÀI LIỆU, VIDEO','Rèn luyện 4 kỹ năng',       '2.000.000 VNĐ'],
            ] as $idx => [$name, $desc, $price])
            <div class="bg-primary-container rounded-2xl px-5 sm:px-6 py-5 sm:py-7
                        sm:flex-col flex items-center sm:items-start gap-4 sm:gap-0
                        reveal reveal-delay-{{ $idx + 1 }}">
                <div class="sm:mb-0 min-w-[120px] sm:min-w-0">
                    <p class="text-white font-bold text-xs sm:text-sm uppercase tracking-wide mb-1 sm:mb-2">{{ $name }}</p>
                    <p class="text-white/80 text-xs sm:text-sm sm:mb-4">{{ $desc }}</p>
                </div>
                <p class="text-white font-black text-[1.4rem] sm:text-[1.7rem] leading-none ml-auto sm:ml-0">{{ $price }}</p>
            </div>
            @endforeach
        </div>

        {{-- CTA button --}}
        <div class="text-center">
            <a href="{{ route('home.gioi-thieu') }}#contact"
               class="inline-flex items-center gap-2 px-7 sm:px-10 py-3 sm:py-4 rounded-full border-2 border-primary-container text-primary-container font-bold text-sm uppercase tracking-widest hover:bg-primary-container hover:text-white transition-all duration-300 animate-zoom-pulse">
                Học thử miễn phí
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>

    </div>
</section>
