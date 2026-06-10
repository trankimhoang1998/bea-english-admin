<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center gap-sm justify-between">
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">Teachers</h1>
                <p class="text-label-sm text-secondary mt-xs">Manage teacher accounts and profiles</p>
            </div>
            <a href="{{ route('manager.teachers.create') }}"
               class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                <span class="material-symbols-outlined text-[18px]">person_add</span>
                Add Teacher
            </a>
        </div>
    </x-slot>

    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-outline-variant bg-surface-container-low">
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Name</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Teacher ID</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Experience</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Account</th>
                        <th class="px-lg py-md text-right text-label-sm font-semibold text-secondary uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @forelse($teachers as $teacher)
                        <tr class="hover:bg-surface-container-low transition-colors">
                            <td class="px-lg py-md">
                                <div class="flex items-center gap-md">
                                    <div class="w-9 h-9 rounded-full bg-secondary-container flex items-center justify-center shrink-0">
                                        <span class="material-symbols-outlined text-[18px] text-on-surface-variant">person</span>
                                    </div>
                                    <span class="font-semibold text-body-sm text-on-surface">{{ $teacher->user->name }}</span>
                                </div>
                            </td>
                            <td class="px-lg py-md">
                                <span class="inline-flex items-center px-sm py-xs bg-primary/10 text-primary font-label-sm rounded-full">{{ $teacher->teacher_id }}</span>
                            </td>
                            <td class="px-lg py-md text-body-sm text-secondary">{{ $teacher->experience }}</td>
                            <td class="px-lg py-md text-body-sm text-secondary">{{ $teacher->user->username }}</td>
                            <td class="px-lg py-md">
                                <div class="flex items-center justify-end gap-sm">
                                    <a href="{{ route('manager.teachers.show', $teacher) }}"
                                       class="inline-flex items-center gap-xs text-label-sm text-secondary hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">visibility</span>
                                        View
                                    </a>
                                    <a href="{{ route('manager.teachers.edit', $teacher) }}"
                                       class="inline-flex items-center gap-xs text-label-sm text-primary hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">edit</span>
                                        Edit
                                    </a>
                                    <form id="del-teacher-{{ $teacher->id }}" method="POST" action="{{ route('manager.teachers.destroy', $teacher) }}">
                                        @csrf @method('DELETE')
                                    </form>
                                    <button type="button"
                                            @click="$store.confirmModal.show('Delete this teacher? Their existing teaching history records will be preserved.', 'del-teacher-{{ $teacher->id }}')"
                                            class="inline-flex items-center gap-xs text-label-sm text-error hover:text-on-surface px-sm py-xs rounded-lg hover:bg-error-container/30 transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">delete</span>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-lg py-2xl text-center">
                                <div class="flex flex-col items-center gap-md text-secondary">
                                    <span class="material-symbols-outlined text-[48px] opacity-30">person_off</span>
                                    <p class="text-body-md">No teachers found.</p>
                                    <a href="{{ route('manager.teachers.create') }}"
                                       class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all">
                                        <span class="material-symbols-outlined text-[16px]">add</span>
                                        Add first teacher
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($teachers->hasPages())
            <div class="px-lg py-md border-t border-outline-variant">
                {{ $teachers->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
