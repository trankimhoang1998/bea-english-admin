<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center gap-sm justify-between">
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">Schedules</h1>
                <p class="text-label-sm text-secondary mt-xs">Manage all teaching schedules</p>
            </div>
            <a href="{{ route('manager.schedules.create') }}"
               class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                <span class="material-symbols-outlined text-[18px]">event_note</span>
                Add Schedule
            </a>
        </div>
    </x-slot>

    {{-- Filters --}}
    <form method="GET" action="{{ route('manager.schedules.index') }}"
          class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-md mb-md">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-md items-end">
            <div class="space-y-xs">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Teacher</label>
                <select name="teacher_id"
                        class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
                    <option value="">All Teachers</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ request('teacher_id') == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-xs">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Student</label>
                <select name="student_id"
                        class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
                    <option value="">All Students</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>
                            {{ $student->user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-xs">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Day</label>
                <select name="day_of_week"
                        class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
                    <option value="">All Days</option>
                    @foreach(['mon' => 'Monday', 'tue' => 'Tuesday', 'wed' => 'Wednesday', 'thu' => 'Thursday', 'fri' => 'Friday', 'sat' => 'Saturday', 'sun' => 'Sunday'] as $val => $label)
                        <option value="{{ $val }}" {{ request('day_of_week') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-sm">
                <button type="submit"
                        class="inline-flex items-center gap-xs bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95 shrink-0">
                    <span class="material-symbols-outlined text-[16px]">filter_alt</span>
                    Filter
                </button>
                @if(request()->anyFilled(['teacher_id', 'student_id', 'day_of_week']))
                    <a href="{{ route('manager.schedules.index') }}"
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
                        <th class="px-lg py-md text-right text-label-sm font-semibold text-secondary uppercase tracking-wide">Actions</th>
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
                            <td class="px-lg py-md">
                                <div class="flex items-center justify-end gap-sm">
                                    <a href="{{ route('manager.schedules.edit', $schedule) }}"
                                       class="inline-flex items-center gap-xs text-label-sm text-primary hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">edit</span>
                                        Edit
                                    </a>
                                    <form id="del-schedule-{{ $schedule->id }}" method="POST" action="{{ route('manager.schedules.destroy', $schedule) }}">
                                        @csrf @method('DELETE')
                                    </form>
                                    <button type="button"
                                            @click="$store.confirmModal.show('Delete this schedule entry? This cannot be undone.', 'del-schedule-{{ $schedule->id }}')"
                                            class="inline-flex items-center gap-xs text-label-sm text-error hover:text-on-surface px-sm py-xs rounded-lg hover:bg-error-container/30 transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">delete</span>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-lg py-2xl text-center">
                                <div class="flex flex-col items-center gap-md text-secondary">
                                    <span class="material-symbols-outlined text-[48px] opacity-30">calendar_off</span>
                                    <p class="text-body-md">No schedules found.</p>
                                    <a href="{{ route('manager.schedules.create') }}"
                                       class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all">
                                        <span class="material-symbols-outlined text-[16px]">add</span>
                                        Create first schedule
                                    </a>
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
