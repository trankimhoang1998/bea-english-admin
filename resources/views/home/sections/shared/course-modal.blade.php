{{--
    Reusable course detail modal.
    Parent section must have: x-data="{ openModal: null }" @keydown.escape.window="openModal = null"

    $course keys required : cefr, desc, goals[], skills[]
    $course keys optional  :
        title    → overrides auto "en (cefr):\nvi" heading (IELTS single-line titles)
        en, vi   → used in auto heading when title is absent
        level    → first orange badge label (IELTS: 'Nền tảng'…); falls back to cefr
        badge1   → overrides level as first badge (rarely needed)
        audience → renders "Đối tượng" section; omit to hide (IELTS pages omit this)
        noi_dung → array, renders "Nội dung khóa học" section after goals
        sessions → default '40 buổi học'
        freq     → default '2-3 buổi/tuần'
--}}
@once
<style>
.modal-scroll::-webkit-scrollbar { display: none; }
.modal-scroll { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endonce
<div x-show="openModal === '{{ $course['cefr'] }}'"
     class="fixed inset-0 z-[100] flex items-center justify-center p-4 lg:p-6"
     style="display:none;">

    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"
         @click="openModal = null"></div>

    {{-- Modal card --}}
    <div class="modal-scroll relative bg-white rounded-3xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto"
         @click.stop>

        {{-- Close button --}}
        <button @click="openModal = null"
                class="absolute top-4 right-4 z-10 w-9 h-9 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 hover:text-gray-700 transition-colors cursor-pointer">
            <span class="material-symbols-outlined text-[18px]">close</span>
        </button>

        {{-- Header --}}
        <div class="px-7 pt-8 pb-0 text-center">
            <h2 class="text-primary-container font-black text-[19px] lg:text-[21px] leading-tight mb-4">
                @isset($course['title'])
                    {{ $course['title'] }}
                @else
                    {{ $course['en'] }} ({{ $course['cefr'] }}):<br>{{ $course['vi'] }}
                @endisset
            </h2>
            <div class="flex flex-wrap justify-center gap-2 mb-5">
                <span class="bg-primary-container text-white font-black text-[12px] lg:text-[13px] px-4 py-1.5 rounded-full">{{ $course['badge1'] ?? $course['level'] ?? $course['cefr'] }}</span>
                <span class="bg-primary-container text-white font-black text-[12px] lg:text-[13px] px-4 py-1.5 rounded-full">{{ $course['sessions'] ?? '40 buổi học' }}</span>
                <span class="bg-primary-container text-white font-black text-[12px] lg:text-[13px] px-4 py-1.5 rounded-full">{{ $course['freq'] ?? '2-3 buổi/tuần' }}</span>
            </div>
            <div class="h-px bg-gray-100 mb-6"></div>
        </div>

        {{-- Body --}}
        <div class="px-7 pb-8 space-y-5">

            {{-- Đối tượng (optional) --}}
            @isset($course['audience'])
            <div>
                <h3 class="flex items-center gap-2 text-primary-container font-black text-[15px] mb-2">
                    <div class="w-1 h-5 bg-primary-container rounded-full shrink-0"></div>
                    Đối tượng
                </h3>
                <p class="text-gray-600 text-[14px] leading-relaxed">{{ $course['audience'] }}</p>
            </div>
            @endisset

            {{-- Hình thức học --}}
            <div>
                <h3 class="flex items-center gap-2 text-primary-container font-black text-[15px] mb-2">
                    <div class="w-1 h-5 bg-primary-container rounded-full shrink-0"></div>
                    Hình thức học
                </h3>
                <p class="text-gray-600 text-[14px]">50 phút/buổi – Trực tuyến 1:1</p>
            </div>

            {{-- Mô tả khóa học --}}
            <div>
                <h3 class="flex items-center gap-2 text-primary-container font-black text-[15px] mb-2">
                    <div class="w-1 h-5 bg-primary-container rounded-full shrink-0"></div>
                    Mô tả khóa học
                </h3>
                <p class="text-gray-600 text-[14px] leading-relaxed">{{ $course['desc'] }}</p>
            </div>

            {{-- Mục tiêu học tập --}}
            <div>
                <h3 class="flex items-center gap-2 text-primary-container font-black text-[15px] mb-2">
                    <div class="w-1 h-5 bg-primary-container rounded-full shrink-0"></div>
                    Mục tiêu học tập
                </h3>
                <ul class="space-y-2">
                    @foreach($course['goals'] as $goal)
                    <li class="flex items-start gap-2.5 text-gray-600 text-[14px] leading-relaxed">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary-container mt-[6px] shrink-0"></span>
                        {{ $goal }}
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Nội dung khóa học (optional, IELTS only) --}}
            @isset($course['noi_dung'])
            <div>
                <h3 class="flex items-center gap-2 text-primary-container font-black text-[15px] mb-2">
                    <div class="w-1 h-5 bg-primary-container rounded-full shrink-0"></div>
                    Nội dung khóa học
                </h3>
                <ul class="space-y-2">
                    @foreach($course['noi_dung'] as $nd)
                    <li class="flex items-start gap-2.5 text-gray-600 text-[14px] leading-relaxed">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary-container mt-[6px] shrink-0"></span>
                        {{ $nd }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endisset

            {{-- Kỹ năng phát triển --}}
            <div>
                <h3 class="flex items-center gap-2 text-primary-container font-black text-[15px] mb-3">
                    <div class="w-1 h-5 bg-primary-container rounded-full shrink-0"></div>
                    Kỹ năng phát triển
                </h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($course['skills'] as $skill)
                    <span class="border border-orange-200 text-primary-container text-[13px] font-medium px-4 py-1.5 rounded-full bg-orange-50">{{ $skill }}</span>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
