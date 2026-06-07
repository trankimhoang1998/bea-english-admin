<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="font-bold text-headline-sm text-on-surface">Teaching Histories</h1>
            <p class="text-label-sm text-secondary mt-xs">View and manage all lesson records</p>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="flex items-center gap-sm p-md bg-secondary-container/50 border border-secondary-container rounded-xl mb-lg">
            <span class="material-symbols-outlined text-primary text-[20px]">check_circle</span>
            <p class="text-body-sm text-on-surface">{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-outline-variant bg-surface-container-low">
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Teacher</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Student</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Lesson</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Date</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Duration</th>
                        <th class="px-lg py-md text-right text-label-sm font-semibold text-secondary uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @forelse($histories as $history)
                        <tr class="hover:bg-surface-container-low transition-colors">
                            <td class="px-lg py-md">
                                <p class="font-semibold text-body-sm text-on-surface">{{ $history->teacher->user->name }}</p>
                                <p class="text-label-sm text-secondary">{{ $history->teacher->teacher_id }}</p>
                            </td>
                            <td class="px-lg py-md">
                                <p class="font-medium text-body-sm text-on-surface">{{ $history->student->user->name }}</p>
                                <p class="text-label-sm text-secondary">{{ $history->student->student_id }}</p>
                            </td>
                            <td class="px-lg py-md text-body-sm text-on-surface max-w-[200px] truncate">{{ $history->lesson }}</td>
                            <td class="px-lg py-md text-body-sm text-secondary whitespace-nowrap">
                                {{ $history->taught_at->format('d/m/Y H:i') }}
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
                                    <form method="POST" action="{{ route('manager.histories.destroy', $history) }}" class="inline"
                                          onsubmit="return confirm('Delete this history record?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center gap-xs text-label-sm text-error hover:text-on-surface px-sm py-xs rounded-lg hover:bg-error-container/30 transition-colors">
                                            <span class="material-symbols-outlined text-[16px]">delete</span>
                                            Delete
                                        </button>
                                    </form>
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
