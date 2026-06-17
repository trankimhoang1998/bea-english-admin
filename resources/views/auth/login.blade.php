<x-guest-layout>
    <x-slot name="title">Sign In | BEA English</x-slot>
    <header class="mb-xl text-center lg:text-left">
        <h2 class="font-bold text-headline-lg text-on-surface">Welcome back</h2>
        <p class="text-body-md text-secondary mt-xs">Sign in to your BEA English account.</p>
    </header>

    {{-- Session status --}}
    <x-auth-session-status class="mb-md" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-lg">
        @csrf

        {{-- Username --}}
        <div class="space-y-xs">
            <label for="username" class="block text-label-md font-semibold text-secondary">Account</label>
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-secondary group-focus-within:text-primary-container transition-colors">person</span>
                <input id="username"
                       name="username"
                       type="text"
                       value="{{ old('username') }}"
                       required
                       autofocus
                       autocomplete="username"
                       placeholder="e.g. kimhoang1014"
                       class="w-full pl-xl pr-md py-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary-container/30 focus:border-primary-container outline-none transition-all text-body-md text-on-surface">
            </div>
            <x-input-error :messages="$errors->get('username')" class="mt-xs" />
        </div>

        {{-- Password --}}
        <div class="space-y-xs" x-data="{ show: false }">
            <div class="flex justify-between items-center">
                <label for="password" class="block text-label-md font-semibold text-secondary">Password</label>
            </div>
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-secondary group-focus-within:text-primary-container transition-colors">lock</span>
                <input id="password"
                       name="password"
                       :type="show ? 'text' : 'password'"
                       required
                       autocomplete="current-password"
                       placeholder="••••••••"
                       class="w-full pl-xl pr-[52px] py-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary-container/30 focus:border-primary-container outline-none transition-all text-body-md text-on-surface">
                <button type="button"
                        @click="show = !show"
                        class="absolute right-md top-1/2 -translate-y-1/2 text-secondary hover:text-on-surface transition-colors">
                    <span class="material-symbols-outlined text-[20px]" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-xs" />
        </div>

        {{-- Remember me --}}
        <div class="flex items-center gap-sm">
            <input id="remember_me"
                   name="remember"
                   type="checkbox"
                   class="w-5 h-5 rounded border-outline-variant text-primary-container focus:ring-primary-container/20 cursor-pointer">
            <label for="remember_me" class="text-body-sm text-secondary cursor-pointer select-none">
                Keep me signed in
            </label>
        </div>

        {{-- Sign in button --}}
        <button type="submit"
                class="w-full bg-primary-container hover:bg-primary text-white font-semibold text-label-md py-md rounded-lg shadow-sm hover:shadow-md transition-all active:scale-[0.98] flex items-center justify-center gap-sm">
            Sign In
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </button>
    </form>
</x-guest-layout>
