<x-app-layout>
    <x-slot name="title">Edit Record | BEA English</x-slot>
    <x-slot name="header">
        <div class="flex items-center gap-md">
            <a href="{{ route('teacher.histories.index') }}"
               class="text-secondary hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">Edit Teaching Record</h1>
                <p class="text-label-sm text-secondary mt-xs">{{ 'Lesson: ' . str_pad($history->lesson_number, 2, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-lg">
            <form method="POST" action="{{ route('teacher.histories.update', $history) }}" enctype="multipart/form-data" class="space-y-lg">
                @csrf @method('PUT')

                {{-- Student --}}
                <div class="space-y-xs">
                    <label for="student_id" class="block text-label-md font-semibold text-on-surface">Student</label>
                    <select id="student_id" name="student_id" required
                            class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                        <option value="">— Select Student —</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}"
                                {{ old('student_id', $history->student_id) == $student->id ? 'selected' : '' }}>
                                {{ $student->user->name }} ({{ $student->student_id }})
                            </option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Lesson number (read-only) --}}
                <div class="space-y-xs">
                    <label class="block text-label-md font-semibold text-on-surface">Lesson Number</label>
                    <div class="px-md py-sm bg-surface-container border border-outline-variant rounded-lg text-body-sm text-secondary">
                        {{ 'Lesson: ' . str_pad($history->lesson_number, 2, '0', STR_PAD_LEFT) }}
                    </div>
                </div>

                {{-- Date --}}
                <div class="space-y-xs">
                    <label for="taught_date" class="block text-label-md font-semibold text-on-surface">Date</label>
                    <input id="taught_date" name="taught_date" type="date"
                           value="{{ old('taught_date', $history->taught_date->format('Y-m-d')) }}" required
                           class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    @error('taught_date')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Time From / Time To --}}
                <div class="grid grid-cols-2 gap-md">
                    <div class="space-y-xs">
                        <label for="time_from" class="block text-label-md font-semibold text-on-surface">Time From</label>
                        <input id="time_from" name="time_from" type="time"
                               value="{{ old('time_from', $history->time_from) }}" required
                               class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                        @error('time_from')
                            <p class="text-label-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-xs">
                        <label for="time_to" class="block text-label-md font-semibold text-on-surface">Time To</label>
                        <input id="time_to" name="time_to" type="time"
                               value="{{ old('time_to', $history->time_to) }}" required
                               class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                        @error('time_to')
                            <p class="text-label-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Duration --}}
                <div class="space-y-xs">
                    <label for="duration" class="block text-label-md font-semibold text-on-surface">Duration</label>
                    <select id="duration" name="duration" required
                            class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                        <option value="25" {{ old('duration', $history->duration) == 25 ? 'selected' : '' }}>25 min</option>
                        <option value="50" {{ old('duration', $history->duration) == 50 ? 'selected' : '' }}>50 min</option>
                    </select>
                    @error('duration')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Note/Homework --}}
                <div class="space-y-xs">
                    <label for="note" class="block text-label-md font-semibold text-on-surface">
                        Note/Homework <span class="text-secondary font-normal">(optional)</span>
                    </label>
                    <textarea id="note" name="note" rows="5"
                              class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest resize-y">{{ old('note', $history->note) }}</textarea>
                    @error('note')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Video --}}
                <div class="space-y-xs">
                    <label for="video" class="block text-label-md font-semibold text-on-surface">Video Log</label>
                    <input type="hidden" name="video_type" value="file">
                    @if($history->video_path)
                        <div class="flex items-center gap-sm p-sm bg-secondary-container/30 border border-secondary-container rounded-lg mb-sm">
                            <span class="material-symbols-outlined text-primary text-[18px]">videocam</span>
                            <div class="flex-1 text-label-sm text-on-surface">Video already uploaded. Upload a new file to replace it.</div>
                            <a href="{{ route('teacher.histories.video', $history) }}"
                               class="inline-flex items-center gap-xs text-label-sm text-primary font-medium hover:underline shrink-0">
                                <span class="material-symbols-outlined text-[15px]">download</span>
                                Download
                            </a>
                        </div>
                    @elseif($history->video_link)
                        <div class="flex items-center gap-sm p-sm bg-surface-container border border-outline-variant rounded-lg mb-sm">
                            <span class="material-symbols-outlined text-sky-600 text-[18px]">link</span>
                            <div class="flex-1 min-w-0">
                                <p class="text-label-sm text-secondary mb-xs">Current video link (set by manager)</p>
                                <p class="text-label-sm text-on-surface truncate">{{ $history->video_link }}</p>
                            </div>
                            <a href="{{ $history->video_link }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-xs text-label-sm text-sky-600 font-medium hover:underline shrink-0">
                                <span class="material-symbols-outlined text-[15px]">open_in_new</span>
                                Open
                            </a>
                        </div>
                    @endif
                    <div class="border border-dashed border-outline-variant rounded-xl p-md">
                        <input id="video" name="video" type="file" accept="video/*"
                               class="block w-full text-body-sm text-secondary
                                      file:mr-md file:py-xs file:px-md
                                      file:rounded-lg file:border-0
                                      file:text-label-sm file:font-semibold
                                      file:bg-surface-container file:text-secondary
                                      hover:file:bg-surface-container-high cursor-pointer">
                        <p class="mt-xs text-label-sm text-secondary">
                            @if($history->video_link)
                                Upload a file to replace the current link.
                            @else
                                Accepted: MP4, WebM, MOV &mdash; max 500 MB
                            @endif
                        </p>
                    </div>
                    @error('video')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-md pt-sm border-t border-outline-variant">
                    <button type="submit"
                            class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-lg py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Update Record
                    </button>
                    <a href="{{ route('teacher.histories.index') }}"
                       class="text-label-md text-secondary hover:text-on-surface transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
