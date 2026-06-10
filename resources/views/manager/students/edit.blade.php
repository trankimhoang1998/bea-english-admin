<x-app-layout>
    <x-slot name="title">Edit Student | BEA English</x-slot>
    <x-slot name="header">
        <div class="flex items-center gap-md">
            <a href="{{ route('manager.students.index') }}"
               class="text-secondary hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">Edit Student</h1>
                <p class="text-label-sm text-secondary mt-xs">{{ $student->user->name }} &middot; {{ $student->student_id }}</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-lg">
            <form method="POST" action="{{ route('manager.students.update', $student) }}" class="space-y-lg">
                @csrf @method('PUT')

                {{-- Name --}}
                <div class="space-y-xs">
                    <label for="name" class="block text-label-md font-semibold text-on-surface">Full Name</label>
                    <input id="name" name="name" type="text"
                           value="{{ old('name', $student->user->name) }}" required
                           class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    @error('name')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Username --}}
                <div class="space-y-xs">
                    <label for="username" class="block text-label-md font-semibold text-on-surface">Account</label>
                    <input id="username" name="username" type="text"
                           value="{{ old('username', $student->user->username) }}" required
                           class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    @error('username')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="space-y-xs">
                    <label for="password" class="block text-label-md font-semibold text-on-surface">
                        New Password <span class="text-secondary font-normal">(leave blank to keep current)</span>
                    </label>
                    <input id="password" name="password" type="password"
                           autocomplete="new-password"
                           class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    @error('password')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Student ID --}}
                <div class="space-y-xs">
                    <label for="student_id" class="block text-label-md font-semibold text-on-surface">Student ID</label>
                    <input id="student_id" name="student_id" type="text"
                           value="{{ old('student_id', $student->student_id) }}" required
                           class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    @error('student_id')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Age --}}
                <div class="space-y-xs">
                    <label for="age" class="block text-label-md font-semibold text-on-surface">Age</label>
                    <input id="age" name="age" type="number"
                           value="{{ old('age', $student->age) }}" required min="5" max="99"
                           class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    @error('age')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Course --}}
                <div class="space-y-xs">
                    <label for="course" class="block text-label-md font-semibold text-on-surface">Course</label>
                    <input id="course" name="course" type="text"
                           value="{{ old('course', $student->course) }}" required
                           class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    @error('course')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-md pt-sm border-t border-outline-variant">
                    <button type="submit"
                            class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-lg py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Update Student
                    </button>
                    <a href="{{ route('manager.students.index') }}"
                       class="text-label-md text-secondary hover:text-on-surface transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
