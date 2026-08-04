{{-- resources/views/home/partials/programs.blade.php --}}
<section id="programs" class="bg-white py-8 lg:py-24 overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Title pill --}}
        <div class="flex items-center justify-center gap-3 mb-6 lg:mb-16 reveal">
            <div class="h-[2px] flex-1 max-w-[60px] sm:max-w-[80px] bg-primary-container rounded-full shrink-0"></div>
            <div class="bg-primary-container rounded-full px-4 lg:px-10 py-2 lg:py-4 text-center">
                <h2 class="lg:hidden text-white font-black text-base uppercase tracking-wide leading-snug">
                    Học Tại BEA English
                </h2>
                <h2 class="hidden lg:block text-white font-black text-2xl uppercase tracking-wide leading-snug">
                    Các Chương Trình Học Tại BEA English
                </h2>
            </div>
            <div class="h-[2px] flex-1 max-w-[60px] sm:max-w-[80px] bg-primary-container rounded-full shrink-0"></div>
        </div>

        {{-- ===== PHẦN 1: HỌC SINH ===== --}}
        <div class="grid lg:grid-cols-2 gap-6 lg:gap-16 items-stretch mb-8 lg:mb-24 reveal">

            {{-- Content --}}
            <div class="order-2 lg:order-1">
                <div class="hidden lg:block">
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
                </div>
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
                    <span class="lg:hidden text-white font-black text-[15px] uppercase tracking-wide">Tiếng Anh Cho Học Sinh</span>
                    <span class="hidden lg:inline text-white font-black text-[15px] uppercase tracking-wide">Khóa Học Tiếng Anh Học Sinh</span>
                </div>
                <div class="flex-1 p-6 flex flex-col gap-6">
                    {{-- Illustration --}}
                    <div class="flex-1 rounded-2xl bg-primary-container/5 flex items-center justify-center px-4 pt-5">
                        <svg viewBox="0 0 300 200" class="w-full max-w-[260px] h-auto" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Học sinh học tiếng Anh trực tuyến">
                            <ellipse cx="150" cy="175" rx="120" ry="14" fill="#fed7aa" opacity="0.5"/>
                            <rect x="60" y="150" width="180" height="10" rx="5" fill="#fdba74"/>
                            <rect x="110" y="120" width="80" height="34" rx="6" fill="#f97316"/>
                            <rect x="118" y="86" width="64" height="46" rx="6" fill="#ffffff" stroke="#f97316" stroke-width="4"/>
                            <rect x="126" y="96" width="48" height="6" rx="3" fill="#fed7aa"/>
                            <rect x="126" y="108" width="34" height="6" rx="3" fill="#fed7aa"/>
                            <rect x="128" y="60" width="44" height="46" rx="18" fill="#fb923c"/>
                            <circle cx="150" cy="42" r="22" fill="#fdba74"/>
                            <path d="M130 38 a20 20 0 0 1 40 0" fill="none" stroke="#f97316" stroke-width="5" stroke-linecap="round"/>
                            <circle cx="130" cy="42" r="6" fill="#f97316"/>
                            <circle cx="170" cy="42" r="6" fill="#f97316"/>
                            <g transform="translate(220,50)">
                                <rect x="0" y="0" width="34" height="24" rx="3" fill="#ffffff" stroke="#f97316" stroke-width="3"/>
                                <line x1="17" y1="0" x2="17" y2="24" stroke="#f97316" stroke-width="3"/>
                            </g>
                            <g transform="translate(50,70)">
                                <path d="M12 0 L15 8 L24 8 L17 13 L19 22 L12 17 L5 22 L7 13 L0 8 L9 8 Z" fill="#fdba74"/>
                            </g>
                        </svg>
                    </div>
                    {{-- 4 Skill icons --}}
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-5">Phát triển 4 kỹ năng</p>
                        <div class="grid grid-cols-4 gap-2">
                            @foreach(['Nghe' => 'headphones', 'Nói' => 'record_voice_over', 'Đọc' => 'menu_book', 'Viết' => 'edit'] as $skill => $skillIcon)
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-12 h-12 rounded-full bg-primary-container/10 flex items-center justify-center">
                                    <span class="material-symbols-outlined ms-filled text-primary-container text-[20px]">{{ $skillIcon }}</span>
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
        <div class="relative flex items-center gap-4 mb-8 lg:mb-24">
            <div class="flex-1 h-px bg-gray-100"></div>
            <div class="w-2 h-2 rounded-full bg-primary-container/30 shrink-0"></div>
            <div class="w-3 h-3 rounded-full bg-primary-container/50 shrink-0"></div>
            <div class="w-2 h-2 rounded-full bg-primary-container/30 shrink-0"></div>
            <div class="flex-1 h-px bg-gray-100"></div>
        </div>

        {{-- ===== PHẦN 2: NGƯỜI LỚN ===== --}}
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-stretch reveal">

            {{-- Visual panel: Level Progression Dashboard --}}
            <div class="rounded-3xl overflow-hidden shadow-xl border border-gray-100 flex flex-col bg-white">
                {{-- Header --}}
                <div class="bg-primary-container px-6 py-4 flex items-center gap-3 shrink-0">
                    <span class="material-symbols-outlined ms-filled text-white text-[22px]">person</span>
                    <span class="lg:hidden text-white font-black text-[15px] uppercase tracking-wide">Tiếng Anh Cho Người Lớn</span>
                    <span class="hidden lg:inline text-white font-black text-[15px] uppercase tracking-wide">Khóa Học Tiếng Anh Người Lớn</span>
                </div>
                <div class="flex-1 p-6 flex flex-col gap-6">
                    {{-- Illustration --}}
                    <div class="flex-1 rounded-2xl bg-primary-container/5 flex items-center justify-center px-4 pt-5">
                        <svg viewBox="0 0 300 200" class="w-full max-w-[260px] h-auto" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Người lớn học tiếng Anh trực tuyến">
                            <ellipse cx="150" cy="175" rx="120" ry="14" fill="#fed7aa" opacity="0.5"/>
                            <rect x="60" y="150" width="180" height="10" rx="5" fill="#fdba74"/>
                            <rect x="110" y="120" width="80" height="34" rx="6" fill="#f97316"/>
                            <rect x="118" y="86" width="64" height="46" rx="6" fill="#ffffff" stroke="#f97316" stroke-width="4"/>
                            <rect x="126" y="96" width="48" height="6" rx="3" fill="#fed7aa"/>
                            <rect x="126" y="108" width="34" height="6" rx="3" fill="#fed7aa"/>
                            <path d="M128 106 L128 66 Q128 58 138 58 L162 58 Q172 58 172 66 L172 106 Z" fill="#78350f"/>
                            <path d="M150 58 L140 74 L150 90 L160 74 Z" fill="#ffffff"/>
                            <circle cx="150" cy="40" r="22" fill="#fdba74"/>
                            <path d="M129 34 a21 21 0 0 1 42 0 q0 -14 -21 -14 t-21 14" fill="#3f2a1a"/>
                            <g transform="translate(215,95)">
                                <rect x="0" y="6" width="40" height="28" rx="4" fill="#78350f"/>
                                <rect x="14" y="0" width="12" height="10" rx="2" fill="none" stroke="#78350f" stroke-width="3"/>
                                <rect x="0" y="18" width="40" height="4" fill="#fdba74"/>
                            </g>
                            <g transform="translate(48,68)">
                                <path d="M12 0 L15 8 L24 8 L17 13 L19 22 L12 17 L5 22 L7 13 L0 8 L9 8 Z" fill="#fdba74"/>
                            </g>
                        </svg>
                    </div>
                    {{-- Level badges --}}
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-5">Lộ trình học 04 cấp độ</p>
                        <div class="grid grid-cols-4 gap-2">
                            @foreach(['A1–A2', 'B1', 'B2', 'C1'] as $code)
                            <div class="flex items-center justify-center py-2.5 rounded-xl bg-primary-container/10">
                                <span class="text-[13px] font-black text-primary-container">{{ $code }}</span>
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
                <div class="hidden lg:block">
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
                </div>
                <div class="divide-y divide-gray-100 mb-8">
                    @foreach([
                        ['auto_awesome', 'Chương trình gồm 04 cấp độ với 10 khóa học chuyên sâu',       'Phù hợp cả với người mới bắt đầu và người muốn học nâng cao toàn diện.'],
                        ['timer',        'Phát triển toàn diện 4 kỹ năng Nghe – Nói – Đọc – Viết',      'Rèn luyện phát âm và ngữ điệu chuẩn xác, nâng cao khả năng nghe hiểu, giúp phản xạ nhanh trong hội thoại công việc và giao tiếp hàng ngày.'],
                        ['menu_book',   'Tích lũy lên đến 5.000+ từ vựng thông dụng',                   'Chủ đề xoay quanh cuộc sống và công việc thường ngày. Làm chủ hàng trăm cấu trúc câu phổ biến trong giao tiếp, giúp bạn tự tin bắt đầu và duy trì cuộc trò chuyện.'],
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
