<x-app-layout>
    <x-slot name="title">Teachers | BEA English</x-slot>
    <x-slot name="header">
        <div>
            <h1 class="font-bold text-headline-sm text-on-surface">Teachers</h1>
            <p class="text-label-sm text-secondary mt-xs">View teacher accounts and profiles</p>
        </div>
    </x-slot>

    <form method="GET" action="{{ route('vice-manager.teachers.index') }}"
          class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-md mb-md">
        <div class="flex gap-sm">
            <div class="relative flex-1">
                <span class="absolute left-sm top-1/2 -translate-y-1/2 text-secondary pointer-events-none">
                    <span class="material-symbols-outlined text-[18px]">search</span>
                </span>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search by name or teacher ID..."
                       class="w-full border border-outline-variant rounded-lg pl-xl pr-md py-sm text-body-sm text-on-surface bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
            </div>
            <button type="submit"
                    class="inline-flex items-center gap-xs bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95 shrink-0">
                <span class="material-symbols-outlined text-[16px]">search</span>
                Search
            </button>
            @if(request('search'))
                <a href="{{ route('vice-manager.teachers.index') }}"
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
                                    <a href="{{ route('vice-manager.teachers.show', $teacher) }}"
                                       class="inline-flex items-center gap-xs text-label-sm text-secondary hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">visibility</span>
                                        View
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-lg py-2xl text-center">
                                <div class="flex flex-col items-center gap-md text-secondary">
                                    <span class="material-symbols-outlined text-[48px] opacity-30">person_off</span>
                                    @if(request('search'))
                                        <p class="text-body-md">No teachers match "{{ request('search') }}".</p>
                                        <a href="{{ route('vice-manager.teachers.index') }}"
                                           class="text-label-md text-primary hover:underline">Clear search</a>
                                    @else
                                        <p class="text-body-md">No teachers found.</p>
                                    @endif
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
