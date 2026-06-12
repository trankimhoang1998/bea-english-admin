<!DOCTYPE html>
<html class="scroll-smooth" lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>BeA English – Nền Tảng Vững Vàng, Tương Lai Rộng Mở</title>
    <meta name="description" content="Hệ sinh thái giáo dục tiếng Anh chuẩn quốc tế, giúp hàng triệu học viên chinh phục IELTS, TOEIC với phương pháp cá nhân hoá đột phá.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary":            "#f97316",
                        "primary-dark":       "#9d4300",
                        "on-background":      "#0B1C30",
                        "surface":            "#f8f9ff",
                        "surface-background": "#FFFFFF",
                        "text-body":          "#334155",
                        "text-heading":       "#0F172A",
                        "outline-variant":    "#E0C0B1",
                        "secondary":          "#255dad",
                        "tertiary":           "#016398",
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg":  "0.5rem",
                        "xl":  "0.75rem",
                        "2xl": "1.5rem",
                        "3xl": "2.5rem",
                        "4xl": "3.5rem",
                        "full": "9999px",
                    },
                    boxShadow: {
                        "premium": "0 25px 50px -12px rgba(0,0,0,0.08)",
                        "glow":    "0 0 30px 0 rgba(249,115,22,0.2)",
                    },
                    fontFamily: {
                        body:    ["Inter", "sans-serif"],
                        display: ["Inter", "sans-serif"],
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass {
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.5);
        }
        .glass-dark {
            background: rgba(11,28,48,0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.1);
        }
        .text-gradient {
            background: linear-gradient(135deg, #1d1d1f 0%, #434345 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .orange-glow-bg {
            background:
                radial-gradient(circle at 10% 20%, rgba(249,115,22,0.08) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(37,93,173,0.08) 0%, transparent 40%);
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-20px); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .bento-card { transition: all 0.5s cubic-bezier(0.4,0,0.2,1); }
        .bento-card:hover { transform: translateY(-8px); }
    </style>
</head>
<body class="bg-[#fcfcfd] font-body text-on-background selection:bg-primary selection:text-white overflow-x-hidden">

{{-- ── NavBar ── --}}
<header class="fixed top-0 left-0 w-full z-[100] transition-all duration-500 py-6" id="main-header">
    <div class="max-w-[1440px] mx-auto px-6">
        <nav class="glass rounded-full px-8 py-3.5 flex justify-between items-center shadow-premium border border-white/60">
            <a href="{{ route('home') }}" class="text-2xl font-black tracking-tighter text-primary">BeA<span class="text-on-background">English</span></a>
            <div class="hidden lg:flex items-center gap-10">
                <a class="text-sm font-bold text-primary" href="#">Trang chủ</a>
                <a class="text-sm font-bold text-on-background/70 hover:text-primary transition-all" href="#">Giới thiệu</a>
                <a class="text-sm font-bold text-on-background/70 hover:text-primary transition-all" href="#">Phương pháp</a>
                <a class="text-sm font-bold text-on-background/70 hover:text-primary transition-all" href="#">Học tại BeA</a>
                <a class="text-sm font-bold text-on-background/70 hover:text-primary transition-all" href="#">Tin tức</a>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="hidden md:block text-sm font-bold text-on-background/80 hover:text-on-background px-4 transition-colors">Đăng nhập</a>
                <button class="bg-primary text-white px-8 py-3 rounded-full text-sm font-black shadow-lg shadow-primary/30 hover:scale-105 active:scale-95 transition-all">Học thử miễn phí</button>
            </div>
        </nav>
    </div>
</header>

<main>

    {{-- ── Hero ── --}}
    <section class="relative min-h-[90vh] flex items-center pt-32 pb-20 overflow-hidden orange-glow-bg">
        <div class="max-w-[1280px] mx-auto px-6 w-full relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">

                {{-- Left: Text --}}
                <div class="space-y-10 order-2 lg:order-1">
                    <div class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full bg-primary/5 text-primary text-xs font-black uppercase tracking-[0.2em] border border-primary/10">
                        <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                        Định hướng tương lai cùng BeA English
                    </div>
                    <div>
                        <h1 class="text-6xl md:text-8xl lg:text-[100px] font-black leading-[0.95] tracking-tighter text-gradient mb-8">
                            Nền tảng<br/>vững vàng
                        </h1>
                        <h2 class="text-5xl md:text-7xl lg:text-8xl font-black text-primary italic leading-tight tracking-tight">
                            Tương lai rộng mở!
                        </h2>
                    </div>
                    <p class="text-xl text-text-body/70 leading-relaxed max-w-xl font-medium">
                        Hệ sinh thái giáo dục tiếng Anh chuẩn quốc tế, giúp hàng triệu học viên chinh phục IELTS, TOEIC với phương pháp cá nhân hoá đột phá.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center gap-6">
                        <button class="w-full sm:w-auto bg-on-background text-white px-10 py-5 rounded-full text-lg font-black shadow-2xl hover:bg-primary transition-all flex items-center justify-center gap-3 group">
                            Khám phá ngay
                            <span class="material-symbols-outlined group-hover:translate-x-2 transition-transform">arrow_forward</span>
                        </button>
                        <button class="w-full sm:w-auto px-10 py-5 rounded-full text-lg font-bold border-2 border-outline-variant/30 hover:border-primary/40 transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">play_circle</span>
                            Xem video
                        </button>
                    </div>
                </div>

                {{-- Right: Image --}}
                <div class="relative order-1 lg:order-2">
                    <div class="relative z-10 animate-float">
                        <div class="rounded-[3rem] overflow-hidden aspect-[4/5] border-[12px] border-white/50 bg-white shadow-2xl">
                            <img alt="Hero Student"
                                 class="w-full h-full object-cover"
                                 src="https://lh3.googleusercontent.com/aida-public/AB6AXuA5VEjQbfsRQJO0ig6Hpujc9WdcQPmaqVMda6jNp8pRfp6LxxGxL12PZVmOhpSVQ1GRGQyEClDw7AIrzktlV1KgbXP4J944_jdD0esTgyql9rx6CZpnw_sQkRgcPmj1cEB_9CBeASzH8wmd5yLbKpt_ZpyvLT_RWhCJsa-nk0yHwhYmRB8avCVFXCWe3UtJ2RZe9HM4dxTshaQp3scfMJ6Sg-r-vZG3izQuifFRrZc7WOjDGYzV2ZXxv11hzgRtNbEZ-A--CCUc454"/>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>
                    </div>
                    <div class="absolute -top-10 -right-10 w-64 h-64 bg-primary/20 blur-[100px] rounded-full pointer-events-none"></div>
                    <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-secondary/20 blur-[80px] rounded-full pointer-events-none"></div>
                    <div class="absolute bottom-12 -left-12 z-20 glass p-6 rounded-3xl shadow-premium border border-white max-w-[240px]">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined">verified</span>
                            </div>
                            <div class="font-black text-on-background">Chuẩn Quốc Tế</div>
                        </div>
                        <p class="text-xs text-text-body/60 font-bold leading-relaxed">Giáo trình từ Oxford &amp; Cambridge được bản địa hóa.</p>
                    </div>
                </div>

            </div>
        </div>
        {{-- Slider dots --}}
        <div class="absolute bottom-12 left-1/2 -translate-x-1/2 flex items-center gap-4 z-20">
            <div class="w-8 h-2.5 rounded-full bg-primary transition-all cursor-pointer"></div>
            <div class="w-2.5 h-2.5 rounded-full bg-primary/20 hover:bg-primary/40 transition-all cursor-pointer"></div>
            <div class="w-2.5 h-2.5 rounded-full bg-primary/20 hover:bg-primary/40 transition-all cursor-pointer"></div>
        </div>
    </section>

    {{-- ── Stats ── --}}
    <section class="py-20 bg-white border-y border-outline-variant/10">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-4">
                @foreach(['Học online 4.0','Giáo viên quốc tế','Cá nhân hóa lộ trình','Cam kết đầu ra'] as $label)
                <div class="flex flex-col items-center text-center px-4">
                    <div class="text-5xl md:text-6xl font-black text-on-background mb-3 tabular-nums">100<span class="text-primary">%</span></div>
                    <p class="text-xs font-black text-on-background/40 uppercase tracking-[0.2em]">{{ $label }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Bento Grid: Programs ── --}}
    <section class="py-32">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="flex flex-col lg:flex-row justify-between items-end gap-10 mb-20">
                <div class="max-w-3xl">
                    <span class="text-primary font-black uppercase tracking-widest text-xs mb-4 block">Chương trình đào tạo</span>
                    <h2 class="text-5xl md:text-7xl font-black text-gradient leading-[1.1]">Thiết kế riêng cho<br/>từng mục tiêu</h2>
                </div>
                <button class="group flex items-center gap-3 text-primary font-black hover:gap-6 transition-all pb-2 whitespace-nowrap">
                    Xem tất cả khóa học <span class="material-symbols-outlined">trending_flat</span>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-10">

                {{-- Card 1: Students --}}
                <div class="md:col-span-7 lg:col-span-8 bg-white bento-card rounded-[3rem] p-12 lg:p-16 border border-outline-variant/30 shadow-premium relative overflow-hidden flex flex-col justify-between min-h-[500px]">
                    <div class="relative z-10">
                        <span class="inline-block px-4 py-1.5 rounded-full bg-primary/10 text-primary text-[10px] font-black uppercase tracking-widest mb-8">Dành cho học sinh</span>
                        <h3 class="text-4xl lg:text-5xl font-black text-on-background mb-10 leading-tight">Tiếng Anh Học Sinh Cambridge</h3>
                        <div class="grid sm:grid-cols-2 gap-8">
                            <div class="space-y-4">
                                <div class="w-12 h-12 rounded-2xl bg-primary/5 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined">menu_book</span>
                                </div>
                                <h4 class="font-black text-lg">Hệ Cambridge</h4>
                                <p class="text-sm text-text-body/60 leading-relaxed">Xây dựng nền tảng vững chắc theo khung chuẩn quốc tế CEFR.</p>
                            </div>
                            <div class="space-y-4">
                                <div class="w-12 h-12 rounded-2xl bg-secondary/5 flex items-center justify-center text-secondary">
                                    <span class="material-symbols-outlined">psychology</span>
                                </div>
                                <h4 class="font-black text-lg">Tư duy toàn diện</h4>
                                <p class="text-sm text-text-body/60 leading-relaxed">Phát triển kỹ năng phản biện và sáng tạo qua ngôn ngữ.</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative z-10 pt-12">
                        <button class="bg-on-background text-white px-10 py-4 rounded-full font-black text-sm hover:bg-primary transition-all">Chi tiết chương trình</button>
                    </div>
                    <div class="absolute -right-20 -bottom-20 opacity-[0.03] pointer-events-none">
                        <span class="material-symbols-outlined text-[450px]">school</span>
                    </div>
                </div>

                {{-- Card 2: Adult --}}
                <div class="md:col-span-5 lg:col-span-4 bg-primary bento-card rounded-[3rem] overflow-hidden relative min-h-[500px] flex flex-col justify-end p-12 group">
                    <img alt="Adult program"
                         class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-110 transition-transform duration-1000"
                         src="https://lh3.googleusercontent.com/aida-public/AB6AXuCQmBR8xVLFxdnJH72MJCB1hUGqovuop23XSl39vIHG0yBkUBwfGCT36dOR2TTtmT9rd5_aLPUCBXtNTfGnN_ddcugxfiD3kw9lRrsqJ2kV_YTr3PrBXKbIqkWR2sua0-OLIJzIRAkMVvBmFWBTeGTpMRdcgljnqIFvBqZ4M2teVVISpwmvxW56RT9MniMkTl6Ko_P_Xgm_9b-U2b202v9HbmgMqo9hEHgXz9QFVRxZQKMvGGPGLc6zOWvqn22jx7PkUF6uFabQMQQ"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-primary-dark via-primary/20 to-transparent"></div>
                    <div class="relative z-10 space-y-6">
                        <h3 class="text-4xl font-black text-white leading-tight">Tiếng Anh<br/>Người Lớn</h3>
                        <p class="text-white/80 font-medium leading-relaxed">Tự tin giao tiếp và nâng tầm sự nghiệp trong môi trường quốc tế.</p>
                        <button class="w-14 h-14 bg-white rounded-full flex items-center justify-center text-primary shadow-xl group-hover:w-full group-hover:rounded-2xl transition-all duration-500 overflow-hidden">
                            <span class="material-symbols-outlined group-hover:hidden">arrow_forward</span>
                            <span class="hidden group-hover:block font-black text-sm">KHÁM PHÁ NGAY</span>
                        </button>
                    </div>
                </div>

                {{-- Card 3: Communication --}}
                <div class="md:col-span-12 bg-[#f0f4f9] bento-card rounded-[3rem] p-12 lg:p-16 border border-white shadow-premium flex flex-col lg:flex-row gap-16 items-center overflow-hidden">
                    <div class="lg:w-1/2 space-y-8">
                        <h3 class="text-4xl font-black text-on-background leading-tight">Giao tiếp chuyên nghiệp<br/>cho mọi ngành nghề</h3>
                        <p class="text-lg text-text-body/70 leading-relaxed font-medium">Chương trình gồm 4 cấp độ từ cơ bản đến nâng cao với 10 khóa học chuyên sâu, giúp bạn phản xạ tự nhiên trong mọi tình huống.</p>
                        <div class="flex flex-wrap gap-3">
                            <span class="px-5 py-2 rounded-full bg-white text-xs font-black text-primary border border-primary/10 shadow-sm">5000+ TỪ VỰNG</span>
                            <span class="px-5 py-2 rounded-full bg-white text-xs font-black text-primary border border-primary/10 shadow-sm">CHUẨN CEFR A2-B2</span>
                            <span class="px-5 py-2 rounded-full bg-white text-xs font-black text-primary border border-primary/10 shadow-sm">LỊCH HỌC LINH HOẠT</span>
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full grid grid-cols-2 gap-6">
                        <div class="p-10 bg-white rounded-3xl shadow-sm border border-outline-variant/10 hover:shadow-xl transition-all group">
                            <div class="w-14 h-14 bg-secondary/5 rounded-2xl flex items-center justify-center text-secondary mb-6 group-hover:bg-secondary group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined text-3xl">work</span>
                            </div>
                            <h4 class="font-black text-xl mb-2">Thăng tiến</h4>
                            <p class="text-sm text-text-body/50">Cơ hội tại tập đoàn đa quốc gia.</p>
                        </div>
                        <div class="p-10 bg-white rounded-3xl shadow-sm border border-outline-variant/10 hover:shadow-xl transition-all group translate-y-8">
                            <div class="w-14 h-14 bg-primary/5 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined text-3xl">flight</span>
                            </div>
                            <h4 class="font-black text-xl mb-2">Du lịch</h4>
                            <p class="text-sm text-text-body/50">Tự tin kết nối khắp toàn cầu.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── IELTS Roadmap ── --}}
    <section class="py-32 bg-on-background overflow-hidden relative">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-primary/5 blur-[150px] pointer-events-none"></div>
        <div class="max-w-[1280px] mx-auto px-6 relative z-10">
            <div class="text-center mb-24">
                <span class="text-primary font-black uppercase tracking-[0.3em] text-xs mb-4 block">Lộ trình bứt phá</span>
                <h2 class="text-5xl md:text-7xl font-black text-white leading-tight">Luyện thi IELTS<br/>Cam kết đầu ra</h2>
            </div>
            <div class="flex gap-8 overflow-x-auto pb-20 no-scrollbar snap-x px-4">
                @foreach([
                    ['0 - 3.5','Foundation','school','Xây dựng nền tảng ngữ pháp, phát âm và từ vựng cốt lõi bài bản nhất.','Cam kết đầu ra 3.5',false],
                    ['3.5 - 4.5','Standard','auto_graph','Phát triển toàn diện 4 kỹ năng theo cấu trúc đề thi IELTS thực tế.','Cam kết đầu ra 4.5',false],
                    ['4.5 - 5.5','Advanced','star','Chinh phục điểm số cao với chiến thuật làm bài chuyên sâu từ chuyên gia.','Cam kết đầu ra 5.5',true],
                    ['5.5 - 6.5','Elite','workspace_premium','Làm chủ kỹ năng Speaking & Writing học thuật để đạt mục tiêu du học.','Hoàn phí nếu không đạt',false],
                ] as [$range,$level,$icon,$desc,$commit,$featured])
                @if($featured)
                <div class="min-w-[340px] md:min-w-[400px] snap-center bg-primary p-12 rounded-[2.5rem] shadow-[0_40px_80px_-15px_rgba(249,115,22,0.4)] relative overflow-hidden flex flex-col justify-between flex-shrink-0">
                    <div class="absolute top-0 right-0 px-8 py-3 bg-white/20 text-white text-[10px] font-black uppercase tracking-widest rounded-bl-3xl">Phổ biến nhất</div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-16">
                            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center text-white border border-white/30">
                                <span class="material-symbols-outlined text-3xl">{{ $icon }}</span>
                            </div>
                            <span class="text-[10px] font-black uppercase tracking-widest text-white/80 bg-white/20 px-4 py-1.5 rounded-full">{{ $level }}</span>
                        </div>
                        <div class="text-6xl font-black text-white mb-6 tracking-tighter">{{ $range }}<span class="text-white/60">+</span></div>
                        <p class="text-white/90 font-medium mb-12 leading-relaxed">{{ $desc }}</p>
                    </div>
                    <div class="space-y-4 pt-8 border-t border-white/20 relative z-10">
                        <div class="flex items-center gap-3 text-sm font-black text-white">
                            <span class="material-symbols-outlined text-xl">check_circle</span>{{ $commit }}
                        </div>
                    </div>
                    <div class="absolute -bottom-10 -right-10 opacity-10 rotate-12 pointer-events-none">
                        <span class="material-symbols-outlined text-[240px] text-white">rocket_launch</span>
                    </div>
                </div>
                @else
                <div class="min-w-[340px] md:min-w-[400px] snap-center glass-dark p-12 rounded-[2.5rem] border border-white/10 group transition-all duration-500 hover:border-primary/50 relative flex-shrink-0">
                    <div class="flex justify-between items-start mb-16">
                        <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center text-primary border border-white/10">
                            <span class="material-symbols-outlined text-3xl">{{ $icon }}</span>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-primary/60 bg-primary/10 px-4 py-1.5 rounded-full">{{ $level }}</span>
                    </div>
                    <div class="text-6xl font-black text-white mb-6 tracking-tighter">{{ $range }}<span class="text-primary">+</span></div>
                    <p class="text-white/40 font-medium mb-12 leading-relaxed">{{ $desc }}</p>
                    <div class="space-y-4 pt-8 border-t border-white/5">
                        <div class="flex items-center gap-3 text-sm font-bold text-white/80">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>{{ $commit }}
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── CTA & Registration ── --}}
    <section class="py-32">
        <div class="max-w-[1400px] mx-auto px-6">
            <div class="bg-on-background rounded-[4rem] overflow-hidden flex flex-col lg:flex-row relative shadow-2xl">
                <div class="absolute top-0 right-0 w-1/3 h-full bg-primary/10 -skew-x-12 translate-x-1/2 pointer-events-none"></div>

                {{-- Left: Benefits --}}
                <div class="lg:w-1/2 p-12 lg:p-24 relative z-10">
                    <h2 class="text-5xl lg:text-7xl font-black text-white mb-16 leading-[1.1] tracking-tight">
                        Nhận quà tặng &amp;<br/><span class="text-primary italic">Ưu đãi độc quyền</span>
                    </h2>
                    <div class="space-y-12">
                        @foreach([
                            ['confirmation_number','Voucher 300.000 VNĐ','Giảm ngay vào học phí khi đăng ký trọn bộ khóa học đầu tiên tại BeA.'],
                            ['laptop_mac','Phần mềm Oxford Pro','Trị giá 4.000.000 VNĐ. Tài khoản bản quyền học ngữ pháp chuyên sâu.'],
                            ['video_library','Kho tài liệu Elite','Độc quyền với hơn 500 bài giảng video và ebook chất lượng cao.'],
                        ] as [$icon,$title,$desc])
                        <div class="flex gap-8 items-start group">
                            <div class="w-16 h-16 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-primary transition-all duration-300">
                                <span class="material-symbols-outlined text-white text-3xl">{{ $icon }}</span>
                            </div>
                            <div>
                                <h4 class="text-2xl font-black text-white mb-3">{{ $title }}</h4>
                                <p class="text-white/40 font-medium leading-relaxed">{{ $desc }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Right: Form --}}
                <div class="lg:w-1/2 p-4 lg:p-12 relative z-10">
                    <div class="bg-white rounded-[3rem] p-12 lg:p-16 h-full shadow-2xl flex flex-col justify-center">
                        <div class="text-center mb-12">
                            <h3 class="text-4xl font-black text-on-background mb-4">Đăng ký tư vấn</h3>
                            <p class="text-text-body/50 font-bold">Chúng tôi sẽ liên hệ lại ngay trong 30 phút</p>
                        </div>
                        <form class="space-y-6">
                            @csrf
                            <input class="w-full bg-[#f8f9ff] border-transparent px-8 py-6 rounded-2xl focus:ring-4 focus:ring-primary/10 transition-all font-bold text-on-background placeholder:text-on-background/30" placeholder="Họ và tên của bạn" type="text"/>
                            <input class="w-full bg-[#f8f9ff] border-transparent px-8 py-6 rounded-2xl focus:ring-4 focus:ring-primary/10 transition-all font-bold text-on-background placeholder:text-on-background/30" placeholder="Số điện thoại liên hệ" type="tel"/>
                            <div class="relative">
                                <select class="w-full bg-[#f8f9ff] border-transparent px-8 py-6 rounded-2xl focus:ring-4 focus:ring-primary/10 transition-all font-bold text-on-background appearance-none">
                                    <option>Chọn khóa học quan tâm</option>
                                    <option>Tiếng Anh Học Sinh</option>
                                    <option>Tiếng Anh Người Lớn</option>
                                    <option>Luyện thi IELTS</option>
                                </select>
                                <div class="absolute right-8 top-1/2 -translate-y-1/2 pointer-events-none opacity-40">
                                    <span class="material-symbols-outlined">expand_more</span>
                                </div>
                            </div>
                            <button type="submit" class="w-full bg-primary text-white py-6 rounded-2xl font-black text-lg shadow-glow hover:shadow-primary/50 hover:-translate-y-1 transition-all active:scale-95">
                                ĐĂNG KÝ NHẬN QUÀ NGAY
                            </button>
                            <p class="text-[10px] text-center text-on-background/20 uppercase tracking-[0.3em] font-black">Bảo mật thông tin 100%</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

{{-- ── Footer ── --}}
<footer class="bg-white pt-32 pb-16 border-t border-outline-variant/10">
    <div class="max-w-[1280px] mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-20 mb-32">
            <div class="space-y-10">
                <span class="text-3xl font-black tracking-tighter text-primary">BeA<span class="text-on-background">English</span></span>
                <p class="text-text-body/60 leading-relaxed font-bold">Tiền thân là cộng đồng giáo viên tiếng Anh quốc tế, chúng tôi cam kết đồng hành cùng tri thức Việt vươn tầm thế giới.</p>
                <div class="flex gap-5">
                    @foreach(['public','video_library','alternate_email'] as $icon)
                    <a class="w-12 h-12 rounded-2xl bg-[#f8f9ff] flex items-center justify-center hover:bg-primary hover:text-white transition-all shadow-sm" href="#">
                        <span class="material-symbols-outlined text-xl">{{ $icon }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
            <div>
                <h4 class="text-xs font-black text-on-background uppercase tracking-[0.3em] mb-10">Liên hệ</h4>
                <ul class="space-y-6">
                    <li class="flex gap-4 items-start">
                        <span class="material-symbols-outlined text-primary">location_on</span>
                        <span class="text-sm text-text-body/70 font-bold">Tòa S402 Vinhomes Smart City, Tây Mỗ, Hà Nội</span>
                    </li>
                    <li class="flex gap-4 items-center">
                        <span class="material-symbols-outlined text-primary">call</span>
                        <span class="text-sm text-text-body/70 font-bold">0972.291.474</span>
                    </li>
                    <li class="flex gap-4 items-center">
                        <span class="material-symbols-outlined text-primary">mail</span>
                        <span class="text-sm text-text-body/70 font-bold">info@beaenglish.vn</span>
                    </li>
                </ul>
            </div>
            <div>
                <h4 class="text-xs font-black text-on-background uppercase tracking-[0.3em] mb-10">Hệ sinh thái</h4>
                <ul class="space-y-5">
                    @foreach(['Tiếng Anh Học Sinh','Tiếng Anh Người Lớn','Luyện thi IELTS','Đào tạo Doanh nghiệp'] as $item)
                    <li><a class="text-sm text-text-body/70 hover:text-primary font-bold transition-all" href="#">{{ $item }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h4 class="text-xs font-black text-on-background uppercase tracking-[0.3em] mb-10">Cộng đồng</h4>
                <ul class="space-y-5">
                    @foreach(['Facebook Community','TikTok Learning','Youtube Channel'] as $item)
                    <li><a class="text-sm text-text-body/70 hover:text-primary font-bold transition-all" href="#">{{ $item }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="pt-16 border-t border-outline-variant/10 flex flex-col md:flex-row justify-between items-center gap-8">
            <p class="text-[10px] font-black text-on-background/20 uppercase tracking-[0.4em]">Copyright 2024 &copy; BeA English Education</p>
            <div class="flex gap-12">
                <a class="text-[10px] font-black text-on-background/30 hover:text-primary transition-all uppercase tracking-[0.4em]" href="#">Điều khoản</a>
                <a class="text-[10px] font-black text-on-background/30 hover:text-primary transition-all uppercase tracking-[0.4em]" href="#">Bảo mật</a>
            </div>
        </div>
    </div>
</footer>

{{-- ── Floating Actions ── --}}
<div class="fixed bottom-8 right-8 z-[100] flex flex-col gap-4">
    <a class="w-14 h-14 bg-[#0068ff] text-white rounded-2xl flex items-center justify-center shadow-2xl hover:-translate-y-2 transition-all font-black text-sm" href="https://zalo.me/0972291474">Zalo</a>
    <a class="w-14 h-14 bg-primary text-white rounded-2xl flex items-center justify-center shadow-glow hover:-translate-y-2 transition-all" href="tel:0972291474">
        <span class="material-symbols-outlined text-2xl">call</span>
    </a>
</div>

<script>
    const header = document.getElementById('main-header');
    window.addEventListener('scroll', () => {
        const nav = header.querySelector('nav');
        if (window.scrollY > 50) {
            header.classList.remove('py-6');
            header.classList.add('py-2');
            nav.classList.add('bg-white/95', 'backdrop-blur-xl', 'shadow-xl');
            nav.classList.remove('bg-white/70');
        } else {
            header.classList.add('py-6');
            header.classList.remove('py-2');
            nav.classList.remove('bg-white/95', 'backdrop-blur-xl', 'shadow-xl');
            nav.classList.add('bg-white/70');
        }
    });
</script>
</body>
</html>
