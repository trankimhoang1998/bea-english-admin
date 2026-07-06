<x-app-layout>
    <x-slot name="title">Article Tags | BEA English</x-slot>
    <x-slot name="header">
        <div class="flex flex-wrap items-center gap-sm justify-between">
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">Article Tags</h1>
                <p class="text-label-sm text-secondary mt-xs">Manage tags for news articles</p>
            </div>
            <a href="{{ route('manager.articles.tags.create') }}"
               class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                <span class="material-symbols-outlined text-[18px]">add</span>
                New Tag
            </a>
        </div>
    </x-slot>

    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
        @if($tags->isEmpty())
            <div class="flex flex-col items-center py-2xl text-secondary">
                <span class="material-symbols-outlined text-[48px] mb-md opacity-30">label</span>
                <p class="text-body-md mb-md">No tags yet.</p>
                <a href="{{ route('manager.articles.tags.create') }}"
                   class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110">
                    <span class="material-symbols-outlined text-[16px]">add</span>
                    Create first tag
                </a>
            </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-outline-variant bg-surface-container-low">
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Name</th>
                        <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide hidden sm:table-cell">Slug</th>
                        <th class="px-lg py-md text-center text-label-sm font-semibold text-secondary uppercase tracking-wide hidden sm:table-cell">Articles</th>
                        <th class="px-lg py-md text-right text-label-sm font-semibold text-secondary uppercase tracking-wide">Actions</th>
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
                        <td class="px-lg py-md">
                            <div class="flex items-center justify-end gap-sm">
                                <a href="{{ route('manager.articles.tags.edit', $tag) }}"
                                   class="inline-flex items-center gap-xs text-label-sm text-primary hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">edit</span>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('manager.articles.tags.destroy', $tag) }}"
                                      onsubmit="return confirm('Delete tag \'{{ addslashes($tag->name) }}\'?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-xs text-label-sm text-error hover:text-on-surface px-sm py-xs rounded-lg hover:bg-error-container/30 transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">delete</span>
                                        Delete
                                    </button>
                                </form>
                            </div>
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
