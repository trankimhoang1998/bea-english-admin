<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Teaching Record</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('teacher.histories.update', $history) }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf @method('PUT')

                    <div>
                        <x-input-label for="student_id" value="Student" />
                        <select id="student_id" name="student_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <option value="">-- Select Student --</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}"
                                    {{ old('student_id', $history->student_id) == $student->id ? 'selected' : '' }}>
                                    {{ $student->user->name }} ({{ $student->student_id }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="lesson" value="Lesson" />
                        <x-text-input id="lesson" name="lesson" type="text" class="mt-1 block w-full"
                                      :value="old('lesson', $history->lesson)" required />
                        <x-input-error :messages="$errors->get('lesson')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="taught_at" value="Date &amp; Time" />
                        <x-text-input id="taught_at" name="taught_at" type="datetime-local" class="mt-1 block w-full"
                                      :value="old('taught_at', $history->taught_at->format('Y-m-d\TH:i'))" required />
                        <x-input-error :messages="$errors->get('taught_at')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="duration" value="Duration" />
                        <select id="duration" name="duration"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <option value="25" {{ old('duration', $history->duration) == 25 ? 'selected' : '' }}>25 min</option>
                            <option value="50" {{ old('duration', $history->duration) == 50 ? 'selected' : '' }}>50 min</option>
                        </select>
                        <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="note" value="Note" />
                        <textarea id="note" name="note" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('note', $history->note) }}</textarea>
                        <x-input-error :messages="$errors->get('note')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="video" value="Video Log" />
                        @if($history->video_path)
                            <p class="mt-1 text-sm text-green-600 font-medium">Video already uploaded. Upload a new file to replace it.</p>
                        @endif
                        <input id="video" name="video" type="file" accept="video/*"
                               class="mt-1 block w-full text-sm text-gray-600
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-md file:border-0
                                      file:text-sm file:font-medium
                                      file:bg-indigo-50 file:text-indigo-700
                                      hover:file:bg-indigo-100" />
                        <p class="mt-1 text-xs text-gray-400">Accepted: MP4, WebM, MOV. Maximum 500 MB.</p>
                        <x-input-error :messages="$errors->get('video')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <x-primary-button>Update</x-primary-button>
                        <a href="{{ route('teacher.histories.index') }}" class="text-sm text-gray-600 hover:underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
