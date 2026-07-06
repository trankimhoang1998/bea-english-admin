{{-- resources/views/home/partials/contact.blade.php --}}
<section id="contact" class="py-14 lg:py-24 bg-on-background relative overflow-hidden">

    {{-- Decorative glow --}}
    <div class="absolute top-0 right-0 w-[500px] h-[400px] bg-primary-container/10 blur-[100px] rounded-full pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-primary-container/8 blur-[80px] rounded-full pointer-events-none"></div>

    {{-- Dot grid pattern --}}
    <div class="absolute inset-0 pointer-events-none"
         style="background-image: radial-gradient(rgba(249,115,22,0.12) 1px, transparent 1px); background-size: 32px 32px;"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-[1fr_380px] gap-12 lg:gap-16 items-center">

            {{-- LEFT: gifts --}}
            <div class="reveal">
                {{-- Title --}}
                <div class="mb-2">
                    <span class="inline-flex items-center gap-2 bg-primary-container/20 border border-primary-container/30 text-primary-container text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded-full mb-5">
                        <span class="material-symbols-outlined ms-filled text-[14px]">redeem</span>
                        Đăng ký nhận ngay
                    </span>
                </div>
                <h2 class="text-white font-black text-2xl lg:text-[2rem] uppercase leading-tight mb-3">
                    Nhận Quà Tặng/<br>Ưu Đãi Khủng
                </h2>
                <p class="text-white/40 text-[13px] mb-8">
                    Chính sách quà tặng có thể thay đổi theo thời điểm mà không được báo trước
                </p>

                {{-- Gift items --}}
                <div class="space-y-4">
                    @foreach([
                        [
                            'icon'  => 'redeem',
                            'title' => 'Tặng Voucher Trị Giá 300.000 VNĐ',
                            'desc'  => 'Giảm trực tiếp vào học phí khi thanh toán khóa học 01 lần',
                            'value' => '300K',
                        ],
                        [
                            'icon'  => 'school',
                            'title' => 'Tặng Bộ Phần Mềm Oxford Trị Giá 4.000.000 VNĐ',
                            'desc'  => 'Bộ phần mềm học tập và rèn luyện ngữ pháp do Đại học Oxford phát triển. Có tính tương tác cao, với nhiều bài tập thực hành, trò chơi ngữ pháp và video minh họa sinh động.',
                            'value' => '4TR',
                        ],
                        [
                            'icon'  => 'auto_stories',
                            'title' => 'Tặng Bộ Tài Liệu, Video Trị Giá 2.000.000 VNĐ',
                            'desc'  => 'Bộ tuyển tập tài liệu, video rèn luyện toàn diện 4 kỹ năng chọn lọc, thường xuyên được cập nhật của BeA chắc chắn giúp bạn học tập hiệu quả hơn.',
                            'value' => '2TR',
                        ],
                    ] as $i => $g)
                    <div class="flex items-start gap-4 bg-white/5 border border-white/10 rounded-2xl p-5 hover:bg-white/8 transition-colors reveal reveal-delay-{{ $i + 1 }}">
                        <div class="w-11 h-11 rounded-full bg-primary-container flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined ms-filled text-white text-[20px]">{{ $g['icon'] }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-white font-bold text-[13px] uppercase tracking-wide mb-1">{{ $g['title'] }}</p>
                            <p class="text-white/50 text-[12.5px] leading-relaxed">{{ $g['desc'] }}</p>
                        </div>
                        <span class="shrink-0 bg-primary-container/20 text-primary-container text-[11px] font-black px-2.5 py-1 rounded-full border border-primary-container/30">
                            {{ $g['value'] }}
                        </span>
                    </div>
                    @endforeach
                </div>

                {{-- Total value --}}
                <div class="mt-6 flex items-center gap-3 bg-primary-container/10 border border-primary-container/20 rounded-2xl px-5 py-4">
                    <span class="material-symbols-outlined ms-filled text-primary-container text-[22px]">savings</span>
                    <div>
                        <p class="text-white/60 text-[11px] uppercase tracking-widest">Tổng giá trị quà tặng lên đến</p>
                        <p class="text-primary-container font-black text-xl leading-none">6.300.000 VNĐ</p>
                    </div>
                </div>
            </div>

            {{-- RIGHT: form --}}
            <div class="reveal reveal-delay-2"
                 x-data="{
                     submitted: false,
                     loading: false,
                     name: '',
                     phone: '',
                     audience: '',
                     errors: {},
                     async submit() {
                         if (this.loading) return;
                         this.errors = {};

                         // Client-side validation
                         if (!this.name.trim()) {
                             this.errors.name = ['Vui lòng nhập họ tên.'];
                         }
                         if (!this.phone.trim()) {
                             this.errors.phone = ['Vui lòng nhập số điện thoại.'];
                         } else if (!/^0[3-9]\d{8}$/.test(this.phone.trim())) {
                             this.errors.phone = ['Số điện thoại không hợp lệ (10 số, bắt đầu bằng 03–09).'];
                         }
                         if (Object.keys(this.errors).length > 0) return;

                         this.loading = true;
                         try {
                             const res = await fetch('{{ route('registration.store') }}', {
                                 method: 'POST',
                                 headers: {
                                     'Content-Type': 'application/json',
                                     'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                     'Accept': 'application/json',
                                 },
                                 body: JSON.stringify({
                                     name:     this.name.trim(),
                                     phone:    this.phone.trim(),
                                     audience: this.audience || null,
                                 }),
                             });
                             if (res.ok) {
                                 this.submitted = true;
                             } else {
                                 const data = await res.json();
                                 if (data.errors) this.errors = data.errors;
                             }
                         } catch (e) {
                             this.errors = { name: ['Lỗi kết nối, vui lòng thử lại.'] };
                         } finally {
                             this.loading = false;
                         }
                     }
                 }">

                {{-- Form card --}}
                <div x-show="!submitted"
                     class="rounded-3xl overflow-hidden shadow-2xl shadow-black/40">

                    {{-- Orange header --}}
                    <div class="bg-gradient-to-br from-orange-500 to-primary-container px-6 py-6 text-center relative overflow-hidden">
                        <div class="absolute -top-6 -right-6 w-24 h-24 rounded-full bg-white/10"></div>
                        <div class="absolute -bottom-4 -left-4 w-16 h-16 rounded-full bg-white/10"></div>
                        <h3 class="text-white font-black text-xl lg:text-2xl uppercase leading-tight relative">
                            Đăng Ký Tư Vấn<br>Và Học Thử Miễn Phí
                        </h3>
                        <p class="text-white/80 text-[13px] mt-2 relative">Đăng ký liền tay, nhận ngay quà khủng</p>
                    </div>

                    {{-- Form body --}}
                    <div class="bg-white px-6 pb-6 pt-5">
                        <form @submit.prevent="submit" class="space-y-3">

                            <div>
                                <input type="text" x-model="name" placeholder="Mời nhập họ tên (*)"
                                       :class="errors.name ? 'border-red-400 bg-red-50' : 'border-gray-200 bg-gray-50'"
                                       class="w-full px-4 py-3 rounded-xl text-gray-800 placeholder-gray-400 text-[14px] focus:outline-none focus:border-primary-container focus:bg-white transition-colors border">
                                <p x-show="errors.name" x-text="errors.name?.[0]"
                                   class="text-red-500 text-[12px] mt-1 ml-1"></p>
                            </div>

                            <div>
                                <input type="tel" x-model="phone" placeholder="Mời nhập số điện thoại (*)"
                                       :class="errors.phone ? 'border-red-400 bg-red-50' : 'border-gray-200 bg-gray-50'"
                                       class="w-full px-4 py-3 rounded-xl text-gray-800 placeholder-gray-400 text-[14px] focus:outline-none focus:border-primary-container focus:bg-white transition-colors border">
                                <p x-show="errors.phone" x-text="errors.phone?.[0]"
                                   class="text-red-500 text-[12px] mt-1 ml-1"></p>
                            </div>

                            <select x-model="audience"
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-500 text-[14px] focus:outline-none focus:border-primary-container focus:bg-white transition-colors"
                                    style="-webkit-appearance:none;-moz-appearance:none;appearance:none;background-image:url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='%239ca3af'%3E%3Cpath fill-rule='evenodd' d='M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z' clip-rule='evenodd'/%3E%3C/svg%3E&quot;);background-repeat:no-repeat;background-position:right 0.75rem center;background-size:1.2em;padding-right:2.5rem;">
                                <option value="">Mời chọn đối tượng</option>
                                <option value="hoc-sinh-tieu-hoc">Học sinh tiểu học</option>
                                <option value="hoc-sinh-thcs">Học sinh THCS</option>
                                <option value="hoc-sinh-thpt">Học sinh THPT</option>
                                <option value="sinh-vien">Sinh viên đại học</option>
                                <option value="nguoi-di-lam">Người đi làm</option>
                                <option value="ielts">Luyện thi IELTS</option>
                                <option value="khac">Khác</option>
                            </select>

                            <button type="submit"
                                    class="w-full py-3.5 rounded-xl bg-primary-container text-white font-black text-[14px] uppercase tracking-widest
                                           hover:bg-orange-600 transition-all duration-200 shadow-lg shadow-primary-container/30
                                           hover:-translate-y-0.5 disabled:opacity-60 flex items-center justify-center gap-2"
                                    :disabled="loading">
                                <svg x-show="loading" class="animate-spin w-5 h-5" viewBox="0 0 24 24" fill="none">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="white" stroke-width="4"/>
                                    <path class="opacity-75" fill="white" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                                </svg>
                                <span x-text="loading ? 'Đang gửi...' : 'Đăng Kí Ngay'"></span>
                            </button>

                            <p class="text-center text-gray-400 text-[11px]">
                                Thông tin của bạn được bảo mật tuyệt đối
                            </p>
                        </form>
                    </div>
                </div>

                {{-- Success state --}}
                <div x-show="submitted"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="rounded-3xl bg-white/5 border border-white/10 p-12 text-center">
                    <div class="w-16 h-16 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-5">
                        <span class="material-symbols-outlined ms-filled text-green-400 text-[32px]">check_circle</span>
                    </div>
                    <h3 class="font-black text-white text-xl mb-2">Đăng ký thành công!</h3>
                    <p class="text-white/60 text-sm leading-relaxed max-w-xs mx-auto">
                        Chuyên viên tư vấn sẽ liên hệ bạn sớm nhất có thể. Hẹn gặp bạn tại BEA English!
                    </p>
                </div>

            </div>
        </div>

    </div>
</section>
