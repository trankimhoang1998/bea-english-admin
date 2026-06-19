<x-app-layout>
    <x-slot name="title">{{ $student->user->name }} | BEA English</x-slot>
    <x-slot name="header">
        <div class="flex items-center gap-md">
            <a href="{{ route('vice-manager.students.index') }}"
               class="text-secondary hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">{{ $student->user->name }}</h1>
                <p class="text-label-sm text-secondary mt-xs">Student Profile</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-lg">
        {{-- Info card --}}
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-lg">
            <div class="flex items-center gap-md mb-lg">
                <div class="w-14 h-14 rounded-full bg-tertiary/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[28px] text-tertiary">person</span>
                </div>
                <div>
                    <h2 class="font-bold text-headline-sm text-on-surface">{{ $student->user->name }}</h2>
                    <p class="text-label-sm text-secondary">{{ $student->user->username }}</p>
                </div>
            </div>
            <dl class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-md">
                <div class="bg-surface-container-low rounded-xl p-md">
                    <dt class="text-label-sm text-secondary mb-xs">Student ID</dt>
                    <dd class="font-semibold text-body-sm text-on-surface">{{ $student->student_id }}</dd>
                </div>
                <div class="bg-surface-container-low rounded-xl p-md">
                    <dt class="text-label-sm text-secondary mb-xs">Age</dt>
                    <dd class="font-semibold text-body-sm text-on-surface">{{ $student->age }}</dd>
                </div>
                <div class="bg-surface-container-low rounded-xl p-md">
                    <dt class="text-label-sm text-secondary mb-xs">Course</dt>
                    <dd class="font-semibold text-body-sm text-on-surface">{{ $student->course }}</dd>
                </div>
                <div class="bg-surface-container-low rounded-xl p-md">
                    <dt class="text-label-sm text-secondary mb-xs">Total Lessons</dt>
                    <dd class="font-semibold text-body-sm text-on-surface">{{ $student->teachingHistories->count() }} lessons</dd>
                </div>
            </dl>
        </div>

        {{-- Learning Schedule --}}
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
            <div class="flex items-center gap-sm px-lg py-md border-b border-outline-variant">
                <span class="material-symbols-outlined text-primary text-[20px]">calendar_month</span>
                <h2 class="font-semibold text-headline-sm text-on-surface">Weekly Learning Schedule</h2>
            </div>
            @php
                $days = ['mon','tue','wed','thu','fri','sat','sun'];
                $dayLabels = ['mon'=>'Mon','tue'=>'Tue','wed'=>'Wed','thu'=>'Thu','fri'=>'Fri','sat'=>'Sat','sun'=>'Sun'];
                $palette = [
                    ['bg'=>'bg-blue-100',   'text'=>'text-blue-800',   'border'=>'border-blue-200',   'dot'=>'bg-blue-400'],
                    ['bg'=>'bg-violet-100', 'text'=>'text-violet-800', 'border'=>'border-violet-200', 'dot'=>'bg-violet-400'],
                    ['bg'=>'bg-emerald-100','text'=>'text-emerald-800','border'=>'border-emerald-200','dot'=>'bg-emerald-400'],
                    ['bg'=>'bg-amber-100',  'text'=>'text-amber-800',  'border'=>'border-amber-200',  'dot'=>'bg-amber-400'],
                    ['bg'=>'bg-rose-100',   'text'=>'text-rose-800',   'border'=>'border-rose-200',   'dot'=>'bg-rose-400'],
                    ['bg'=>'bg-cyan-100',   'text'=>'text-cyan-800',   'border'=>'border-cyan-200',   'dot'=>'bg-cyan-400'],
                    ['bg'=>'bg-orange-100', 'text'=>'text-orange-800', 'border'=>'border-orange-200', 'dot'=>'bg-orange-400'],
                    ['bg'=>'bg-pink-100',   'text'=>'text-pink-800',   'border'=>'border-pink-200',   'dot'=>'bg-pink-400'],
                ];
                $allTeacherIds = $student->schedules->pluck('teacher_id')
                    ->merge($student->teachingHistories->pluck('teacher_id'))
                    ->unique()->values();
                $teacherColorMap = $allTeacherIds->mapWithKeys(
                    fn($id, $idx) => [$id => $palette[$idx % count($palette)]]
                )->toArray();
                $scheduledTeachers = $student->schedules->unique('teacher_id')
                    ->map(fn($s) => ['id' => $s->teacher_id, 'name' => $s->teacher->user->name, 'code' => $s->teacher->teacher_id])
                    ->values();
                $slots = $student->schedules->map(fn($s) => $s->start_time . '-' . $s->end_time)->unique()->sort()->values();
                $lookup = [];
                foreach ($student->schedules as $s) {
                    $lookup[$s->start_time . '-' . $s->end_time . '-' . $s->day_of_week] = $s;
                }
            @endphp
            @if($slots->isEmpty())
                <div class="flex flex-col items-center py-xl text-secondary">
                    <span class="material-symbols-outlined text-[40px] mb-md opacity-30">calendar_month</span>
                    <p class="text-body-sm">No schedule assigned yet.</p>
                </div>
            @else
                @if($scheduledTeachers->count() > 1)
                    <div class="flex flex-wrap gap-md px-lg py-sm border-b border-outline-variant bg-surface-container-low/40">
                        @foreach($scheduledTeachers as $sl)
                            @php $lc = $teacherColorMap[$sl['id']] ?? $palette[0]; @endphp
                            <span class="inline-flex items-center gap-xs text-label-sm {{ $lc['text'] }}">
                                <span class="w-2.5 h-2.5 rounded-full {{ $lc['dot'] }} shrink-0"></span>
                                {{ $sl['name'] }}
                                <span class="opacity-60 text-[11px]">({{ $sl['code'] }})</span>
                            </span>
                        @endforeach
                    </div>
                @endif
                <div class="overflow-x-auto">
                    <table class="w-full text-body-sm">
                        <thead class="bg-surface-container-low border-b border-outline-variant">
                            <tr>
                                <th class="px-md py-sm text-left text-label-sm font-semibold text-secondary w-28">Time</th>
                                @foreach($days as $d)
                                    <th class="px-md py-sm text-center text-label-sm font-semibold text-secondary uppercase">{{ $dayLabels[$d] }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            @foreach($slots as $slot)
                                @php
                                    [$startRaw, $endRaw] = explode('-', $slot, 2);
                                @endphp
                                <tr class="hover:bg-surface-container-low/50 transition-colors">
                                    <td class="px-md py-sm font-mono text-label-sm text-secondary whitespace-nowrap">
                                        {{ substr($startRaw, 0, 5) }}–{{ substr($endRaw, 0, 5) }}
                                    </td>
                                    @foreach($days as $d)
                                        @php $schedule = $lookup[$slot . '-' . $d] ?? null; @endphp
                                        <td class="px-md py-sm text-center">
                                            @if($schedule)
                                                @php $c = $teacherColorMap[$schedule->teacher_id] ?? $palette[0]; @endphp
                                                <div class="inline-flex flex-col items-center px-sm py-xs {{ $c['bg'] }} {{ $c['text'] }} rounded-lg text-label-sm leading-tight border {{ $c['border'] }}">
                                                    <span class="font-semibold">{{ $schedule->teacher->user->name }}</span>
                                                    <span class="text-[11px] opacity-60">{{ $schedule->teacher->teacher_id }}</span>
                                                </div>
                                            @else
                                                <span class="text-outline-variant">—</span>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- Learning History --}}
        @php
            $historyTeachers = $student->teachingHistories
                ->sortBy('teacher.user.name')
                ->unique('teacher_id')
                ->map(fn($h) => ['id' => $h->teacher_id, 'name' => $h->teacher->user->name]);
        @endphp
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden"
             x-data="{
                 ft: '', fd: '', fte: '', fdu: '', ftf: '', ftt: '',
                 ok(t, d, du, tf) {
                     if (this.ft  && t  !== this.ft)  return false;
                     if (this.fd  && d  < this.fd)   return false;
                     if (this.fte && d  > this.fte)  return false;
                     if (this.fdu && du !== this.fdu) return false;
                     if (this.ftf && tf < this.ftf)  return false;
                     if (this.ftt && tf > this.ftt)  return false;
                     return true;
                 }
             }">
            <div class="flex items-center gap-sm px-lg py-md border-b border-outline-variant">
                <span class="material-symbols-outlined text-primary text-[20px]">history_edu</span>
                <h2 class="font-semibold text-headline-sm text-on-surface">Learning History</h2>
            </div>
            <div class="p-md border-b border-outline-variant bg-surface-container-low/50 space-y-md">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-md">
                    <div class="space-y-xs">
                        <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Date From</label>
                        <input type="date" x-model="fd" class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary outline-none transition-all">
                    </div>
                    <div class="space-y-xs">
                        <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Date To</label>
                        <input type="date" x-model="fte" class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary outline-none transition-all">
                    </div>
                    <div class="space-y-xs">
                        <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Time From</label>
                        <input type="time" x-model="ftf" class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary outline-none transition-all">
                    </div>
                    <div class="space-y-xs">
                        <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Time To</label>
                        <input type="time" x-model="ftt" class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary outline-none transition-all">
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-md items-end">
                    <div class="space-y-xs">
                        <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Teacher</label>
                        <select x-model="ft" class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary outline-none transition-all">
                            <option value="">All</option>
                            @foreach($historyTeachers as $ht)
                                <option value="{{ $ht['id'] }}">{{ $ht['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-xs">
                        <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Duration</label>
                        <select x-model="fdu" class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary outline-none transition-all">
                            <option value="">Any</option>
                            <option value="25">25 min</option>
                            <option value="50">50 min</option>
                            <option value="90">90 min</option>
                        </select>
                    </div>
                    <div class="md:col-span-2 flex items-end">
                        <button type="button" @click="ft=''; fd=''; fte=''; fdu=''; ftf=''; ftt=''"
                                x-show="ft || fd || fte || fdu || ftf || ftt" x-cloak
                                class="inline-flex items-center gap-xs text-label-sm text-secondary hover:text-on-surface transition-colors py-sm">
                            <span class="material-symbols-outlined text-[18px]">close</span>
                            Clear filters
                        </button>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-body-sm">
                    <thead class="bg-surface-container-low border-b border-outline-variant">
                        <tr>
                            <th class="px-lg py-sm text-left text-label-sm font-semibold text-secondary">Teacher</th>
                            <th class="px-lg py-sm text-left text-label-sm font-semibold text-secondary">Lesson</th>
                            <th class="px-lg py-sm text-left text-label-sm font-semibold text-secondary">Date</th>
                            <th class="px-lg py-sm text-left text-label-sm font-semibold text-secondary">Duration</th>
                            <th class="px-lg py-sm text-left text-label-sm font-semibold text-secondary">Video</th>
                            <th class="px-lg py-sm text-left text-label-sm font-semibold text-secondary">Note/Homework</th>
                            <th class="px-lg py-sm text-right text-label-sm font-semibold text-secondary">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @forelse($student->teachingHistories->sortByDesc('taught_date') as $h)
                            <tr class="hover:bg-surface-container-low transition-colors"
                                x-show="ok('{{ $h->teacher_id }}', '{{ $h->taught_date->format('Y-m-d') }}', '{{ $h->duration }}', '{{ $h->time_from }}')">
                                <td class="px-lg py-md">
                                    @php $hc = $teacherColorMap[$h->teacher_id] ?? $palette[0]; @endphp
                                    <div class="flex items-center gap-xs">
                                        <span class="w-2 h-2 rounded-full {{ $hc['dot'] }} shrink-0"></span>
                                        <div>
                                            <p class="font-semibold text-body-sm text-on-surface">{{ $h->teacher->user->name }}</p>
                                            <p class="text-label-sm text-secondary">{{ $h->teacher->teacher_id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-lg py-md font-medium text-on-surface">{{ 'Lesson: ' . str_pad($h->lesson_number, 2, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-lg py-md whitespace-nowrap">
                                    <p class="text-body-sm text-on-surface">{{ $h->taught_date->format('d/m/Y') }}</p>
                                    <p class="text-label-sm text-secondary">{{ $h->time_from }} – {{ $h->time_to }}</p>
                                </td>
                                <td class="px-lg py-md">
                                    <span class="text-label-sm bg-surface-container px-sm py-xs rounded-full text-secondary">{{ $h->duration }} min</span>
                                </td>
                                <td class="px-lg py-md whitespace-nowrap">
                                    @if($h->video_path)
                                        <a href="{{ route('vice-manager.histories.video', $h) }}"
                                           class="inline-flex items-center gap-xs text-label-sm text-primary hover:underline">
                                            <span class="material-symbols-outlined text-[16px]">download</span>
                                            Download
                                        </a>
                                    @elseif($h->video_link)
                                        <a href="{{ $h->video_link }}" target="_blank" rel="noopener"
                                           class="inline-flex items-center gap-xs text-label-sm text-sky-600 hover:underline">
                                            <span class="material-symbols-outlined text-[16px]">play_circle</span>
                                            Watch
                                        </a>
                                    @else
                                        <span class="inline-flex items-center gap-xs text-label-sm text-secondary/50">
                                            <span class="material-symbols-outlined text-[14px]">close</span>
                                            No video
                                        </span>
                                    @endif
                                </td>
                                <td class="px-lg py-md">
                                    @if($h->note)
                                        <span class="block truncate text-body-sm text-secondary max-w-[180px]">{{ $h->note }}</span>
                                    @else
                                        <span class="text-secondary">—</span>
                                    @endif
                                </td>
                                <td class="px-lg py-md text-right">
                                    <a href="{{ route('vice-manager.histories.show', $h) }}"
                                       class="inline-flex items-center gap-xs text-label-sm text-secondary hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">visibility</span>
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-lg py-xl text-center text-secondary">
                                    <span class="material-symbols-outlined text-[32px] opacity-30 mb-sm block">history_edu</span>
                                    No history yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
