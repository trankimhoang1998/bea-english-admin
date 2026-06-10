<x-app-layout>
    <x-slot name="title">Session Detail | BEA English</x-slot>
    <x-slot name="header">
        <div class="flex items-center gap-md">
            <a href="{{ route('student.history.index') }}"
               class="text-secondary hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">Lesson Detail</h1>
                <p class="text-label-sm text-secondary mt-xs">{{ \Carbon\Carbon::parse($history->taught_at)->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
            <div class="px-lg py-md border-b border-outline-variant bg-surface-container-low">
                <div class="flex items-center gap-md">
                    <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center">
                        <span class="material-symbols-outlined text-[20px] text-on-surface-variant">history_edu</span>
                    </div>
                    <div>
                        <p class="font-semibold text-body-sm text-on-surface">{{ 'Lesson: ' . str_pad($history->lesson_number, 2, '0', STR_PAD_LEFT) }}</p>
                        <p class="text-label-sm text-secondary">{{ $history->taught_at->format('d/m/Y H:i') }}</p>
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
                    <dt class="text-label-sm text-secondary font-medium">Lesson</dt>
                    <dd class="col-span-2 text-body-sm text-on-surface">{{ 'Lesson: ' . str_pad($history->lesson_number, 2, '0', STR_PAD_LEFT) }}</dd>
                </div>
                <div class="px-lg py-md grid grid-cols-1 sm:grid-cols-3 gap-md">
                    <dt class="text-label-sm text-secondary font-medium">Date</dt>
                    <dd class="col-span-2 text-body-sm text-on-surface">
                        {{ \Carbon\Carbon::parse($history->taught_at)->format('d/m/Y H:i') }}
                    </dd>
                </div>
                <div class="px-lg py-md grid grid-cols-1 sm:grid-cols-3 gap-md">
                    <dt class="text-label-sm text-secondary font-medium">Duration</dt>
                    <dd class="col-span-2">
                        <span class="text-label-sm bg-surface-container px-sm py-xs rounded-full text-secondary">{{ $history->duration }} min</span>
                    </dd>
                </div>
                <div class="px-lg py-md grid grid-cols-1 sm:grid-cols-3 gap-md">
                    <dt class="text-label-sm text-secondary font-medium">Note</dt>
                    <dd class="col-span-2 text-body-sm text-on-surface">{{ $history->note ?? '—' }}</dd>
                </div>
                <div class="px-lg py-md grid grid-cols-1 sm:grid-cols-3 gap-md">
                    <dt class="text-label-sm text-secondary font-medium">Video Recording</dt>
                    <dd class="col-span-2">
                        @if($history->video_path)
                            <a href="{{ route('student.history.video', $history) }}"
                               class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                                <span class="material-symbols-outlined text-[18px]">download</span>
                                Download Video
                            </a>
                        @else
                            <span class="text-label-sm text-secondary">(no recording available)</span>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</x-app-layout>
