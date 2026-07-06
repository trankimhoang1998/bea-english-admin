{{-- resources/views/home/sections/gioi-thieu/gia-tri-cot-loi.blade.php --}}
<section class="relative overflow-hidden bg-surface-alt py-20 lg:py-28">

    {{-- Dot grid --}}
    <div class="absolute inset-0 pointer-events-none"
         style="background-image: radial-gradient(rgba(249,115,22,.2) 1px, transparent 1px); background-size: 30px 30px; opacity:.25;"></div>

    <div class="relative max-w-7xl mx-auto px-5 lg:px-16">

        {{-- Header --}}
        <div class="text-center mb-14 reveal">
            <div class="inline-flex items-center gap-3 mb-5">
                <div class="h-[2px] w-10 bg-primary-container rounded-full"></div>
                <div class="bg-primary-container rounded-full px-8 py-3">
                    <h2 class="text-white font-black text-xl lg:text-2xl uppercase tracking-wide">Giá Trị Cốt Lõi</h2>
                </div>
                <div class="h-[2px] w-10 bg-primary-container rounded-full"></div>
            </div>
            <p class="text-gray-800 font-semibold text-lg">Những giá trị định hướng <span class="text-orange-500">&mdash;</span> mọi hoạt động của BeA English</p>
        </div>

        {{-- 6 cards --}}
        @php
        $values = [
            [
                'num'   => '01',
                'icon'  => 'person_pin',
                'title' => 'Cá Nhân Hóa',
                'sub'   => 'Lấy người học làm trung tâm',
                'desc'  => 'Mỗi học viên là một hành trình riêng biệt. BeA English thiết kế nội dung học phù hợp với nhu cầu, năng lực và mục tiêu của từng người.',
                'grad'  => 'from-orange-400 to-orange-600',
                'delay' => '',
            ],
            [
                'num'   => '02',
                'icon'  => 'verified',
                'title' => 'Chất Lượng',
                'sub'   => 'Cam kết hiệu quả thực tế',
                'desc'  => 'Không chỉ dạy, chúng tôi hướng tới kết quả rõ ràng và sự tiến bộ bền vững cho từng học viên.',
                'grad'  => 'from-orange-500 to-red-500',
                'delay' => 'reveal-delay-1',
            ],
            [
                'num'   => '03',
                'icon'  => 'favorite',
                'title' => 'Tận Tâm',
                'sub'   => 'Dạy bằng cả trái tim',
                'desc'  => 'Giáo viên không chỉ là người hướng dẫn mà còn là người truyền cảm hứng, đồng hành và lắng nghe.',
                'grad'  => 'from-amber-400 to-orange-600',
                'delay' => 'reveal-delay-2',
            ],
            [
                'num'   => '04',
                'icon'  => 'public',
                'title' => 'Kết Nối Toàn Cầu',
                'sub'   => 'Học không biên giới',
                'desc'  => 'BeA English mang đến cơ hội tiếp cận giáo viên quốc tế mọi lúc, mọi nơi, giúp học viên vươn ra thế giới ngay từ lớp học online.',
                'grad'  => 'from-orange-400 to-amber-500',
                'delay' => 'reveal-delay-1',
            ],
            [
                'num'   => '05',
                'icon'  => 'groups',
                'title' => 'Trách Nhiệm Xã Hội',
                'sub'   => 'Vì một thế hệ trẻ Việt Nam tự tin hội nhập',
                'desc'  => 'Chúng tôi tin rằng giáo dục là nền tảng để thay đổi cuộc sống và đóng góp cho cộng đồng.',
                'grad'  => 'from-orange-500 to-red-400',
                'delay' => 'reveal-delay-2',
            ],
            [
                'num'   => '06',
                'icon'  => 'tips_and_updates',
                'title' => 'Đổi Mới',
                'sub'   => 'Dẫn đầu trong chuyển đổi số giáo dục',
                'desc'  => 'Luôn cập nhật công nghệ, phương pháp giảng dạy hiện đại để mang lại trải nghiệm học tập linh hoạt và hiệu quả nhất.',
                'grad'  => 'from-amber-500 to-orange-600',
                'delay' => 'reveal-delay-3',
            ],
        ];
        @endphp

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6">
            @foreach($values as $v)
            <div class="gtv-card reveal {{ $v['delay'] }} group bg-white rounded-3xl overflow-hidden border border-gray-200 flex flex-col">

                {{-- Card header --}}
                <div class="bg-gradient-to-r {{ $v['grad'] }} px-6 py-5 flex items-center gap-4 relative overflow-hidden">
                    <div class="absolute -top-6 -right-4 w-20 h-20 rounded-full bg-white/10"></div>

                    <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined ms-filled text-white text-[22px]">{{ $v['icon'] }}</span>
                    </div>
                    <div>
                        <p class="text-white/60 text-[10px] font-bold uppercase tracking-widest leading-none mb-1">{{ $v['num'] }}</p>
                        <h3 class="text-white font-black text-[15px] lg:text-[16px] uppercase leading-tight">{{ $v['title'] }}</h3>
                    </div>
                </div>

                {{-- Card body --}}
                <div class="p-6 flex-1 flex flex-col">
                    {{-- Subtitle --}}
                    <div class="flex items-start gap-2 mb-3">
                        <span class="material-symbols-outlined ms-filled text-primary-container text-[14px] mt-0.5 shrink-0">play_arrow</span>
                        <p class="text-primary-container font-bold text-[13px] leading-snug">{{ $v['sub'] }}</p>
                    </div>

                    {{-- Description --}}
                    <p class="text-gray-500 text-[13.5px] leading-relaxed flex-1">{{ $v['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

<style>
    .gtv-card {
        transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
    }
    .gtv-card:hover {
        transform: translateY(-5px);
        border-color: rgba(249,115,22,.3);
        box-shadow: 0 16px 40px rgba(249,115,22,.12);
    }
</style>
