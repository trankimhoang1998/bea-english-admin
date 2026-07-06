{{-- resources/views/home/sections/gioi-thieu/tam-nhin-su-menh.blade.php --}}
<section class="relative overflow-hidden bg-white py-20 lg:py-28">

    {{-- Background glow orbs --}}
    <div class="absolute -top-40 -left-40 w-[500px] h-[500px] rounded-full pointer-events-none"
         style="background: radial-gradient(circle, rgba(249,115,22,.07) 0%, transparent 65%);"></div>
    <div class="absolute -bottom-40 -right-40 w-[500px] h-[500px] rounded-full pointer-events-none"
         style="background: radial-gradient(circle, rgba(249,115,22,.06) 0%, transparent 65%);"></div>

    {{-- Dot grid --}}
    <div class="absolute inset-0 pointer-events-none"
         style="background-image: radial-gradient(rgba(249,115,22,.25) 1px, transparent 1px); background-size: 32px 32px; opacity:.3;"></div>

    <div class="relative max-w-7xl mx-auto px-5 lg:px-16">

        {{-- Section header --}}
        <div class="text-center mb-14 reveal">
            <div class="inline-flex items-center gap-2 bg-primary-container/10 border border-primary-container/25 text-primary-container text-[11px] font-bold uppercase tracking-[0.2em] px-4 py-1.5 rounded-full mb-5">
                <span class="material-symbols-outlined ms-filled text-[13px]">corporate_fare</span>
                Về Chúng Tôi
            </div>
            <h2 class="text-on-background font-black text-2xl lg:text-[2.2rem] uppercase leading-tight">
                Tầm Nhìn &amp; Sứ Mệnh
            </h2>
        </div>

        {{-- Two cards --}}
        <div class="grid lg:grid-cols-2 gap-6 lg:gap-8">

            {{-- Card 1: Tầm nhìn --}}
            <div class="relative rounded-3xl overflow-hidden border border-gray-200 reveal tnsm-card group">

                {{-- Big bg number --}}
                <div class="absolute -bottom-4 -right-2 text-[10rem] font-black leading-none pointer-events-none select-none text-gray-900/[0.04] group-hover:text-gray-900/[0.07] transition-colors duration-500">01</div>

                {{-- Gradient top strip --}}
                <div class="h-1.5 w-full bg-gradient-to-r from-orange-400 via-primary-container to-orange-600"></div>

                <div class="p-8 lg:p-10">
                    {{-- Icon + title --}}
                    <div class="flex items-center gap-4 mb-7">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center shrink-0 shadow-lg shadow-orange-500/25 group-hover:scale-110 transition-transform duration-300">
                            <span class="material-symbols-outlined ms-filled text-white text-[26px]">visibility</span>
                        </div>
                        <div>
                            <p class="text-primary-container text-[11px] font-bold uppercase tracking-[0.2em] mb-0.5">01</p>
                            <h3 class="text-on-background font-black text-xl lg:text-2xl uppercase tracking-wide">Tầm Nhìn</h3>
                        </div>
                    </div>

                    {{-- Content --}}
                    <p class="text-gray-600 text-[14.5px] leading-relaxed mb-7">
                        <span class="text-on-background font-bold">BeA English</span> định hướng phát triển thành
                        <span class="text-on-background font-bold">Trung tâm Anh ngữ quốc tế online hàng đầu</span>
                        tại Việt Nam dành cho các bạn học sinh, sinh viên. Mục tiêu giúp học viên chinh phục ước mơ tiếng Anh trên nền tảng online cá nhân hóa và tự tin hội nhập thế giới bằng ngôn ngữ quốc tế.
                    </p>

                    {{-- Stat highlight --}}
                    <div class="inline-flex items-center gap-3 bg-primary-container/10 border border-primary-container/20 rounded-2xl px-5 py-3.5">
                        <span class="material-symbols-outlined ms-filled text-primary-container text-[22px]">groups</span>
                        <div>
                            <div class="text-primary-container font-black text-2xl leading-none">1 TRIỆU</div>
                            <div class="text-gray-500 text-[11px] mt-0.5">Học viên chinh phục ước mơ tiếng Anh</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card 2: Sứ mệnh --}}
            <div class="relative rounded-3xl overflow-hidden border border-gray-200 reveal reveal-delay-1 tnsm-card group">

                {{-- Big bg number --}}
                <div class="absolute -bottom-4 -right-2 text-[10rem] font-black leading-none pointer-events-none select-none text-gray-900/[0.04] group-hover:text-gray-900/[0.07] transition-colors duration-500">02</div>

                {{-- Gradient top strip --}}
                <div class="h-1.5 w-full bg-gradient-to-r from-amber-400 via-orange-500 to-red-500"></div>

                <div class="p-8 lg:p-10">
                    {{-- Icon + title --}}
                    <div class="flex items-center gap-4 mb-7">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-400 to-orange-600 flex items-center justify-center shrink-0 shadow-lg shadow-orange-500/25 group-hover:scale-110 transition-transform duration-300">
                            <span class="material-symbols-outlined ms-filled text-white text-[26px]">rocket_launch</span>
                        </div>
                        <div>
                            <p class="text-primary-container text-[11px] font-bold uppercase tracking-[0.2em] mb-0.5">02</p>
                            <h3 class="text-on-background font-black text-xl lg:text-2xl uppercase tracking-wide">Sứ Mệnh</h3>
                        </div>
                    </div>

                    {{-- Content --}}
                    <p class="text-gray-600 text-[14.5px] leading-relaxed mb-7">
                        <span class="text-on-background font-bold">BeA English</span> cam kết mang đến môi trường học tập tiếng Anh chất lượng, truyền cảm hứng và sáng tạo, với tinh thần trách nhiệm, tận tâm và yêu thương. Góp phần tiếp tục nâng cao uy tín, vị thế của cộng đồng giáo viên tiếng Anh Philippines tại Việt Nam và trên thế giới.
                    </p>

                    {{-- Value tags --}}
                    <div class="flex flex-wrap gap-2">
                        @foreach(['Chất lượng', 'Truyền cảm hứng', 'Sáng tạo', 'Tận tâm', 'Yêu thương'] as $tag)
                        <span class="bg-gray-100 border border-gray-200 text-gray-600 text-[11px] font-semibold px-3 py-1.5 rounded-full">
                            {{ $tag }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    .tnsm-card {
        background: #ffffff;
        transition: transform .3s ease, border-color .3s ease, box-shadow .3s ease;
    }
    .tnsm-card:hover {
        transform: translateY(-5px);
        border-color: rgba(249,115,22,.35);
        box-shadow: 0 20px 48px rgba(249,115,22,.12), 0 0 0 1px rgba(249,115,22,.08);
    }
</style>
