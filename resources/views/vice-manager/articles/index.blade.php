<x-app-layout>
    <x-slot name="title">Articles | BEA English</x-slot>
    <x-slot name="header">
        <div>
            <h1 class="font-bold text-headline-sm text-on-surface">Articles</h1>
            <p class="text-label-sm text-secondary mt-xs">Browse news articles and posts</p>
        </div>
    </x-slot>

    <form method="GET" action="{{ route('vice-manager.articles.index') }}"
          class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-md mb-md">
        <div class="flex flex-wrap gap-md items-end">
            <div class="flex-1 min-w-[180px]">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide mb-xs">Search</label>
                <div class="relative">
                    <span class="absolute left-sm top-1/2 -translate-y-1/2 text-secondary pointer-events-none">
                        <span class="material-symbols-outlined text-[16px]">search</span>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title..."
                           class="w-full pl-xl border border-outline-variant rounded-lg px-md py-sm text-body-sm bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
                </div>
            </div>
            <div class="w-36 shrink-0">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide mb-xs">Status</label>
                <select name="status" class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm bg-surface-container-lowest focus:border-primary outline-none transition-all">
                    <option value="">All</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft"     {{ request('status') === 'draft'     ? 'selected' : '' }}>Draft</option>
                    <option value="archived"  {{ request('status') === 'archived'  ? 'selected' : '' }}>Archived</option>
                </select>
            </div>
            <div class="w-48 shrink-0">
                <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide mb-xs">Category</label>
                <select name="category_id" class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm bg-surface-container-lowest focus:border-primary outline-none transition-all">
                    <option value="">All categories</option>
                    @foreach($categories as $row)
                    <option value="{{ $row['item']->id }}" {{ request('category_id') == $row['item']->id ? 'selected' : '' }}>
                        {{ str_repeat('— ', $row['depth']) }}{{ $row['item']->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="inline-flex items-center gap-xs px-md py-sm bg-primary-container text-on-primary font-label-md rounded-lg hover:brightness-110 transition-all active:scale-95 shrink-0">
                <span class="material-symbols-outlined text-[16px]">filter_list</span>
                Filter
            </button>
            @if(request()->anyFilled(['search', 'status', 'category_id']))
            <a href="{{ route('vice-manager.articles.index') }}" class="px-md py-sm border border-outline-variant text-secondary font-label-md rounded-lg hover:bg-surface-container-low transition-all shrink-0">
                Clear
            </a>
            @endif
        </div>
    </form>

    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-outline-variant bg-surface-container-low">
                    <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Title</th>
                    <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide hidden md:table-cell">Category</th>
                    <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Status</th>
                    <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide hidden lg:table-cell">Published</th>
                    <th class="px-lg py-md text-right text-label-sm font-semibold text-secondary uppercase tracking-wide">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant">
                @forelse($articles as $article)
                <tr class="hover:bg-surface-container-low transition-colors">
                    <td class="px-lg py-md">
                        <p class="font-medium text-body-sm text-on-surface line-clamp-1">{{ $article->title }}</p>
                        @if($article->excerpt)
                        <p class="text-secondary text-label-sm mt-xs line-clamp-1">{{ $article->excerpt }}</p>
                        @endif
                    </td>
                    <td class="px-lg py-md hidden md:table-cell text-body-sm text-secondary">
                        {{ $article->category?->name ?? '—' }}
                    </td>
                    <td class="px-lg py-md">
                        @php $s = $article->statusBadge(); @endphp
                        <span class="inline-flex items-center px-sm py-0.5 rounded-full text-label-sm font-medium {{ $s['class'] }}">
                            {{ $s['label'] }}
                        </span>
                    </td>
                    <td class="px-lg py-md hidden lg:table-cell text-body-sm text-secondary">
                        {{ $article->published_at ? $article->published_at->format('d/m/Y') : '—' }}
                    </td>
                    <td class="px-lg py-md text-right">
                        <a href="{{ route('vice-manager.articles.show', $article) }}"
                           class="inline-flex items-center gap-xs text-label-sm text-secondary hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                            <span class="material-symbols-outlined text-[16px]">visibility</span>
                            View
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-lg py-2xl text-center text-secondary">No articles yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
        @if($articles->hasPages())
        <div class="px-lg py-md border-t border-outline-variant">
            {{ $articles->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
