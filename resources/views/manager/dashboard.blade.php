<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center gap-sm justify-between">
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">Dashboard</h1>
                <p class="text-label-sm text-secondary mt-xs">Welcome back, {{ Auth::user()->name }}</p>
            </div>
        </div>
    </x-slot>

    @php
        $teacherCount  = \App\Models\Teacher::count();
        $studentCount  = \App\Models\Student::count();
        $scheduleCount = \App\Models\Schedule::count();
        $materialCount = \App\Models\LearningMaterial::count();
        $historyCount  = \App\Models\TeachingHistory::count();
        $recentHistories = \App\Models\TeachingHistory::with(['teacher.user', 'student.user'])
                            ->latest('taught_at')->limit(5)->get();
    @endphp

    {{-- Stats cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-md mb-xl">
        <a href="{{ route('manager.teachers.index') }}"
           class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all group">
            <div class="flex items-center justify-between mb-md">
                <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-[22px]">person</span>
                </div>
                <span class="material-symbols-outlined text-secondary text-[18px] group-hover:text-primary transition-colors">arrow_forward</span>
            </div>
            <p class="font-bold text-2xl md:text-display-lg text-on-surface leading-none">{{ $teacherCount }}</p>
            <p class="text-label-sm text-secondary mt-xs">Teachers</p>
        </a>

        <a href="{{ route('manager.students.index') }}"
           class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all group">
            <div class="flex items-center justify-between mb-md">
                <div class="w-10 h-10 rounded-lg bg-tertiary/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-tertiary text-[22px]">group</span>
                </div>
                <span class="material-symbols-outlined text-secondary text-[18px] group-hover:text-primary transition-colors">arrow_forward</span>
            </div>
            <p class="font-bold text-2xl md:text-display-lg text-on-surface leading-none">{{ $studentCount }}</p>
            <p class="text-label-sm text-secondary mt-xs">Students</p>
        </a>

        <a href="{{ route('manager.schedules.index') }}"
           class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all group">
            <div class="flex items-center justify-between mb-md">
                <div class="w-10 h-10 rounded-lg bg-primary-container/20 flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary-container text-[22px]">calendar_month</span>
                </div>
                <span class="material-symbols-outlined text-secondary text-[18px] group-hover:text-primary transition-colors">arrow_forward</span>
            </div>
            <p class="font-bold text-2xl md:text-display-lg text-on-surface leading-none">{{ $scheduleCount }}</p>
            <p class="text-label-sm text-secondary mt-xs">Schedules</p>
        </a>

        <a href="{{ route('manager.materials.index') }}"
           class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all group">
            <div class="flex items-center justify-between mb-md">
                <div class="w-10 h-10 rounded-lg bg-secondary-container/50 flex items-center justify-center">
                    <span class="material-symbols-outlined text-secondary text-[22px]">folder_open</span>
                </div>
                <span class="material-symbols-outlined text-secondary text-[18px] group-hover:text-primary transition-colors">arrow_forward</span>
            </div>
            <p class="font-bold text-2xl md:text-display-lg text-on-surface leading-none">{{ $materialCount }}</p>
            <p class="text-label-sm text-secondary mt-xs">Materials</p>
        </a>
    </div>

    {{-- Recent teaching sessions --}}
    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-lg py-md border-b border-outline-variant">
            <div class="flex items-center gap-sm">
                <span class="material-symbols-outlined text-primary text-[20px]">history_edu</span>
                <h2 class="font-semibold text-headline-sm text-on-surface">Recent Teaching Sessions</h2>
            </div>
            <a href="{{ route('manager.histories.index') }}"
               class="text-label-sm text-primary hover:underline flex items-center gap-xs">
                View all
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
        </div>

        @if($recentHistories->isEmpty())
            <div class="flex flex-col items-center justify-center py-2xl text-secondary">
                <span class="material-symbols-outlined text-[48px] mb-md opacity-30">history_edu</span>
                <p class="text-body-md">No teaching sessions recorded yet.</p>
            </div>
        @else
            <div class="divide-y divide-outline-variant">
                @foreach($recentHistories as $history)
                    <div class="flex items-center gap-md px-lg py-md hover:bg-surface-container-low transition-colors">
                        <div class="w-9 h-9 rounded-full bg-secondary-container flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[18px] text-on-surface-variant">person</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-body-sm font-semibold text-on-surface truncate">
                                {{ $history->teacher->user->name }} → {{ $history->student->user->name }}
                            </p>
                            <p class="text-label-sm text-secondary">
                                {{ 'Lesson: ' . str_pad($history->lesson_number, 2, '0', STR_PAD_LEFT) }}
                            </p>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="text-label-sm text-secondary">{{ \Carbon\Carbon::parse($history->taught_at)->format('d M Y') }}</p>
                            <p class="text-label-sm text-on-surface-variant">{{ $history->duration }} min</p>
                        </div>
                        <a href="{{ route('manager.histories.show', $history) }}"
                           class="shrink-0 text-primary hover:bg-surface-container p-xs rounded-lg transition-colors">
                            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Quick actions --}}
    <div class="mt-xl grid grid-cols-1 sm:grid-cols-3 gap-md">
        <a href="{{ route('manager.teachers.create') }}"
           class="flex items-center gap-md p-lg bg-surface-container-lowest border border-outline-variant rounded-xl hover:border-primary hover:bg-surface-container-low transition-all group">
            <div class="w-10 h-10 rounded-lg bg-primary-container flex items-center justify-center text-white">
                <span class="material-symbols-outlined text-[20px]">person_add</span>
            </div>
            <div>
                <p class="text-body-sm font-semibold text-on-surface group-hover:text-primary transition-colors">Add Teacher</p>
                <p class="text-label-sm text-secondary">Register new faculty</p>
            </div>
        </a>
        <a href="{{ route('manager.students.create') }}"
           class="flex items-center gap-md p-lg bg-surface-container-lowest border border-outline-variant rounded-xl hover:border-primary hover:bg-surface-container-low transition-all group">
            <div class="w-10 h-10 rounded-lg bg-tertiary flex items-center justify-center text-white">
                <span class="material-symbols-outlined text-[20px]">group_add</span>
            </div>
            <div>
                <p class="text-body-sm font-semibold text-on-surface group-hover:text-primary transition-colors">Add Student</p>
                <p class="text-label-sm text-secondary">Enroll new student</p>
            </div>
        </a>
        <a href="{{ route('manager.schedules.create') }}"
           class="flex items-center gap-md p-lg bg-surface-container-lowest border border-outline-variant rounded-xl hover:border-primary hover:bg-surface-container-low transition-all group">
            <div class="w-10 h-10 rounded-lg bg-secondary flex items-center justify-center text-white">
                <span class="material-symbols-outlined text-[20px]">event_note</span>
            </div>
            <div>
                <p class="text-body-sm font-semibold text-on-surface group-hover:text-primary transition-colors">New Schedule</p>
                <p class="text-label-sm text-secondary">Create teaching slot</p>
            </div>
        </a>
    </div>
</x-app-layout>
