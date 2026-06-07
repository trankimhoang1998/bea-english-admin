<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Teacher — {{ $teacher->user->name }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('manager.teachers.update', $teacher) }}" class="space-y-4">
                    @csrf @method('PUT')

                    <div>
                        <x-input-label for="name" value="Name" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                      :value="old('name', $teacher->user->name)" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                      :value="old('email', $teacher->user->email)" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="teacher_id" value="Teacher ID" />
                        <x-text-input id="teacher_id" name="teacher_id" type="text" class="mt-1 block w-full"
                                      :value="old('teacher_id', $teacher->teacher_id)" required />
                        <x-input-error :messages="$errors->get('teacher_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="experience" value="Experience" />
                        <x-text-input id="experience" name="experience" type="text" class="mt-1 block w-full"
                                      :value="old('experience', $teacher->experience)" required />
                        <x-input-error :messages="$errors->get('experience')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <x-primary-button>Update</x-primary-button>
                        <a href="{{ route('manager.teachers.index') }}" class="text-sm text-gray-600 hover:underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
