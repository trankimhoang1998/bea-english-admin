<x-app-layout>
    <x-slot name="title">{{ $article->title }} | BEA English</x-slot>
    <x-slot name="header">
        <div class="flex items-center gap-md min-w-0">
            <a href="{{ route('vice-manager.articles.index') }}"
               class="text-secondary hover:text-on-surface transition-colors shrink-0">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>
            <div class="min-w-0">
                <h1 class="font-bold text-headline-sm text-on-surface line-clamp-1">{{ $article->title }}</h1>
            </div>
        </div>
    </x-slot>

    <div class="grid lg:grid-cols-[1fr_280px] gap-md">

        <div class="space-y-md min-w-0">
            @if($article->thumbnail)
            <div class="rounded-xl overflow-hidden border border-outline-variant">
                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}"
                     class="w-full max-h-80 object-cover">
            </div>
            @endif

            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg overflow-hidden">
                <div class="prose prose-sm max-w-none text-on-surface break-words
                            [&_img]:max-w-full [&_table]:block [&_table]:overflow-x-auto [&_pre]:overflow-x-auto">
                    {!! $article->content !!}
                </div>
            </div>
        </div>

        <div class="space-y-md">
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-md space-y-sm">
                <h3 class="text-label-sm font-semibold text-secondary uppercase tracking-wide">Details</h3>

                <div>
                    <p class="text-label-sm text-secondary">Status</p>
                    @php $s = $article->statusBadge(); @endphp
                    <span class="inline-flex items-center px-sm py-0.5 rounded-full text-label-sm font-medium {{ $s['class'] }}">
                        {{ $s['label'] }}
                    </span>
                </div>

                <div>
                    <p class="text-label-sm text-secondary">Category</p>
                    <p class="text-body-sm text-on-surface">{{ $article->category?->name ?? '—' }}</p>
                </div>

                <div>
                    <p class="text-label-sm text-secondary">Author</p>
                    <p class="text-body-sm text-on-surface">{{ $article->author?->name ?? '—' }}</p>
                </div>

                <div>
                    <p class="text-label-sm text-secondary">Published</p>
                    <p class="text-body-sm text-on-surface">{{ $article->published_at ? $article->published_at->format('d/m/Y H:i') : '—' }}</p>
                </div>

                <div>
                    <p class="text-label-sm text-secondary">Created</p>
                    <p class="text-body-sm text-on-surface">{{ $article->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            @if($article->excerpt)
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-md">
                <h3 class="text-label-sm font-semibold text-secondary uppercase tracking-wide mb-xs">Excerpt</h3>
                <p class="text-body-sm text-on-surface">{{ $article->excerpt }}</p>
            </div>
            @endif

            @if($article->tags->count() > 0)
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-md">
                <h3 class="text-label-sm font-semibold text-secondary uppercase tracking-wide mb-sm">Tags</h3>
                <div class="flex flex-wrap gap-xs">
                    @foreach($article->tags as $tag)
                    <span class="inline-flex items-center px-sm py-0.5 rounded-full text-label-sm bg-surface-container text-secondary">
                        {{ $tag->name }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
