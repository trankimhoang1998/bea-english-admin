{{-- resources/views/home/sections/luyen-thi-ielts/thong-tin.blade.php --}}
<section class="relative overflow-hidden bg-surface-alt py-8 lg:py-16">

    <div class="relative max-w-7xl mx-auto px-5 lg:px-16">

        <div class="text-center mb-5 lg:mb-8 reveal">
            <div class="inline-flex items-center gap-2">
                <span class="material-symbols-outlined ms-filled text-primary-container text-[20px]">calendar_today</span>
                <h2 class="text-on-background font-black text-base lg:text-2xl uppercase tracking-wide">Thông tin khóa học</h2>
            </div>
            <div class="h-[3px] w-12 bg-primary-container rounded-full mx-auto mt-2"></div>
        </div>

        @php
        $stats = [
            ['group',   'Số lượng',   '40 buổi học',    'from-orange-400 to-orange-600'],
            ['bar_chart','Tần suất',  '2-3 buổi/tuần',  'from-amber-400 to-orange-500'],
            ['timer',   'Thời lượng', '50 phút/buổi',   'from-orange-500 to-red-500'],
            ['laptop_mac','Hình thức','Online 1:1',      'from-orange-500 to-red-400'],
        ];
        @endphp

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-2.5 lg:gap-6 reveal">
            @foreach($stats as $i => [$icon, $label, $value, $grad])
            <div class="bg-white border border-gray-200 rounded-2xl px-4 py-3 lg:px-6 lg:py-5 flex flex-col gap-2 lg:gap-3 shadow-sm hover:shadow-md hover:border-orange-200 transition-all duration-300">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br {{ $grad }} flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined ms-filled text-white text-[16px]">{{ $icon }}</span>
                    </div>
                    <span class="text-primary-container font-black text-[12px] uppercase tracking-wider">{{ $label }}</span>
                </div>
                <div class="h-[2px] w-8 bg-gradient-to-r {{ $grad }} rounded-full"></div>
                <span class="text-on-background font-black text-[16px] lg:text-[20px]">{{ $value }}</span>
            </div>
            @endforeach
        </div>

    </div>
</section>
