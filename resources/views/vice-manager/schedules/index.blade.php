<x-app-layout>
    <x-slot name="title">Schedules | BEA English</x-slot>
    <x-slot name="header">
        <div>
            <h1 class="font-bold text-headline-sm text-on-surface">Schedules</h1>
            <p class="text-label-sm text-secondary mt-xs">View all teaching schedules</p>
        </div>
    </x-slot>

    @php
        $selTeacher = $teachers->firstWhere('id', request('teacher_id'));
        $selStudent = $students->firstWhere('id', request('student_id'));
        $teacherInitSearch = $selTeacher ? $selTeacher->user->name . ' (' . $selTeacher->teacher_id . ')' : '';
        $studentInitSearch = $selStudent ? $selStudent->user->name . ' (' . $selStudent->student_id . ')' : '';
    @endphp

    <script>
        window._scheduleFilters = {
            teacherOptions: @json($teachers->map(fn($t) => ['id' => $t->id, 'name' => $t->user->name, 'code' => $t->teacher_id])),
            studentOptions: @json($students->map(fn($s) => ['id' => $s->id, 'name' => $s->user->name, 'code' => $s->student_id])),
            teacherInit: @json($teacherInitSearch),
            studentInit: @json($studentInitSearch),
            teacherValue: @json(request('teacher_id', '')),
            studentValue: @json(request('student_id', '')),
        };
    </script>

    <form method="GET" action="{{ route('vice-manager.schedules.index') }}"
          class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-md mb-md space-y-md">

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-md">
            <div class="space-y-xs">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Day</label>
                <select name="day_of_week"
                        class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
                    <option value="">All Days</option>
                    @foreach(['mon'=>'Monday','tue'=>'Tuesday','wed'=>'Wednesday','thu'=>'Thursday','fri'=>'Friday','sat'=>'Saturday','sun'=>'Sunday'] as $val => $label)
                        <option value="{{ $val }}" {{ request('day_of_week') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
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

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-md items-end">
            <div class="space-y-xs"
                 x-data="{
                     search: window._scheduleFilters.teacherInit,
                     value: window._scheduleFilters.teacherValue,
                     open: false,
                     options: window._scheduleFilters.teacherOptions,
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

            <div class="space-y-xs"
                 x-data="{
                     search: window._scheduleFilters.studentInit,
                     value: window._scheduleFilters.studentValue,
                     open: false,
                     options: window._scheduleFilters.studentOptions,
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

            <div class="flex gap-sm">
                <button type="submit"
                        class="inline-flex items-center gap-xs bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95 shrink-0">
                    <span class="material-symbols-outlined text-[16px]">filter_alt</span>
                    Filter
                </button>
                @if(request()->anyFilled(['teacher_id','student_id','day_of_week','time_from','time_to']))
                    <a href="{{ route('vice-manager.schedules.index') }}"
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
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Day</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Time</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Teacher</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Student</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @forelse($schedules as $schedule)
                        <tr class="hover:bg-surface-container-low transition-colors">
                            <td class="px-lg py-md">
                                <span class="inline-flex items-center px-sm py-xs bg-surface-container text-secondary font-label-sm rounded-full uppercase">
                                    {{ $schedule->day_of_week }}
                                </span>
                            </td>
                            <td class="px-lg py-md font-mono text-body-sm text-on-surface whitespace-nowrap">
                                {{ substr($schedule->start_time, 0, 5) }}–{{ substr($schedule->end_time, 0, 5) }}
                            </td>
                            <td class="px-lg py-md">
                                <p class="font-semibold text-body-sm text-on-surface">{{ $schedule->teacher->user->name }}</p>
                                <p class="text-label-sm text-secondary">{{ $schedule->teacher->teacher_id }}</p>
                            </td>
                            <td class="px-lg py-md">
                                <p class="font-medium text-body-sm text-on-surface">{{ $schedule->student->user->name }}</p>
                                <p class="text-label-sm text-secondary">{{ $schedule->student->student_id }}</p>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-lg py-2xl text-center">
                                <div class="flex flex-col items-center gap-md text-secondary">
                                    <span class="material-symbols-outlined text-[48px] opacity-30">calendar_off</span>
                                    <p class="text-body-md">No schedules found.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($schedules->hasPages())
            <div class="px-lg py-md border-t border-outline-variant">
                {{ $schedules->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
