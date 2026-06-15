<x-app-layout>
    <x-slot name="title">Materials | BEA English</x-slot>
    <x-slot name="header">
        <div>
            <h1 class="font-bold text-headline-sm text-on-surface">Learning Materials</h1>
            <p class="text-label-sm text-secondary mt-xs">Download resources uploaded by your teachers</p>
        </div>
    </x-slot>

    {{-- Filters --}}
    <form method="GET" action="{{ route('student.materials.index') }}"
          class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-md mb-md">
        <div class="flex flex-wrap gap-md items-end">
            <div class="space-y-xs flex-1 min-w-[180px]">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Search</label>
                <div class="relative">
                    <span class="absolute left-sm top-1/2 -translate-y-1/2 text-secondary pointer-events-none">
                        <span class="material-symbols-outlined text-[16px]">search</span>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search by title..."
                           class="w-full pl-xl border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
                </div>
            </div>
            <div class="space-y-xs w-36 shrink-0">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Type</label>
                <select name="type"
                        class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
                    <option value="">All Types</option>
                    <option value="file" {{ request('type') === 'file' ? 'selected' : '' }}>File</option>
                    <option value="link" {{ request('type') === 'link' ? 'selected' : '' }}>Link</option>
                </select>
            </div>
            <div class="flex gap-sm shrink-0">
                <button type="submit"
                        class="inline-flex items-center gap-xs bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                    <span class="material-symbols-outlined text-[16px]">filter_alt</span>
                    Filter
                </button>
                @if(request()->anyFilled(['search', 'type']))
                    <a href="{{ route('student.materials.index') }}"
                       class="inline-flex items-center px-sm py-sm text-secondary hover:text-on-surface transition-colors"
                       title="Clear filters">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </a>
                @endif
            </div>
        </div>
    </form>

    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
        @if($materials->isEmpty())
            <div class="flex flex-col items-center py-2xl text-secondary">
                <span class="material-symbols-outlined text-[48px] mb-md opacity-30">folder_open</span>
                @if(request()->anyFilled(['search', 'type']))
                    <p class="text-body-md mb-md">No materials match your filters.</p>
                    <a href="{{ route('student.materials.index') }}"
                       class="inline-flex items-center gap-xs text-label-sm text-primary hover:underline">
                        <span class="material-symbols-outlined text-[16px]">close</span>
                        Clear filters
                    </a>
                @else
                    <p class="text-body-md">No learning materials available yet.</p>
                @endif
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-outline-variant bg-surface-container-low">
                            <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Title</th>
                            <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Uploaded</th>
                            <th class="px-lg py-md text-right text-label-sm font-semibold text-secondary uppercase tracking-wide">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @foreach($materials as $material)
                            <tr class="hover:bg-surface-container-low transition-colors">
                                <td class="px-lg py-md">
                                    <div class="flex items-center gap-md">
                                        <div class="w-9 h-9 rounded-lg bg-surface-container flex items-center justify-center shrink-0">
                                            <span class="material-symbols-outlined text-[18px] text-secondary">{{ $material->material_link ? 'link' : 'description' }}</span>
                                        </div>
                                        <div>
                                            <span class="font-semibold text-body-sm text-on-surface">{{ $material->title }}</span>
                                            @if($material->description)
                                                <p class="text-label-sm text-secondary mt-xs">{{ $material->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-lg py-md text-body-sm text-secondary whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($material->created_at)->format('d/m/Y') }}
                                </td>
                                <td class="px-lg py-md text-right">
                                    @if($material->material_link)
                                        <a href="{{ $material->material_link }}" target="_blank" rel="noopener"
                                           class="inline-flex items-center gap-sm bg-sky-100 text-sky-700 font-label-md px-md py-sm rounded-lg hover:bg-sky-200 transition-all active:scale-95">
                                            <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                                            Open Link
                                        </a>
                                    @else
                                        <a href="{{ route('student.materials.download', $material) }}"
                                           class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                                            <span class="material-symbols-outlined text-[16px]">download</span>
                                            Download
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($materials->hasPages())
                <div class="px-lg py-md border-t border-outline-variant">
                    {{ $materials->links() }}
                </div>
            @endif
        @endif
    </div>
</x-app-layout>
