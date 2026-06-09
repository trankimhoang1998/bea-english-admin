<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-md">
            <a href="{{ route('teacher.histories.index') }}"
               class="text-secondary hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">Log Teaching Session</h1>
                <p class="text-label-sm text-secondary mt-xs">Record a completed lesson</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-lg">
            <form method="POST" action="{{ route('teacher.histories.store') }}" enctype="multipart/form-data" class="space-y-lg">
                @csrf

                {{-- Student --}}
                <div class="space-y-xs">
                    <label for="student_id" class="block text-label-md font-semibold text-on-surface">Student</label>
                    <select id="student_id" name="student_id" required
                            class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                        <option value="">— Select Student —</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                {{ $student->user->name }} ({{ $student->student_id }})
                            </option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Date & Time --}}
                <div class="space-y-xs">
                    <label for="taught_at" class="block text-label-md font-semibold text-on-surface">Date &amp; Time</label>
                    <input id="taught_at" name="taught_at" type="datetime-local"
                           value="{{ old('taught_at') }}" required
                           class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    @error('taught_at')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Duration --}}
                <div class="space-y-xs">
                    <label for="duration" class="block text-label-md font-semibold text-on-surface">Duration</label>
                    <select id="duration" name="duration" required
                            class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                        <option value="">— Select Duration —</option>
                        <option value="25" {{ old('duration') == '25' ? 'selected' : '' }}>25 min</option>
                        <option value="50" {{ old('duration') == '50' ? 'selected' : '' }}>50 min</option>
                    </select>
                    @error('duration')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Note --}}
                <div class="space-y-xs">
                    <label for="note" class="block text-label-md font-semibold text-on-surface">
                        Note <span class="text-secondary font-normal">(optional)</span>
                    </label>
                    <textarea id="note" name="note" rows="3"
                              placeholder="Comments, feedback, or notes about this session..."
                              class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest resize-y">{{ old('note') }}</textarea>
                    @error('note')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Video --}}
                <div class="space-y-xs">
                    <label for="video" class="block text-label-md font-semibold text-on-surface">
                        Video Log <span class="text-secondary font-normal">(optional)</span>
                    </label>
                    <div class="border border-dashed border-outline-variant rounded-xl p-md">
                        <input id="video" name="video" type="file" accept="video/*"
                               class="block w-full text-body-sm text-secondary
                                      file:mr-md file:py-xs file:px-md
                                      file:rounded-lg file:border-0
                                      file:text-label-sm file:font-semibold
                                      file:bg-surface-container file:text-secondary
                                      hover:file:bg-surface-container-high cursor-pointer">
                        <p class="mt-xs text-label-sm text-secondary">Accepted: MP4, WebM, MOV &mdash; max 500 MB</p>
                    </div>
                    @error('video')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-md pt-sm border-t border-outline-variant">
                    <button type="submit"
                            class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-lg py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Save Record
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
