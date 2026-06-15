<x-app-layout>
    <x-slot name="title">Learning Materials | BEA English</x-slot>
    <x-slot name="header">
        <div class="flex flex-wrap items-center gap-sm justify-between">
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">Learning Materials</h1>
                <p class="text-label-sm text-secondary mt-xs">Upload and manage teaching resources</p>
            </div>
            <a href="{{ route('manager.materials.create') }}"
               class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                <span class="material-symbols-outlined text-[18px]">upload_file</span>
                Upload Material
            </a>
        </div>
    </x-slot>

    {{-- Filters --}}
    <form method="GET" action="{{ route('manager.materials.index') }}"
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
            <div class="space-y-xs w-52 shrink-0">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Student</label>
                <select name="student_id"
                        class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
                    <option value="">All Students</option>
                    @foreach($students as $stu)
                        <option value="{{ $stu->id }}" {{ request('student_id') == $stu->id ? 'selected' : '' }}>
                            {{ $stu->user->name }} ({{ $stu->student_id }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-sm shrink-0">
                <button type="submit"
                        class="inline-flex items-center gap-xs bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                    <span class="material-symbols-outlined text-[16px]">filter_alt</span>
                    Filter
                </button>
                @if(request()->anyFilled(['search', 'type', 'student_id']))
                    <a href="{{ route('manager.materials.index') }}"
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
                @if(request()->anyFilled(['search', 'type', 'student_id']))
                    <p class="text-body-md mb-md">No materials match your filters.</p>
                    <a href="{{ route('manager.materials.index') }}"
                       class="inline-flex items-center gap-xs text-label-sm text-primary hover:underline">
                        <span class="material-symbols-outlined text-[16px]">close</span>
                        Clear filters
                    </a>
                @else
                    <p class="text-body-md mb-md">No materials uploaded yet.</p>
                    <a href="{{ route('manager.materials.create') }}"
                       class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all">
                        <span class="material-symbols-outlined text-[16px]">upload_file</span>
                        Upload first material
                    </a>
                @endif
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-outline-variant bg-surface-container-low">
                            <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Title</th>
                            <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Students</th>
                            <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Uploaded By</th>
                            <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Date</th>
                            <th class="px-lg py-md text-right text-label-sm font-semibold text-secondary uppercase tracking-wide">Actions</th>
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
                                <td class="px-lg py-md">
                                    @if($material->students->isEmpty())
                                        <span class="inline-flex items-center gap-xs text-label-sm text-secondary bg-surface-container px-sm py-xs rounded-full">
                                            <span class="material-symbols-outlined text-[13px]">public</span>
                                            All students
                                        </span>
                                    @else
                                        <div class="flex flex-wrap gap-xs max-w-[260px]">
                                            @foreach($material->students->take(3) as $stu)
                                                <span class="inline-flex items-center gap-xs text-label-sm bg-primary/10 text-primary px-sm py-xs rounded-full whitespace-nowrap">
                                                    {{ $stu->user->name }} ({{ $stu->student_id }})
                                                </span>
                                            @endforeach
                                            @if($material->students->count() > 3)
                                                <div class="relative group">
                                                    <span class="inline-flex items-center text-label-sm bg-surface-container text-secondary px-sm py-xs rounded-full cursor-default">
                                                        +{{ $material->students->count() - 3 }} more
                                                    </span>
                                                    <div class="absolute z-50 bottom-full left-0 mb-1 hidden group-hover:block bg-on-surface text-surface text-label-sm rounded-lg px-md py-sm shadow-lg w-56 whitespace-normal leading-relaxed pointer-events-none space-y-xs">
                                                        @foreach($material->students->skip(3) as $stu)
                                                            <div>{{ $stu->user->name }} ({{ $stu->student_id }})</div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                                <td class="px-lg py-md text-body-sm text-secondary">{{ $material->uploader->name ?? '—' }}</td>
                                <td class="px-lg py-md text-body-sm text-secondary whitespace-nowrap">{{ $material->created_at->format('d/m/Y') }}</td>
                                <td class="px-lg py-md">
                                    <div class="flex items-center justify-end gap-sm">
                                        <a href="{{ route('manager.materials.edit', $material) }}"
                                           class="inline-flex items-center gap-xs text-label-sm text-primary hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                                            <span class="material-symbols-outlined text-[16px]">edit</span>
                                            Edit
                                        </a>
                                        @if($material->material_link)
                                            <a href="{{ $material->material_link }}" target="_blank" rel="noopener"
                                               class="inline-flex items-center gap-xs text-label-sm text-sky-600 hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                                                <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                                                Open Link
                                            </a>
                                        @elseif($material->file_path)
                                            <a href="{{ route('manager.materials.download', $material) }}"
                                               class="inline-flex items-center gap-xs text-label-sm text-primary hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                                                <span class="material-symbols-outlined text-[16px]">download</span>
                                                Download
                                            </a>
                                        @endif
                                        <form id="del-material-{{ $material->id }}" method="POST" action="{{ route('manager.materials.destroy', $material) }}">
                                            @csrf @method('DELETE')
                                        </form>
                                        <button type="button"
                                                @click="$store.confirmModal.show('Delete ' + {{ Js::from($material->title) }} + '? The file will also be removed from storage.', 'del-material-{{ $material->id }}')"
                                                class="inline-flex items-center gap-xs text-label-sm text-error hover:text-on-surface px-sm py-xs rounded-lg hover:bg-error-container/30 transition-colors">
                                            <span class="material-symbols-outlined text-[16px]">delete</span>
                                            Delete
                                        </button>
                                    </div>
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
