<x-app-layout>
    <x-slot name="title">Session Detail | BEA English</x-slot>
    <x-slot name="header">
        <div class="flex flex-wrap items-center gap-sm justify-between">
            <div class="flex items-center gap-md">
                <a href="{{ route('manager.histories.index') }}"
                   class="text-secondary hover:text-on-surface transition-colors">
                    <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                </a>
                <div>
                    <h1 class="font-bold text-headline-sm text-on-surface">Teaching Record</h1>
                    <p class="text-label-sm text-secondary mt-xs">{{ $history->taught_date->format('d/m/Y') }} &middot; {{ $history->time_from }} – {{ $history->time_to }}</p>
                </div>
            </div>
            <a href="{{ route('manager.histories.edit', $history) }}"
               class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                <span class="material-symbols-outlined text-[18px]">edit</span>
                Edit
            </a>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
            {{-- Header info --}}
            <div class="px-lg py-md border-b border-outline-variant bg-surface-container-low">
                <div class="flex items-center gap-md">
                    <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center">
                        <span class="material-symbols-outlined text-[20px] text-on-surface-variant">history_edu</span>
                    </div>
                    <div>
                        <p class="font-semibold text-body-sm text-on-surface">{{ 'Lesson: ' . str_pad($history->lesson_number, 2, '0', STR_PAD_LEFT) }}</p>
                        <p class="text-label-sm text-secondary">{{ $history->taught_date->format('d/m/Y') }} &middot; {{ $history->time_from }} – {{ $history->time_to }}</p>
                    </div>
                </div>
            </div>

            <dl class="divide-y divide-outline-variant">
                <div class="px-lg py-md grid grid-cols-1 sm:grid-cols-3 gap-md">
                    <dt class="text-label-sm text-secondary font-medium">Teacher</dt>
                    <dd class="col-span-2 text-body-sm text-on-surface font-medium">
                        {{ $history->teacher->user->name }}
                        <span class="text-secondary text-label-sm ml-xs">({{ $history->teacher->teacher_id }})</span>
                    </dd>
                </div>
                <div class="px-lg py-md grid grid-cols-1 sm:grid-cols-3 gap-md">
                    <dt class="text-label-sm text-secondary font-medium">Student</dt>
                    <dd class="col-span-2 text-body-sm text-on-surface font-medium">
                        {{ $history->student->user->name }}
                        <span class="text-secondary text-label-sm ml-xs">({{ $history->student->student_id }})</span>
                    </dd>
                </div>
                <div class="px-lg py-md grid grid-cols-1 sm:grid-cols-3 gap-md">
                    <dt class="text-label-sm text-secondary font-medium">Lesson</dt>
                    <dd class="col-span-2 text-body-sm text-on-surface">{{ 'Lesson: ' . str_pad($history->lesson_number, 2, '0', STR_PAD_LEFT) }}</dd>
                </div>
                <div class="px-lg py-md grid grid-cols-1 sm:grid-cols-3 gap-md">
                    <dt class="text-label-sm text-secondary font-medium">Date &amp; Time</dt>
                    <dd class="col-span-2 text-body-sm text-on-surface">{{ $history->taught_date->format('d/m/Y') }} &middot; {{ $history->time_from }} – {{ $history->time_to }}</dd>
                </div>
                <div class="px-lg py-md grid grid-cols-1 sm:grid-cols-3 gap-md">
                    <dt class="text-label-sm text-secondary font-medium">Duration</dt>
                    <dd class="col-span-2">
                        <span class="text-label-sm bg-surface-container px-sm py-xs rounded-full text-secondary">{{ $history->duration }} min</span>
                    </dd>
                </div>
                <div class="px-lg py-md grid grid-cols-1 sm:grid-cols-3 gap-md">
                    <dt class="text-label-sm text-secondary font-medium">Note/Homework</dt>
                    <dd class="col-span-2 text-body-sm text-on-surface whitespace-pre-wrap">{{ $history->note ?? '—' }}</dd>
                </div>
                <div class="px-lg py-md grid grid-cols-1 sm:grid-cols-3 gap-md">
                    <dt class="text-label-sm text-secondary font-medium">Video Log</dt>
                    <dd class="col-span-2">
                        @if($history->video_path)
                            <a href="{{ route('manager.histories.video', $history) }}"
                               class="inline-flex items-center gap-xs text-label-sm text-primary font-medium hover:underline">
                                <span class="material-symbols-outlined text-[16px]">download</span>
                                Download video
                            </a>
                        @else
                            <span class="text-label-sm text-secondary">(none)</span>
                        @endif
                    </dd>
                </div>
            </dl>

            <div class="px-lg py-md border-t border-outline-variant flex items-center justify-between">
                <a href="{{ route('manager.histories.index') }}"
                   class="inline-flex items-center gap-xs text-label-md text-secondary hover:text-on-surface transition-colors">
                    <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                    Back to histories
                </a>
                <form id="del-history-show" method="POST" action="{{ route('manager.histories.destroy', $history) }}">
                    @csrf @method('DELETE')
                </form>
                <button type="button"
                        @click="$store.confirmModal.show('Delete this teaching history record? Any uploaded video will also be removed.', 'del-history-show')"
                        class="inline-flex items-center gap-xs text-label-sm text-error hover:text-on-surface px-sm py-xs rounded-lg hover:bg-error-container/30 transition-colors">
                    <span class="material-symbols-outlined text-[16px]">delete</span>
                    Delete Record
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
