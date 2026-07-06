<x-app-layout>
    <x-slot name="title">Đăng Ký Tư Vấn | BEA English</x-slot>
    <x-slot name="header">
        <div class="flex flex-wrap items-center gap-sm justify-between">
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">Đăng Ký Tư Vấn</h1>
                <p class="text-label-sm text-secondary mt-xs">Quản lý danh sách đăng ký tư vấn & học thử</p>
            </div>
            {{-- Status count chips --}}
            <div class="flex flex-wrap gap-xs">
                <span class="inline-flex items-center gap-xs px-sm py-xs rounded-full text-label-sm font-medium bg-surface-container text-secondary">
                    Tất cả: {{ $counts['all'] }}
                </span>
                <span class="inline-flex items-center gap-xs px-sm py-xs rounded-full text-label-sm font-medium bg-amber-100 text-amber-800">
                    Chờ: {{ $counts['pending'] }}
                </span>
                <span class="inline-flex items-center gap-xs px-sm py-xs rounded-full text-label-sm font-medium bg-green-100 text-green-800">
                    Đã liên hệ: {{ $counts['contacted'] }}
                </span>
                <span class="inline-flex items-center gap-xs px-sm py-xs rounded-full text-label-sm font-medium bg-red-100 text-red-800">
                    Không liên lạc được: {{ $counts['not_reached'] }}
                </span>
            </div>
        </div>
    </x-slot>

    @if(session('success'))
    <div class="mb-md px-md py-sm bg-green-50 border border-green-200 text-green-800 text-body-sm rounded-xl">
        {{ session('success') }}
    </div>
    @endif

    {{-- Filters --}}
    <form method="GET" action="{{ route('manager.registrations.index') }}"
          class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-md mb-md">
        <div class="flex flex-wrap gap-md items-end">
            <div class="flex-1 min-w-[180px]">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide mb-xs">Tìm kiếm</label>
                <div class="relative">
                    <span class="absolute left-sm top-1/2 -translate-y-1/2 text-secondary pointer-events-none">
                        <span class="material-symbols-outlined text-[16px]">search</span>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Tên hoặc số điện thoại..."
                           class="w-full pl-xl border border-outline-variant rounded-lg px-md py-sm text-body-sm bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
                </div>
            </div>
            <div class="w-44 shrink-0">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide mb-xs">Trạng thái</label>
                <select name="status" class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm bg-surface-container-lowest focus:border-primary outline-none transition-all">
                    <option value="">Tất cả</option>
                    <option value="pending"     {{ request('status') === 'pending'     ? 'selected' : '' }}>Chờ liên hệ</option>
                    <option value="contacted"   {{ request('status') === 'contacted'   ? 'selected' : '' }}>Đã liên hệ</option>
                    <option value="not_reached" {{ request('status') === 'not_reached' ? 'selected' : '' }}>Không liên lạc được</option>
                </select>
            </div>
            <button type="submit" class="inline-flex items-center gap-xs px-md py-sm bg-primary-container text-on-primary font-label-md rounded-lg hover:brightness-110 transition-all active:scale-95 shrink-0">
                <span class="material-symbols-outlined text-[16px]">filter_list</span>
                Lọc
            </button>
            @if(request()->anyFilled(['search', 'status']))
            <a href="{{ route('manager.registrations.index') }}" class="px-md py-sm border border-outline-variant text-secondary font-label-md rounded-lg hover:bg-surface-container-low transition-all shrink-0">
                Xóa lọc
            </a>
            @endif
        </div>
    </form>

    {{-- Table --}}
    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-outline-variant bg-surface-container-low">
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Họ tên</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">SĐT</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide hidden md:table-cell">Đối tượng</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Trạng thái</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide hidden lg:table-cell">Đăng ký</th>
                        <th class="px-lg py-md text-right text-label-sm font-semibold text-secondary uppercase tracking-wide">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @forelse($registrations as $reg)
                    @php $s = $reg->statusBadge(); @endphp
                    <tr class="hover:bg-surface-container-low transition-colors" id="row-{{ $reg->id }}">
                        <td class="px-lg py-md">
                            <p class="font-medium text-body-sm text-on-surface">{{ $reg->name }}</p>
                        </td>
                        <td class="px-lg py-md text-body-sm text-secondary">
                            <a href="tel:{{ $reg->phone }}" class="hover:text-primary-container transition-colors">{{ $reg->phone }}</a>
                        </td>
                        <td class="px-lg py-md hidden md:table-cell text-body-sm text-secondary">
                            {{ $reg->audienceLabel() }}
                        </td>
                        <td class="px-lg py-md">
                            <span id="badge-{{ $reg->id }}"
                                  class="inline-flex items-center px-sm py-0.5 rounded-full text-label-sm font-medium {{ $s['class'] }}">
                                {{ $s['label'] }}
                            </span>
                        </td>
                        <td class="px-lg py-md hidden lg:table-cell text-body-sm text-secondary">
                            {{ $reg->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-lg py-md">
                            <div class="flex items-center justify-end gap-xs">
                                @if($reg->status !== 'contacted')
                                <button onclick="quickStatus({{ $reg->id }}, 'contacted')"
                                        title="Đánh dấu đã liên hệ"
                                        class="w-7 h-7 inline-flex items-center justify-center rounded-lg text-green-700 hover:text-white hover:bg-green-600 transition-colors border border-green-200 hover:border-green-600">
                                    <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                </button>
                                @endif

                                @if($reg->status !== 'not_reached')
                                <button onclick="quickStatus({{ $reg->id }}, 'not_reached')"
                                        title="Không liên lạc được"
                                        class="w-7 h-7 inline-flex items-center justify-center rounded-lg text-red-700 hover:text-white hover:bg-red-600 transition-colors border border-red-200 hover:border-red-600">
                                    <span class="material-symbols-outlined text-[16px]">phone_missed</span>
                                </button>
                                @endif

                                <a href="{{ route('manager.registrations.show', $reg) }}"
                                   title="Xem chi tiết"
                                   class="w-7 h-7 inline-flex items-center justify-center rounded-lg text-secondary hover:text-on-surface hover:bg-surface-container transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">visibility</span>
                                </a>

                                <form id="del-reg-{{ $reg->id }}" method="POST" action="{{ route('manager.registrations.destroy', $reg) }}">
                                    @csrf @method('DELETE')
                                </form>
                                <button type="button"
                                        title="Xóa"
                                        @click="$store.confirmModal.show('Xóa đăng ký của {{ addslashes($reg->name) }}?', 'del-reg-{{ $reg->id }}')"
                                        class="w-7 h-7 inline-flex items-center justify-center rounded-lg text-error hover:text-on-surface hover:bg-error-container/30 transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-lg py-2xl text-center text-secondary">Chưa có đăng ký nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($registrations->hasPages())
        <div class="px-lg py-md border-t border-outline-variant">
            {{ $registrations->links() }}
        </div>
        @endif
    </div>

<script>
async function quickStatus(id, status) {
    const res = await fetch(`/manager/registrations/${id}/quick-status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
        body: JSON.stringify({ status }),
    });
    if (!res.ok) return;
    const badge = await res.json();
    const el = document.getElementById('badge-' + id);
    if (el) {
        el.textContent = badge.label;
        el.className = 'inline-flex items-center px-sm py-0.5 rounded-full text-label-sm font-medium ' + badge.class;
    }
    // Reload để cập nhật lại nút quick action
    setTimeout(() => location.reload(), 400);
}
</script>

</x-app-layout>
