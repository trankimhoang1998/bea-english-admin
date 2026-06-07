<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center gap-sm justify-between">
            <div class="flex items-center gap-md">
                <a href="{{ route('manager.students.index') }}"
                   class="text-secondary hover:text-on-surface transition-colors">
                    <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                </a>
                <div>
                    <h1 class="font-bold text-headline-sm text-on-surface">{{ $student->user->name }}</h1>
                    <p class="text-label-sm text-secondary mt-xs">Student Profile</p>
                </div>
            </div>
            <a href="{{ route('manager.students.edit', $student) }}"
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
                <div class="w-14 h-14 rounded-full bg-tertiary/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[28px] text-tertiary">person</span>
                </div>
                <div>
                    <h2 class="font-bold text-headline-sm text-on-surface">{{ $student->user->name }}</h2>
                    <p class="text-label-sm text-secondary">{{ $student->user->email }}</p>
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
                $byDaySlot = [];
                foreach ($student->schedules as $s) {
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
                                                    <span class="font-semibold">{{ $dayMap[$d]->teacher->user->name }}</span>
                                                    <span class="text-secondary opacity-80 text-[11px]">{{ $dayMap[$d]->teacher->teacher_id }}</span>
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

        {{-- Learning History --}}
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
            <div class="flex items-center gap-sm px-lg py-md border-b border-outline-variant">
                <span class="material-symbols-outlined text-primary text-[20px]">history_edu</span>
                <h2 class="font-semibold text-headline-sm text-on-surface">Learning History</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-body-sm">
                    <thead class="bg-surface-container-low border-b border-outline-variant">
                        <tr>
                            <th class="px-lg py-sm text-left text-label-sm font-semibold text-secondary">Lesson</th>
                            <th class="px-lg py-sm text-left text-label-sm font-semibold text-secondary">Date</th>
                            <th class="px-lg py-sm text-left text-label-sm font-semibold text-secondary">Duration</th>
                            <th class="px-lg py-sm text-left text-label-sm font-semibold text-secondary">Note</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @forelse($student->teachingHistories->sortByDesc('taught_at') as $h)
                            <tr class="hover:bg-surface-container-low transition-colors">
                                <td class="px-lg py-md font-medium text-on-surface">{{ $h->lesson }}</td>
                                <td class="px-lg py-md text-secondary whitespace-nowrap">{{ $h->taught_at->format('d/m/Y H:i') }}</td>
                                <td class="px-lg py-md">
                                    <span class="text-label-sm bg-surface-container px-sm py-xs rounded-full text-secondary">{{ $h->duration }} min</span>
                                </td>
                                <td class="px-lg py-md text-secondary">{{ $h->note ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-lg py-xl text-center text-secondary">
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
