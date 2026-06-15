<x-app-layout>
    <x-slot name="title">Students | BEA English</x-slot>
    <x-slot name="header">
        <div class="flex flex-wrap items-center gap-sm justify-between">
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">Students</h1>
                <p class="text-label-sm text-secondary mt-xs">Manage student accounts and enrollments</p>
            </div>
            <a href="{{ route('manager.students.create') }}"
               class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                <span class="material-symbols-outlined text-[18px]">group_add</span>
                Add Student
            </a>
        </div>
    </x-slot>

    {{-- Search --}}
    <form method="GET" action="{{ route('manager.students.index') }}"
          class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-md mb-md">
        <div class="flex gap-sm">
            <div class="relative flex-1">
                <span class="absolute left-sm top-1/2 -translate-y-1/2 text-secondary pointer-events-none">
                    <span class="material-symbols-outlined text-[18px]">search</span>
                </span>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search by name or student ID..."
                       class="w-full border border-outline-variant rounded-lg pl-xl pr-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
            </div>
            <button type="submit"
                    class="inline-flex items-center gap-xs bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95 shrink-0">
                <span class="material-symbols-outlined text-[16px]">search</span>
                Search
            </button>
            @if(request('search'))
                <a href="{{ route('manager.students.index') }}"
                   class="inline-flex items-center px-sm py-sm text-secondary hover:text-on-surface transition-colors shrink-0"
                   title="Clear search">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </a>
            @endif
        </div>
    </form>

    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-outline-variant bg-surface-container-low">
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Name</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Student ID</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Age</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Course</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Account</th>
                        <th class="px-lg py-md text-right text-label-sm font-semibold text-secondary uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @forelse($students as $student)
                        <tr class="hover:bg-surface-container-low transition-colors">
                            <td class="px-lg py-md">
                                <div class="flex items-center gap-md">
                                    <div class="w-9 h-9 rounded-full bg-tertiary/10 flex items-center justify-center shrink-0">
                                        <span class="material-symbols-outlined text-[18px] text-tertiary">person</span>
                                    </div>
                                    <span class="font-semibold text-body-sm text-on-surface">{{ $student->user->name }}</span>
                                </div>
                            </td>
                            <td class="px-lg py-md">
                                <span class="inline-flex items-center px-sm py-xs bg-tertiary/10 text-tertiary font-label-sm rounded-full">{{ $student->student_id }}</span>
                            </td>
                            <td class="px-lg py-md text-body-sm text-secondary">{{ $student->age }}</td>
                            <td class="px-lg py-md text-body-sm text-secondary">{{ $student->course }}</td>
                            <td class="px-lg py-md text-body-sm text-secondary">{{ $student->user->username }}</td>
                            <td class="px-lg py-md">
                                <div class="flex items-center justify-end gap-sm">
                                    <a href="{{ route('manager.students.show', $student) }}"
                                       class="inline-flex items-center gap-xs text-label-sm text-secondary hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">visibility</span>
                                        View
                                    </a>
                                    <a href="{{ route('manager.students.edit', $student) }}"
                                       class="inline-flex items-center gap-xs text-label-sm text-primary hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">edit</span>
                                        Edit
                                    </a>
                                    <form id="del-student-{{ $student->id }}" method="POST" action="{{ route('manager.students.destroy', $student) }}">
                                        @csrf @method('DELETE')
                                    </form>
                                    <button type="button"
                                            @click="$store.confirmModal.show('Delete this student? This will fail if they have existing teaching history records.', 'del-student-{{ $student->id }}')"
                                            class="inline-flex items-center gap-xs text-label-sm text-error hover:text-on-surface px-sm py-xs rounded-lg hover:bg-error-container/30 transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">delete</span>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-lg py-2xl text-center">
                                <div class="flex flex-col items-center gap-md text-secondary">
                                    <span class="material-symbols-outlined text-[48px] opacity-30">group_off</span>
                                    @if(request('search'))
                                        <p class="text-body-md">No students match "{{ request('search') }}".</p>
                                        <a href="{{ route('manager.students.index') }}"
                                           class="text-label-md text-primary hover:underline">Clear search</a>
                                    @else
                                        <p class="text-body-md">No students found.</p>
                                        <a href="{{ route('manager.students.create') }}"
                                           class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all">
                                            <span class="material-symbols-outlined text-[16px]">add</span>
                                            Add first student
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($students->hasPages())
            <div class="px-lg py-md border-t border-outline-variant">
                {{ $students->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
