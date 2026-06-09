<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="font-bold text-headline-sm text-on-surface">Teaching Histories</h1>
            <p class="text-label-sm text-secondary mt-xs">View and manage all lesson records</p>
        </div>
    </x-slot>

    {{-- Filters --}}
    <form method="GET" action="{{ route('manager.histories.index') }}"
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
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Date From</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}"
                       class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
            </div>
            <div class="space-y-xs">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Date To</label>
                <div class="flex gap-sm">
                    <input type="date" name="date_to" value="{{ request('date_to') }}"
                           class="flex-1 border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
                    <button type="submit"
                            class="inline-flex items-center gap-xs bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95 shrink-0">
                        <span class="material-symbols-outlined text-[16px]">filter_alt</span>
                        Filter
                    </button>
                    @if(request()->anyFilled(['teacher_id', 'student_id', 'date_from', 'date_to']))
                        <a href="{{ route('manager.histories.index') }}"
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
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Date</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Teacher</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Student</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Lesson</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Duration</th>
                        <th class="px-lg py-md text-right text-label-sm font-semibold text-secondary uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @forelse($histories as $history)
                        <tr class="hover:bg-surface-container-low transition-colors">
                            <td class="px-lg py-md text-body-sm text-secondary whitespace-nowrap">
                                {{ $history->taught_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-lg py-md">
                                <p class="font-semibold text-body-sm text-on-surface">{{ $history->teacher->user->name }}</p>
                                <p class="text-label-sm text-secondary">{{ $history->teacher->teacher_id }}</p>
                            </td>
                            <td class="px-lg py-md">
                                <p class="font-medium text-body-sm text-on-surface">{{ $history->student->user->name }}</p>
                                <p class="text-label-sm text-secondary">{{ $history->student->student_id }}</p>
                            </td>
                            <td class="px-lg py-md text-body-sm text-on-surface">
                                {{ 'Lesson: ' . str_pad($history->lesson_number, 2, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-lg py-md">
                                <span class="text-label-sm bg-surface-container px-sm py-xs rounded-full text-secondary">{{ $history->duration }} min</span>
                            </td>
                            <td class="px-lg py-md">
                                <div class="flex items-center justify-end gap-sm">
                                    <a href="{{ route('manager.histories.show', $history) }}"
                                       class="inline-flex items-center gap-xs text-label-sm text-secondary hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">visibility</span>
                                        View
                                    </a>
                                    <form id="del-history-{{ $history->id }}" method="POST" action="{{ route('manager.histories.destroy', $history) }}">
                                        @csrf @method('DELETE')
                                    </form>
                                    <button type="button"
                                            @click="$store.confirmModal.show('Delete this teaching history record? Any uploaded video will also be removed.', 'del-history-{{ $history->id }}')"
                                            class="inline-flex items-center gap-xs text-label-sm text-error hover:text-on-surface px-sm py-xs rounded-lg hover:bg-error-container/30 transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">delete</span>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-lg py-2xl text-center">
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
