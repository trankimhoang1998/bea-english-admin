<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center gap-sm justify-between">
            <div class="flex items-center gap-md">
                <a href="{{ route('manager.teachers.index') }}"
                   class="text-secondary hover:text-on-surface transition-colors">
                    <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                </a>
                <div>
                    <h1 class="font-bold text-headline-sm text-on-surface">{{ $teacher->user->name }}</h1>
                    <p class="text-label-sm text-secondary mt-xs">Teacher Profile</p>
                </div>
            </div>
            <a href="{{ route('manager.teachers.edit', $teacher) }}"
               class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                <span class="material-symbols-outlined text-[18px]">edit</span>
                Edit
            </a>
        </div>
    </x-slot>

    <div class="space-y-lg">
        {{-- Info card --}}
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-lg">
            <div class="flex items-center gap-md mb-lg">
                <div class="w-14 h-14 rounded-full bg-secondary-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-[28px] text-on-surface-variant">person</span>
                </div>
                <div>
                    <h2 class="font-bold text-headline-sm text-on-surface">{{ $teacher->user->name }}</h2>
                    <p class="text-label-sm text-secondary">{{ $teacher->user->username }}</p>
                </div>
            </div>
            <dl class="grid grid-cols-1 sm:grid-cols-3 gap-lg">
                <div class="bg-surface-container-low rounded-xl p-md">
                    <dt class="text-label-sm text-secondary mb-xs">Teacher ID</dt>
                    <dd class="font-semibold text-body-sm text-on-surface">{{ $teacher->teacher_id }}</dd>
                </div>
                <div class="bg-surface-container-low rounded-xl p-md">
                    <dt class="text-label-sm text-secondary mb-xs">Experience</dt>
                    <dd class="font-semibold text-body-sm text-on-surface">{{ $teacher->experience }}</dd>
                </div>
                <div class="bg-surface-container-low rounded-xl p-md">
                    <dt class="text-label-sm text-secondary mb-xs">Total Sessions</dt>
                    <dd class="font-semibold text-body-sm text-on-surface">{{ $teacher->teachingHistories->count() }} lessons</dd>
                </div>
            </dl>
        </div>

        {{-- Weekly Teaching Schedule --}}
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
            <div class="flex items-center gap-sm px-lg py-md border-b border-outline-variant">
                <span class="material-symbols-outlined text-primary text-[20px]">calendar_month</span>
                <h2 class="font-semibold text-headline-sm text-on-surface">Weekly Teaching Schedule</h2>
            </div>
            @php
                $days = ['mon','tue','wed','thu','fri','sat','sun'];
                $dayLabels = ['mon'=>'Mon','tue'=>'Tue','wed'=>'Wed','thu'=>'Thu','fri'=>'Fri','sat'=>'Sat','sun'=>'Sun'];
                $byDaySlot = [];
                foreach ($teacher->schedules as $s) {
                    $byDaySlot[$s->start_time][$s->day_of_week] = $s;
                }
                ksort($byDaySlot);
            @endphp
            @if(empty($byDaySlot))
                <div class="flex flex-col items-center py-xl text-secondary">
                    <span class="material-symbols-outlined text-[40px] mb-md opacity-30">calendar_month</span>
                    <p class="text-body-sm">No schedule assigned yet.</p>
                </div>
            @else
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
                            @foreach($byDaySlot as $startTime => $dayMap)
                                <tr class="hover:bg-surface-container-low transition-colors">
                                    <td class="px-md py-sm font-mono text-label-md text-secondary whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($startTime)->format('H:i') }}
                                    </td>
                                    @foreach($days as $d)
                                        <td class="px-md py-sm text-center">
                                            @if(isset($dayMap[$d]))
                                                <span class="inline-flex flex-col items-center px-sm py-xs bg-secondary-container text-on-secondary-container rounded-lg text-label-sm leading-tight">
                                                    <span class="font-semibold">{{ $dayMap[$d]->student->user->name }}</span>
                                                    <span class="text-secondary opacity-80 text-[11px]">{{ $dayMap[$d]->student->student_id }}</span>
                                                </span>
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

        {{-- Teaching Histories --}}
        @php
            $historyStudents = $teacher->teachingHistories
                ->sortBy('student.user.name')
                ->unique('student_id')
                ->map(fn($h) => ['id' => $h->student_id, 'name' => $h->student->user->name]);
        @endphp
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden"
             x-data="{
                 fs: '', fd: '', ft: '', fdu: '',
                 ok(s, d, du) {
                     if (this.fs  && s  !== this.fs)  return false;
                     if (this.fd  && d  < this.fd)   return false;
                     if (this.ft  && d  > this.ft)   return false;
                     if (this.fdu && du !== this.fdu) return false;
                     return true;
                 }
             }">
            <div class="flex items-center gap-sm px-lg py-md border-b border-outline-variant">
                <span class="material-symbols-outlined text-primary text-[20px]">history_edu</span>
                <h2 class="font-semibold text-headline-sm text-on-surface">Teaching History</h2>
            </div>

            {{-- Filters --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-md p-md border-b border-outline-variant bg-surface-container-low/50">
                <div class="space-y-xs">
                    <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Student</label>
                    <select x-model="fs"
                            class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary outline-none transition-all">
                        <option value="">All</option>
                        @foreach($historyStudents as $hs)
                            <option value="{{ $hs['id'] }}">{{ $hs['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-xs">
                    <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Date From</label>
                    <input type="date" x-model="fd"
                           class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary outline-none transition-all">
                </div>
                <div class="space-y-xs">
                    <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Date To</label>
                    <input type="date" x-model="ft"
                           class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary outline-none transition-all">
                </div>
                <div class="space-y-xs">
                    <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Duration</label>
                    <div class="flex gap-sm">
                        <select x-model="fdu"
                                class="flex-1 border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary outline-none transition-all">
                            <option value="">Any</option>
                            <option value="25">25 min</option>
                            <option value="50">50 min</option>
                        </select>
                        <button type="button" @click="fs=''; fd=''; ft=''; fdu=''"
                                x-show="fs || fd || ft || fdu"
                                class="inline-flex items-center px-sm py-sm text-secondary hover:text-on-surface transition-colors shrink-0"
                                title="Clear filters">
                            <span class="material-symbols-outlined text-[18px]">close</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-body-sm">
                    <thead class="bg-surface-container-low border-b border-outline-variant">
                        <tr>
                            <th class="px-lg py-sm text-left text-label-sm font-semibold text-secondary">Date</th>
                            <th class="px-lg py-sm text-left text-label-sm font-semibold text-secondary">Student</th>
                            <th class="px-lg py-sm text-left text-label-sm font-semibold text-secondary">Lesson</th>
                            <th class="px-lg py-sm text-left text-label-sm font-semibold text-secondary">Duration</th>
                            <th class="px-lg py-sm text-left text-label-sm font-semibold text-secondary">Note</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @forelse($teacher->teachingHistories->sortByDesc('taught_at') as $h)
                            <tr class="hover:bg-surface-container-low transition-colors"
                                x-show="ok('{{ $h->student_id }}', '{{ $h->taught_at->format('Y-m-d') }}', '{{ $h->duration }}')">
                                <td class="px-lg py-md text-secondary whitespace-nowrap">{{ $h->taught_at->format('d/m/Y H:i') }}</td>
                                <td class="px-lg py-md">
                                    <p class="font-semibold text-body-sm text-on-surface">{{ $h->student->user->name }}</p>
                                    <p class="text-label-sm text-secondary">{{ $h->student->student_id }}</p>
                                </td>
                                <td class="px-lg py-md text-on-surface">{{ 'Lesson: ' . str_pad($h->lesson_number, 2, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-lg py-md">
                                    <span class="text-label-sm bg-surface-container px-sm py-xs rounded-full text-secondary">{{ $h->duration }} min</span>
                                </td>
                                <td class="px-lg py-md text-secondary">{{ $h->note ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-lg py-xl text-center text-secondary">
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
