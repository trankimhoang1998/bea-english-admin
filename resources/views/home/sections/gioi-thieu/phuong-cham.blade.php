{{-- resources/views/home/sections/gioi-thieu/phuong-cham.blade.php --}}
<section class="relative overflow-hidden bg-white py-20 lg:py-28">

    {{-- Glow orbs --}}
    <div class="absolute top-0 right-0 w-[600px] h-[500px] rounded-full pointer-events-none"
         style="background: radial-gradient(ellipse at 100% 0%, rgba(249,115,22,.10) 0%, transparent 60%);"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[400px] rounded-full pointer-events-none"
         style="background: radial-gradient(ellipse at 0% 100%, rgba(249,115,22,.08) 0%, transparent 60%);"></div>

    {{-- Dot grid --}}
    <div class="absolute inset-0 pointer-events-none"
         style="background-image: radial-gradient(rgba(249,115,22,.13) 1px, transparent 1px); background-size: 32px 32px;"></div>

    <div class="relative max-w-7xl mx-auto px-5 lg:px-16">

        {{-- Header --}}
        <div class="text-center mb-16 reveal">
            <div class="inline-flex items-center gap-3 mb-5">
                <div class="h-[2px] w-10 bg-primary-container rounded-full"></div>
                <div class="bg-primary-container rounded-full px-8 py-3">
                    <h2 class="text-white font-black text-xl lg:text-2xl uppercase tracking-wide">Giữ Vững Phương Châm Đào Tạo</h2>
                </div>
                <div class="h-[2px] w-10 bg-primary-container rounded-full"></div>
            </div>
            <p class="text-gray-800 font-semibold text-lg">Nguyên tắc vàng <span class="text-orange-500">&mdash;</span> định hướng mọi buổi học tại BeA English</p>
        </div>

        {{-- List --}}
        @php
        $items = [
            ['supervisor_account', '01', 'Cá nhân hóa lộ trình',       'Mỗi học viên có năng lực và mục tiêu riêng. BeA English thiết kế lộ trình học phù hợp với từng cá nhân để tối ưu hóa hiệu quả học tập.',                                'from-orange-400 to-orange-600'],
            ['person_pin',         '02', 'Lấy người học làm trung tâm', 'Giáo viên là người đồng hành, hướng dẫn; học viên được khuyến khích chủ động, phản biện và phát triển toàn diện.',                                                   'from-amber-400 to-orange-500'],
            ['workspace_premium',  '03', 'Cam kết chất lượng & kết quả','Mỗi buổi học đều phải mang lại giá trị cụ thể. Chúng tôi chú trọng đến sự tiến bộ rõ ràng và bền vững của học viên.',                                              'from-orange-500 to-red-500'],
            ['school',             '04', 'Học đi đôi với thực hành',    'Kiến thức được gắn với tình huống thực tế, giúp học viên "học để dùng" thay vì "học để biết".',                                                                        'from-orange-400 to-amber-500'],
            ['videocam',           '05', 'Tương tác sâu — Online 1:1',  'Học viên được kết nối trực tiếp với giáo viên quốc tế, tạo không gian học tập tập trung, linh hoạt và hiệu quả.',                                                     'from-amber-500 to-orange-600'],
            ['tips_and_updates',   '06', 'Đổi mới không ngừng',         'BeA English liên tục cập nhật công nghệ, phương pháp giảng dạy và tài liệu học để bắt kịp xu thế giáo dục toàn cầu.',                                                'from-orange-500 to-red-400'],
        ];
        @endphp

        <div class="grid lg:grid-cols-2 gap-4">
            @foreach($items as $i => [$icon, $num, $title, $desc, $grad])
            @php $delay = ['', 'reveal-delay-1', 'reveal-delay-2', '', 'reveal-delay-1', 'reveal-delay-2'][$i]; @endphp
            <div class="pc-row reveal {{ $delay }} group flex items-center gap-5 bg-gray-50 border border-gray-200 rounded-2xl px-6 py-5">

                {{-- Icon --}}
                <div class="shrink-0 w-14 h-14 rounded-2xl bg-gradient-to-br {{ $grad }} flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <span class="material-symbols-outlined ms-filled text-white text-[24px]">{{ $icon }}</span>
                </div>

                {{-- Text --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-primary-container text-[10px] font-black uppercase tracking-widest">{{ $num }}</span>
                        <h3 class="text-on-background font-black text-[14px] lg:text-[15px] uppercase leading-tight">{{ $title }}</h3>
                    </div>
                    <p class="text-gray-500 text-[13px] leading-relaxed">{{ $desc }}</p>
                </div>

                {{-- Arrow --}}
                <div class="shrink-0 w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 group-hover:translate-x-1">
                    <span class="material-symbols-outlined text-primary-container text-[16px]">arrow_forward</span>
                </div>

            </div>
            @endforeach
        </div>

    </div>
</section>

<style>
    .pc-row {
        transition: background .25s, border-color .25s, box-shadow .25s, transform .25s;
    }
    .pc-row:hover {
        transform: translateX(4px);
        border-color: rgba(249,115,22,.3);
        box-shadow: 0 8px 24px rgba(249,115,22,.10);
        background: #fff;
    }
</style>
