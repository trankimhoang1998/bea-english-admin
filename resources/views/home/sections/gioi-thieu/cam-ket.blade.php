{{-- resources/views/home/sections/gioi-thieu/cam-ket.blade.php --}}
<section class="relative overflow-hidden bg-surface-alt py-10 lg:py-28">

    {{-- Dot grid --}}
    <div class="absolute inset-0 pointer-events-none"
         style="background-image: radial-gradient(rgba(249,115,22,.2) 1px, transparent 1px); background-size: 30px 30px; opacity:.25;"></div>

    <div class="relative max-w-7xl mx-auto px-5 lg:px-16">

        {{-- Header --}}
        <div class="text-center mb-6 lg:mb-14 reveal">
            <div class="inline-flex items-center gap-3 mb-5">
                <div class="h-[2px] w-6 lg:w-10 bg-primary-container rounded-full"></div>
                <div class="bg-primary-container rounded-full px-4 py-2 lg:px-8 lg:py-3">
                    <h2 class="text-white font-black text-base lg:text-2xl uppercase tracking-wide">Cam Kết Đào Tạo</h2>
                </div>
                <div class="h-[2px] w-6 lg:w-10 bg-primary-container rounded-full"></div>
            </div>
            <p class="hidden lg:block text-gray-800 font-semibold text-lg">Chúng tôi không chỉ dạy <span class="text-orange-500">&mdash;</span> chúng tôi cam kết kết quả</p>
        </div>

        {{-- 3 cards --}}
        <div class="grid lg:grid-cols-3 gap-4 lg:gap-8">

            {{-- Card 1 --}}
            <div class="ck-card reveal group bg-white rounded-3xl overflow-hidden border border-gray-200 flex flex-col">
                {{-- Top accent --}}
                <div class="h-1.5 bg-gradient-to-r from-orange-400 to-orange-600"></div>
                <div class="p-5 lg:p-8 flex-1 flex flex-col">
                    {{-- Icon + number --}}
                    <div class="flex items-start justify-between mb-3 lg:mb-6">
                        <div class="w-11 h-11 lg:w-14 lg:h-14 rounded-2xl bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center shadow-lg shadow-orange-500/25 group-hover:scale-110 transition-transform duration-300">
                            <span class="material-symbols-outlined ms-filled text-white text-[20px] lg:text-[26px]">workspace_premium</span>
                        </div>
                        <span class="text-[2.2rem] lg:text-[3.5rem] font-black leading-none text-gray-900/[0.05] select-none">01</span>
                    </div>
                    {{-- Title --}}
                    <h3 class="text-on-background font-black text-[15px] lg:text-[17px] leading-snug mb-2 lg:mb-4">
                        Cam kết hiệu quả, cá nhân hóa 100%
                    </h3>
                    {{-- Body --}}
                    <p class="text-gray-500 text-[13px] lg:text-[13.5px] leading-relaxed flex-1">
                        Giáo trình và phương pháp đào tạo được
                        <span class="ck-highlight">cá nhân hóa theo lộ trình và mục tiêu</span>,
                        BeA English cam kết giúp học viên tự tin chinh phục các chứng chỉ quốc tế như
                        <span class="ck-highlight">Cambridge, IELTS, TOEIC, VSTEP</span> dễ dàng.
                    </p>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="ck-card reveal reveal-delay-1 group bg-white rounded-3xl overflow-hidden border border-gray-200 flex flex-col">
                <div class="h-1.5 bg-gradient-to-r from-amber-400 to-orange-500"></div>
                <div class="p-5 lg:p-8 flex-1 flex flex-col">
                    <div class="flex items-start justify-between mb-3 lg:mb-6">
                        <div class="w-11 h-11 lg:w-14 lg:h-14 rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center shadow-lg shadow-orange-500/25 group-hover:scale-110 transition-transform duration-300">
                            <span class="material-symbols-outlined ms-filled text-white text-[20px] lg:text-[26px]">school</span>
                        </div>
                        <span class="text-[2.2rem] lg:text-[3.5rem] font-black leading-none text-gray-900/[0.05] select-none">02</span>
                    </div>
                    <h3 class="text-on-background font-black text-[15px] lg:text-[17px] leading-snug mb-2 lg:mb-4">
                        Giáo viên chất lượng, lựa chọn theo nhu cầu
                    </h3>
                    <p class="text-gray-500 text-[13px] lg:text-[13.5px] leading-relaxed flex-1">
                        Đội ngũ giảng viên người Philippines có
                        <span class="ck-highlight">trình độ sư phạm đại học trở lên</span>,
                        sở hữu chứng chỉ quốc tế
                        <span class="ck-highlight">TESOL, TEFL, CELTA</span>,
                        kinh nghiệm nhiều năm, luôn tận tâm hỗ trợ và sẵn sàng giải đáp mọi thắc mắc từ học viên.
                    </p>
                </div>
            </div>

            {{-- Card 3 --}}
            <div class="ck-card reveal reveal-delay-2 group bg-white rounded-3xl overflow-hidden border border-gray-200 flex flex-col">
                <div class="h-1.5 bg-gradient-to-r from-orange-500 to-red-500"></div>
                <div class="p-5 lg:p-8 flex-1 flex flex-col">
                    <div class="flex items-start justify-between mb-3 lg:mb-6">
                        <div class="w-11 h-11 lg:w-14 lg:h-14 rounded-2xl bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center shadow-lg shadow-orange-500/25 group-hover:scale-110 transition-transform duration-300">
                            <span class="material-symbols-outlined ms-filled text-white text-[20px] lg:text-[26px]">payments</span>
                        </div>
                        <span class="text-[2.2rem] lg:text-[3.5rem] font-black leading-none text-gray-900/[0.05] select-none">03</span>
                    </div>
                    <h3 class="text-on-background font-black text-[15px] lg:text-[17px] leading-snug mb-2 lg:mb-4">
                        Chi phí hợp lý, lịch học linh hoạt
                    </h3>
                    <p class="text-gray-500 text-[13px] lg:text-[13.5px] leading-relaxed mb-3 lg:mb-5">
                        Chi phí tại BeA English không phải thấp nhất nhưng
                        <span class="ck-highlight">xứng đáng nhất</span>. Cam kết
                        <span class="ck-highlight">hoàn tiền nếu học viên không tiến bộ</span>.
                    </p>
                    {{-- Bullet list --}}
                    <div class="space-y-2 mt-auto">
                        @foreach(['Lịch học linh hoạt, hủy miễn phí trước 6 giờ', 'Hỗ trợ bảo lưu khóa học'] as $item)
                        <div class="flex items-center gap-2.5">
                            <span class="w-5 h-5 rounded-full bg-primary-container/10 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined ms-filled text-primary-container text-[12px]">check</span>
                            </span>
                            <span class="text-gray-500 text-[13px]">{{ $item }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    .ck-card {
        transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
    }
    .ck-card:hover {
        transform: translateY(-5px);
        border-color: rgba(249,115,22,.3);
        box-shadow: 0 16px 40px rgba(249,115,22,.12);
    }
    .ck-highlight {
        background: rgba(249,115,22,.12);
        color: #ea580c;
        font-weight: 600;
        padding: 1px 6px;
        border-radius: 4px;
    }
</style>
