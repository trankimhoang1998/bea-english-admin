<x-app-layout>
    <x-slot name="title">Edit Teaching Record | BEA English</x-slot>
    <x-slot name="header">
        <div class="flex items-center gap-md">
            <a href="{{ route('manager.histories.show', $history) }}"
               class="text-secondary hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">Edit Teaching Record</h1>
                <p class="text-label-sm text-secondary mt-xs">{{ 'Lesson: ' . str_pad($history->lesson_number, 2, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>
    </x-slot>

    @php
        $activeTeacherId = old('teacher_id', $history->teacher_id);
        $activeStudentId = old('student_id', $history->student_id);
        $activeTeacher   = $teachers->firstWhere('id', $activeTeacherId);
        $activeStudent   = $students->firstWhere('id', $activeStudentId);
    @endphp

    <script>
        window._historyEdit = {
            teacherOptions: @json($teachers->map(fn($t) => ['id' => $t->id, 'name' => $t->user->name, 'code' => $t->teacher_id])),
            studentOptions: @json($students->map(fn($s) => ['id' => $s->id, 'name' => $s->user->name, 'code' => $s->student_id])),
            teacherInit:  @json($activeTeacher ? $activeTeacher->user->name . ' (' . $activeTeacher->teacher_id . ')' : ''),
            studentInit:  @json($activeStudent ? $activeStudent->user->name . ' (' . $activeStudent->student_id . ')' : ''),
            teacherValue: @json($activeTeacherId),
            studentValue: @json($activeStudentId),
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

            <form method="POST" action="{{ route('manager.histories.update', $history) }}" enctype="multipart/form-data" class="space-y-lg">
                @csrf @method('PUT')

                {{-- Teacher --}}
                <div class="space-y-xs"
                     x-data="{
                         search: window._historyEdit.teacherInit,
                         value: window._historyEdit.teacherValue,
                         open: false,
                         options: window._historyEdit.teacherOptions,
                         get filtered() {
                             if (!this.search) return this.options;
                             const q = this.search.toLowerCase();
                             return this.options.filter(o => o.name.toLowerCase().includes(q) || o.code.toLowerCase().includes(q));
                         },
                         select(opt) { this.value = opt.id; this.search = opt.name + ' (' + opt.code + ')'; this.open = false; },
                         clear() { this.value = ''; this.search = ''; }
                     }">
                    <label class="block text-label-md font-semibold text-on-surface">Teacher</label>
                    <input type="hidden" name="teacher_id" :value="value">
                    <div class="relative">
                        <input type="text" x-model="search"
                               @focus="open = true" @click.outside="open = false"
                               @input="open = true; value = ''"
                               placeholder="Search by name or ID..."
                               class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all pr-xl">
                        <button type="button" x-show="value || search" @click="clear()"
                                class="absolute right-sm top-1/2 -translate-y-1/2 text-secondary hover:text-on-surface transition-colors">
                            <span class="material-symbols-outlined text-[16px]">close</span>
                        </button>
                        <div x-show="open" x-cloak
                             class="absolute z-50 w-full mt-xs bg-surface-container-lowest border border-outline-variant rounded-lg shadow-lg max-h-48 overflow-y-auto">
                            <div x-show="filtered.length === 0" class="px-md py-sm text-label-sm text-secondary">No results</div>
                            <template x-for="opt in filtered" :key="opt.id">
                                <div @click="select(opt)"
                                     class="px-md py-sm hover:bg-surface-container-low cursor-pointer flex items-center justify-between gap-sm">
                                    <span class="text-body-sm text-on-surface" x-text="opt.name"></span>
                                    <span class="text-label-sm text-secondary shrink-0" x-text="opt.code"></span>
                                </div>
                            </template>
                        </div>
                    </div>
                    @error('teacher_id')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Student --}}
                <div class="space-y-xs"
                     x-data="{
                         search: window._historyEdit.studentInit,
                         value: window._historyEdit.studentValue,
                         open: false,
                         options: window._historyEdit.studentOptions,
                         get filtered() {
                             if (!this.search) return this.options;
                             const q = this.search.toLowerCase();
                             return this.options.filter(o => o.name.toLowerCase().includes(q) || o.code.toLowerCase().includes(q));
                         },
                         select(opt) { this.value = opt.id; this.search = opt.name + ' (' + opt.code + ')'; this.open = false; },
                         clear() { this.value = ''; this.search = ''; }
                     }">
                    <label class="block text-label-md font-semibold text-on-surface">Student</label>
                    <input type="hidden" name="student_id" :value="value">
                    <div class="relative">
                        <input type="text" x-model="search"
                               @focus="open = true" @click.outside="open = false"
                               @input="open = true; value = ''"
                               placeholder="Search by name or ID..."
                               class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all pr-xl">
                        <button type="button" x-show="value || search" @click="clear()"
                                class="absolute right-sm top-1/2 -translate-y-1/2 text-secondary hover:text-on-surface transition-colors">
                            <span class="material-symbols-outlined text-[16px]">close</span>
                        </button>
                        <div x-show="open" x-cloak
                             class="absolute z-50 w-full mt-xs bg-surface-container-lowest border border-outline-variant rounded-lg shadow-lg max-h-48 overflow-y-auto">
                            <div x-show="filtered.length === 0" class="px-md py-sm text-label-sm text-secondary">No results</div>
                            <template x-for="opt in filtered" :key="opt.id">
                                <div @click="select(opt)"
                                     class="px-md py-sm hover:bg-surface-container-low cursor-pointer flex items-center justify-between gap-sm">
                                    <span class="text-body-sm text-on-surface" x-text="opt.name"></span>
                                    <span class="text-label-sm text-secondary shrink-0" x-text="opt.code"></span>
                                </div>
                            </template>
                        </div>
                    </div>
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
                    @if($history->video_path)
                        <div class="flex items-center gap-sm p-sm bg-secondary-container/30 border border-secondary-container rounded-lg mb-sm">
                            <span class="material-symbols-outlined text-primary text-[18px]">videocam</span>
                            <div class="flex-1 text-label-sm text-on-surface">Video already uploaded. Upload a new file to replace it.</div>
                            <a href="{{ route('manager.histories.video', $history) }}"
                               class="inline-flex items-center gap-xs text-label-sm text-primary font-medium hover:underline shrink-0">
                                <span class="material-symbols-outlined text-[15px]">download</span>
                                Download
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
                        Update Record
                    </button>
                    <a href="{{ route('manager.histories.show', $history) }}"
                       class="text-label-md text-secondary hover:text-on-surface transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
