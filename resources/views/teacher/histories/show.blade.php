<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Teaching Record</h2>
            <div class="flex gap-2">
                <a href="{{ route('teacher.histories.edit', $history) }}"
                   class="px-4 py-2 bg-yellow-500 text-white rounded-md text-sm hover:bg-yellow-600">Edit</a>
                <a href="{{ route('teacher.histories.index') }}"
                   class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm hover:bg-gray-200">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <dl class="divide-y divide-gray-100">
                    <div class="px-6 py-4 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-500">Student</dt>
                        <dd class="text-sm text-gray-900 col-span-2">
                            {{ $history->student->user->name }}
                            <span class="text-gray-400 text-xs">({{ $history->student->student_id }})</span>
                        </dd>
                    </div>
                    <div class="px-6 py-4 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-500">Lesson</dt>
                        <dd class="text-sm text-gray-900 col-span-2">{{ $history->lesson }}</dd>
                    </div>
                    <div class="px-6 py-4 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-500">Date & Time</dt>
                        <dd class="text-sm text-gray-900 col-span-2">
                            {{ $history->taught_at->format('d/m/Y H:i') }}
                        </dd>
                    </div>
                    <div class="px-6 py-4 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-500">Duration</dt>
                        <dd class="text-sm text-gray-900 col-span-2">{{ $history->duration }} min</dd>
                    </div>
                    <div class="px-6 py-4 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-500">Note</dt>
                        <dd class="text-sm text-gray-900 col-span-2">
                            {{ $history->note ?? '(none)' }}
                        </dd>
                    </div>
                    <div class="px-6 py-4 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-500">Video Log</dt>
                        <dd class="text-sm col-span-2">
                            @if($history->video_path)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Video uploaded
                                </span>
                            @else
                                <span class="text-gray-400">(no video)</span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
