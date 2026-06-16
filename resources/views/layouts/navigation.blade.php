<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
       class="fixed left-0 top-0 h-full w-[280px] bg-surface-container-lowest border-r border-outline-variant flex flex-col z-50 transition-transform duration-300 ease-in-out">

    {{-- Close button (mobile only) --}}
    <button @click="sidebarOpen = false"
            class="md:hidden absolute top-md right-md p-xs rounded-lg hover:bg-surface-container-low transition-colors text-secondary">
        <span class="material-symbols-outlined text-[22px]">close</span>
    </button>

    {{-- Branding --}}
    <div class="px-lg pt-xl pb-lg">
        <div class="flex items-center gap-md">
            <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center text-white shrink-0">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;">school</span>
            </div>
            <div>
                <h1 class="font-black text-headline-sm text-primary leading-none">BEA English</h1>
                <p class="text-label-sm text-secondary mt-xs">
                    @if(Auth::user()->isManager() || Auth::user()->isViceManager()) Management Portal
                    @elseif(Auth::user()->isTeacher()) Teacher Portal
                    @else Student Portal
                    @endif
                </p>
            </div>
        </div>
    </div>

    {{-- Navigation links --}}
    <nav class="flex-1 overflow-y-auto px-md space-y-xs pb-lg">
        @if(Auth::user()->isManager())
            <a href="{{ route('dashboard') }}" @click="sidebarOpen = false"
               class="flex items-center gap-md py-md rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'nav-active font-semibold' : 'text-secondary hover:bg-surface-container-low px-lg' }}">
                <span class="material-symbols-outlined text-[22px]" @if(request()->routeIs('dashboard')) style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;" @endif>dashboard</span>
                <span class="text-label-md">Dashboard</span>
            </a>
            <a href="{{ route('manager.schedules.index') }}" @click="sidebarOpen = false"
               class="flex items-center gap-md py-md rounded-lg transition-all duration-200 {{ request()->routeIs('manager.schedules*') ? 'nav-active font-semibold' : 'text-secondary hover:bg-surface-container-low px-lg' }}">
                <span class="material-symbols-outlined text-[22px]" @if(request()->routeIs('manager.schedules*')) style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;" @endif>calendar_month</span>
                <span class="text-label-md">Schedules</span>
            </a>
            <a href="{{ route('manager.histories.index') }}" @click="sidebarOpen = false"
               class="flex items-center gap-md py-md rounded-lg transition-all duration-200 {{ request()->routeIs('manager.histories*') ? 'nav-active font-semibold' : 'text-secondary hover:bg-surface-container-low px-lg' }}">
                <span class="material-symbols-outlined text-[22px]" @if(request()->routeIs('manager.histories*')) style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;" @endif>history_edu</span>
                <span class="text-label-md">Teaching History</span>
            </a>
            <a href="{{ route('manager.teachers.index') }}" @click="sidebarOpen = false"
               class="flex items-center gap-md py-md rounded-lg transition-all duration-200 {{ request()->routeIs('manager.teachers*') ? 'nav-active font-semibold' : 'text-secondary hover:bg-surface-container-low px-lg' }}">
                <span class="material-symbols-outlined text-[22px]" @if(request()->routeIs('manager.teachers*')) style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;" @endif>person</span>
                <span class="text-label-md">Teachers</span>
            </a>
            <a href="{{ route('manager.students.index') }}" @click="sidebarOpen = false"
               class="flex items-center gap-md py-md rounded-lg transition-all duration-200 {{ request()->routeIs('manager.students*') ? 'nav-active font-semibold' : 'text-secondary hover:bg-surface-container-low px-lg' }}">
                <span class="material-symbols-outlined text-[22px]" @if(request()->routeIs('manager.students*')) style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;" @endif>group</span>
                <span class="text-label-md">Students</span>
            </a>
            <div x-data="{ open: {{ request()->routeIs('manager.materials*') ? 'true' : 'false' }} }">
                <button type="button" @click="open = !open"
                        class="w-full flex items-center gap-md py-md px-lg rounded-lg transition-all duration-200 {{ request()->routeIs('manager.materials*') ? 'text-on-surface font-semibold' : 'text-secondary hover:bg-surface-container-low' }}">
                    <span class="material-symbols-outlined text-[22px]" @if(request()->routeIs('manager.materials*')) style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;" @endif>folder_open</span>
                    <span class="text-label-md flex-1 text-left">Materials</span>
                    <span class="material-symbols-outlined text-[16px] transition-transform duration-200" :class="open ? 'rotate-180' : ''">expand_more</span>
                </button>
                <div x-show="open" x-cloak x-transition:enter="transition-all duration-150" class="ml-[42px] mt-xs space-y-xs">
                    <a href="{{ route('manager.materials.categories.index') }}" @click="sidebarOpen = false"
                       class="flex items-center gap-sm py-sm px-md rounded-lg transition-all duration-200 text-label-md {{ request()->routeIs('manager.materials.categories*') ? 'nav-active font-semibold' : 'text-secondary hover:bg-surface-container-low' }}">
                        <span class="material-symbols-outlined text-[17px]">folder_special</span>
                        Categories
                    </a>
                    <a href="{{ route('manager.materials.index') }}" @click="sidebarOpen = false"
                       class="flex items-center gap-sm py-sm px-md rounded-lg transition-all duration-200 text-label-md {{ request()->routeIs('manager.materials.index', 'manager.materials.create', 'manager.materials.edit', 'manager.materials.update', 'manager.materials.store', 'manager.materials.destroy', 'manager.materials.download') ? 'nav-active font-semibold' : 'text-secondary hover:bg-surface-container-low' }}">
                        <span class="material-symbols-outlined text-[17px]">description</span>
                        All Materials
                    </a>
                </div>
            </div>

        @elseif(Auth::user()->isViceManager())
            <a href="{{ route('dashboard') }}" @click="sidebarOpen = false"
               class="flex items-center gap-md py-md rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'nav-active font-semibold' : 'text-secondary hover:bg-surface-container-low px-lg' }}">
                <span class="material-symbols-outlined text-[22px]" @if(request()->routeIs('dashboard')) style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;" @endif>dashboard</span>
                <span class="text-label-md">Dashboard</span>
            </a>
            <a href="{{ route('vice-manager.schedules.index') }}" @click="sidebarOpen = false"
               class="flex items-center gap-md py-md rounded-lg transition-all duration-200 {{ request()->routeIs('vice-manager.schedules*') ? 'nav-active font-semibold' : 'text-secondary hover:bg-surface-container-low px-lg' }}">
                <span class="material-symbols-outlined text-[22px]" @if(request()->routeIs('vice-manager.schedules*')) style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;" @endif>calendar_month</span>
                <span class="text-label-md">Schedules</span>
            </a>
            <a href="{{ route('vice-manager.histories.index') }}" @click="sidebarOpen = false"
               class="flex items-center gap-md py-md rounded-lg transition-all duration-200 {{ request()->routeIs('vice-manager.histories*') ? 'nav-active font-semibold' : 'text-secondary hover:bg-surface-container-low px-lg' }}">
                <span class="material-symbols-outlined text-[22px]" @if(request()->routeIs('vice-manager.histories*')) style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;" @endif>history_edu</span>
                <span class="text-label-md">Teaching History</span>
            </a>
            <a href="{{ route('vice-manager.teachers.index') }}" @click="sidebarOpen = false"
               class="flex items-center gap-md py-md rounded-lg transition-all duration-200 {{ request()->routeIs('vice-manager.teachers*') ? 'nav-active font-semibold' : 'text-secondary hover:bg-surface-container-low px-lg' }}">
                <span class="material-symbols-outlined text-[22px]" @if(request()->routeIs('vice-manager.teachers*')) style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;" @endif>person</span>
                <span class="text-label-md">Teachers</span>
            </a>
            <a href="{{ route('vice-manager.students.index') }}" @click="sidebarOpen = false"
               class="flex items-center gap-md py-md rounded-lg transition-all duration-200 {{ request()->routeIs('vice-manager.students*') ? 'nav-active font-semibold' : 'text-secondary hover:bg-surface-container-low px-lg' }}">
                <span class="material-symbols-outlined text-[22px]" @if(request()->routeIs('vice-manager.students*')) style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;" @endif>group</span>
                <span class="text-label-md">Students</span>
            </a>
            <div x-data="{ open: {{ request()->routeIs('vice-manager.materials*') ? 'true' : 'false' }} }">
                <button type="button" @click="open = !open"
                        class="w-full flex items-center gap-md py-md px-lg rounded-lg transition-all duration-200 {{ request()->routeIs('vice-manager.materials*') ? 'text-on-surface font-semibold' : 'text-secondary hover:bg-surface-container-low' }}">
                    <span class="material-symbols-outlined text-[22px]" @if(request()->routeIs('vice-manager.materials*')) style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;" @endif>folder_open</span>
                    <span class="text-label-md flex-1 text-left">Materials</span>
                    <span class="material-symbols-outlined text-[16px] transition-transform duration-200" :class="open ? 'rotate-180' : ''">expand_more</span>
                </button>
                <div x-show="open" x-cloak x-transition:enter="transition-all duration-150" class="ml-[42px] mt-xs space-y-xs">
                    <a href="{{ route('vice-manager.materials.categories.index') }}" @click="sidebarOpen = false"
                       class="flex items-center gap-sm py-sm px-md rounded-lg transition-all duration-200 text-label-md {{ request()->routeIs('vice-manager.materials.categories*') ? 'nav-active font-semibold' : 'text-secondary hover:bg-surface-container-low' }}">
                        <span class="material-symbols-outlined text-[17px]">folder_special</span>
                        Categories
                    </a>
                    <a href="{{ route('vice-manager.materials.index') }}" @click="sidebarOpen = false"
                       class="flex items-center gap-sm py-sm px-md rounded-lg transition-all duration-200 text-label-md {{ request()->routeIs('vice-manager.materials.index', 'vice-manager.materials.download') ? 'nav-active font-semibold' : 'text-secondary hover:bg-surface-container-low' }}">
                        <span class="material-symbols-outlined text-[17px]">description</span>
                        All Materials
                    </a>
                </div>
            </div>

        @elseif(Auth::user()->isTeacher())
            <a href="{{ route('teacher.dashboard') }}" @click="sidebarOpen = false"
               class="flex items-center gap-md py-md rounded-lg transition-all duration-200 {{ request()->routeIs('teacher.dashboard') ? 'nav-active font-semibold' : 'text-secondary hover:bg-surface-container-low px-lg' }}">
                <span class="material-symbols-outlined text-[22px]" @if(request()->routeIs('teacher.dashboard')) style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;" @endif>calendar_today</span>
                <span class="text-label-md">My Schedule</span>
            </a>
            <a href="{{ route('teacher.histories.index') }}" @click="sidebarOpen = false"
               class="flex items-center gap-md py-md rounded-lg transition-all duration-200 {{ request()->routeIs('teacher.histories*') ? 'nav-active font-semibold' : 'text-secondary hover:bg-surface-container-low px-lg' }}">
                <span class="material-symbols-outlined text-[22px]" @if(request()->routeIs('teacher.histories*')) style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;" @endif>history_edu</span>
                <span class="text-label-md">Teaching History</span>
            </a>
            <a href="{{ route('teacher.materials.index') }}" @click="sidebarOpen = false"
               class="flex items-center gap-md py-md rounded-lg transition-all duration-200 {{ request()->routeIs('teacher.materials*') ? 'nav-active font-semibold' : 'text-secondary hover:bg-surface-container-low px-lg' }}">
                <span class="material-symbols-outlined text-[22px]" @if(request()->routeIs('teacher.materials*')) style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;" @endif>folder_open</span>
                <span class="text-label-md">Materials</span>
            </a>

        @elseif(Auth::user()->isStudent())
            <a href="{{ route('student.dashboard') }}" @click="sidebarOpen = false"
               class="flex items-center gap-md py-md rounded-lg transition-all duration-200 {{ request()->routeIs('student.dashboard') ? 'nav-active font-semibold' : 'text-secondary hover:bg-surface-container-low px-lg' }}">
                <span class="material-symbols-outlined text-[22px]" @if(request()->routeIs('student.dashboard')) style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;" @endif>calendar_today</span>
                <span class="text-label-md">My Schedule</span>
            </a>
            <a href="{{ route('student.history.index') }}" @click="sidebarOpen = false"
               class="flex items-center gap-md py-md rounded-lg transition-all duration-200 {{ request()->routeIs('student.history*') ? 'nav-active font-semibold' : 'text-secondary hover:bg-surface-container-low px-lg' }}">
                <span class="material-symbols-outlined text-[22px]" @if(request()->routeIs('student.history*')) style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;" @endif>history_edu</span>
                <span class="text-label-md">Learning History</span>
            </a>
            <a href="{{ route('student.materials.index') }}" @click="sidebarOpen = false"
               class="flex items-center gap-md py-md rounded-lg transition-all duration-200 {{ request()->routeIs('student.materials*') ? 'nav-active font-semibold' : 'text-secondary hover:bg-surface-container-low px-lg' }}">
                <span class="material-symbols-outlined text-[22px]" @if(request()->routeIs('student.materials*')) style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;" @endif>folder_open</span>
                <span class="text-label-md">Materials</span>
            </a>
        @endif
    </nav>

    {{-- User info + logout --}}
    <div class="border-t border-outline-variant p-md space-y-xs">
        <div class="flex items-center gap-sm px-md py-sm">
            <div class="w-8 h-8 rounded-full bg-secondary-container flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[18px] text-on-surface-variant">person</span>
            </div>
            <div class="min-w-0">
                <p class="text-label-md font-semibold text-on-surface truncate">{{ Auth::user()->name }}</p>
                <p class="text-label-sm text-secondary capitalize">{{ Auth::user()->role }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full flex items-center gap-sm text-error px-md py-sm hover:bg-error-container/20 transition-all rounded-lg">
                <span class="material-symbols-outlined text-[20px]">logout</span>
                <span class="text-label-md">Logout</span>
            </button>
        </form>
    </div>
</aside>
