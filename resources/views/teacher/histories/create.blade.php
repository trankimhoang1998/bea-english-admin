<x-app-layout>
    <x-slot name="title">Log Session | BEA English</x-slot>
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

    <script>
    window._videoUploadData = window._videoUploadData || function() {
        return {
            uploading: false,
            progress: 0,
            submit(form) {
                const videoType = form.querySelector('[name="video_type"]');
                const video = form.querySelector('[name="video"]');
                const isFileUpload = !videoType || videoType.value === 'file';
                if (!isFileUpload || !video || !video.files.length) { form.submit(); return; }
                this.uploading = true;
                this.progress = 0;
                const self = this;
                const xhr = new XMLHttpRequest();
                xhr.upload.onprogress = e => { if (e.lengthComputable) self.progress = Math.round(e.loaded / e.total * 100); };
                xhr.upload.onload = () => { self.progress = 100; };
                xhr.onload = () => {
                    if (xhr.responseURL !== window.location.href) history.pushState({}, '', xhr.responseURL);
                    document.open(); document.write(xhr.responseText); document.close();
                };
                xhr.onerror = () => { self.uploading = false; alert('Upload failed. Please try again.'); };
                xhr.open('POST', form.action);
                xhr.send(new FormData(form));
            }
        };
    };
    </script>

    <div class="max-w-2xl">
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-lg">
            @if($errors->any())
                <div class="flex items-start gap-sm p-md bg-error-container border border-error/20 rounded-xl mb-lg">
                    <span class="material-symbols-outlined text-error text-[20px] shrink-0 mt-xs">error</span>
                    <div>
                        <p class="text-label-md font-semibold text-on-error-container mb-xs">Please fix the following errors:</p>
                        <ul class="list-disc list-inside text-label-sm text-on-error-container space-y-xs">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <form method="POST" action="{{ route('teacher.histories.store') }}" enctype="multipart/form-data" class="space-y-lg"
                  x-data="window._videoUploadData()" @submit.prevent="submit($el)">
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

                {{-- Date --}}
                <div class="space-y-xs">
                    <label for="taught_date" class="block text-label-md font-semibold text-on-surface">Date</label>
                    <input id="taught_date" name="taught_date" type="date"
                           value="{{ old('taught_date') }}" required
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
                               value="{{ old('time_from') }}" required
                               class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                        @error('time_from')
                            <p class="text-label-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-xs">
                        <label for="time_to" class="block text-label-md font-semibold text-on-surface">Time To</label>
                        <input id="time_to" name="time_to" type="time"
                               value="{{ old('time_to') }}" required
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
                        <option value="">— Select Duration —</option>
                        <option value="25" {{ old('duration') == '25' ? 'selected' : '' }}>25 min</option>
                        <option value="50" {{ old('duration') == '50' ? 'selected' : '' }}>50 min</option>
                        <option value="90" {{ old('duration') == '90' ? 'selected' : '' }}>90 min</option>
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
                              placeholder="Comments, feedback, homework assignments, or notes about this session..."
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
                    <input type="hidden" name="video_type" value="file">
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

                {{-- Video upload progress overlay --}}
                <div x-show="uploading" x-cloak
                     class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
                    <div class="bg-surface-container-lowest rounded-2xl shadow-xl p-xl w-full max-w-sm mx-lg">
                        <div class="flex flex-col items-center text-center">
                            <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mb-lg">
                                <span class="material-symbols-outlined text-primary text-[32px]">cloud_upload</span>
                            </div>
                            <p class="font-semibold text-body-md text-on-surface mb-xs"
                               x-text="progress < 100 ? 'Uploading video...' : 'Processing...'"></p>
                            <p class="text-label-sm text-secondary mb-lg"
                               x-text="progress < 100 ? progress + '%' : 'Almost done, please wait'"></p>
                            <div class="w-full bg-surface-container rounded-full h-2 overflow-hidden">
                                <div class="bg-primary h-full rounded-full transition-all duration-300"
                                     :style="'width: ' + progress + '%'"></div>
                            </div>
                            <p class="text-label-sm text-secondary/70 mt-md">Do not close this page.</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
