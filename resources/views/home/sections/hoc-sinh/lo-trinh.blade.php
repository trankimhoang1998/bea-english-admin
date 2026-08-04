{{-- resources/views/home/sections/hoc-sinh/lo-trinh.blade.php --}}
<section class="relative overflow-hidden bg-white py-20 lg:py-28"
         x-data="{ openModal: null }"
         x-effect="document.body.style.overflow = openModal ? 'hidden' : ''"
         @keydown.escape.window="openModal = null">

    <div class="absolute inset-0 pointer-events-none opacity-[.20]"
         style="background-image: radial-gradient(rgba(249,115,22,.25) 1px, transparent 1px); background-size: 30px 30px;"></div>
    <div class="absolute -top-40 -left-40 w-[500px] h-[500px] rounded-full pointer-events-none"
         style="background: radial-gradient(circle, rgba(249,115,22,.06) 0%, transparent 65%);"></div>

    <div class="relative max-w-7xl mx-auto px-5 lg:px-16">

        {{-- Header --}}
        <div class="text-center mb-10 reveal">
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
        $rows = [
            [
                'label'   => 'Cấp độ A',
                'desc'    => 'Tiền cơ bản → Sơ cấp nâng cao',
                'hasNext' => true,
                'items'   => [
                    [
                        'cefr'     => 'A1–',
                        'cert'     => 'Starters',
                        'en'       => 'Pre-Beginner',
                        'vi'       => 'Tiền cơ bản',
                        'grad'     => 'from-orange-300 to-orange-500',
                        'audience' => 'Độ tuổi/trình độ phù hợp: 6-7 tuổi hoặc học sinh mới bắt đầu, chỉ mới tiếp xúc và có những kiến thức cơ bản nhất về tiếng Anh',
                        'desc'     => 'Dựa trên những kỹ năng ban đầu, khóa học này giúp học sinh phát triển khả năng tiếng Anh, cho phép các em nói về những sự vật xung quanh và giao tiếp tự tin hơn. Thông qua những câu chuyện hấp dẫn, bài hát sôi động và các hoạt động luyện nói, học sinh sẽ hiểu sâu hơn về các chủ đề quen thuộc hằng ngày, từ lớp học đến những con vật mình yêu thích. Khóa học này bao gồm các ý tưởng nền tảng và chủ đề chính trong cấp độ 1 của chương trình. Học sinh sẽ được tiếp cận thêm từ vựng mới, mẫu câu mới và tiếp tục luyện âm chữ cái. Các bài hát vui nhộn và câu chuyện sinh động giúp việc học trở nên thú vị, kết hợp với hoạt động ôn tập thường xuyên và các bài kiểm tra đánh giá tiến độ toàn diện.',
                        'goals'    => [
                            'Phát triển khả năng tiếng Anh từ những kỹ năng ban đầu',
                            'Giao tiếp tự tin về những sự vật xung quanh',
                            'Hiểu sâu hơn về các chủ đề quen thuộc hằng ngày',
                            'Tiếp cận thêm từ vựng mới và mẫu câu mới',
                            'Luyện âm chữ cái thông qua hoạt động thú vị',
                        ],
                        'skills'   => ['Nghe hiểu câu chuyện đơn giản', 'Nói về sự vật xung quanh', 'Đọc hiểu từ vựng cơ bản', 'Viết từ và câu đơn giản'],
                    ],
                    [
                        'cefr'     => 'A1',
                        'cert'     => 'Movers',
                        'en'       => 'Beginner',
                        'vi'       => 'Cơ bản',
                        'grad'     => 'from-orange-400 to-orange-600',
                        'audience' => 'Độ tuổi/trình độ phù hợp: 7-8 tuổi hoặc đang có trình độ tiếng anh tương đương Starters A1–',
                        'desc'     => 'Khóa học này giúp học sinh cải thiện khả năng nói về cuộc sống hằng ngày và những gì xung quanh các em. Học sinh sẽ giao tiếp trôi chảy hơn khi thảo luận về các hoạt động thường nhật, nói giờ giấc, miêu tả ngoại hình hoặc cảm xúc của người khác, và tìm đường trong thành phố. Các hoạt động thú vị cùng nội dung hấp dẫn khiến việc học trở nên thực tế và đầy hứng thú.',
                        'goals'    => [
                            'Cải thiện khả năng nói về cuộc sống hằng ngày',
                            'Giao tiếp trôi chảy hơn về các hoạt động thường nhật',
                            'Nói về giờ giấc và miêu tả ngoại hình',
                            'Miêu tả cảm xúc của người khác',
                            'Tìm đường và chỉ dẫn trong thành phố',
                        ],
                        'skills'   => ['Nghe hiểu hội thoại đời thường', 'Nói về hoạt động hàng ngày', 'Đọc hiểu văn bản đơn giản', 'Viết mô tả ngắn'],
                    ],
                    [
                        'cefr'     => 'A1+',
                        'cert'     => 'Movers',
                        'en'       => 'Upper-Beginner',
                        'vi'       => 'Cơ bản nâng cao',
                        'grad'     => 'from-orange-400 to-orange-600',
                        'audience' => 'Độ tuổi/trình độ phù hợp: 8-9 tuổi hoặc đang có trình độ tiếng anh tương đương Movers A1',
                        'desc'     => 'Ở cấp độ này, học sinh bắt đầu chia sẻ ý tưởng chi tiết hơn và có những cuộc trò chuyện thú vị hơn. Khóa học giới thiệu từ vựng dùng để so sánh, các câu hỏi đơn giản về quyền sở hữu và động từ chỉ hành động đã xảy ra trong quá khứ. Nhờ đó, học sinh có thể mô tả chi tiết hơn về ngoại hình của sự vật, kể lại các sự việc đã qua và đưa ra chỉ dẫn đơn giản trong khu vực sống của mình.',
                        'goals'    => [
                            'Chia sẻ ý tưởng chi tiết hơn trong cuộc trò chuyện',
                            'Sử dụng từ vựng so sánh và câu hỏi về quyền sở hữu',
                            'Sử dụng động từ chỉ hành động trong quá khứ',
                            'Mô tả chi tiết về ngoại hình sự vật',
                            'Kể lại sự việc và đưa ra chỉ dẫn đơn giản',
                        ],
                        'skills'   => ['Nghe hiểu chi tiết hơn', 'Nói về quá khứ', 'Đọc hiểu chính xác', 'Viết mô tả chi tiết'],
                    ],
                    [
                        'cefr'     => 'A2',
                        'cert'     => 'Flyers',
                        'en'       => 'Elementary',
                        'vi'       => 'Sơ cấp',
                        'grad'     => 'from-orange-500 to-amber-600',
                        'audience' => 'Độ tuổi/trình độ phù hợp: 9-10 tuổi hoặc đang có trình độ tiếng anh tương đương Movers A1+',
                        'desc'     => 'Khóa học này giúp học sinh mở rộng kiến thức với nhiều chủ đề hơn, cho phép các em nói về những sự việc đang diễn ra trên thế giới, kể lại những chuyến phiêu lưu trong quá khứ và đưa ra lời khuyên về việc giữ gìn sức khỏe. Chương trình học giới thiệu các cấu trúc câu phức tạp hơn và từ vựng mới, giúp học sinh tự tin nói về hoạt động hằng ngày, khám phá lối sống ở các quốc gia khác nhau và hiểu được các ý tưởng liên quan đến thiên nhiên cũng như việc bảo vệ hành tinh của chúng ta.',
                        'goals'    => [
                            'Mở rộng kiến thức với nhiều chủ đề đa dạng',
                            'Nói về những sự việc đang diễn ra trên thế giới',
                            'Kể lại những chuyến phiêu lưu trong quá khứ',
                            'Đưa ra lời khuyên về việc giữ gìn sức khỏe',
                            'Khám phá lối sống ở các quốc gia khác nhau',
                        ],
                        'skills'   => ['Nghe hiểu tin tức đơn giản', 'Nói về nhiều chủ đề', 'Đọc hiểu bài văn phức tạp', 'Viết bài luận ngắn'],
                    ],
                    [
                        'cefr'     => 'A2+',
                        'cert'     => 'Flyers',
                        'en'       => 'Upper-Elementary',
                        'vi'       => 'Sơ cấp nâng cao',
                        'grad'     => 'from-orange-500 to-red-500',
                        'audience' => 'Độ tuổi/trình độ phù hợp: 10-11 tuổi hoặc đang có trình độ tiếng anh tương đương Flyers A2',
                        'desc'     => 'Khóa học này thử thách học sinh chia sẻ những ý tưởng nâng cao hơn, bao gồm cách miêu tả con người, cách bảo vệ môi trường và những điều các em hy vọng sẽ làm trong tương lai. Học viên sẽ học cách sử dụng "will" để nói về những điều mình nghĩ sẽ xảy ra, dùng "could" hoặc "couldn\'t" để kể về khả năng của mình khi còn nhỏ, và bắt đầu dùng các từ so sánh nhất để diễn đạt điều gì đó là "nhất" (như "cao nhất", "vui nhất"). Những kiến thức này giúp các em có thể trò chuyện phong phú và chi tiết hơn.',
                        'goals'    => [
                            'Chia sẻ những ý tưởng nâng cao hơn',
                            'Miêu tả con người và thảo luận về bảo vệ môi trường',
                            'Nói về những điều hy vọng sẽ làm trong tương lai',
                            'Sử dụng "will" để nói về tương lai',
                            'Sử dụng so sánh nhất để diễn đạt',
                        ],
                        'skills'   => ['Nghe hiểu chính xác', 'Nói về tương lai', 'Đọc hiểu sâu hơn', 'Viết bài có cấu trúc'],
                    ],
                ],
            ],
            [
                'label'   => 'Cấp độ B',
                'desc'    => 'Tiền trung cấp → Trung cấp nâng cao',
                'hasNext' => false,
                'items'   => [
                    [
                        'cefr'     => 'B1–',
                        'cert'     => 'Pioneer',
                        'en'       => 'Pre-Intermediate',
                        'vi'       => 'Tiền trung cấp',
                        'grad'     => 'from-orange-400 to-orange-600',
                        'audience' => 'Độ tuổi/trình độ phù hợp: 12-13 tuổi hoặc đang có trình độ tiếng anh tương đương Flyers A2+',
                        'desc'     => 'Đây là khóa học quan trọng trước khi vượt qua trình độ sơ cấp để tiến tới trình độ trung cấp, nơi giúp học sinh nâng cao trình độ tiếng Anh hơn nữa, chuẩn bị sẵn sàng để giao tiếp rõ ràng và tự tin và "chuyên nghiệp" hơn. Học sinh sẽ được học các cấu trúc ngữ pháp nâng cao hơn, như cách nói về những việc đã làm trong cuộc sống, hoặc mô tả hành động được thực hiện lên một đối tượng (bị động). Các em sẽ thảo luận về những vấn đề lớn trên thế giới, các sự kiện quan trọng trong quá khứ và cách đóng góp cho cộng đồng địa phương, giúp các em thành thạo toàn diện trong mọi kỹ năng tiếng Anh.',
                        'goals'    => [
                            'Sử dụng các cấu trúc ngữ pháp nâng cao hơn',
                            'Thảo luận về những vấn đề lớn trên thế giới',
                            'Kể về các sự kiện quan trọng trong quá khứ',
                            'Nói về cách đóng góp cho cộng đồng địa phương',
                            'Sử dụng câu bị động cơ bản',
                        ],
                        'skills'   => ['Nghe hiểu ý chính', 'Nói chuyên nghiệp hơn', 'Đọc phân tích cơ bản', 'Viết báo cáo ngắn'],
                    ],
                    [
                        'cefr'     => 'B1',
                        'cert'     => 'Pioneer',
                        'en'       => 'Intermediate',
                        'vi'       => 'Trung cấp',
                        'grad'     => 'from-orange-500 to-orange-700',
                        'audience' => 'Độ tuổi/trình độ phù hợp: 14-15 tuổi hoặc đang có trình độ tiếng anh tương đương Pioneer B1–',
                        'desc'     => 'Ở khóa học này, học sinh sẽ được giảng dạy, luyện tập để đủ khả năng giao tiếp hiệu quả trong nhiều tình huống quen thuộc. Viết được đoạn văn và thư/email mang tính cá nhân hoặc chức năng. Đọc hiểu nội dung chính của tin tức, bài báo đơn giản. Nói và trình bày quan điểm rõ ràng ở mức độ cơ bản.',
                        'goals'    => [
                            'Giao tiếp hiệu quả trong tình huống quen thuộc',
                            'Viết đoạn văn và thư/email mang tính cá nhân hoặc chức năng',
                            'Đọc hiểu nội dung chính của tin tức, bài báo đơn giản',
                            'Nói và trình bày quan điểm rõ ràng',
                            'Thảo luận về nhiều chủ đề đa dạng',
                        ],
                        'skills'   => ['Nghe hiểu ý kiến', 'Nói trình bày rõ ràng', 'Đọc báo chí', 'Viết email chuyên nghiệp'],
                    ],
                    [
                        'cefr'     => 'B1+',
                        'cert'     => 'Leader',
                        'en'       => 'High-Intermediate',
                        'vi'       => 'Cận trung cấp nâng cao',
                        'grad'     => 'from-orange-500 to-red-500',
                        'audience' => 'Độ tuổi/trình độ phù hợp: 15-16 tuổi hoặc đang có trình độ tiếng anh tương đương Pioneer B1',
                        'desc'     => 'Khóa học này sẽ giúp học sinh trình bày quan điểm mạch lạc, có lý do và ví dụ. Viết bài luận ngắn, có mở bài, thân bài, kết luận rõ ràng. Thảo luận các chủ đề xã hội cơ bản như sức khỏe, giáo dục, môi trường... Nghe hiểu phần lớn hội thoại và bài nói trong môi trường học tập hoặc công sở đơn giản.',
                        'goals'    => [
                            'Trình bày quan điểm mạch lạc, có lý do và ví dụ',
                            'Viết bài luận ngắn có cấu trúc rõ ràng',
                            'Thảo luận các chủ đề xã hội cơ bản',
                            'Nghe hiểu phần lớn hội thoại và bài nói',
                            'Đưa ra ví dụ và giải thích',
                        ],
                        'skills'   => ['Nghe hiểu chi tiết', 'Nói thuyết phục', 'Đọc phân tích', 'Viết luận ngắn'],
                    ],
                    [
                        'cefr'     => 'B2–',
                        'cert'     => 'Leader',
                        'en'       => 'Pre-Upper-Intermediate',
                        'vi'       => 'Tiền trung cấp nâng cao',
                        'grad'     => 'from-orange-500 to-red-600',
                        'audience' => 'Độ tuổi/trình độ phù hợp: 16-17 tuổi hoặc đang có trình độ tiếng anh tương đương Leader B1+',
                        'desc'     => 'Khóa học giúp học sinh tham gia thảo luận chuyên sâu với vốn từ học thuật cơ bản. Viết báo cáo, email công việc, bài luận học thuật có cấu trúc tốt. Nghe hiểu bài giảng, bài phỏng vấn dài. Phản xạ nhanh hơn và chính xác hơn trong giao tiếp học thuật.',
                        'goals'    => [
                            'Tham gia thảo luận chuyên sâu với từ vựng học thuật',
                            'Viết báo cáo và email công việc',
                            'Nghe hiểu bài giảng và phỏng vấn',
                            'Phản xạ nhanh trong giao tiếp',
                            'Sử dụng ngôn ngữ học thuật cơ bản',
                        ],
                        'skills'   => ['Nghe hiểu hàm ý', 'Nói học thuật', 'Đọc hiểu ngụ ý', 'Viết báo cáo'],
                    ],
                    [
                        'cefr'     => 'B2',
                        'en'       => 'Upper-Intermediate',
                        'vi'       => 'Trung cấp nâng cao',
                        'grad'     => 'from-red-500 to-red-700',
                        'audience' => 'Độ tuổi/trình độ phù hợp: 17-18 tuổi hoặc đang có trình độ tiếng anh tương đương Leader B2–',
                        'desc'     => 'Khóa học giúp học sinh giao tiếp trôi chảy và độc lập trong hầu hết tình huống. Hiểu các bài nói và bài viết có cấu trúc phức tạp. Viết luận mang tính phản biện rõ ràng. Trình bày, tranh luận, giải thích rõ ràng các ý tưởng trừu tượng hoặc học thuật.',
                        'goals'    => [
                            'Giao tiếp trôi chảy và độc lập',
                            'Hiểu văn bản có cấu trúc phức tạp',
                            'Viết luận phản biện',
                            'Trình bày và tranh luận',
                            'Giải thích ý tưởng trừu tượng',
                        ],
                        'skills'   => ['Nghe hiểu hoàn hảo', 'Nói lưu loát tự nhiên', 'Đọc hiểu sâu sắc', 'Viết học thuật chuyên nghiệp'],
                    ],
                ],
            ],
        ];
        @endphp

        @foreach($rows as $ri => $row)
        @php $revealDelay = $ri === 0 ? 'reveal' : 'reveal reveal-delay-1'; @endphp
        <div class="{{ $revealDelay }} mb-8 last:mb-0">

            {{-- Group label (mobile only) --}}
            <div class="flex items-center gap-3 mb-3 lg:hidden">
                <div class="h-8 w-1 rounded-full bg-gradient-to-b from-orange-400 to-red-500"></div>
                <div>
                    <span class="text-on-background font-black text-[14px]">{{ $row['label'] }}</span>
                    <span class="text-gray-400 text-[12px] ml-2">{{ $row['desc'] }}</span>
                </div>
            </div>

            {{-- MOBILE: 2-col grid --}}
            <div class="grid grid-cols-2 gap-2 lg:hidden">
                @foreach($row['items'] as $i => $item)
                <div class="lt-card group flex flex-col items-center bg-white border border-gray-200 rounded-2xl px-2 py-4 cursor-pointer relative"
                     @click="openModal = '{{ $item['cefr'] }}'">
                    <span class="absolute top-2 left-3 text-[10px] font-black text-gray-300 select-none">{{ str_pad($ri * 5 + $i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br {{ $item['grad'] }} flex flex-col items-center justify-center mb-2 shadow-md shadow-orange-400/25 group-hover:scale-110 transition-transform duration-300">
                        <span class="text-white font-black text-[14px] leading-none">{{ $item['cefr'] }}</span>
                        @if(!empty($item['cert']))
                        <span class="text-white/80 text-[9px] font-semibold mt-0.5">{{ $item['cert'] }}</span>
                        @endif
                    </div>
                    <span class="text-primary-container font-black text-[11px] text-center leading-tight mb-0.5">{{ $item['en'] }}</span>
                    <span class="text-gray-400 text-[10px] text-center">{{ $item['vi'] }}</span>
                </div>
                @endforeach
            </div>

            {{-- DESKTOP: horizontal flex with arrows --}}
            <div class="hidden lg:block pt-3 pb-1">
                <div class="flex items-center justify-center gap-2">
                    @foreach($row['items'] as $i => $item)
                    <div class="lt-card group flex flex-col items-center bg-white border border-gray-200 rounded-2xl px-6 py-8 w-[200px] cursor-pointer"
                         style="animation: hsLevelFloat {{ 2.8 + $i * 0.25 }}s ease-in-out {{ $ri * 0.1 + $i * 0.15 }}s infinite;"
                         @click="openModal = '{{ $item['cefr'] }}'">
                        <div class="w-24 h-24 rounded-full bg-gradient-to-br {{ $item['grad'] }} flex flex-col items-center justify-center mb-5 shadow-xl shadow-orange-400/30 group-hover:scale-110 transition-transform duration-300">
                            <span class="text-white font-black text-[20px] leading-none">{{ $item['cefr'] }}</span>
                            @if(!empty($item['cert']))
                            <span class="text-white/80 text-[11px] font-semibold mt-1">{{ $item['cert'] }}</span>
                            @endif
                        </div>
                        <span class="text-primary-container font-black text-[14px] text-center leading-tight mb-1">{{ $item['en'] }}</span>
                        <span class="text-gray-400 text-[12px] text-center">{{ $item['vi'] }}</span>
                    </div>
                    @if(!$loop->last)
                    <div class="shrink-0 text-orange-400">
                        <span class="material-symbols-outlined text-[24px]">arrow_forward</span>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>

            {{-- Mobile: arrow connecting rows --}}
            @if($row['hasNext'])
            <div class="flex justify-center mt-3 lg:hidden">
                <div class="flex flex-col items-center gap-1 text-orange-300">
                    <div class="w-[2px] h-4 bg-orange-200 rounded-full"></div>
                    <span class="material-symbols-outlined text-[20px]">arrow_downward</span>
                </div>
            </div>
            @endif

        </div>
        @endforeach

        {{-- Course detail modals (fixed overlay, inside Alpine scope) --}}
        @foreach($rows as $row)
            @foreach($row['items'] as $item)
            @include('home.sections.shared.course-modal', ['course' => $item])
            @endforeach
        @endforeach

    </div>
</section>
