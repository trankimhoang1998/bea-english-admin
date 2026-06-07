<x-app-layout>
    <x-slot name="header">
        <h1 class="font-bold text-headline-sm text-on-surface">Dashboard</h1>
    </x-slot>

    <div class="flex items-center justify-center min-h-[60vh]">
        <div class="text-center">
            <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mx-auto mb-lg">
                <span class="material-symbols-outlined text-primary text-[32px]">school</span>
            </div>
            <h2 class="font-bold text-headline-sm text-on-surface mb-xs">You're logged in!</h2>
            <p class="text-body-md text-secondary">Welcome to BEA English LMS.</p>
        </div>
    </div>
</x-app-layout>
