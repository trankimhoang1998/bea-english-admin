<x-app-layout>
    <x-slot name="title">Dashboard | BEA English</x-slot>
    <x-slot name="header">
        <div>
            <h1 class="font-bold text-headline-sm text-on-surface">My Dashboard</h1>
            <p class="text-label-sm text-secondary mt-xs">Welcome back, {{ $student->user->name }}</p>
        </div>
    </x-slot>

    <div class="space-y-lg">
        {{-- Student info card --}}
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-lg">
            <div class="flex items-center gap-md mb-lg">
                <div class="w-14 h-14 rounded-full bg-tertiary/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[28px] text-tertiary">person</span>
                </div>
                <div>
                    <h2 class="font-bold text-headline-sm text-on-surface">{{ $student->user->name }}</h2>
                    <p class="text-label-sm text-secondary">{{ $student->student_id }}</p>
                </div>
            </div>
            <dl class="grid grid-cols-2 sm:grid-cols-3 gap-md">
                <div class="bg-surface-container-low rounded-xl p-md">
                    <dt class="text-label-sm text-secondary mb-xs">Age</dt>
                    <dd class="font-semibold text-body-sm text-on-surface">{{ $student->age }}</dd>
                </div>
                <div class="bg-surface-container-low rounded-xl p-md">
                    <dt class="text-label-sm text-secondary mb-xs">Course</dt>
                    <dd class="font-semibold text-body-sm text-on-surface">{{ $student->course }}</dd>
                </div>
                <div class="bg-surface-container-low rounded-xl p-md col-span-2 sm:col-span-1">
                    <dt class="text-label-sm text-secondary mb-xs">Student ID</dt>
                    <dd class="font-semibold text-body-sm text-on-surface">{{ $student->student_id }}</dd>
                </div>
            </dl>
        </div>

        {{-- Weekly Learning Schedule --}}
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
            <div class="flex items-center gap-sm px-lg py-md border-b border-outline-variant">
                <span class="material-symbols-outlined text-primary text-[20px]">calendar_month</span>
                <h2 class="font-semibold text-headline-sm text-on-surface">Weekly Learning Schedule</h2>
            </div>

            @php
                $dayKeys = ['mon','tue','wed','thu','fri','sat','sun'];
                $dayLabels = ['mon'=>'Mon','tue'=>'Tue','wed'=>'Wed','thu'=>'Thu','fri'=>'Fri','sat'=>'Sat','sun'=>'Sun'];
                $slots = $student->schedules->map(fn($s) => $s->start_time . '-' . $s->end_time)->unique()->sort()->values();
                $lookup = [];
                foreach ($student->schedules as $s) {
                    $key = $s->start_time . '-' . $s->end_time . '-' . $s->day_of_week;
                    $lookup[$key] = $s;
                }
            @endphp

            @if($slots->isEmpty())
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
                                @foreach($dayKeys as $d)
                                    <th class="px-md py-sm text-center text-label-sm font-semibold text-secondary uppercase">{{ $dayLabels[$d] }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            @foreach($slots as $slot)
                                @php
                                    [$startRaw, $endRaw] = explode('-', $slot, 2);
                                    $startDisplay = substr($startRaw, 0, 5);
                                    $endDisplay = substr($endRaw, 0, 5);
                                @endphp
                                <tr class="hover:bg-surface-container-low transition-colors">
                                    <td class="px-md py-sm font-mono text-label-md text-secondary whitespace-nowrap">
                                        {{ $startDisplay }}–{{ $endDisplay }}
                                    </td>
                                    @foreach($dayKeys as $dayKey)
                                        @php
                                            $cellKey = $slot . '-' . $dayKey;
                                            $schedule = $lookup[$cellKey] ?? null;
                                        @endphp
                                        <td class="px-md py-sm text-center">
                                            @if($schedule)
                                                <span class="inline-flex flex-col items-center px-sm py-xs bg-secondary-container text-on-secondary-container rounded-lg text-label-sm leading-tight">
                                                    <span class="font-semibold">{{ $schedule->teacher->user->name }}</span>
                                                    <span class="text-secondary opacity-80 text-[11px]">{{ $schedule->teacher->teacher_id }}</span>
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

        {{-- Quick links --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-md">
            <a href="{{ route('student.history.index') }}"
               class="flex items-center gap-md p-lg bg-surface-container-lowest border border-outline-variant rounded-xl hover:border-primary hover:bg-surface-container-low transition-all group">
                <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-[20px]">history_edu</span>
                </div>
                <div>
                    <p class="font-semibold text-body-sm text-on-surface group-hover:text-primary transition-colors">My Learning History</p>
                    <p class="text-label-sm text-secondary">View all past lessons and recordings</p>
                </div>
                <span class="material-symbols-outlined text-secondary text-[18px] ml-auto group-hover:text-primary transition-colors">arrow_forward</span>
            </a>
            <a href="{{ route('student.materials.index') }}"
               class="flex items-center gap-md p-lg bg-surface-container-lowest border border-outline-variant rounded-xl hover:border-primary hover:bg-surface-container-low transition-all group">
                <div class="w-10 h-10 rounded-lg bg-tertiary/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-tertiary text-[20px]">folder_open</span>
                </div>
                <div>
                    <p class="font-semibold text-body-sm text-on-surface group-hover:text-primary transition-colors">Learning Materials</p>
                    <p class="text-label-sm text-secondary">Download resources from your teachers</p>
                </div>
                <span class="material-symbols-outlined text-secondary text-[18px] ml-auto group-hover:text-primary transition-colors">arrow_forward</span>
            </a>
        </div>
    </div>
</x-app-layout>
