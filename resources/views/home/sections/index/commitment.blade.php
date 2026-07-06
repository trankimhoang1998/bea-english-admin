{{-- resources/views/home/partials/commitment.blade.php --}}
<section id="commitment" class="py-16 lg:py-28 relative overflow-hidden">

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-16 reveal">
            <div class="inline-flex items-center gap-3 mb-5">
                <div class="h-[2px] w-10 bg-primary-container rounded-full"></div>
                <div class="bg-primary-container rounded-full px-8 py-3">
                    <h2 class="text-white font-black text-xl lg:text-2xl uppercase tracking-wide">Cam Kết Đào Tạo</h2>
                </div>
                <div class="h-[2px] w-10 bg-primary-container rounded-full"></div>
            </div>
        </div>

        {{-- 3 Cards --}}
        <div class="grid lg:grid-cols-3 gap-6">

            @php
            $items = [
                [
                    'num'   => '01',
                    'icon'  => 'star',
                    'title' => 'Cam kết hiệu quả, cá nhân hóa 100%',
                    'desc'  => 'Giáo trình và phương pháp được cá nhân hóa theo lộ trình và mục tiêu riêng. BeA English cam kết giúp học viên tự tin sử dụng tiếng Anh và chinh phục các chứng chỉ quốc tế.',
                    'tags'  => ['Cambridge', 'IELTS', 'TOEIC', 'VSTEP'],
                    'gradient' => 'from-orange-500/20 to-orange-600/5',
                ],
                [
                    'num'   => '02',
                    'icon'  => 'school',
                    'title' => 'Giáo viên chất lượng, lựa chọn theo nhu cầu',
                    'desc'  => 'Đội ngũ giảng viên Philippines trình độ đại học trở lên, chứng chỉ quốc tế TESOL/TEFL/CELTA, kinh nghiệm giảng dạy nhiều năm, tận tâm hỗ trợ học viên.',
                    'tags'  => ['TESOL', 'TEFL', 'CELTA'],
                    'gradient' => 'from-blue-500/15 to-blue-600/5',
                ],
                [
                    'num'   => '03',
                    'icon'  => 'payments',
                    'title' => 'Chi phí hợp lý, lịch học linh hoạt',
                    'desc'  => 'Chi phí xứng đáng với chất lượng. Lịch học linh hoạt, hủy miễn phí trước 6 giờ. Hỗ trợ bảo lưu và hoàn tiền nếu không hiệu quả.',
                    'tags'  => ['Hoàn tiền', 'Bảo lưu', 'Linh hoạt'],
                    'gradient' => 'from-emerald-500/15 to-emerald-600/5',
                ],
            ];
            @endphp

            @foreach($items as $i => $item)
            <div class="relative group rounded-3xl border border-gray-200 bg-white
                         hover:border-orange-300 hover:shadow-xl hover:shadow-orange-500/8
                         transition-all duration-500 overflow-hidden
                         reveal {{ $i > 0 ? 'reveal-delay-' . $i : '' }}">

                {{-- Gradient bg on hover --}}
                <div class="absolute inset-0 bg-gradient-to-br {{ $item['gradient'] }} opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                {{-- Big number decoration --}}
                <div class="absolute -top-4 -right-2 font-black text-[7rem] leading-none text-gray-900/[0.08] select-none pointer-events-none group-hover:text-orange-500/20 transition-colors duration-500">
                    {{ $item['num'] }}
                </div>

                <div class="relative p-7 lg:p-8 flex flex-col h-full">

                    {{-- Icon --}}
                    <div class="w-14 h-14 rounded-2xl bg-orange-500/10 border border-orange-500/20
                                flex items-center justify-center mb-6
                                group-hover:bg-orange-500 group-hover:border-orange-500
                                transition-all duration-300">
                        <span class="material-symbols-outlined ms-filled text-orange-500 text-[26px] group-hover:text-white transition-colors duration-300">{{ $item['icon'] }}</span>
                    </div>

                    {{-- Number badge --}}
                    <span class="text-orange-500/60 text-[11px] font-black uppercase tracking-[0.25em] mb-3">{{ $item['num'] }}</span>

                    {{-- Title --}}
                    <h3 class="text-gray-900 font-black text-[1.1rem] leading-snug mb-4">
                        {{ $item['title'] }}
                    </h3>

                    {{-- Desc --}}
                    <p class="text-gray-500 text-[13.5px] leading-relaxed mb-6 flex-1">
                        {{ $item['desc'] }}
                    </p>

                    {{-- Tags --}}
                    <div class="flex flex-wrap gap-2">
                        @foreach($item['tags'] as $tag)
                        <span class="text-[11px] font-semibold text-orange-600 bg-orange-50 border border-orange-200 px-2.5 py-1 rounded-full">
                            {{ $tag }}
                        </span>
                        @endforeach
                    </div>

                    {{-- Bottom accent line --}}
                    <div class="absolute bottom-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-orange-500/0 to-transparent group-hover:via-orange-500/50 transition-all duration-500"></div>
                </div>
            </div>
            @endforeach

        </div>

    </div>
</section>
