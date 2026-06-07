<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Student</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('manager.students.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <x-input-label for="name" value="Name" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                      :value="old('name')" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                      :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" value="Password" />
                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="student_id" value="Student ID" />
                        <x-text-input id="student_id" name="student_id" type="text" class="mt-1 block w-full"
                                      :value="old('student_id')" required placeholder="e.g. STU1011" />
                        <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="age" value="Age" />
                        <x-text-input id="age" name="age" type="number" class="mt-1 block w-full"
                                      :value="old('age')" required min="5" max="99" />
                        <x-input-error :messages="$errors->get('age')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="course" value="Course" />
                        <x-text-input id="course" name="course" type="text" class="mt-1 block w-full"
                                      :value="old('course')" required placeholder="e.g. 120 lessons" />
                        <x-input-error :messages="$errors->get('course')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <x-primary-button>Save</x-primary-button>
                        <a href="{{ route('manager.students.index') }}" class="text-sm text-gray-600 hover:underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
