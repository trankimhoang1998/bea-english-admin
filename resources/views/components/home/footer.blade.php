<style>
@keyframes footerGradient {
    0%   { background-position: 0% 50%, center center; }
    50%  { background-position: 100% 50%, center center; }
    100% { background-position: 0% 50%, center center; }
}
@keyframes footerBgPan {
    0%   { background-position: 0% 50%, 0% center; }
    50%  { background-position: 100% 50%, 100% center; }
    100% { background-position: 0% 50%, 0% center; }
}
.footer-bea {
    background: linear-gradient(135deg, #f8fafce6, #e5e7ebe6, #f3f4f6e6), url('/images/footer-bg.png');
    background-size: 400% 400%, cover;
    background-position: 0% 50%, center center;
    background-repeat: no-repeat, no-repeat;
    animation: footerGradient 8s ease infinite;
    position: relative;
    color: #374151;
}
@media (max-width: 767px) {
    .footer-bea {
        background-size: 400% 400%, 250% auto;
        animation: footerBgPan 12s ease-in-out infinite;
    }
}
.footer-bea::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image:
        radial-gradient(circle at 20% 80%, rgba(249,115,22,.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(34,197,94,.05)  0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(59,130,246,.03) 0%, transparent 50%);
    pointer-events: none;
}
</style>

<footer class="footer-bea overflow-hidden">

    {{-- Top orange accent bar --}}
    <div class="h-[3px] w-full bg-gradient-to-r from-transparent via-orange-500 to-transparent relative z-10"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">

        {{-- ===== 3 COLUMNS ===== --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10 lg:gap-16 py-12">

            {{-- Col 1: Liên hệ --}}
            <div>
                <h3 class="text-orange-500 font-black text-[11px] uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                    <span class="w-4 h-[2px] bg-orange-500 rounded-full"></span>
                    Liên Hệ Chúng Tôi
                </h3>
                <ul class="space-y-4">
                    @foreach([
                        ['home',       'Công ty CP Đầu Tư và Giáo Dục Quốc Tế BeA'],
                        ['location_on','Tòa S402 Vinhomes Smart City, Tây Mỗ, Hà Nội'],
                        ['call',       '0972.291.474'],
                        ['mail',       'info@beaenglish.vn'],
                    ] as [$icon, $text])
                    <li class="flex items-center gap-3.5 group">
                        <div class="w-10 h-10 rounded-xl bg-orange-500/10 border border-orange-500/20 flex items-center justify-center shrink-0 group-hover:bg-orange-500 transition-colors">
                            <span class="material-symbols-outlined ms-filled text-orange-500 text-[20px] group-hover:text-white transition-colors">{{ $icon }}</span>
                        </div>
                        <span class="text-gray-600 text-[14px] leading-snug group-hover:text-gray-900 transition-colors">{{ $text }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Col 2: Truyền thông --}}
            <div>
                <h3 class="text-orange-500 font-black text-[11px] uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                    <span class="w-4 h-[2px] bg-orange-500 rounded-full"></span>
                    Truyền Thông
                </h3>
                <div class="space-y-3.5">
                    @foreach([
                        ['language',     'www.beaenglish.vn',           'https://www.beaenglish.vn'],
                        ['group',        'facebook.com/beaenglish.vn',  'https://www.facebook.com/beaenglish.vn'],
                        ['music_note',   'tiktok.com/@beaenglish.vn',   'https://www.tiktok.com/@beaenglish.vn'],
                        ['photo_camera', 'instagram.com/beaenglish.vn', 'https://www.instagram.com/beaenglish.vn'],
                        ['play_circle',  'youtube.com/@beaenglish',     'https://www.youtube.com/@beaenglish'],
                    ] as [$icon, $label, $url])
                    <a href="{{ $url }}" target="_blank" rel="noopener noreferrer"
                       class="flex items-center gap-3 text-gray-600 hover:text-orange-500 text-[15px] transition-colors group">
                        <span class="material-symbols-outlined ms-filled text-[22px] text-orange-400 shrink-0 group-hover:text-orange-500 transition-colors">{{ $icon }}</span>
                        {{ $label }}
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Col 3: Khóa học --}}
            <div>
                <h3 class="text-orange-500 font-black text-[11px] uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                    <span class="w-4 h-[2px] bg-orange-500 rounded-full"></span>
                    Các Khóa Học
                </h3>
                <div class="space-y-3">
                    @foreach([
                        ['Tiếng Anh cho Học Sinh',  'Lớp 1 – 12, luyện thi Cambridge',      route('home.khoa-hoc')],
                        ['Tiếng Anh cho Người Lớn', 'Giao tiếp, công việc, phỏng vấn',       route('home.khoa-hoc')],
                        ['Luyện Thi IELTS',         'Cam kết đầu ra 3.5 – 6.5+, hoàn tiền', route('home.ielts')],
                    ] as [$title, $sub, $url])
                    <a href="{{ $url }}"
                       class="flex items-center gap-3.5 p-3.5 rounded-2xl border border-gray-200/80 bg-white/50
                              hover:bg-white hover:border-orange-300 hover:shadow-sm transition-all group backdrop-blur-sm">
                        <div class="w-8 h-8 rounded-xl bg-orange-500/10 border border-orange-500/20 flex items-center justify-center shrink-0 group-hover:bg-orange-500 transition-colors">
                            <span class="material-symbols-outlined ms-filled text-orange-500 text-[15px] group-hover:text-white transition-colors">school</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-gray-800 font-semibold text-[13px] leading-tight group-hover:text-orange-600 transition-colors">{{ $title }}</p>
                            <p class="text-gray-400 text-[11px] mt-0.5 leading-tight">{{ $sub }}</p>
                        </div>
                        <span class="material-symbols-outlined text-gray-300 text-[16px] ml-auto shrink-0 group-hover:text-orange-400 transition-colors">chevron_right</span>
                    </a>
                    @endforeach
                </div>

            </div>

        </div>

    </div>

    {{-- ===== BOTTOM BAR ===== --}}
    <div class="bg-orange-500 py-4 text-center relative z-10">
        <p class="text-white text-[13px] font-medium">
            © {{ date('Y') }} BEA English — Công ty Cổ phần Đầu Tư và Giáo Dục Quốc Tế BeA
        </p>
    </div>
</footer>
