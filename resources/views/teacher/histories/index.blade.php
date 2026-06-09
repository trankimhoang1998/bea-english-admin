<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center gap-sm justify-between">
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">Teaching History</h1>
                <p class="text-label-sm text-secondary mt-xs">Your recorded lesson sessions</p>
            </div>
            <a href="{{ route('teacher.histories.create') }}"
               class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                <span class="material-symbols-outlined text-[18px]">add</span>
                Log Session
            </a>
        </div>
    </x-slot>

    {{-- Filters --}}
    <form method="GET" action="{{ route('teacher.histories.index') }}"
          class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-md mb-md">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-md items-end">
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
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Duration</label>
                <div class="flex gap-sm">
                    <select name="duration"
                            class="flex-1 border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
                        <option value="">Any</option>
                        <option value="25" {{ request('duration') == '25' ? 'selected' : '' }}>25 min</option>
                        <option value="50" {{ request('duration') == '50' ? 'selected' : '' }}>50 min</option>
                    </select>
                    <button type="submit"
                            class="inline-flex items-center gap-xs bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95 shrink-0">
                        <span class="material-symbols-outlined text-[16px]">filter_alt</span>
                        Filter
                    </button>
                    @if(request()->anyFilled(['student_id', 'date_from', 'date_to', 'duration']))
                        <a href="{{ route('teacher.histories.index') }}"
                           class="inline-flex items-center px-sm py-sm text-secondary hover:text-on-surface transition-colors shrink-0"
                           title="Clear filters">
                            <span class="material-symbols-outlined text-[18px]">close</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </form>

    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-outline-variant bg-surface-container-low">
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Student</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Lesson</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Date</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Duration</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Video</th>
                        <th class="px-lg py-md text-right text-label-sm font-semibold text-secondary uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @forelse($histories as $history)
                        <tr class="hover:bg-surface-container-low transition-colors">
                            <td class="px-lg py-md">
                                <p class="font-semibold text-body-sm text-on-surface">{{ $history->student->user->name }}</p>
                                <p class="text-label-sm text-secondary">{{ $history->student->student_id }}</p>
                            </td>
                            <td class="px-lg py-md text-body-sm text-on-surface">{{ 'Lesson: ' . str_pad($history->lesson_number, 2, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-lg py-md text-body-sm text-secondary whitespace-nowrap">
                                {{ $history->taught_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-lg py-md">
                                <span class="text-label-sm bg-surface-container px-sm py-xs rounded-full text-secondary">{{ $history->duration }} min</span>
                            </td>
                            <td class="px-lg py-md">
                                @if($history->video_path)
                                    <span class="inline-flex items-center gap-xs text-label-sm text-primary">
                                        <span class="material-symbols-outlined text-[16px]">videocam</span>
                                        Yes
                                    </span>
                                @else
                                    <span class="text-label-sm text-secondary">—</span>
                                @endif
                            </td>
                            <td class="px-lg py-md">
                                <div class="flex items-center justify-end gap-sm">
                                    <a href="{{ route('teacher.histories.show', $history) }}"
                                       class="inline-flex items-center gap-xs text-label-sm text-secondary hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">visibility</span>
                                        View
                                    </a>
                                    <a href="{{ route('teacher.histories.edit', $history) }}"
                                       class="inline-flex items-center gap-xs text-label-sm text-primary hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">edit</span>
                                        Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-lg py-2xl text-center">
                                <div class="flex flex-col items-center gap-md text-secondary">
                                    <span class="material-symbols-outlined text-[48px] opacity-30">history_edu</span>
                                    <p class="text-body-md">No teaching history yet.</p>
                                    <a href="{{ route('teacher.histories.create') }}"
                                       class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all">
                                        <span class="material-symbols-outlined text-[16px]">add</span>
                                        Log first session
                                    </a>
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
