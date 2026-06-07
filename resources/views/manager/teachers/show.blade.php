<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Teacher: {{ $teacher->user->name }}
            </h2>
            <a href="{{ route('manager.teachers.edit', $teacher) }}"
               class="px-4 py-2 bg-yellow-500 text-white rounded-md text-sm hover:bg-yellow-600">Edit</a>
        </div>
    </x-slot>

    <div class="py-8 space-y-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Info card --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <dl class="grid grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Name</dt>
                        <dd class="text-gray-900 font-semibold">{{ $teacher->user->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Teacher ID</dt>
                        <dd class="text-gray-900 font-semibold">{{ $teacher->teacher_id }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Experience</dt>
                        <dd class="text-gray-900">{{ $teacher->experience }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="text-gray-500 text-sm">{{ $teacher->user->email }}</dd>
                    </div>
                </dl>
            </div>

            {{-- Teaching Schedule --}}
            <h3 class="font-semibold text-lg text-gray-700 px-1 mb-2">Teaching Schedule</h3>
            @php
                $days = ['mon','tue','wed','thu','fri','sat','sun'];
                $slots = $teacher->schedules->groupBy('start_time');
                $byDaySlot = [];
                foreach ($teacher->schedules as $s) {
                    $byDaySlot[$s->start_time][$s->day_of_week] = $s;
                }
                ksort($byDaySlot);
            @endphp
            <div class="bg-white shadow-sm sm:rounded-lg overflow-x-auto mb-6">
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
                                <td class="px-4 py-3 font-mono text-gray-600">
                                    {{ \Carbon\Carbon::parse($startTime)->format('H:i') }}
                                </td>
                                @foreach($days as $d)
                                    <td class="px-4 py-3 text-center">
                                        @if(isset($dayMap[$d]))
                                            <span class="text-indigo-700 font-medium">{{ $dayMap[$d]->student->user->name }}</span>
                                            <span class="text-gray-400 text-xs block">({{ $dayMap[$d]->student->student_id }})</span>
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

            {{-- Teaching Histories --}}
            <h3 class="font-semibold text-lg text-gray-700 px-1 mb-2">Teaching Histories</h3>
            <div class="bg-white shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Student</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Lesson</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Time</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Duration</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Note</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($teacher->teachingHistories->sortByDesc('taught_at') as $h)
                            <tr>
                                <td class="px-4 py-3">{{ $h->student->user->name }}</td>
                                <td class="px-4 py-3">{{ $h->lesson }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $h->taught_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-3">{{ $h->duration }} min</td>
                                <td class="px-4 py-3 text-gray-500">{{ $h->note ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-4 py-4 text-center text-gray-400">No history yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <a href="{{ route('manager.teachers.index') }}" class="text-sm text-indigo-600 hover:underline">← Back to teachers</a>
            </div>
        </div>
    </div>
</x-app-layout>
