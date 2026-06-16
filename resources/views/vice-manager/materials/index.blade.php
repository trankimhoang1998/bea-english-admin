<x-app-layout>
    <x-slot name="title">Learning Materials | BEA English</x-slot>
    <x-slot name="header">
        <div>
            <h1 class="font-bold text-headline-sm text-on-surface">Learning Materials</h1>
            <p class="text-label-sm text-secondary mt-xs">View all teaching resources</p>
        </div>
    </x-slot>

    @php
        $selTeacher = $teachers->firstWhere('id', request('teacher_id'));
        $selStudent = $students->firstWhere('id', request('student_id'));
        $teacherInitSearch = $selTeacher ? $selTeacher->user->name . ' (' . $selTeacher->teacher_id . ')' : '';
        $studentInitSearch = $selStudent ? $selStudent->user->name . ' (' . $selStudent->student_id . ')' : '';
    @endphp
    <script>
        window._materialFilters = {
            teacherOptions: @json($teachers->map(fn($t) => ['id' => $t->id, 'name' => $t->user->name, 'code' => $t->teacher_id])),
            studentOptions: @json($students->map(fn($s) => ['id' => $s->id, 'name' => $s->user->name, 'code' => $s->student_id])),
            teacherInit: @json($teacherInitSearch),
            studentInit: @json($studentInitSearch),
            teacherValue: @json(request('teacher_id', '')),
            studentValue: @json(request('student_id', '')),
        };
    </script>

    <form method="GET" action="{{ route('vice-manager.materials.index') }}"
          class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-md mb-md space-y-md">
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
            <div class="space-y-xs w-32 shrink-0">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Type</label>
                <select name="type"
                        class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
                    <option value="">All Types</option>
                    <option value="file" {{ request('type') === 'file' ? 'selected' : '' }}>File</option>
                    <option value="link" {{ request('type') === 'link' ? 'selected' : '' }}>Link</option>
                </select>
            </div>
            <div class="space-y-xs w-52 shrink-0">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Category</label>
                <select name="category_id"
                        class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat['id'] }}" {{ request('category_id') == $cat['id'] ? 'selected' : '' }}>
                            {{ $cat['label'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex flex-wrap gap-md items-end">
            <div class="space-y-xs flex-1 min-w-[180px]"
                 x-data="{
                     search: window._materialFilters.studentInit,
                     value: window._materialFilters.studentValue,
                     open: false,
                     options: window._materialFilters.studentOptions,
                     get filtered() {
                         if (!this.search) return this.options;
                         const q = this.search.toLowerCase();
                         return this.options.filter(o => o.name.toLowerCase().includes(q) || o.code.toLowerCase().includes(q));
                     },
                     select(opt) { this.value = opt.id; this.search = opt.name + ' (' + opt.code + ')'; this.open = false; },
                     clear() { this.value = ''; this.search = ''; }
                 }">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Student</label>
                <input type="hidden" name="student_id" :value="value">
                <div class="relative">
                    <input type="text" x-model="search"
                           @focus="open = true" @click.outside="open = false"
                           @input="open = true; value = ''"
                           placeholder="Search by name or ID..."
                           class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all pr-xl">
                    <button type="button" x-show="value || search" @click="clear()"
                            class="absolute right-sm top-1/2 -translate-y-1/2 text-secondary hover:text-on-surface transition-colors">
                        <span class="material-symbols-outlined text-[16px]">close</span>
                    </button>
                    <div x-show="open" x-cloak class="absolute z-50 w-full mt-xs bg-surface-container-lowest border border-outline-variant rounded-lg shadow-lg max-h-48 overflow-y-auto">
                        <div x-show="filtered.length === 0" class="px-md py-sm text-label-sm text-secondary">No results</div>
                        <template x-for="opt in filtered" :key="opt.id">
                            <div @click="select(opt)" class="px-md py-sm hover:bg-surface-container-low cursor-pointer flex items-center justify-between gap-sm">
                                <span class="text-body-sm text-on-surface" x-text="opt.name"></span>
                                <span class="text-label-sm text-secondary shrink-0" x-text="opt.code"></span>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <div class="space-y-xs flex-1 min-w-[180px]"
                 x-data="{
                     search: window._materialFilters.teacherInit,
                     value: window._materialFilters.teacherValue,
                     open: false,
                     options: window._materialFilters.teacherOptions,
                     get filtered() {
                         if (!this.search) return this.options;
                         const q = this.search.toLowerCase();
                         return this.options.filter(o => o.name.toLowerCase().includes(q) || o.code.toLowerCase().includes(q));
                     },
                     select(opt) { this.value = opt.id; this.search = opt.name + ' (' + opt.code + ')'; this.open = false; },
                     clear() { this.value = ''; this.search = ''; }
                 }">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Teacher</label>
                <input type="hidden" name="teacher_id" :value="value">
                <div class="relative">
                    <input type="text" x-model="search"
                           @focus="open = true" @click.outside="open = false"
                           @input="open = true; value = ''"
                           placeholder="Search by name or ID..."
                           class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all pr-xl">
                    <button type="button" x-show="value || search" @click="clear()"
                            class="absolute right-sm top-1/2 -translate-y-1/2 text-secondary hover:text-on-surface transition-colors">
                        <span class="material-symbols-outlined text-[16px]">close</span>
                    </button>
                    <div x-show="open" x-cloak class="absolute z-50 w-full mt-xs bg-surface-container-lowest border border-outline-variant rounded-lg shadow-lg max-h-48 overflow-y-auto">
                        <div x-show="filtered.length === 0" class="px-md py-sm text-label-sm text-secondary">No results</div>
                        <template x-for="opt in filtered" :key="opt.id">
                            <div @click="select(opt)" class="px-md py-sm hover:bg-surface-container-low cursor-pointer flex items-center justify-between gap-sm">
                                <span class="text-body-sm text-on-surface" x-text="opt.name"></span>
                                <span class="text-label-sm text-secondary shrink-0" x-text="opt.code"></span>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <div class="flex gap-sm shrink-0">
                <button type="submit"
                        class="inline-flex items-center gap-xs bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                    <span class="material-symbols-outlined text-[16px]">filter_alt</span>
                    Filter
                </button>
                @if(request()->anyFilled(['search', 'type', 'student_id', 'teacher_id', 'category_id']))
                    <a href="{{ route('vice-manager.materials.index') }}"
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
                @if(request()->anyFilled(['search', 'type', 'student_id', 'teacher_id', 'category_id']))
                    <p class="text-body-md mb-md">No materials match your filters.</p>
                    <a href="{{ route('vice-manager.materials.index') }}"
                       class="inline-flex items-center gap-xs text-label-sm text-primary hover:underline">
                        <span class="material-symbols-outlined text-[16px]">close</span>
                        Clear filters
                    </a>
                @else
                    <p class="text-body-md">No materials found.</p>
                @endif
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-outline-variant bg-surface-container-low">
                            <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Title</th>
                            <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Category</th>
                            <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Access</th>
                            <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Date</th>
                            <th class="px-lg py-md text-right text-label-sm font-semibold text-secondary uppercase tracking-wide">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @foreach($materials as $material)
                            <tr class="hover:bg-surface-container-low transition-colors">
                                <td class="px-lg py-md max-w-[260px]">
                                    <div class="flex items-start gap-md">
                                        <div class="w-8 h-8 rounded-lg bg-surface-container flex items-center justify-center shrink-0 mt-xs">
                                            <span class="material-symbols-outlined text-[16px] text-secondary">{{ $material->material_link ? 'link' : 'description' }}</span>
                                        </div>
                                        <div class="min-w-0">
                                            <span class="font-semibold text-body-sm text-on-surface line-clamp-2">{{ $material->title }}</span>
                                            @if($material->description)
                                                <p class="text-label-sm text-secondary mt-xs truncate">{{ $material->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-lg py-md whitespace-nowrap">
                                    @if($material->category)
                                        <span class="inline-flex items-center gap-xs text-label-sm bg-primary/10 text-primary px-sm py-xs rounded-full">
                                            <span class="material-symbols-outlined text-[12px]">folder</span>
                                            {{ $material->category->name }}
                                        </span>
                                    @else
                                        <span class="text-label-sm text-secondary/50">—</span>
                                    @endif
                                </td>
                                <td class="px-lg py-md">
                                    <div class="flex flex-col gap-xs">
                                        @if($material->students->isEmpty())
                                            <span class="inline-flex items-center gap-xs text-label-sm text-secondary whitespace-nowrap">
                                                <span class="material-symbols-outlined text-[14px]">group</span>
                                                All students
                                            </span>
                                        @else
                                            <div class="relative group inline-flex">
                                                <span class="inline-flex items-center gap-xs text-label-sm bg-primary/10 text-primary px-sm py-xs rounded-full whitespace-nowrap cursor-default">
                                                    <span class="material-symbols-outlined text-[13px]">group</span>
                                                    {{ $material->students->count() }} student{{ $material->students->count() > 1 ? 's' : '' }}
                                                </span>
                                                <div class="absolute z-50 top-full left-0 mt-1 hidden group-hover:block bg-on-surface text-surface text-label-sm rounded-lg px-md py-sm shadow-lg w-52 whitespace-normal leading-relaxed pointer-events-none space-y-xs">
                                                    @foreach($material->students as $stu)
                                                        <div>{{ $stu->user->name }} ({{ $stu->student_id }})</div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        @if($material->teachers->isEmpty())
                                            <span class="inline-flex items-center gap-xs text-label-sm text-secondary whitespace-nowrap">
                                                <span class="material-symbols-outlined text-[14px]">school</span>
                                                All teachers
                                            </span>
                                        @else
                                            <div class="relative group inline-flex">
                                                <span class="inline-flex items-center gap-xs text-label-sm bg-tertiary/10 text-tertiary px-sm py-xs rounded-full whitespace-nowrap cursor-default">
                                                    <span class="material-symbols-outlined text-[13px]">school</span>
                                                    {{ $material->teachers->count() }} teacher{{ $material->teachers->count() > 1 ? 's' : '' }}
                                                </span>
                                                <div class="absolute z-50 top-full left-0 mt-1 hidden group-hover:block bg-on-surface text-surface text-label-sm rounded-lg px-md py-sm shadow-lg w-52 whitespace-normal leading-relaxed pointer-events-none space-y-xs">
                                                    @foreach($material->teachers as $tea)
                                                        <div>{{ $tea->user->name }} ({{ $tea->teacher_id }})</div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-lg py-md whitespace-nowrap">
                                    <p class="text-body-sm text-secondary">{{ $material->created_at->format('d/m/Y') }}</p>
                                    <p class="text-label-sm text-secondary">{{ $material->created_at->format('H:i') }}</p>
                                </td>
                                <td class="px-lg py-md">
                                    <div class="flex items-center justify-end gap-sm">
                                        @if($material->material_link)
                                            <a href="{{ $material->material_link }}" target="_blank" rel="noopener"
                                               class="inline-flex items-center gap-xs text-label-sm text-sky-600 hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                                                <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                                                Open Link
                                            </a>
                                        @elseif($material->file_path)
                                            <a href="{{ route('vice-manager.materials.download', $material) }}"
                                               class="inline-flex items-center gap-xs text-label-sm text-primary hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                                                <span class="material-symbols-outlined text-[16px]">download</span>
                                                Download
                                            </a>
                                        @endif
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
