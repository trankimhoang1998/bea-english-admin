{{-- resources/views/home/partials/programs.blade.php --}}
<section id="programs" class="bg-white py-14 lg:py-24 overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Title pill --}}
        <div class="flex items-center justify-center gap-3 mb-16 reveal">
            <div class="h-[2px] flex-1 max-w-[60px] sm:max-w-[80px] bg-primary-container rounded-full shrink-0"></div>
            <div class="bg-primary-container rounded-full px-6 sm:px-10 py-3 sm:py-4 text-center">
                <h2 class="text-white font-black text-base sm:text-xl lg:text-2xl uppercase tracking-wide leading-snug">
                    Các Chương Trình Học Tại BEA English
                </h2>
            </div>
            <div class="h-[2px] flex-1 max-w-[60px] sm:max-w-[80px] bg-primary-container rounded-full shrink-0"></div>
        </div>

        {{-- ===== PHẦN 1: HỌC SINH ===== --}}
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center mb-16 lg:mb-24 reveal">

            {{-- Content --}}
            <div class="order-2 lg:order-1">
                <div class="inline-flex items-center gap-2 bg-primary-container/10 rounded-full px-4 py-1.5 mb-5">
                    <span class="material-symbols-outlined ms-filled text-primary-container text-[16px]">school</span>
                    <span class="text-sm font-semibold text-primary-container uppercase tracking-wide">Dành cho học sinh</span>
                </div>
                <h3 class="text-2xl lg:text-[1.9rem] font-black text-primary-container uppercase leading-tight mb-4">
                    Các Khóa Học Tiếng Anh<br>Cho Học Sinh
                </h3>
                <p class="text-gray-500 text-[15px] leading-relaxed mb-7">
                    Chương trình toàn diện bám sát khung chuẩn Cambridge Young Learners và CEFR, giúp học sinh từ 6–18 tuổi làm chủ tiếng Anh và tự tin bước ra thế giới.
                </p>
                <div class="divide-y divide-gray-100 mb-8">
                    @foreach([
                        ['menu_book',     'Chương trình gồm 10 khóa học',                            'Nội dung giáo trình giảng dạy bám sát khung chuẩn Cambridge Young Learners và phù hợp với khung tham chiếu ngôn ngữ chung châu Âu CEFR.'],
                        ['task_alt',      'Phát triển toàn diện 4 kỹ năng Nghe – Nói – Đọc – Viết', 'Luyện phát âm chuẩn, tăng phản xạ giao tiếp và thuyết trình tự tin. Rèn luyện tư duy phản biện, kỹ năng suy luận bằng tiếng Anh, hỗ trợ học tập ở các cấp độ cao hơn.'],
                        ['verified_user', 'Xây dựng nền tảng vững chắc với 6.000+ từ vựng',         'Hàng trăm cấu trúc câu phổ biến, sử dụng hàng ngày trong học tập và cuộc sống.'],
                        ['star',          'Chuẩn bị cho kỳ thi Cambridge',                           'Đạt điểm cao với phương pháp luyện thi hiệu quả. Hướng đến mục tiêu IELTS 6.0+, tạo lợi thế du học và cơ hội phát triển trong môi trường quốc tế.'],
                    ] as [$icon, $bold, $text])
                    <div class="group flex gap-4 py-4 px-3 -mx-3 rounded-2xl transition-colors duration-300 hover:bg-primary-container/5">
                        <div class="shrink-0 w-10 h-10 rounded-xl bg-primary-container/10 flex items-center justify-center mt-0.5 transition-transform duration-300 group-hover:scale-110">
                            <span class="material-symbols-outlined ms-filled text-primary-container text-[20px]">{{ $icon }}</span>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-[14px] mb-1 transition-colors duration-300 group-hover:text-primary-container">{{ $bold }}</p>
                            <p class="text-[13px] text-gray-500 leading-relaxed">{{ $text }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('home.khoa-hoc') }}"
                   class="inline-flex items-center gap-2 px-7 py-3 rounded-full border-2 border-primary-container text-primary-container font-bold text-sm uppercase tracking-wide hover:bg-primary-container hover:text-white transition-all duration-300 animate-float-cta">
                    Xem chi tiết
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
            </div>

            {{-- Visual panel: Skill Dashboard --}}
            <div class="order-1 lg:order-2 rounded-3xl overflow-hidden shadow-xl border border-gray-100 flex flex-col bg-white">
                {{-- Header --}}
                <div class="bg-primary-container px-6 py-4 flex items-center gap-3 shrink-0">
                    <span class="material-symbols-outlined ms-filled text-white text-[22px]">school</span>
                    <span class="text-white font-black text-[15px] uppercase tracking-wide">Khóa Học Tiếng Anh Học Sinh</span>
                </div>
                <div class="flex-1 p-6 flex flex-col gap-6">
                    {{-- 4 Skill circles --}}
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-5">Phát triển 4 kỹ năng</p>
                        <div class="grid grid-cols-4 gap-2">
                            @foreach(['Nghe' => 88, 'Nói' => 85, 'Đọc' => 90, 'Viết' => 82] as $skill => $pct)
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-16 h-16 rounded-full flex items-center justify-center"
                                     style="background: conic-gradient(#f97316 0% {{ $pct }}%, #fed7aa {{ $pct }}% 100%);">
                                    <div class="w-11 h-11 rounded-full bg-white flex items-center justify-center">
                                        <span class="text-[11px] font-black text-primary-container">{{ $pct }}%</span>
                                    </div>
                                </div>
                                <span class="text-[12px] font-semibold text-gray-600">{{ $skill }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- Stats --}}
                    <div class="grid grid-cols-3 gap-3">
                        @foreach([['10', 'Khóa học'], ['6.000+', 'Từ vựng'], ['6–18', 'Tuổi']] as [$num, $label])
                        <div class="bg-orange-50 rounded-2xl p-3 text-center">
                            <div class="text-xl lg:text-2xl font-black text-primary-container leading-none mb-1">{{ $num }}</div>
                            <div class="text-[11px] text-gray-500">{{ $label }}</div>
                        </div>
                        @endforeach
                    </div>
                    {{-- Achievement chips --}}
                    <div class="flex flex-wrap gap-2">
                        @foreach(['Cambridge YL', 'CEFR', 'IELTS Ready'] as $badge)
                        <span class="inline-flex items-center gap-1.5 bg-primary-container/10 text-primary-container rounded-full px-3 py-1.5 text-xs font-semibold">
                            <span class="material-symbols-outlined ms-filled text-[14px]">verified</span>{{ $badge }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Divider --}}
        <div class="relative flex items-center gap-4 mb-16 lg:mb-24">
            <div class="flex-1 h-px bg-gray-100"></div>
            <div class="w-2 h-2 rounded-full bg-primary-container/30 shrink-0"></div>
            <div class="w-3 h-3 rounded-full bg-primary-container/50 shrink-0"></div>
            <div class="w-2 h-2 rounded-full bg-primary-container/30 shrink-0"></div>
            <div class="flex-1 h-px bg-gray-100"></div>
        </div>

        {{-- ===== PHẦN 2: NGƯỜI LỚN ===== --}}
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center reveal">

            {{-- Visual panel: Level Progression Dashboard --}}
            <div class="rounded-3xl overflow-hidden shadow-xl border border-gray-100 flex flex-col bg-white">
                {{-- Header --}}
                <div class="bg-primary-container px-6 py-4 flex items-center gap-3 shrink-0">
                    <span class="material-symbols-outlined ms-filled text-white text-[22px]">person</span>
                    <span class="text-white font-black text-[15px] uppercase tracking-wide">Khóa Học Tiếng Anh Người Lớn</span>
                </div>
                <div class="flex-1 p-6 flex flex-col gap-6">
                    {{-- Level progress bars --}}
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-5">Lộ trình học 04 cấp độ</p>
                        <div class="space-y-4">
                            @foreach([
                                ['A1–A2', 'Cơ bản',     100, true],
                                ['B1',    'Trung cấp',    72, false],
                                ['B2',    'Nâng cao',     40, false],
                                ['C1',    'Thành thạo',   12, false],
                            ] as [$code, $label, $pct, $done])
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-black px-2 py-0.5 rounded-md {{ $done ? 'bg-primary-container text-white' : 'bg-primary-container/10 text-primary-container' }}">{{ $code }}</span>
                                        <span class="text-[13px] font-semibold text-gray-700">{{ $label }}</span>
                                        @if($done)
                                        <span class="material-symbols-outlined ms-filled text-primary-container text-[16px]">check_circle</span>
                                        @endif
                                    </div>
                                    <span class="text-xs font-bold text-primary-container">{{ $pct }}%</span>
                                </div>
                                <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full prog-bar" style="width:{{ $pct }}%;"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- Stats --}}
                    <div class="grid grid-cols-3 gap-3">
                        @foreach([['04', 'Cấp độ'], ['5.000+', 'Từ vựng'], ['A2–B2', 'CEFR']] as [$num, $label])
                        <div class="bg-orange-50 rounded-2xl p-3 text-center">
                            <div class="text-xl lg:text-2xl font-black text-primary-container leading-none mb-1">{{ $num }}</div>
                            <div class="text-[11px] text-gray-500">{{ $label }}</div>
                        </div>
                        @endforeach
                    </div>
                    {{-- Chips --}}
                    <div class="flex flex-wrap gap-2">
                        @foreach(['IELTS', 'TOEIC', 'VSTEP'] as $badge)
                        <span class="inline-flex items-center gap-1.5 bg-primary-container/10 text-primary-container rounded-full px-3 py-1.5 text-xs font-semibold">
                            <span class="material-symbols-outlined ms-filled text-[14px]">workspace_premium</span>{{ $badge }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Content --}}
            <div>
                <div class="inline-flex items-center gap-2 bg-primary-container/10 rounded-full px-4 py-1.5 mb-5">
                    <span class="material-symbols-outlined ms-filled text-primary-container text-[16px]">person</span>
                    <span class="text-sm font-semibold text-primary-container uppercase tracking-wide">Dành cho người lớn</span>
                </div>
                <h3 class="text-2xl lg:text-[1.9rem] font-black text-primary-container uppercase leading-tight mb-4">
                    Các Khóa Học Tiếng Anh<br>Cho Người Lớn
                </h3>
                <p class="text-gray-500 text-[15px] leading-relaxed mb-7">
                    04 cấp độ từ cơ bản đến nâng cao, phù hợp người mới bắt đầu lẫn người muốn nâng cao toàn diện, lịch học linh hoạt theo nhu cầu.
                </p>
                <div class="divide-y divide-gray-100 mb-8">
                    @foreach([
                        ['auto_awesome', 'Chương trình gồm 04 cấp độ với 10 khóa học chuyên sâu',       'Phù hợp cả với người mới bắt đầu và người muốn học nâng cao toàn diện.'],
                        ['timer',        'Phát triển toàn diện 4 kỹ năng Nghe – Nói – Đọc – Viết',      'Rèn luyện phát âm và ngữ điệu chuẩn xác, nâng cao khả năng nghe hiểu, giúp phản xạ nhanh trong hội thoại công việc và giao tiếp hàng ngày.'],
                        ['menu_book',   'Tích lũy lên đến 5.000+ từ vựng thông dụng',                   'Về các chủ đề xung quanh cuộc sống và công việc thường ngày. Làm chủ hàng trăm cấu trúc câu phổ biến trong giao tiếp, giúp bạn tự tin bắt đầu và duy trì cuộc trò chuyện.'],
                        ['star',        'Cam kết chuẩn đầu ra theo khung CEFR từ A2 đến B2',            'Hướng đến mục tiêu chinh phục các kỳ thi IELTS, TOEIC, VSTEP... tạo lợi thế du học và cơ hội nghề nghiệp trong môi trường quốc tế.'],
                    ] as [$icon, $bold, $text])
                    <div class="group flex gap-4 py-4 px-3 -mx-3 rounded-2xl transition-colors duration-300 hover:bg-primary-container/5">
                        <div class="shrink-0 w-10 h-10 rounded-xl bg-primary-container/10 flex items-center justify-center mt-0.5 transition-transform duration-300 group-hover:scale-110">
                            <span class="material-symbols-outlined ms-filled text-primary-container text-[20px]">{{ $icon }}</span>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-[14px] mb-1 transition-colors duration-300 group-hover:text-primary-container">{{ $bold }}</p>
                            <p class="text-[13px] text-gray-500 leading-relaxed">{{ $text }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('home.nguoi-lon') }}"
                   class="inline-flex items-center gap-2 px-7 py-3 rounded-full border-2 border-primary-container text-primary-container font-bold text-sm uppercase tracking-wide hover:bg-primary-container hover:text-white transition-all duration-300 animate-float-cta">
                    Xem chi tiết
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
            </div>
        </div>

    </div>
</section>
