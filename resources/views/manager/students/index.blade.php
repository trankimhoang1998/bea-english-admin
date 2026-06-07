<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Students</h2>
            <a href="{{ route('manager.students.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700">
                + Add Student
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Age</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Course</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($students as $student)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $student->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $student->student_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $student->age }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $student->course }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500 text-sm">{{ $student->user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                    <a href="{{ route('manager.students.show', $student) }}" class="text-indigo-600 hover:underline me-3">View</a>
                                    <a href="{{ route('manager.students.edit', $student) }}" class="text-yellow-600 hover:underline me-3">Edit</a>
                                    <form method="POST" action="{{ route('manager.students.destroy', $student) }}" class="inline"
                                          onsubmit="return confirm('Delete this student?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-6 py-4 text-center text-gray-400">No students found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-6 py-3">{{ $students->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
