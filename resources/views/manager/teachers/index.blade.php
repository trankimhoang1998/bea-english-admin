<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Teachers</h2>
            <a href="{{ route('manager.teachers.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700">
                + Add Teacher
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-4 px-4 py-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Teacher ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Experience</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($teachers as $teacher)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                    {{ $teacher->user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $teacher->teacher_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $teacher->experience }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500 text-sm">{{ $teacher->user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                    <a href="{{ route('manager.teachers.show', $teacher) }}" class="text-indigo-600 hover:underline me-3">View</a>
                                    <a href="{{ route('manager.teachers.edit', $teacher) }}" class="text-yellow-600 hover:underline me-3">Edit</a>
                                    <form method="POST" action="{{ route('manager.teachers.destroy', $teacher) }}" class="inline"
                                          onsubmit="return confirm('Delete this teacher?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-6 py-4 text-center text-gray-400">No teachers found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-6 py-3">{{ $teachers->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
