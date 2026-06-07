<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Dashboard</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Student Info --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Student Information</h3>
                <dl class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase">Name</dt>
                        <dd class="mt-1 text-gray-900 font-medium">{{ $student->user->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase">Student ID</dt>
                        <dd class="mt-1 text-gray-900 font-medium">{{ $student->student_id }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase">Course</dt>
                        <dd class="mt-1 text-gray-900 font-medium">{{ $student->course }}</dd>
                    </div>
                </dl>
            </div>

            {{-- Weekly Schedule Timetable --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Weekly Learning Schedule</h3>

                @php
                    $days = ['mon' => 'Mon', 'tue' => 'Tue', 'wed' => 'Wed', 'thu' => 'Thu', 'fri' => 'Fri', 'sat' => 'Sat', 'sun' => 'Sun'];
                    $slots = $student->schedules->map(fn($s) => $s->start_time . '-' . $s->end_time)->unique()->sort()->values();
                    $lookup = [];
                    foreach ($student->schedules as $s) {
                        $key = $s->start_time . '-' . $s->end_time . '-' . $s->day_of_week;
                        $lookup[$key] = $s;
                    }
                @endphp

                @if($slots->isEmpty())
                    <p class="text-gray-400 text-sm">No schedule assigned yet.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 border border-gray-200 text-left text-xs font-medium text-gray-500 uppercase w-32">Time</th>
                                    @foreach($days as $key => $label)
                                        <th class="px-4 py-2 border border-gray-200 text-center text-xs font-medium text-gray-500 uppercase">{{ $label }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach($slots as $slot)
                                    @php
                                        [$startRaw, $endRaw] = explode('-', $slot, 2);
                                        $startDisplay = substr($startRaw, 0, 5);
                                        $endDisplay = substr($endRaw, 0, 5);
                                    @endphp
                                    <tr>
                                        <td class="px-4 py-3 border border-gray-200 whitespace-nowrap text-gray-600 font-medium">
                                            {{ $startDisplay }}–{{ $endDisplay }}
                                        </td>
                                        @foreach(array_keys($days) as $dayKey)
                                            @php
                                                $cellKey = $slot . '-' . $dayKey;
                                                $schedule = $lookup[$cellKey] ?? null;
                                            @endphp
                                            <td class="px-4 py-3 border border-gray-200 text-center">
                                                @if($schedule)
                                                    <span class="inline-block bg-indigo-50 text-indigo-800 rounded px-2 py-1 text-xs">
                                                        {{ $schedule->teacher->user->name }}<br>
                                                        <span class="text-indigo-500">({{ $schedule->teacher->teacher_id }})</span>
                                                    </span>
                                                @else
                                                    <span class="text-gray-300">—</span>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            {{-- Quick Links --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('student.history.index') }}"
                   class="block bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-indigo-50 transition">
                    <h4 class="text-base font-semibold text-indigo-700">My Learning History</h4>
                    <p class="text-sm text-gray-500 mt-1">View all your past lessons and session recordings.</p>
                </a>
                <a href="{{ route('student.materials.index') }}"
                   class="block bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-indigo-50 transition">
                    <h4 class="text-base font-semibold text-indigo-700">Learning Materials</h4>
                    <p class="text-sm text-gray-500 mt-1">Download materials uploaded by your teachers.</p>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
