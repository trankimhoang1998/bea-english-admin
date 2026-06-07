<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manager Dashboard</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <a href="{{ route('manager.teachers.index') }}"
                   class="block bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-indigo-50 transition">
                    <h4 class="text-base font-semibold text-indigo-700">Teachers</h4>
                    <p class="text-sm text-gray-500 mt-1">Manage teacher accounts and profiles.</p>
                </a>

                <a href="{{ route('manager.students.index') }}"
                   class="block bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-indigo-50 transition">
                    <h4 class="text-base font-semibold text-indigo-700">Students</h4>
                    <p class="text-sm text-gray-500 mt-1">Manage student accounts and profiles.</p>
                </a>

                <a href="{{ route('manager.schedules.index') }}"
                   class="block bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-indigo-50 transition">
                    <h4 class="text-base font-semibold text-indigo-700">Schedules</h4>
                    <p class="text-sm text-gray-500 mt-1">Create and manage teaching schedules.</p>
                </a>

                <a href="{{ route('manager.materials.index') }}"
                   class="block bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-indigo-50 transition">
                    <h4 class="text-base font-semibold text-indigo-700">Learning Materials</h4>
                    <p class="text-sm text-gray-500 mt-1">Upload and manage study materials.</p>
                </a>

                <a href="{{ route('manager.histories.index') }}"
                   class="block bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-indigo-50 transition sm:col-span-2 lg:col-span-4">
                    <h4 class="text-base font-semibold text-indigo-700">Teaching Histories</h4>
                    <p class="text-sm text-gray-500 mt-1">View all session records across teachers and students.</p>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
