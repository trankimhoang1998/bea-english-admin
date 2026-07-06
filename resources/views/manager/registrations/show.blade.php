<x-app-layout>
    <x-slot name="title">Đăng ký #{{ $registration->id }} | BEA English</x-slot>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-sm">
            <div class="flex items-center gap-md min-w-0">
                <a href="{{ route('manager.registrations.index') }}"
                   class="text-secondary hover:text-on-surface transition-colors shrink-0">
                    <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                </a>
                <div class="min-w-0">
                    <h1 class="font-bold text-headline-sm text-on-surface">{{ $registration->name }}</h1>
                    <p class="text-label-sm text-secondary mt-xs">Đăng ký #{{ $registration->id }} — {{ $registration->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </x-slot>

    @if(session('success'))
    <div class="mb-md px-md py-sm bg-green-50 border border-green-200 text-green-800 text-body-sm rounded-xl">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid lg:grid-cols-[1fr_320px] gap-md">

        {{-- Info card --}}
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg space-y-md">
            <h2 class="text-label-sm font-semibold text-secondary uppercase tracking-wide">Thông tin</h2>

            <div class="grid sm:grid-cols-2 gap-md">
                <div>
                    <p class="text-label-sm text-secondary mb-xs">Họ tên</p>
                    <p class="text-body-sm font-semibold text-on-surface">{{ $registration->name }}</p>
                </div>
                <div>
                    <p class="text-label-sm text-secondary mb-xs">Số điện thoại</p>
                    <a href="tel:{{ $registration->phone }}"
                       class="text-body-sm font-semibold text-primary-container hover:underline">{{ $registration->phone }}</a>
                </div>
                <div>
                    <p class="text-label-sm text-secondary mb-xs">Đối tượng</p>
                    <p class="text-body-sm text-on-surface">{{ $registration->audienceLabel() }}</p>
                </div>
                <div>
                    <p class="text-label-sm text-secondary mb-xs">Trạng thái hiện tại</p>
                    @php $s = $registration->statusBadge(); @endphp
                    <span class="inline-flex items-center px-sm py-0.5 rounded-full text-label-sm font-medium {{ $s['class'] }}">
                        {{ $s['label'] }}
                    </span>
                </div>
                <div>
                    <p class="text-label-sm text-secondary mb-xs">Đăng ký lúc</p>
                    <p class="text-body-sm text-on-surface">{{ $registration->created_at->format('d/m/Y H:i') }}</p>
                </div>
                @if($registration->contacted_at)
                <div>
                    <p class="text-label-sm text-secondary mb-xs">Đã liên hệ lúc</p>
                    <p class="text-body-sm text-on-surface">
                        {{ $registration->contacted_at->format('d/m/Y H:i') }}
                        @if($registration->contactedBy)
                        <span class="text-secondary"> — {{ $registration->contactedBy->name }}</span>
                        @endif
                    </p>
                </div>
                @endif
            </div>

            @if($registration->notes)
            <div class="pt-md border-t border-outline-variant">
                <p class="text-label-sm text-secondary mb-xs">Ghi chú</p>
                <p class="text-body-sm text-on-surface whitespace-pre-wrap">{{ $registration->notes }}</p>
            </div>
            @endif
        </div>

        {{-- Update status form --}}
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg">
            <h2 class="text-label-sm font-semibold text-secondary uppercase tracking-wide mb-md">Cập nhật trạng thái</h2>

            <form method="POST" action="{{ route('manager.registrations.update-status', $registration) }}" class="space-y-md">
                @csrf @method('PATCH')

                <div>
                    <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide mb-xs">Trạng thái</label>
                    <select name="status" class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm bg-surface-container-lowest focus:border-primary outline-none transition-all">
                        <option value="pending"     {{ $registration->status === 'pending'     ? 'selected' : '' }}>Chờ liên hệ</option>
                        <option value="contacted"   {{ $registration->status === 'contacted'   ? 'selected' : '' }}>Đã liên hệ</option>
                        <option value="not_reached" {{ $registration->status === 'not_reached' ? 'selected' : '' }}>Không liên lạc được</option>
                    </select>
                </div>

                <div>
                    <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide mb-xs">Ghi chú</label>
                    <textarea name="notes" rows="5" placeholder="Nhập ghi chú (tùy chọn)..."
                              class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all resize-none">{{ old('notes', $registration->notes) }}</textarea>
                </div>

                <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-sm px-md py-sm bg-primary-container text-on-primary font-label-md rounded-lg hover:brightness-110 transition-all active:scale-95">
                    <span class="material-symbols-outlined text-[16px]">save</span>
                    Lưu
                </button>
            </form>

            <div class="mt-lg pt-md border-t border-outline-variant">
                <form id="del-reg-{{ $registration->id }}" method="POST" action="{{ route('manager.registrations.destroy', $registration) }}">
                    @csrf @method('DELETE')
                </form>
                <button type="button"
                        @click="$store.confirmModal.show('Xóa đăng ký của {{ addslashes($registration->name) }}?', 'del-reg-{{ $registration->id }}')"
                        class="w-full inline-flex items-center justify-center gap-sm px-md py-sm border border-error text-error font-label-md rounded-lg hover:bg-error-container/30 transition-all">
                    <span class="material-symbols-outlined text-[16px]">delete</span>
                    Xóa đăng ký
                </button>
            </div>
        </div>
    </div>

</x-app-layout>
