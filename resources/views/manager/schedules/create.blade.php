<x-app-layout>
    <x-slot name="title">Add Schedule | BEA English</x-slot>
    <x-slot name="header">
        <div class="flex items-center gap-md">
            <a href="{{ route('manager.schedules.index') }}"
               class="text-secondary hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">Add Schedule</h1>
                <p class="text-label-sm text-secondary mt-xs">Assign a teacher-student teaching slot</p>
            </div>
        </div>
    </x-slot>

    @php
        $oldTeacher = $teachers->firstWhere('id', old('teacher_id'));
        $oldStudent = $students->firstWhere('id', old('student_id'));
    @endphp

    <script>
        window._scheduleCreate = {
            teacherOptions: @json($teachers->map(fn($t) => ['id' => $t->id, 'name' => $t->user->name, 'code' => $t->teacher_id])),
            studentOptions: @json($students->map(fn($s) => ['id' => $s->id, 'name' => $s->user->name, 'code' => $s->student_id])),
            teacherInit:  @json($oldTeacher ? $oldTeacher->user->name . ' (' . $oldTeacher->teacher_id . ')' : ''),
            studentInit:  @json($oldStudent ? $oldStudent->user->name . ' (' . $oldStudent->student_id . ')' : ''),
            teacherValue: @json(old('teacher_id', '')),
            studentValue: @json(old('student_id', '')),
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

            <form method="POST" action="{{ route('manager.schedules.store') }}" class="space-y-lg">
                @csrf

                {{-- Teacher --}}
                <div class="space-y-xs"
                     x-data="{
                         search: window._scheduleCreate.teacherInit,
                         value: window._scheduleCreate.teacherValue,
                         open: false,
                         options: window._scheduleCreate.teacherOptions,
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
                         search: window._scheduleCreate.studentInit,
                         value: window._scheduleCreate.studentValue,
                         open: false,
                         options: window._scheduleCreate.studentOptions,
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

                {{-- Day of Week --}}
                <div class="space-y-xs">
                    <label for="day_of_week" class="block text-label-md font-semibold text-on-surface">Day of Week</label>
                    <select id="day_of_week" name="day_of_week" required
                            class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                        <option value="">— Select Day —</option>
                        @foreach(['mon' => 'Monday', 'tue' => 'Tuesday', 'wed' => 'Wednesday', 'thu' => 'Thursday', 'fri' => 'Friday', 'sat' => 'Saturday', 'sun' => 'Sunday'] as $val => $label)
                            <option value="{{ $val }}" {{ old('day_of_week') === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('day_of_week')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Time --}}
                <div class="grid grid-cols-2 gap-md">
                    <div class="space-y-xs">
                        <label for="start_time" class="block text-label-md font-semibold text-on-surface">Start Time</label>
                        <input id="start_time" name="start_time" type="time"
                               value="{{ old('start_time') }}" required
                               class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                        @error('start_time')
                            <p class="text-label-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-xs">
                        <label for="end_time" class="block text-label-md font-semibold text-on-surface">End Time</label>
                        <input id="end_time" name="end_time" type="time"
                               value="{{ old('end_time') }}" required
                               class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                        @error('end_time')
                            <p class="text-label-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center gap-md pt-sm border-t border-outline-variant">
                    <button type="submit"
                            class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-lg py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Save Schedule
                    </button>
                    <a href="{{ route('manager.schedules.index') }}"
                       class="text-label-md text-secondary hover:text-on-surface transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
