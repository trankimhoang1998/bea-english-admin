{{-- resources/views/home/sections/luyen-thi-ielts/lo-trinh.blade.php --}}
<section class="relative overflow-hidden bg-surface-alt py-10 lg:py-28"
         x-data="{ openModal: null }"
         x-effect="document.body.style.overflow = openModal ? 'hidden' : ''"
         @keydown.escape.window="openModal = null">

    <div class="absolute inset-0 pointer-events-none"
         style="background-image: radial-gradient(rgba(249,115,22,.2) 1px, transparent 1px); background-size: 30px 30px; opacity:.25;"></div>

    <div class="relative max-w-7xl mx-auto px-5 lg:px-16">

        {{-- Header --}}
        <div class="text-center mb-4 reveal">
            <div class="inline-flex items-center gap-3 mb-5">
                <div class="h-[2px] w-6 lg:w-10 bg-primary-container rounded-full"></div>
                <div class="bg-primary-container rounded-full px-4 py-2 lg:px-8 lg:py-3">
                    <h2 class="lg:hidden text-white font-black text-base uppercase tracking-wide">Lộ Trình Khóa Học</h2>
                    <h2 class="hidden lg:block text-white font-black text-2xl uppercase tracking-wide">Lộ Trình Các Khóa Học Trong Chương Trình</h2>
                </div>
                <div class="h-[2px] w-6 lg:w-10 bg-primary-container rounded-full"></div>
            </div>
            <p class="text-gray-400 text-[13px] italic">* Click vào các khóa học để xem thông tin chi tiết</p>
        </div>

        @php
        $courses = [
            [
                'cefr'    => 'IELTS 0–3.5',
                'title'   => 'IELTS 0-3.5',
                'level'   => 'Nền tảng',
                'icon'    => 'school',
                'grad'    => 'from-orange-300 to-orange-500',
                'cardBg'  => 'bg-orange-50  border-orange-200',
                'desc'    => 'Khóa học dành cho học viên mới bắt đầu với IELTS, xây dựng nền tảng vững chắc từ ngữ pháp cơ bản đến từ vựng thiết yếu.',
                'goals'   => [
                    'Hệ thống hóa 36 chủ điểm ngữ pháp từ cơ bản đến nâng cao với phương pháp 6P-BeA',
                    'Xây dựng 1.500 từ vựng A1-A2 về các chủ đề quen thuộc trong cuộc sống',
                    'Học bảng phiên âm IPA (44 âm), ngữ điệu câu, nối âm, biến âm',
                    'Luyện phát âm chuẩn và giao tiếp thường xuyên với giáo viên',
                    'Làm quen với format cơ bản của bài thi IELTS',
                ],
                'noi_dung' => [
                    'Ngữ pháp (Grammar): Hệ thống hóa 36 chủ điểm ngữ pháp từ cơ bản đến nâng cao một cách hiệu quả với phương pháp 6P-BeA đã được chứng minh.',
                    'Từ vựng (Vocabulary): Xây dựng 1.500 từ vựng A1 – A2 (chuẩn Oxford) về các chủ đề quen thuộc áp dụng trong đời sống.',
                    'Phát âm (Pronunciation): Học bảng phiên âm IPA (44 âm), ngữ điệu câu, nối âm, biến âm.',
                    'Kỹ năng Nghe – Nói (Listening & Speaking): Luyện phát âm chuẩn và nói tự nhiên qua thực hành giao tiếp thường xuyên với giáo viên về các chủ đề cuộc sống.',
                ],
                'skills'  => ['Ngữ pháp cơ bản', 'Từ vựng thiết yếu', 'Phát âm chuẩn', 'Giao tiếp đơn giản'],
            ],
            [
                'cefr'    => 'IELTS 3.5–4.5',
                'title'   => 'IELTS 3.5-4.5',
                'level'   => 'Cơ bản',
                'icon'    => 'import_contacts',
                'grad'    => 'from-orange-400 to-orange-600',
                'cardBg'  => 'bg-orange-50  border-orange-300',
                'desc'    => 'Làm quen với các dạng câu hỏi cơ bản trong IELTS, phát triển kỹ năng Listening, Speaking, Reading và Writing từ mức độ cơ bản.',
                'goals'   => [
                    'Luyện tập các dạng câu hỏi phổ biến trong Listening như Note Completion, Multiple Choice',
                    'Phát triển kỹ năng Speaking Part 1 với phát âm chuẩn',
                    'Luyện Reading với các dạng True/False/Not Given, Note Completion',
                    'Làm quen với Writing Task 1: Line Graphs và Comparative Charts',
                    'Cải thiện nguyên âm, phụ âm, trọng âm cơ bản',
                ],
                'noi_dung' => [
                    'Kỹ năng Nghe (Listening): Luyện tập nghe các dạng câu hỏi phổ biến như Note Completion, Multiple Choice, Matching, Map Labeling.',
                    'Kỹ năng Nói (Speaking): Luyện tập trả lời các câu hỏi ngắn thuộc Speaking Part 1. Luyện phát âm với nguyên âm, phụ âm, trọng âm cơ bản.',
                    'Kỹ năng Đọc hiểu (Reading): Luyện đọc hiểu các dạng câu hỏi: True/False/Not Given, Note Completion, Matching Information.',
                    'Kỹ năng Viết (Writing): Làm quen với Line Graphs và Comparative Charts trong Task 1.',
                ],
                'skills'  => ['Listening cơ bản', 'Speaking Part 1', 'Reading hiểu đơn giản', 'Writing Task 1 cơ bản'],
            ],
            [
                'cefr'    => 'IELTS 4.5–5.5',
                'title'   => 'IELTS 4.5-5.5',
                'level'   => 'Trung cấp',
                'icon'    => 'emoji_events',
                'grad'    => 'from-orange-500 to-amber-600',
                'cardBg'  => 'bg-orange-50  border-orange-400',
                'desc'    => 'Nâng cao kỹ năng IELTS lên trình độ trung cấp với các dạng bài phức tạp hơn và chiến lược làm bài hiệu quả.',
                'goals'   => [
                    'Luyện Listening nâng cao với Matching Heading, Map Labeling, Multiple Choice',
                    'Phát triển Speaking Part 1 & 2 với kỹ năng trình bày và phát âm nâng cao',
                    'Thành thạo Reading Passage 2 & 3 với các dạng câu hỏi khó',
                    'Viết Writing Task 1 (Process, Maps) và Task 2 (Discussion, Opinion)',
                    'Cải thiện nối âm, ngắt nghỉ, trọng âm từ và câu',
                ],
                'noi_dung' => [
                    'Kỹ năng Nghe (Listening): Luyện tập nghe nâng cao với các dạng bài: Matching Heading, Map Labeling, Multiple Choice.',
                    'Kỹ năng Nói (Speaking): Luyện tập trình bày về người, địa điểm, sự kiện, đồ vật tại Speaking Part 1, Part 2. Luyện phát âm nâng cao: Nối âm, ngắt nghỉ, trọng âm từ và câu.',
                    'Kỹ năng Đọc hiểu (Reading): Luyện tập đọc hiểu Passage 2: Finding Information, Matching Headings. Passage 3: Summary Completion.',
                    'Kỹ năng Viết (Writing): Task 1: Làm quen với Process và Maps. Task 2: Viết bài luận với các dạng Discussion, Opinion.',
                ],
                'skills'  => ['Listening nâng cao', 'Speaking Part 1&2', 'Reading Passage 2&3', 'Writing Task 1&2 cơ bản'],
            ],
            [
                'cefr'    => 'IELTS 5.5–6.5+',
                'title'   => 'IELTS 5.5-6.5+',
                'level'   => 'Nâng cao',
                'icon'    => 'workspace_premium',
                'grad'    => 'from-orange-500 to-red-500',
                'cardBg'  => 'bg-orange-50  border-orange-500',
                'desc'    => 'Đạt band điểm cao trong IELTS với các kỹ thuật nâng cao và luyện tập intensive trên các phần khó nhất.',
                'goals'   => [
                    'Thành thạo Listening Section 3 & 4 với tốc độ nghe cao',
                    'Phát triển Speaking Part 3 với tiêu chí Fluency, Coherence, Lexical Resource',
                    'Hoàn thành tất cả dạng câu hỏi Reading Passage 3',
                    'Viết thành thạo Writing Task 1 (Mixed Charts, Maps) và Task 2 (Problems/Solutions)',
                    'Hoàn thiện phát âm: âm cuối, giảm âm, thanh điệu',
                ],
                'noi_dung' => [
                    'Kỹ năng Nghe (Listening): Luyện tập bài khó: Section 3 và Section 4. Tăng tốc độ nghe hiểu với bài tập thực tế.',
                    'Kỹ năng Nói (Speaking): Speaking Part 3: Phát triển ý tưởng với tiêu chí Fluency & Coherence, Lexical Resource, Grammatical Range & Accuracy. Luyện phát âm: Âm cuối, giảm âm, thanh điệu.',
                    'Kỹ năng Đọc hiểu (Reading): Passage 3: Tổng hợp tất cả các dạng câu hỏi.',
                    'Kỹ năng Viết (Writing): Task 1: Hoàn thiện các dạng bài Mixed Charts, Maps. Task 2: Luyện viết Problems and Solutions, Two-part Questions.',
                ],
                'skills'  => ['Listening Section 3&4', 'Speaking Part 3 nâng cao', 'Reading Passage 3 hoàn chỉnh', 'Writing Task 1&2 nâng cao'],
            ],
            [
                'cefr'    => 'IELTS Cấp Tốc',
                'title'   => 'IELTS cấp tốc',
                'level'   => 'Chạy nước rút',
                'icon'    => 'timer',
                'grad'    => 'from-red-500   to-red-700',
                'cardBg'  => 'bg-red-50      border-red-300',
                'desc'    => 'Khóa học IELTS cấp tốc chạy đua nước rút dành cho các học viên gần tới ngày thi, tập trung cải thiện điểm yếu và tối ưu điểm số.',
                'goals'   => [
                    'Căn cứ vào trình độ học viên để tập trung cải thiện các điểm yếu',
                    'Luyện 32 đề hoàn chỉnh 4 kỹ năng: Nghe - Nói - Đọc - Viết',
                    'Tăng cường kỹ năng Speaking với 9 buổi luyện tập chuyên sâu',
                    'Cải thiện Writing với 3 buổi luyện tập tập trung',
                    'Ôn tập chiến lược và tránh các bẫy thường gặp',
                ],
                'noi_dung' => [
                    'Căn cứ vào trình độ của học viên để tập trung cải thiện các điểm yếu, tăng tối đa band điểm.',
                    'Luyện 32 đề hoàn chỉnh 4 kỹ năng: Nghe - Nói - Đọc - Viết',
                    '9 buổi giải đề tăng cường kỹ năng Nói, 3 buổi giải đề tăng cường kỹ năng Viết',
                    'Ôn tập chiến lược, nhắc nhở các bẫy thường gặp, giúp học viên tăng phản xạ, tự tin khi vào phòng thi.',
                ],
                'skills'  => ['Intensive Practice', 'Strategic Review', 'Speaking Enhancement', 'Writing Improvement', 'Test Confidence'],
            ],
        ];
        @endphp

        {{-- MOBILE: 2-col grid --}}
        <div class="grid grid-cols-2 gap-2.5 lg:hidden reveal">
            @foreach($courses as $i => $course)
            <div class="lt-ielts-card group {{ $course['cardBg'] }} border rounded-2xl p-3 cursor-pointer flex flex-col items-center text-center {{ $i === 4 ? 'col-span-2 max-w-xs mx-auto w-full' : '' }}"
                 @click="openModal = '{{ $course['cefr'] }}'">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br {{ $course['grad'] }} flex items-center justify-center mb-2 shadow-md shadow-orange-400/25 group-hover:scale-110 transition-transform duration-300">
                    <span class="material-symbols-outlined ms-filled text-white text-[20px]">{{ $course['icon'] }}</span>
                </div>
                <span class="text-primary-container font-black text-[13px] leading-tight mb-0.5">{{ $course['cefr'] }}</span>
                <span class="text-gray-500 text-[11px]">{{ $course['level'] }}</span>
            </div>
            @endforeach
        </div>

        {{-- DESKTOP: single row with arrows --}}
        <div class="hidden lg:block pt-4 reveal">
            <div class="flex items-stretch justify-center gap-3">
                @foreach($courses as $i => $course)
                <div class="lt-ielts-card group {{ $course['cardBg'] }} border rounded-3xl p-6 cursor-pointer flex flex-col items-center text-center flex-1 max-w-[220px]"
                     style="animation: hsLevelFloat {{ 3 + $i * 0.3 }}s ease-in-out {{ $i * 0.2 }}s infinite;"
                     @click="openModal = '{{ $course['cefr'] }}'">

                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br {{ $course['grad'] }} flex items-center justify-center mb-5 shadow-xl shadow-orange-400/30 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined ms-filled text-white text-[40px]">{{ $course['icon'] }}</span>
                    </div>

                    <span class="text-primary-container font-black text-[15px] leading-tight mb-1">{{ $course['cefr'] }}</span>
                    <div class="h-[2px] w-8 bg-primary-container/30 rounded-full mb-2"></div>
                    <span class="text-gray-500 text-[13px] font-semibold">{{ $course['level'] }}</span>

                </div>
                @if(!$loop->last)
                <div class="flex items-center shrink-0 text-orange-400 self-center">
                    <span class="material-symbols-outlined text-[24px]">arrow_forward</span>
                </div>
                @endif
                @endforeach
            </div>
        </div>

        {{-- Course detail modals (fixed overlay, inside Alpine scope) --}}
        @foreach($courses as $course)
        @include('home.sections.shared.course-modal', ['course' => $course])
        @endforeach

    </div>
</section>
