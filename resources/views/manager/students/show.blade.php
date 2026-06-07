<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Student: {{ $student->user->name }}
            </h2>
            <a href="{{ route('manager.students.edit', $student) }}"
               class="px-4 py-2 bg-yellow-500 text-white rounded-md text-sm hover:bg-yellow-600">Edit</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Info card --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <dl class="grid grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Name</dt>
                        <dd class="text-gray-900 font-semibold">{{ $student->user->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Student ID</dt>
                        <dd class="text-gray-900 font-semibold">{{ $student->student_id }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Age</dt>
                        <dd class="text-gray-900">{{ $student->age }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Course</dt>
                        <dd class="text-gray-900">{{ $student->course }}</dd>
                    </div>
                </dl>
            </div>

            {{-- Learning Schedule --}}
            <h3 class="font-semibold text-lg text-gray-700 px-1">Learning Schedule</h3>
            @php
                $days = ['mon','tue','wed','thu','fri','sat','sun'];
                $byDaySlot = [];
                foreach ($student->schedules as $s) {
                    $byDaySlot[$s->start_time][$s->day_of_week] = $s;
                }
                ksort($byDaySlot);
            @endphp
            <div class="bg-white shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Time</th>
                            @foreach($days as $d)<th class="px-4 py-3 text-center font-medium text-gray-500 uppercase">{{ $d }}</th>@endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($byDaySlot as $startTime => $dayMap)
                            <tr>
                                <td class="px-4 py-3 font-mono text-gray-600">{{ \Carbon\Carbon::parse($startTime)->format('H:i') }}</td>
                                @foreach($days as $d)
                                    <td class="px-4 py-3 text-center">
                                        @if(isset($dayMap[$d]))
                                            <span class="text-indigo-700 font-medium">{{ $dayMap[$d]->teacher->user->name }}</span>
                                            <span class="text-gray-400 text-xs block">({{ $dayMap[$d]->teacher->teacher_id }})</span>
                                        @else
                                            <span class="text-gray-200">—</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Learning Histories --}}
            <h3 class="font-semibold text-lg text-gray-700 px-1">Learning History</h3>
            <div class="bg-white shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Lesson</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Time</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Duration</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Note</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($student->teachingHistories->sortByDesc('taught_at') as $h)
                            <tr>
                                <td class="px-4 py-3">{{ $h->lesson }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $h->taught_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-3">{{ $h->duration }} min</td>
                                <td class="px-4 py-3 text-gray-500">{{ $h->note ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-4 py-4 text-center text-gray-400">No history yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <a href="{{ route('manager.students.index') }}" class="inline-block text-sm text-indigo-600 hover:underline">← Back to students</a>
        </div>
    </div>
</x-app-layout>
