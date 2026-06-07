<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Teaching History</h2>
            <a href="{{ route('teacher.histories.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700">
                + Add Record
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lesson</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Duration</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Video</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($histories as $history)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                    {{ $history->student->user->name }}
                                    <span class="text-xs text-gray-400">({{ $history->student->student_id }})</span>
                                </td>
                                <td class="px-6 py-4 text-gray-800">{{ $history->lesson }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600 text-sm">
                                    {{ $history->taught_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $history->duration }} min</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($history->video_path)
                                        <span class="text-green-600 font-medium">Yes</span>
                                    @else
                                        <span class="text-gray-400">No</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-x-3">
                                    <a href="{{ route('teacher.histories.show', $history) }}"
                                       class="text-indigo-600 hover:underline">View</a>
                                    <a href="{{ route('teacher.histories.edit', $history) }}"
                                       class="text-yellow-600 hover:underline">Edit</a>
                                    <form method="POST" action="{{ route('teacher.histories.destroy', $history) }}" class="inline"
                                          onsubmit="return confirm('Delete this record?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-400">No teaching history yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-6 py-3">{{ $histories->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
