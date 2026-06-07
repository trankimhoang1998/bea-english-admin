<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Lesson Detail</h2>
            <a href="{{ route('student.history.index') }}"
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md text-sm hover:bg-gray-300">
                &larr; Back
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase">Teacher</dt>
                        <dd class="mt-1 text-gray-900 font-medium">
                            {{ $history->teacher->user->name }}
                            <span class="text-gray-400 text-sm">({{ $history->teacher->teacher_id }})</span>
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase">Lesson</dt>
                        <dd class="mt-1 text-gray-900 font-medium">{{ $history->lesson }}</dd>
                    </div>

                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase">Date</dt>
                        <dd class="mt-1 text-gray-900 font-medium">
                            {{ \Carbon\Carbon::parse($history->taught_at)->format('d/m/Y H:i') }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase">Duration</dt>
                        <dd class="mt-1 text-gray-900 font-medium">{{ $history->duration }} min</dd>
                    </div>

                    <div class="sm:col-span-2">
                        <dt class="text-xs font-medium text-gray-500 uppercase">Note</dt>
                        <dd class="mt-1 text-gray-900">
                            {{ $history->note ?? '(none)' }}
                        </dd>
                    </div>

                    <div class="sm:col-span-2">
                        <dt class="text-xs font-medium text-gray-500 uppercase">Video Recording</dt>
                        <dd class="mt-2">
                            @if($history->video_path)
                                <a href="{{ route('student.history.video', $history) }}"
                                   class="inline-block px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">
                                    Download Video
                                </a>
                            @else
                                <span class="text-gray-400 text-sm">(no recording available)</span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
