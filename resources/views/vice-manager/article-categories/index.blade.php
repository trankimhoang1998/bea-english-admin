<x-app-layout>
    <x-slot name="title">Article Categories | BEA English</x-slot>
    <x-slot name="header">
        <div>
            <h1 class="font-bold text-headline-sm text-on-surface">Article Categories</h1>
            <p class="text-label-sm text-secondary mt-xs">Browse news article categories</p>
        </div>
    </x-slot>

    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
        @if($categories->isEmpty())
            <div class="flex flex-col items-center py-2xl text-secondary">
                <span class="material-symbols-outlined text-[48px] mb-md opacity-30">category</span>
                <p class="text-body-md">No categories yet.</p>
            </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-outline-variant bg-surface-container-low">
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Category</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide hidden md:table-cell">Parent</th>
                        <th class="px-lg py-md text-center text-label-sm font-semibold text-secondary uppercase tracking-wide hidden sm:table-cell">Order</th>
                        <th class="px-lg py-md text-center text-label-sm font-semibold text-secondary uppercase tracking-wide hidden sm:table-cell">Articles</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @foreach($categories as $cat)
                    <tr class="hover:bg-surface-container-low transition-colors">
                        <td class="px-lg py-md">
                            <p class="font-medium text-body-sm text-on-surface">{{ $cat->name }}</p>
                            <p class="text-label-sm text-secondary font-mono">{{ $cat->slug }}</p>
                        </td>
                        <td class="px-lg py-md hidden md:table-cell text-body-sm text-secondary">
                            {{ $cat->parent?->name ?? '—' }}
                        </td>
                        <td class="px-lg py-md hidden sm:table-cell text-center text-body-sm text-secondary">
                            {{ $cat->sort_order }}
                        </td>
                        <td class="px-lg py-md hidden sm:table-cell text-center">
                            <span class="inline-flex items-center justify-center min-w-[28px] text-label-sm font-semibold
                                {{ $cat->articles_count > 0 ? 'bg-primary/10 text-primary' : 'bg-surface-container text-secondary' }}
                                px-sm py-xs rounded-full">
                                {{ $cat->articles_count }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</x-app-layout>
