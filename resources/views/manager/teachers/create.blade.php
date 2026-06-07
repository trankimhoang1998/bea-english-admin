<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-md">
            <a href="{{ route('manager.teachers.index') }}"
               class="text-secondary hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">Add Teacher</h1>
                <p class="text-label-sm text-secondary mt-xs">Register a new teacher account</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-lg">
            <form method="POST" action="{{ route('manager.teachers.store') }}" class="space-y-lg">
                @csrf

                {{-- Name --}}
                <div class="space-y-xs">
                    <label for="name" class="block text-label-md font-semibold text-on-surface">Full Name</label>
                    <input id="name" name="name" type="text"
                           value="{{ old('name') }}" required
                           placeholder="e.g. Ann Oliver"
                           class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    @error('name')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="space-y-xs">
                    <label for="email" class="block text-label-md font-semibold text-on-surface">Email Address</label>
                    <input id="email" name="email" type="email"
                           value="{{ old('email') }}" required
                           placeholder="teacher@bea.test"
                           class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    @error('email')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="space-y-xs">
                    <label for="password" class="block text-label-md font-semibold text-on-surface">Password</label>
                    <input id="password" name="password" type="password"
                           required minlength="8"
                           placeholder="Min. 8 characters"
                           class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    @error('password')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Teacher ID --}}
                <div class="space-y-xs">
                    <label for="teacher_id" class="block text-label-md font-semibold text-on-surface">Teacher ID</label>
                    <input id="teacher_id" name="teacher_id" type="text"
                           value="{{ old('teacher_id') }}" required
                           placeholder="e.g. TEA101"
                           class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    @error('teacher_id')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Experience --}}
                <div class="space-y-xs">
                    <label for="experience" class="block text-label-md font-semibold text-on-surface">Experience</label>
                    <input id="experience" name="experience" type="text"
                           value="{{ old('experience') }}" required
                           placeholder="e.g. 5 years"
                           class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    @error('experience')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-md pt-sm border-t border-outline-variant">
                    <button type="submit"
                            class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-lg py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Save Teacher
                    </button>
                    <a href="{{ route('manager.teachers.index') }}"
                       class="text-label-md text-secondary hover:text-on-surface transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
