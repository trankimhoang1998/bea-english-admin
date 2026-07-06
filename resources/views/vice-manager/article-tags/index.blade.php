<x-app-layout>
    <x-slot name="title">Article Tags | BEA English</x-slot>
    <x-slot name="header">
        <div>
            <h1 class="font-bold text-headline-sm text-on-surface">Article Tags</h1>
            <p class="text-label-sm text-secondary mt-xs">Browse tags for news articles</p>
        </div>
    </x-slot>

    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
        @if($tags->isEmpty())
            <div class="flex flex-col items-center py-2xl text-secondary">
                <span class="material-symbols-outlined text-[48px] mb-md opacity-30">label</span>
                <p class="text-body-md">No tags yet.</p>
            </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-outline-variant bg-surface-container-low">
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Name</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide hidden sm:table-cell">Slug</th>
                        <th class="px-lg py-md text-center text-label-sm font-semibold text-secondary uppercase tracking-wide hidden sm:table-cell">Articles</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @foreach($tags as $tag)
                    <tr class="hover:bg-surface-container-low transition-colors">
                        <td class="px-lg py-md font-medium text-body-sm text-on-surface">{{ $tag->name }}</td>
                        <td class="px-lg py-md hidden sm:table-cell text-body-sm text-secondary font-mono">{{ $tag->slug }}</td>
                        <td class="px-lg py-md hidden sm:table-cell text-center">
                            <span class="inline-flex items-center justify-center min-w-[28px] text-label-sm font-semibold
                                {{ $tag->articles_count > 0 ? 'bg-primary/10 text-primary' : 'bg-surface-container text-secondary' }}
                                px-sm py-xs rounded-full">
                                {{ $tag->articles_count }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($tags->hasPages())
        <div class="px-lg py-md border-t border-outline-variant">
            {{ $tags->links() }}
        </div>
        @endif
        @endif
    </div>
</x-app-layout>
