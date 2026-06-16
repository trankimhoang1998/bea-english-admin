<x-app-layout>
    <x-slot name="title">Class Links | BEA English</x-slot>
    <x-slot name="header">
        <div>
            <h1 class="font-bold text-headline-sm text-on-surface">Class Links</h1>
            <p class="text-label-sm text-secondary mt-xs">View and manage all teacher–student class links</p>
        </div>
    </x-slot>

    {{-- Filters --}}
    @php
        $selTeacher = $teachers->firstWhere('id', request('teacher_id'));
        $teacherInitSearch = $selTeacher ? $selTeacher->user->name . ' (' . $selTeacher->teacher_id . ')' : '';
    @endphp
    <script>
        window._classLinkFilters = {
            teacherOptions: @json($teachers->map(fn($t) => ['id' => $t->id, 'name' => $t->user->name, 'code' => $t->teacher_id])),
            teacherInit:    @json($teacherInitSearch),
            teacherValue:   @json(request('teacher_id', '')),
        };
    </script>

    <form method="GET" action="{{ route('manager.class-links.index') }}"
          class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-md mb-md">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-md items-end">

            {{-- Teacher searchable --}}
            <div class="space-y-xs"
                 x-data="{
                     search: window._classLinkFilters.teacherInit,
                     value: window._classLinkFilters.teacherValue,
                     open: false,
                     options: window._classLinkFilters.teacherOptions,
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
                    <div x-show="open" x-cloak
                         class="absolute z-50 w-full mt-xs bg-surface-container-lowest border border-outline-variant rounded-lg shadow-lg max-h-48 overflow-y-auto">
                        <div x-show="filtered.length === 0" class="px-md py-sm text-label-sm text-secondary">No results</div>
                        <template x-for="opt in filtered" :key="opt.id">
                            <div @click="select(opt)"
                                 class="px-md py-sm hover:bg-surface-container-low cursor-pointer flex items-center justify-between gap-sm">
                                <span class="text-body-sm text-on-surface" x-text="opt.name"></span>
                                <span class="text-label-sm text-secondary shrink-0" x-text="opt.code"></span>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <div class="flex gap-sm items-end col-span-1 sm:col-span-2">
                <button type="submit"
                        class="inline-flex items-center gap-xs bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95 shrink-0">
                    <span class="material-symbols-outlined text-[16px]">filter_alt</span>
                    Filter
                </button>
                @if(request()->anyFilled(['teacher_id']))
                    <a href="{{ route('manager.class-links.index') }}"
                       class="inline-flex items-center px-sm py-sm text-secondary hover:text-on-surface transition-colors"
                       title="Clear filters">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </a>
                @endif
            </div>
        </div>
    </form>

    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
        @if($classLinks->isEmpty())
            <div class="flex flex-col items-center py-2xl text-secondary">
                <span class="material-symbols-outlined text-[48px] mb-md opacity-30">link_off</span>
                <p class="text-body-md">No class links found.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-outline-variant bg-surface-container-low">
                            <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Teacher</th>
                            <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Student</th>
                            <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Class ID / Class Link</th>
                            <th class="px-lg py-md text-right text-label-sm font-semibold text-secondary uppercase tracking-wide">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @foreach($classLinks as $cl)
                            <tr class="hover:bg-surface-container-low transition-colors" x-data="{ editing: false }">
                                <td class="px-lg py-md">
                                    <p class="font-semibold text-body-sm text-on-surface">{{ $cl->teacher->user->name }}</p>
                                    <p class="text-label-sm text-secondary">{{ $cl->teacher->teacher_id }}</p>
                                </td>
                                <td class="px-lg py-md">
                                    <p class="font-medium text-body-sm text-on-surface">{{ $cl->student->user->name }}</p>
                                    <p class="text-label-sm text-secondary">{{ $cl->student->student_id }}</p>
                                </td>
                                {{-- Class ID / Class Link --}}
                                <td class="px-lg py-md">
                                    <div x-show="!editing" class="space-y-xs">
                                        @if($cl->class_id)
                                            <span class="inline-flex items-center gap-xs bg-surface-container-low border border-outline-variant rounded-lg px-sm py-xs font-mono text-label-sm font-semibold text-on-surface">
                                                <span class="material-symbols-outlined text-[13px] text-secondary">tag</span>{{ $cl->class_id }}
                                            </span>
                                        @endif
                                        <div class="flex items-center gap-xs">
                                            <span class="material-symbols-outlined text-[16px] text-primary shrink-0">video_call</span>
                                            <a href="{{ $cl->class_link }}" target="_blank" rel="noopener"
                                               class="text-body-sm text-primary hover:underline truncate max-w-xs">{{ $cl->class_link }}</a>
                                        </div>
                                    </div>
                                    <form x-show="editing" x-cloak method="POST"
                                          action="{{ route('manager.class-links.update', $cl) }}"
                                          class="flex items-center gap-sm">
                                        @csrf @method('PUT')
                                        <div class="flex-1 min-w-0 space-y-xs">
                                            <div>
                                                <input type="text" name="class_id" value="{{ $cl->class_id }}"
                                                       maxlength="100" placeholder="Class ID (e.g. 536-053-706)"
                                                       class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
                                                <p class="text-[10px] text-secondary mt-xs">Format: 536-053-706</p>
                                            </div>
                                            <div>
                                                <input type="url" name="class_link" value="{{ $cl->class_link }}"
                                                       required maxlength="500" placeholder="https://voovmeeting.com/dm/LngItGq4Ga1L"
                                                       class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
                                                <p class="text-[10px] text-secondary mt-xs">Format: https://voovmeeting.com/dm/LngItGq4Ga1L</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-xs shrink-0">
                                            <button type="submit"
                                                    class="inline-flex items-center gap-xs text-label-sm bg-primary-container text-on-primary px-md py-sm rounded-lg hover:brightness-110 transition-all">
                                                <span class="material-symbols-outlined text-[16px]">save</span>Save
                                            </button>
                                            <button type="button" @click="editing = false"
                                                    class="inline-flex items-center justify-center text-secondary hover:text-on-surface px-sm py-sm rounded-lg hover:bg-surface-container transition-colors">
                                                <span class="material-symbols-outlined text-[16px]">close</span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                                <td class="px-lg py-md">
                                    <div class="flex items-center justify-end gap-sm">
                                        <button type="button" x-show="!editing" @click="editing = true"
                                                class="inline-flex items-center gap-xs text-label-sm text-primary hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                                            <span class="material-symbols-outlined text-[16px]">edit</span>
                                            Edit
                                        </button>
                                        <form id="del-cl-{{ $cl->id }}" method="POST" action="{{ route('manager.class-links.destroy', $cl) }}">
                                            @csrf @method('DELETE')
                                        </form>
                                        <button type="button"
                                                @click="$store.confirmModal.show('Remove class link for {{ addslashes($cl->student->user->name) }}?', 'del-cl-{{ $cl->id }}')"
                                                class="inline-flex items-center gap-xs text-label-sm text-error hover:text-on-surface px-sm py-xs rounded-lg hover:bg-error-container/30 transition-colors">
                                            <span class="material-symbols-outlined text-[16px]">link_off</span>
                                            Remove
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($classLinks->hasPages())
                <div class="px-lg py-md border-t border-outline-variant">
                    {{ $classLinks->links() }}
                </div>
            @endif
        @endif
    </div>
</x-app-layout>
