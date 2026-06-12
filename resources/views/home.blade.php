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
                        "primary":          "#f97316",
                        "primary-dark":     "#9d4300",
                        "on-background":    "#0B1C30",
                        "surface":          "#f8f9ff",
                        "surface-background": "#FFFFFF",
                        "text-body":        "#334155",
                        "text-heading":     "#0F172A",
                        "outline-variant":  "#E0C0B1",
                        "secondary":        "#255dad",
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg":  "0.5rem",
                        "xl":  "0.75rem",
                        "2xl": "1.5rem",
                        "3xl": "2.5rem",
                        "full": "9999px",
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
        .text-glow { text-shadow: 0 0 20px rgba(249,115,22,0.3); }
        .glass {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.1);
        }
        .glass-light {
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.5);
        }
        .orange-gradient-bg {
            background:
                radial-gradient(circle at 10% 20%, rgba(249,115,22,0.05) 0%, transparent 50%),
                radial-gradient(circle at 90% 80%, rgba(37,93,173,0.05) 0%, transparent 50%);
        }
        .premium-card-shadow { box-shadow: 0 20px 50px -12px rgba(0,0,0,0.08); }
        .premium-card-shadow:hover { box-shadow: 0 30px 60px -12px rgba(249,115,22,0.15); }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .floating { animation: floating 6s ease-in-out infinite; }
        @keyframes floating {
            0%   { transform: translateY(0px); }
            50%  { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .apple-text {
            background: linear-gradient(180deg, #1d1d1f 0%, #434345 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="bg-[#fcfcfd] font-body text-on-background selection:bg-primary selection:text-white">

{{-- ── Top Nav ── --}}
<header class="fixed top-0 left-0 w-full z-[100] transition-all duration-300" id="navbar">
    <div class="max-w-[1440px] mx-auto px-6 py-4">
        <nav class="glass-light rounded-full px-8 py-3 flex justify-between items-center shadow-sm border border-white/40">
            <div class="flex items-center gap-2">
                <a href="{{ route('home') }}" class="text-2xl font-black tracking-tighter text-primary">BeA<span class="text-on-background">English</span></a>
            </div>
            <div class="hidden lg:flex items-center gap-10">
                <a class="text-sm font-semibold text-primary" href="#">Trang chủ</a>
                <a class="text-sm font-semibold text-on-background/70 hover:text-primary transition-colors" href="#">Giới thiệu</a>
                <a class="text-sm font-semibold text-on-background/70 hover:text-primary transition-colors" href="#">Phương pháp</a>
                <a class="text-sm font-semibold text-on-background/70 hover:text-primary transition-colors" href="#">Học tại BeA</a>
                <a class="text-sm font-semibold text-on-background/70 hover:text-primary transition-colors" href="#">Tin tức</a>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="hidden md:block text-sm font-bold text-on-background/80 hover:text-on-background transition-colors">Đăng nhập</a>
                <button class="bg-primary text-white px-7 py-3 rounded-full text-sm font-bold shadow-lg shadow-primary/25 hover:scale-105 active:scale-95 transition-all">Học thử miễn phí</button>
            </div>
        </nav>
    </div>
</header>

<main>

    {{-- ── Hero ── --}}
    <section class="relative pt-40 pb-20 lg:pt-52 lg:pb-32 overflow-hidden orange-gradient-bg">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10 overflow-hidden">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-primary/10 blur-[120px] rounded-full"></div>
            <div class="absolute bottom-[10%] right-[-5%] w-[30%] h-[30%] bg-secondary/10 blur-[100px] rounded-full"></div>
        </div>
        <div class="max-w-[1280px] mx-auto px-6 relative z-10">
            <div class="flex flex-col items-center text-center max-w-4xl mx-auto mb-20">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-widest mb-8">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                    </span>
                    Định hướng tương lai cùng BeA English
                </div>
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-black apple-text leading-[1.05] tracking-tight mb-8">
                    Nền tảng vững vàng<br/>
                    <span class="text-primary italic">Tương lai rộng mở!</span>
                </h1>
                <p class="text-lg md:text-xl text-text-body/80 leading-relaxed mb-12 max-w-2xl font-medium">
                    Hệ sinh thái giáo dục tiếng Anh chuẩn quốc tế, giúp hàng triệu học viên chinh phục IELTS, TOEIC với phương pháp cá nhân hoá đột phá.
                </p>
                <div class="flex flex-col sm:flex-row items-center gap-5">
                    <button class="w-full sm:w-auto bg-primary text-white px-10 py-5 rounded-full text-lg font-bold shadow-2xl shadow-primary/30 hover:shadow-primary/40 hover:-translate-y-1 transition-all flex items-center justify-center gap-3">
                        Bắt đầu ngay <span class="material-symbols-outlined">east</span>
                    </button>
                    <button class="w-full sm:w-auto bg-white text-on-background px-10 py-5 rounded-full text-lg font-bold border border-outline-variant hover:bg-surface transition-all">
                        Tìm hiểu thêm
                    </button>
                </div>
            </div>

            <div class="relative group mt-10">
                <div class="absolute -inset-1 bg-gradient-to-r from-primary to-secondary rounded-3xl blur opacity-20 group-hover:opacity-30 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-white rounded-3xl overflow-hidden shadow-2xl border border-white/20">
                    <img alt="Students studying"
                         class="w-full h-[400px] md:h-[600px] object-cover scale-105 group-hover:scale-100 transition-transform duration-1000"
                         src="https://lh3.googleusercontent.com/aida-public/AB6AXuA5VEjQbfsRQJO0ig6Hpujc9WdcQPmaqVMda6jNp8pRfp6LxxGxL12PZVmOhpSVQ1GRGQyEClDw7AIrzktlV1KgbXP4J944_jdD0esTgyql9rx6CZpnw_sQkRgcPmj1cEB_9CBeASzH8wmd5yLbKpt_ZpyvLT_RWhCJsa-nk0yHwhYmRB8avCVFXCWe3UtJ2RZe9HM4dxTshaQp3scfMJ6Sg-r-vZG3izQuifFRrZc7WOjDGYzV2ZXxv11hzgRtNbEZ-A--CCUc454"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                </div>
                <div class="absolute -bottom-10 -left-6 hidden xl:block floating">
                    <div class="glass-light p-8 rounded-3xl premium-card-shadow border border-white">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center text-white">
                                <span class="material-symbols-outlined">groups</span>
                            </div>
                            <div>
                                <div class="text-2xl font-black text-on-background">50,000+</div>
                                <div class="text-xs font-bold text-on-background/50 uppercase tracking-widest">Học viên tin dùng</div>
                            </div>
                        </div>
                        <div class="flex -space-x-3">
                            <img alt="user" class="w-8 h-8 rounded-full border-2 border-white" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDStKDjqfG59A4f15-L8SN852nPVCbutGPljVv88iP5MWH9o9oYm85SaxII3X1IZinh8DVWdDI8DghEhWzpSmgXZmaAgg9wooWcl2-9aZcGfoMU_WWIB9Qwj0TTjTNkYHkHp0-AWfX33d7grf3vEEx1Y3hZSDpKFx2lQK0UXUA6j5SC5iV4qBADR8_KSnyjPIR5casUOeJ0ANYE30pz0yiOc7MaB7LZr8CqpeFZ9BSeBiDdwubLiJlKwFJwEGJItUIJ8B8JghjksDE"/>
                            <img alt="user" class="w-8 h-8 rounded-full border-2 border-white" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBol91vZt3cnTmkzlnhrA_V_GcQ30QPNXh9v_mDEnh-E9lJPF9Xv9ZR-kp1NJaXIOAcQL8YwgjNMca8Vql18TBYc39yf5EnhMk8sPgwpUHV3w9R8bY2M6I_-YaMLJXM2W05-0TPPCu-PoXc__V81VzjvfqfzgZVk6wiaLhrFXkL5ZJ9XK7gUTUNC4g1I4x6uRd2xg7Ojcyt-T2dEu5MeqPPNrGobRRxO2Cr9cCk9KGJS7Yw3mqchHmMidZ0IH1Pynaj7hCZ1M6g_HQ"/>
                            <img alt="user" class="w-8 h-8 rounded-full border-2 border-white" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBGipu6QejvF5pVw1sPBBiY0puZjKUhT9uC4QD1cDdFZHGdmYvuhCJhVL4OUGz5ehv62t1kwNY-M9WTAcQwaOh6uAZj3-qetdSCCYmj0P-Una3RpFt5F95MEr3KClm5faELTidQEQrgwYiFbwwtW1msQTYcjdcBZkIHQuRn0DV2qJfu3wLHPmXW1nMDSqBAAV7F1q9icsz06NVPqNdL1QOtk0mjx56ZupDX9Pk-Q1-OyHVrdTQafpMqcSd0ueUBzX7LdKbQuM7YJzg"/>
                            <div class="w-8 h-8 rounded-full bg-primary/10 border-2 border-white flex items-center justify-center text-[10px] font-bold text-primary">+4.9k</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Trust Stats ── --}}
    <section class="py-24 bg-white">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8">
                @foreach([['100%','Học online 4.0'],['100%','Giáo viên quốc tế'],['100%','Cá nhân hóa lộ trình'],['100%','Cam kết đầu ra']] as [$stat,$label])
                <div class="flex flex-col items-center lg:items-start group">
                    <div class="text-5xl font-black apple-text mb-2 group-hover:text-primary transition-colors">{{ $stat }}</div>
                    <div class="h-1 w-12 bg-primary mb-4 rounded-full"></div>
                    <div class="text-sm font-black text-on-background/40 uppercase tracking-[0.2em]">{{ $label }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Bento Grid: Programs ── --}}
    <section class="py-24 bg-[#f8f9ff]">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-20">
                <div class="max-w-2xl">
                    <h2 class="text-4xl md:text-5xl font-black apple-text mb-6">Chương trình đào tạo<br/>Chuẩn quốc tế</h2>
                    <p class="text-lg text-text-body/70 font-medium">BeA mang đến giải pháp học tập toàn diện cho mọi lứa tuổi, từ trẻ em đến người đi làm, cam kết hiệu quả tối ưu.</p>
                </div>
                <button class="group flex items-center gap-2 text-primary font-bold hover:gap-4 transition-all whitespace-nowrap">
                    Xem tất cả khóa học <span class="material-symbols-outlined">trending_flat</span>
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                {{-- Card: Students --}}
                <div class="lg:col-span-8 bg-white rounded-3xl p-10 lg:p-14 premium-card-shadow relative overflow-hidden group">
                    <div class="relative z-10 flex flex-col h-full justify-between max-w-lg">
                        <div>
                            <span class="bg-primary/10 text-primary px-4 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-widest mb-8 inline-block">Dành cho học sinh</span>
                            <h3 class="text-3xl md:text-4xl font-black mb-8 text-on-background">Tiếng Anh Học Sinh Cambridge</h3>
                            <div class="space-y-8">
                                <div class="flex gap-5">
                                    <div class="w-12 h-12 rounded-2xl bg-primary/5 flex items-center justify-center flex-shrink-0 group-hover:bg-primary group-hover:text-white transition-colors">
                                        <span class="material-symbols-outlined">menu_book</span>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-on-background mb-1">10 Khóa học Chuẩn Cambridge</h4>
                                        <p class="text-sm text-text-body/60 leading-relaxed">Theo sát khung tham chiếu CEFR châu Âu, xây dựng nền tảng vững chắc nhất.</p>
                                    </div>
                                </div>
                                <div class="flex gap-5">
                                    <div class="w-12 h-12 rounded-2xl bg-primary/5 flex items-center justify-center flex-shrink-0 group-hover:bg-primary group-hover:text-white transition-colors">
                                        <span class="material-symbols-outlined">psychology</span>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-on-background mb-1">Phát triển tư duy toàn diện</h4>
                                        <p class="text-sm text-text-body/60 leading-relaxed">Rèn luyện phản biện, logic và kỹ năng giải quyết vấn đề bằng ngôn ngữ.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="mt-12 bg-on-background text-white px-8 py-4 rounded-full font-bold w-fit hover:bg-primary transition-colors">Khám phá chi tiết</button>
                    </div>
                    <div class="absolute right-[-10%] bottom-[-10%] w-2/3 h-2/3 opacity-5 group-hover:opacity-10 transition-opacity pointer-events-none">
                        <span class="material-symbols-outlined text-[400px]">auto_stories</span>
                    </div>
                </div>

                {{-- Card: Adult --}}
                <div class="lg:col-span-4 bg-primary rounded-3xl overflow-hidden premium-card-shadow relative group min-h-[420px]">
                    <img alt="Adult program"
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-70"
                         src="https://lh3.googleusercontent.com/aida-public/AB6AXuCQmBR8xVLFxdnJH72MJCB1hUGqovuop23XSl39vIHG0yBkUBwfGCT36dOR2TTtmT9rd5_aLPUCBXtNTfGnN_ddcugxfiD3kw9lRrsqJ2kV_YTr3PrBXKbIqkWR2sua0-OLIJzIRAkMVvBmFWBTeGTpMRdcgljnqIFvBqZ4M2teVVISpwmvxW56RT9MniMkTl6Ko_P_Xgm_9b-U2b202v9HbmgMqo9hEHgXz9QFVRxZQKMvGGPGLc6zOWvqn22jx7PkUF6uFabQMQQ"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-primary-dark via-primary/40 to-transparent p-10 flex flex-col justify-end">
                        <h3 class="text-3xl font-black text-white mb-4 leading-tight">Tiếng Anh<br/>Người Lớn</h3>
                        <p class="text-white/80 font-medium mb-8">Tự tin giao tiếp trong môi trường quốc tế và nâng tầm sự nghiệp.</p>
                        <button class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-primary shadow-lg group-hover:w-full group-hover:rounded-full transition-all duration-300 overflow-hidden">
                            <span class="material-symbols-outlined group-hover:hidden">arrow_forward</span>
                            <span class="hidden group-hover:inline font-bold text-sm">Tìm hiểu khóa học</span>
                        </button>
                    </div>
                </div>

                {{-- Card: Communication --}}
                <div class="lg:col-span-12 glass-light rounded-3xl p-10 lg:p-14 border border-white premium-card-shadow flex flex-col md:flex-row gap-12 items-center">
                    <div class="md:w-1/2">
                        <h3 class="text-3xl font-black apple-text mb-6">Tự tin giao tiếp và làm việc chuyên nghiệp</h3>
                        <p class="text-text-body/70 mb-10 text-lg font-medium leading-relaxed">Chương trình gồm 4 cấp độ từ cơ bản đến nâng cao với 10 khóa học chuyên sâu, giúp bạn phản xạ tự nhiên trong mọi tình huống hội thoại công việc.</p>
                        <div class="flex flex-wrap gap-4">
                            <span class="px-5 py-2 rounded-full bg-white border border-primary/20 text-primary text-xs font-bold shadow-sm">5000+ Từ vựng</span>
                            <span class="px-5 py-2 rounded-full bg-white border border-primary/20 text-primary text-xs font-bold shadow-sm">Chuẩn CEFR A2-B2</span>
                            <span class="px-5 py-2 rounded-full bg-white border border-primary/20 text-primary text-xs font-bold shadow-sm">Lịch học linh hoạt</span>
                        </div>
                    </div>
                    <div class="md:w-1/2 w-full grid grid-cols-2 gap-6">
                        <div class="p-8 bg-white rounded-2xl shadow-sm border border-outline-variant/30 hover:-translate-y-2 transition-transform">
                            <div class="w-14 h-14 bg-secondary/10 rounded-2xl flex items-center justify-center text-secondary mb-6">
                                <span class="material-symbols-outlined text-3xl">work</span>
                            </div>
                            <h4 class="font-black text-xl mb-2">Thăng tiến</h4>
                            <p class="text-sm text-text-body/50">Mở cánh cửa tại các tập đoàn đa quốc gia.</p>
                        </div>
                        <div class="p-8 bg-white rounded-2xl shadow-sm border border-outline-variant/30 hover:-translate-y-2 transition-transform">
                            <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6">
                                <span class="material-symbols-outlined text-3xl">flight</span>
                            </div>
                            <h4 class="font-black text-xl mb-2">Du lịch</h4>
                            <p class="text-sm text-text-body/50">Kết nối bạn bè thế giới dễ dàng hơn.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── IELTS Roadmap ── --}}
    <section class="py-24 overflow-hidden bg-white">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-5xl font-black apple-text mb-6">Lộ trình luyện thi IELTS</h2>
                <p class="text-lg text-text-body/60 max-w-2xl mx-auto font-medium">Cam kết đầu ra bằng văn bản, hỗ trợ học viên đạt điểm mục tiêu trong thời gian ngắn nhất.</p>
            </div>
            <div class="flex overflow-x-auto gap-8 pb-16 no-scrollbar snap-x snap-mandatory px-4">
                @foreach([
                    ['0 - 3.5+','Foundation','school','Xây dựng nền tảng ngữ pháp, phát âm và từ vựng cốt lõi cực kỳ bài bản.','Cam kết đầu ra 3.5','Luyện đề thi thật 100%',false],
                    ['3.5 - 4.5+','Standard','auto_graph','Phát triển toàn diện 4 kỹ năng theo khung đề thi IELTS chuẩn quốc tế.','Cam kết đầu ra 4.5','Tặng bộ tài liệu 990k',false],
                    ['4.5 - 5.5+','Advanced','star','Chinh phục điểm số cao với chiến thuật làm bài chuyên sâu từ chuyên gia.','Cam kết đầu ra 5.5','Luyện đề chuyên sâu 24/7',true],
                    ['5.5 - 6.5+','Elite','workspace_premium','Làm chủ kỹ năng Speaking & Writing học thuật để đạt điểm giỏi.','Cam kết đầu ra 6.5+','Hoàn học phí nếu không đạt',false],
                ] as [$range,$level,$icon,$desc,$c1,$c2,$featured])
                @if($featured)
                <div class="min-w-[340px] md:min-w-[380px] snap-center bg-primary p-10 rounded-3xl relative overflow-hidden shadow-2xl shadow-primary/40 -translate-y-4 flex-shrink-0">
                    <div class="absolute top-0 right-0 px-6 py-2 bg-white/20 text-white text-[10px] font-black uppercase tracking-widest rounded-bl-2xl">Phổ biến nhất</div>
                    <div class="flex justify-between items-start mb-12 relative z-10">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center text-white">
                            <span class="material-symbols-outlined text-3xl">{{ $icon }}</span>
                        </div>
                        <span class="px-4 py-1.5 rounded-full bg-white/20 text-white text-[10px] font-black uppercase tracking-widest">{{ $level }}</span>
                    </div>
                    <h4 class="text-5xl font-black text-white mb-4 relative z-10">{{ $range }}</h4>
                    <p class="text-white/80 font-medium mb-10 leading-relaxed relative z-10">{{ $desc }}</p>
                    <div class="space-y-4 pt-8 border-t border-white/20 relative z-10">
                        <div class="flex items-center gap-3 text-sm font-bold text-white"><span class="material-symbols-outlined">check_circle</span>{{ $c1 }}</div>
                        <div class="flex items-center gap-3 text-sm font-bold text-white"><span class="material-symbols-outlined">check_circle</span>{{ $c2 }}</div>
                    </div>
                    <div class="absolute -bottom-10 -right-10 opacity-10 rotate-12">
                        <span class="material-symbols-outlined text-[200px] text-white">rocket_launch</span>
                    </div>
                </div>
                @else
                <div class="min-w-[340px] md:min-w-[380px] snap-center bg-surface p-10 rounded-3xl border border-outline-variant/30 relative group transition-all duration-500 hover:bg-white premium-card-shadow flex-shrink-0">
                    <div class="flex justify-between items-start mb-12">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-sm text-primary">
                            <span class="material-symbols-outlined text-3xl">{{ $icon }}</span>
                        </div>
                        <span class="px-4 py-1.5 rounded-full bg-primary/10 text-primary text-[10px] font-black uppercase tracking-widest">{{ $level }}</span>
                    </div>
                    <h4 class="text-5xl font-black text-on-background mb-4">{{ $range }}</h4>
                    <p class="text-text-body/60 font-medium mb-10 leading-relaxed">{{ $desc }}</p>
                    <div class="space-y-4 pt-8 border-t border-outline-variant/20">
                        <div class="flex items-center gap-3 text-sm font-bold text-on-background"><span class="material-symbols-outlined text-green-500">check_circle</span>{{ $c1 }}</div>
                        <div class="flex items-center gap-3 text-sm font-bold text-on-background"><span class="material-symbols-outlined text-green-500">check_circle</span>{{ $c2 }}</div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── CTA & Registration ── --}}
    <section class="py-24 relative overflow-hidden">
        <div class="max-w-[1400px] mx-auto px-6">
            <div class="bg-on-background rounded-[3rem] overflow-hidden flex flex-col lg:flex-row relative">
                <div class="absolute top-0 right-0 w-1/3 h-full bg-primary/5 -skew-x-12 translate-x-1/2"></div>
                <div class="lg:w-1/2 p-12 lg:p-24 relative z-10">
                    <h2 class="text-4xl lg:text-6xl font-black text-white mb-12 leading-tight">
                        Nhận quà tặng &amp; <br/>
                        <span class="text-primary italic">Ưu đãi độc quyền</span>
                    </h2>
                    <div class="space-y-10">
                        @foreach([
                            ['confirmation_number','Voucher 300.000 VNĐ','Giảm ngay vào học phí khi đăng ký trọn bộ khóa học đầu tiên.'],
                            ['laptop_mac','Phần mềm Oxford Pro','Trị giá 4.000.000 VNĐ. Tài khoản bản quyền học ngữ pháp 5 cấp độ.'],
                            ['video_library','Kho tài liệu Elite','Độc quyền từ BeA English với hơn 500 bài giảng video chất lượng cao.'],
                        ] as [$icon,$title,$desc])
                        <div class="flex gap-8 items-start group">
                            <div class="w-14 h-14 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-primary transition-all duration-300">
                                <span class="material-symbols-outlined text-white text-2xl">{{ $icon }}</span>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-white mb-2">{{ $title }}</h4>
                                <p class="text-white/40 leading-relaxed">{{ $desc }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="lg:w-1/2 bg-white m-4 lg:m-8 rounded-[2rem] p-10 lg:p-16 relative z-10 shadow-2xl">
                    <div class="text-center mb-12">
                        <h3 class="text-3xl font-black text-on-background mb-3">Đăng ký tư vấn</h3>
                        <p class="text-text-body/60 font-medium">Chúng tôi sẽ liên hệ trong vòng 30 phút</p>
                    </div>
                    <form class="space-y-6">
                        @csrf
                        <input class="w-full bg-surface border-none px-6 py-5 rounded-2xl focus:ring-2 focus:ring-primary/20 transition-all font-medium text-on-background" placeholder="Họ và tên của bạn" type="text"/>
                        <input class="w-full bg-surface border-none px-6 py-5 rounded-2xl focus:ring-2 focus:ring-primary/20 transition-all font-medium text-on-background" placeholder="Số điện thoại liên hệ" type="tel"/>
                        <select class="w-full bg-surface border-none px-6 py-5 rounded-2xl focus:ring-2 focus:ring-primary/20 transition-all font-medium text-on-background appearance-none">
                            <option>Chọn khóa học bạn quan tâm</option>
                            <option>Tiếng Anh Học Sinh</option>
                            <option>Tiếng Anh Người Lớn</option>
                            <option>Luyện thi IELTS</option>
                        </select>
                        <button type="submit" class="w-full bg-primary text-white py-6 rounded-2xl font-black text-lg shadow-xl shadow-primary/30 hover:shadow-primary/50 hover:-translate-y-1 transition-all active:scale-[0.98]">
                            ĐĂNG KÝ NHẬN QUÀ NGAY
                        </button>
                        <p class="text-[10px] text-center text-on-background/30 uppercase tracking-[0.2em]">Bảo mật thông tin 100% theo tiêu chuẩn giáo dục quốc tế</p>
                    </form>
                </div>
            </div>
        </div>
    </section>

</main>

{{-- ── Footer ── --}}
<footer class="bg-white border-t border-outline-variant/30 pt-24 pb-12">
    <div class="max-w-[1280px] mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 mb-24">
            <div class="space-y-8">
                <span class="text-3xl font-black tracking-tighter text-primary">BeA<span class="text-on-background">English</span></span>
                <p class="text-text-body/60 leading-relaxed font-medium">Tiền thân là cộng đồng giáo viên tiếng Anh người Philippines, chúng tôi cam kết đồng hành cùng tri thức Việt trên hành trình vươn tầm thế giới.</p>
                <div class="flex gap-4">
                    <a class="w-12 h-12 rounded-2xl bg-surface flex items-center justify-center hover:bg-primary hover:text-white transition-all" href="#">
                        <span class="material-symbols-outlined">public</span>
                    </a>
                    <a class="w-12 h-12 rounded-2xl bg-surface flex items-center justify-center hover:bg-primary hover:text-white transition-all" href="#">
                        <span class="material-symbols-outlined">video_library</span>
                    </a>
                    <a class="w-12 h-12 rounded-2xl bg-surface flex items-center justify-center hover:bg-primary hover:text-white transition-all" href="#">
                        <span class="material-symbols-outlined">alternate_email</span>
                    </a>
                </div>
            </div>
            <div>
                <h4 class="text-sm font-black text-on-background uppercase tracking-[0.2em] mb-8">Liên hệ</h4>
                <ul class="space-y-5">
                    <li class="flex gap-4 items-start">
                        <span class="material-symbols-outlined text-primary">location_on</span>
                        <span class="text-sm text-text-body/70 font-medium">Tòa S402 Vinhomes Smart City, Tây Mỗ, Hà Nội</span>
                    </li>
                    <li class="flex gap-4 items-center">
                        <span class="material-symbols-outlined text-primary">call</span>
                        <span class="text-sm text-text-body/70 font-medium">0972.291.474</span>
                    </li>
                    <li class="flex gap-4 items-center">
                        <span class="material-symbols-outlined text-primary">mail</span>
                        <span class="text-sm text-text-body/70 font-medium">info@beaenglish.vn</span>
                    </li>
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-black text-on-background uppercase tracking-[0.2em] mb-8">Hệ sinh thái</h4>
                <ul class="space-y-4">
                    <li><a class="text-sm text-text-body/70 hover:text-primary font-medium transition-colors" href="#">Tiếng Anh Học Sinh</a></li>
                    <li><a class="text-sm text-text-body/70 hover:text-primary font-medium transition-colors" href="#">Tiếng Anh Người Lớn</a></li>
                    <li><a class="text-sm text-text-body/70 hover:text-primary font-medium transition-colors" href="#">Luyện thi IELTS chuyên sâu</a></li>
                    <li><a class="text-sm text-text-body/70 hover:text-primary font-medium transition-colors" href="#">Đào tạo Doanh nghiệp</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-black text-on-background uppercase tracking-[0.2em] mb-8">Kết nối với BeA</h4>
                <ul class="space-y-4">
                    <li><a class="text-sm text-text-body/70 hover:text-primary font-medium transition-colors" href="#">Facebook Community</a></li>
                    <li><a class="text-sm text-text-body/70 hover:text-primary font-medium transition-colors" href="#">TikTok Learning</a></li>
                    <li><a class="text-sm text-text-body/70 hover:text-primary font-medium transition-colors" href="#">Youtube Channel</a></li>
                </ul>
            </div>
        </div>
        <div class="pt-12 border-t border-outline-variant/20 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-xs font-bold text-on-background/30 uppercase tracking-widest">Copyright 2024 &copy; BeA English Education</p>
            <div class="flex gap-10">
                <a class="text-xs font-bold text-on-background/30 hover:text-on-background transition-colors uppercase tracking-widest" href="#">Điều khoản</a>
                <a class="text-xs font-bold text-on-background/30 hover:text-on-background transition-colors uppercase tracking-widest" href="#">Bảo mật</a>
            </div>
        </div>
    </div>
</footer>

{{-- ── Floating Widgets ── --}}
<div class="fixed bottom-10 right-10 z-[100] flex flex-col gap-4">
    <a class="w-16 h-16 bg-[#0068ff] text-white rounded-2xl flex items-center justify-center shadow-2xl hover:-translate-y-2 transition-all font-black" href="https://zalo.me/0972291474">Zalo</a>
    <a class="w-16 h-16 bg-primary text-white rounded-2xl flex items-center justify-center shadow-2xl hover:-translate-y-2 transition-all" href="tel:0972291474">
        <span class="material-symbols-outlined text-3xl">call</span>
    </a>
</div>

<script>
    const header = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        const nav = header.querySelector('nav');
        if (window.scrollY > 100) {
            nav.classList.remove('glass-light');
            nav.classList.add('bg-white/90', 'backdrop-blur-xl', 'shadow-lg');
        } else {
            nav.classList.add('glass-light');
            nav.classList.remove('bg-white/90', 'backdrop-blur-xl', 'shadow-lg');
        }
    });
</script>
</body>
</html>
