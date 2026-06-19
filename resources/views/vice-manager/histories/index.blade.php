<x-app-layout>
    <x-slot name="title">Teaching Histories | BEA English</x-slot>
    <x-slot name="header">
        <div>
            <h1 class="font-bold text-headline-sm text-on-surface">Teaching Histories</h1>
            <p class="text-label-sm text-secondary mt-xs">View all lesson records</p>
        </div>
    </x-slot>

    @php
        $selTeacher = $teachers->firstWhere('id', request('teacher_id'));
        $selStudent = $students->firstWhere('id', request('student_id'));
        $teacherInitSearch = $selTeacher ? $selTeacher->user->name . ' (' . $selTeacher->teacher_id . ')' : '';
        $studentInitSearch = $selStudent ? $selStudent->user->name . ' (' . $selStudent->student_id . ')' : '';
    @endphp

    <script>
        window._historyFilters = {
            teacherOptions: @json($teachers->map(fn($t) => ['id' => $t->id, 'name' => $t->user->name, 'code' => $t->teacher_id])),
            studentOptions: @json($students->map(fn($s) => ['id' => $s->id, 'name' => $s->user->name, 'code' => $s->student_id])),
            teacherInit: @json($teacherInitSearch),
            studentInit: @json($studentInitSearch),
            teacherValue: @json(request('teacher_id', '')),
            studentValue: @json(request('student_id', '')),
        };
    </script>

    <form method="GET" action="{{ route('vice-manager.histories.index') }}"
          class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-md mb-md space-y-md">

        <div class="grid grid-cols-2 md:grid-cols-4 gap-md">
            <div class="space-y-xs">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Date From</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}"
                       class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
            </div>
            <div class="space-y-xs">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Date To</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}"
                       class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
            </div>
            <div class="space-y-xs">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Time From</label>
                <input type="time" name="time_from" value="{{ request('time_from') }}"
                       class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
            </div>
            <div class="space-y-xs">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Time To</label>
                <input type="time" name="time_to" value="{{ request('time_to') }}"
                       class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-md items-end">
            <div class="space-y-xs"
                 x-data="{
                     search: window._historyFilters.teacherInit,
                     value: window._historyFilters.teacherValue,
                     open: false,
                     options: window._historyFilters.teacherOptions,
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

            <div class="space-y-xs"
                 x-data="{
                     search: window._historyFilters.studentInit,
                     value: window._historyFilters.studentValue,
                     open: false,
                     options: window._historyFilters.studentOptions,
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

            <div class="space-y-xs col-span-2 md:col-span-1">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Duration</label>
                <select name="duration"
                        class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
                    <option value="">All</option>
                    <option value="25" {{ request('duration') == '25' ? 'selected' : '' }}>25 min</option>
                    <option value="50" {{ request('duration') == '50' ? 'selected' : '' }}>50 min</option>
                    <option value="90" {{ request('duration') == '90' ? 'selected' : '' }}>90 min</option>
                </select>
            </div>

            <div class="flex gap-sm">
                <button type="submit"
                        class="inline-flex items-center gap-xs bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95 shrink-0">
                    <span class="material-symbols-outlined text-[16px]">filter_alt</span>
                    Filter
                </button>
                @if(request()->anyFilled(['teacher_id', 'student_id', 'date_from', 'date_to', 'time_from', 'time_to', 'duration']))
                    <a href="{{ route('vice-manager.histories.index') }}"
                       class="inline-flex items-center px-sm py-sm text-secondary hover:text-on-surface transition-colors shrink-0"
                       title="Clear filters">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </a>
                @endif
            </div>
        </div>
    </form>

    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-outline-variant bg-surface-container-low">
                        <th class="px-md py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide whitespace-nowrap">Session</th>
                        <th class="px-md py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Teacher</th>
                        <th class="px-md py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Student</th>
                        <th class="px-md py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Details</th>
                        <th class="px-md py-md text-right text-label-sm font-semibold text-secondary uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @forelse($histories as $history)
                        <tr class="hover:bg-surface-container-low transition-colors">
                            <td class="px-md py-md whitespace-nowrap align-top">
                                <p class="text-body-sm font-semibold text-on-surface">{{ $history->taught_date->format('d/m/Y') }}</p>
                                <p class="text-label-sm text-secondary mt-xs">{{ $history->time_from }} – {{ $history->time_to }}</p>
                            </td>
                            <td class="px-md py-md align-top whitespace-nowrap">
                                <div class="flex items-start gap-xs">
                                    <span class="material-symbols-outlined text-[14px] text-secondary mt-[3px] shrink-0">school</span>
                                    <div>
                                        <p class="text-body-sm font-semibold text-on-surface">{{ $history->teacher->user->name }}</p>
                                        <p class="text-label-sm text-secondary">{{ $history->teacher->teacher_id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-md py-md align-top whitespace-nowrap">
                                <div class="flex items-start gap-xs">
                                    <span class="material-symbols-outlined text-[14px] text-secondary mt-[3px] shrink-0">person</span>
                                    <div>
                                        <p class="text-body-sm font-semibold text-on-surface">{{ $history->student->user->name }}</p>
                                        <p class="text-label-sm text-secondary">{{ $history->student->student_id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-md py-md align-top">
                                <div class="flex items-center gap-sm flex-wrap">
                                    <span class="text-label-sm font-semibold text-on-surface">
                                        Lesson {{ str_pad($history->lesson_number, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                    <span class="text-label-sm bg-surface-container px-sm py-xs rounded-full text-secondary whitespace-nowrap">
                                        {{ $history->duration }} min
                                    </span>
                                    @if($history->video_path)
                                        <a href="{{ route('vice-manager.histories.video', $history) }}"
                                           class="inline-flex items-center gap-xs text-label-sm text-primary hover:underline whitespace-nowrap">
                                            <span class="material-symbols-outlined text-[14px]">download</span>
                                            Video
                                        </a>
                                    @elseif($history->video_link)
                                        <a href="{{ $history->video_link }}" target="_blank" rel="noopener"
                                           class="inline-flex items-center gap-xs text-label-sm text-sky-600 hover:underline whitespace-nowrap">
                                            <span class="material-symbols-outlined text-[14px]">play_circle</span>
                                            Video
                                        </a>
                                    @endif
                                </div>
                                @if($history->note)
                                    <p class="text-label-sm text-secondary mt-xs truncate max-w-xs">{{ $history->note }}</p>
                                @endif
                            </td>
                            <td class="px-md py-md align-top">
                                <div class="flex items-center justify-end gap-xs">
                                    <a href="{{ route('vice-manager.histories.show', $history) }}"
                                       class="inline-flex items-center gap-xs text-label-sm text-secondary hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors whitespace-nowrap">
                                        <span class="material-symbols-outlined text-[16px]">visibility</span>
                                        View
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-lg py-2xl text-center">
                                <div class="flex flex-col items-center gap-md text-secondary">
                                    <span class="material-symbols-outlined text-[48px] opacity-30">history_edu</span>
                                    <p class="text-body-md">No teaching histories found.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($histories->hasPages())
            <div class="px-lg py-md border-t border-outline-variant">
                {{ $histories->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
