{{-- resources/views/home/sections/khoa-hoc/chinh-sach.blade.php --}}
<section class="relative overflow-hidden bg-surface-alt py-10 lg:py-28">

    <div class="absolute inset-0 pointer-events-none"
         style="background-image: radial-gradient(rgba(249,115,22,.2) 1px, transparent 1px); background-size: 30px 30px; opacity:.25;"></div>

    <div class="relative max-w-7xl mx-auto px-5 lg:px-16">

        {{-- Header --}}
        <div class="text-center mb-6 lg:mb-14 reveal">
            <div class="inline-flex items-center gap-3 mb-5">
                <div class="h-[2px] w-6 lg:w-10 bg-primary-container rounded-full"></div>
                <div class="bg-primary-container rounded-full px-4 py-2 lg:px-8 lg:py-3">
                    <h2 class="text-white font-black text-base lg:text-2xl uppercase tracking-wide">Chính Sách Và Cam Kết</h2>
                </div>
                <div class="h-[2px] w-6 lg:w-10 bg-primary-container rounded-full"></div>
            </div>
            <p class="hidden lg:block text-gray-800 font-semibold text-lg">Minh bạch – Rõ ràng – Có trách nhiệm <span class="text-orange-500">&mdash;</span> BeA English cam kết bằng hợp đồng</p>
        </div>

        <div class="grid lg:grid-cols-2 gap-4 lg:gap-8">

            {{-- Chính sách --}}
            <div class="cs-card reveal group bg-white rounded-3xl overflow-hidden border border-gray-200 flex flex-col">
                <div class="h-1.5 bg-gradient-to-r from-orange-400 to-orange-600"></div>
                <div class="p-5 lg:p-10 flex-1">
                    <div class="flex items-center gap-2.5 lg:gap-3 mb-4 lg:mb-7">
                        <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-2xl bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center shadow-lg shadow-orange-500/20 group-hover:scale-110 transition-transform duration-300 shrink-0">
                            <span class="material-symbols-outlined ms-filled text-white text-[18px] lg:text-[22px]">policy</span>
                        </div>
                        <h3 class="text-on-background font-black text-lg lg:text-xl">Chính sách</h3>
                    </div>
                    @php
                    $policies = [
                        'Nhận ngay bộ giáo trình khóa học trị giá <strong>800.000 VNĐ</strong>.',
                        'Nhận ngay bộ 5 phần mềm Oxford luyện ngữ pháp (5 cấp độ) trị giá <strong>4.000.000 VNĐ</strong>.',
                        'Tự chọn giáo viên, đổi giáo viên nếu chưa thấy phù hợp.',
                        'Ghi hình toàn bộ buổi học, dễ dàng xem lại ôn tập.',
                        'Miễn phí hủy buổi học.',
                        'Miễn phí bảo lưu thời gian học trong vòng <strong>1 năm</strong> kể từ ngày đăng ký.',
                    ];
                    @endphp
                    <ul class="space-y-2.5 lg:space-y-4">
                        @foreach($policies as $item)
                        <li class="flex items-start gap-2.5 lg:gap-3.5">
                            <div class="w-5 h-5 rounded-full bg-primary-container/15 flex items-center justify-center shrink-0 mt-0.5">
                                <span class="material-symbols-outlined ms-filled text-primary-container text-[13px]">check</span>
                            </div>
                            <span class="text-gray-600 text-[13px] lg:text-[14.5px] leading-relaxed">{!! $item !!}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- Cam kết --}}
            <div class="cs-card reveal reveal-delay-1 group bg-white rounded-3xl overflow-hidden border border-gray-200 flex flex-col">
                <div class="h-1.5 bg-gradient-to-r from-orange-500 to-red-500"></div>
                <div class="p-5 lg:p-10 flex-1">
                    <div class="flex items-center gap-2.5 lg:gap-3 mb-4 lg:mb-7">
                        <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-2xl bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center shadow-lg shadow-orange-500/20 group-hover:scale-110 transition-transform duration-300 shrink-0">
                            <span class="material-symbols-outlined ms-filled text-white text-[18px] lg:text-[22px]">workspace_premium</span>
                        </div>
                        <h3 class="text-on-background font-black text-lg lg:text-xl">Cam kết</h3>
                    </div>
                    @php
                    $commitments = [
                        'Cam kết lộ trình học được <strong>cá nhân hóa</strong>, học viên đạt mục tiêu đầu ra của khóa học.',
                        'Cam kết <strong>100% giáo viên nước ngoài</strong>, có bằng sư phạm, chứng chỉ quốc tế tiếng Anh.',
                        'Cam kết chương trình <strong>chuẩn quốc tế Anh-Mỹ</strong>, giáo trình Cambridge/Oxford/CCSS chuẩn hóa.',
                        'Cam kết <strong>hoàn tiền bằng hợp đồng</strong> nếu học viên không tiến bộ.',
                    ];
                    @endphp
                    <ul class="space-y-3 lg:space-y-5">
                        @foreach($commitments as $item)
                        <li class="flex items-start gap-2.5 lg:gap-3.5">
                            <div class="w-5 h-5 rounded-full bg-primary-container/15 flex items-center justify-center shrink-0 mt-0.5">
                                <span class="material-symbols-outlined ms-filled text-primary-container text-[13px]">check</span>
                            </div>
                            <span class="text-gray-600 text-[13px] lg:text-[14.5px] leading-relaxed">{!! $item !!}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>
