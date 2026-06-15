<x-app-layout>
    <x-slot name="title">Learning History | BEA English</x-slot>
    <x-slot name="header">
        <div>
            <h1 class="font-bold text-headline-sm text-on-surface">My Learning History</h1>
            <p class="text-label-sm text-secondary mt-xs">All your completed lesson sessions</p>
        </div>
    </x-slot>

    {{-- Filters --}}
    <form method="GET" action="{{ route('student.history.index') }}"
          class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-md mb-md space-y-md">

        {{-- Row 1: Date From, Date To, Time From, Time To --}}
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

        {{-- Row 2: Teacher, Duration, Buttons --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-md items-end">
            <div class="space-y-xs">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Teacher</label>
                <select name="teacher_id"
                        class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
                    <option value="">All Teachers</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ request('teacher_id') == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->user->name }} ({{ $teacher->teacher_id }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-xs">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Duration</label>
                <select name="duration"
                        class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
                    <option value="">All</option>
                    <option value="25" {{ request('duration') == '25' ? 'selected' : '' }}>25 min</option>
                    <option value="50" {{ request('duration') == '50' ? 'selected' : '' }}>50 min</option>
                </select>
            </div>
            <div class="md:col-span-2 flex gap-sm items-end">
                <button type="submit"
                        class="inline-flex items-center gap-xs bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95 shrink-0">
                    <span class="material-symbols-outlined text-[16px]">filter_alt</span>
                    Filter
                </button>
                @if(request()->anyFilled(['teacher_id', 'date_from', 'date_to', 'time_from', 'time_to', 'duration']))
                    <a href="{{ route('student.history.index') }}"
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
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Teacher</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Lesson</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Date</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Duration</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Note/Homework</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Video</th>
                        <th class="px-lg py-md text-right text-label-sm font-semibold text-secondary uppercase tracking-wide">Details</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @forelse($histories as $history)
                        <tr class="hover:bg-surface-container-low transition-colors">
                            <td class="px-lg py-md">
                                <p class="font-semibold text-body-sm text-on-surface">{{ $history->teacher->user->name }}</p>
                                <p class="text-label-sm text-secondary">{{ $history->teacher->teacher_id }}</p>
                            </td>
                            <td class="px-lg py-md text-body-sm text-on-surface">{{ 'Lesson: ' . str_pad($history->lesson_number, 2, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-lg py-md whitespace-nowrap">
                                <p class="text-body-sm text-on-surface">{{ $history->taught_date->format('d/m/Y') }}</p>
                                <p class="text-label-sm text-secondary">{{ $history->time_from }} – {{ $history->time_to }}</p>
                            </td>
                            <td class="px-lg py-md">
                                <span class="text-label-sm bg-surface-container px-sm py-xs rounded-full text-secondary">{{ $history->duration }} min</span>
                            </td>
                            <td class="px-lg py-md">
                                @if($history->note)
                                    <span class="block truncate text-body-sm text-on-surface max-w-[180px]">{{ $history->note }}</span>
                                @else
                                    <span class="text-label-sm text-secondary">—</span>
                                @endif
                            </td>
                            <td class="px-lg py-md">
                                @if($history->video_path)
                                    <a href="{{ route('student.history.video', $history) }}"
                                       class="inline-flex items-center gap-xs text-label-sm text-primary hover:underline">
                                        <span class="material-symbols-outlined text-[16px]">download</span>
                                        Download
                                    </a>
                                @else
                                    <span class="inline-flex items-center gap-xs text-label-sm text-secondary/50">
                                        <span class="material-symbols-outlined text-[14px]">close</span>
                                        No video
                                    </span>
                                @endif
                            </td>
                            <td class="px-lg py-md text-right">
                                <a href="{{ route('student.history.show', $history) }}"
                                   class="inline-flex items-center gap-xs text-label-sm text-secondary hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">visibility</span>
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-lg py-2xl text-center">
                                <div class="flex flex-col items-center gap-md text-secondary">
                                    <span class="material-symbols-outlined text-[48px] opacity-30">history_edu</span>
                                    @if(request()->anyFilled(['teacher_id', 'date_from', 'date_to', 'time_from', 'time_to', 'duration']))
                                        <p class="text-body-md">No records match your filters.</p>
                                        <a href="{{ route('student.history.index') }}"
                                           class="inline-flex items-center gap-xs text-label-sm text-primary hover:underline">
                                            <span class="material-symbols-outlined text-[16px]">close</span>
                                            Clear filters
                                        </a>
                                    @else
                                        <p class="text-body-md">No learning history found.</p>
                                    @endif
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
