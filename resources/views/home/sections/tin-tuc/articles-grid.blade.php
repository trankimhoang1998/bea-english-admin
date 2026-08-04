<section class="bg-white pt-4 pb-8 lg:pt-8 lg:pb-24">
    <div class="max-w-7xl mx-auto px-5 lg:px-16">

        {{-- Category filter tabs --}}
        @if($categories->count() > 0)
        <div class="flex flex-wrap gap-1.5 lg:gap-2 mb-5 lg:mb-10">
            <a href="{{ route('home.tin-tuc') }}"
               class="px-3.5 py-1.5 lg:px-5 lg:py-2 rounded-full text-[12px] lg:text-[13px] font-bold transition-all
                      {{ !request('category_id') ? 'bg-primary-container text-white' : 'bg-gray-100 text-gray-600 hover:bg-orange-50 hover:text-primary-container' }}">
                Tất cả
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('home.tin-tuc', ['category_id' => $cat->id]) }}"
               class="px-3.5 py-1.5 lg:px-5 lg:py-2 rounded-full text-[12px] lg:text-[13px] font-bold transition-all
                      {{ request('category_id') == $cat->id ? 'bg-primary-container text-white' : 'bg-gray-100 text-gray-600 hover:bg-orange-50 hover:text-primary-container' }}">
                {{ $cat->name }}
            </a>
            @endforeach
        </div>
        @endif

        {{-- Article grid --}}
        @if($articles->count() > 0)
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-5 lg:gap-6 lg:mb-10">
            @foreach($articles as $article)
            <a href="{{ route('home.article-detail', $article->slug) }}"
               class="group bg-white border border-gray-100 rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 flex flex-col">

                {{-- Thumbnail --}}
                <div class="relative aspect-[16/9] bg-gradient-to-br from-orange-50 to-orange-100 overflow-hidden">
                    @if($article->thumbnail)
                    <img src="{{ asset('storage/' . $article->thumbnail) }}"
                         alt="{{ $article->title }}"
                         loading="lazy"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="material-symbols-outlined ms-filled text-primary-container/40 text-[64px]">article</span>
                    </div>
                    @endif
                    @if($article->category)
                    <span class="absolute top-3 left-3 bg-primary-container text-white text-[11px] font-bold px-3 py-1 rounded-full">
                        {{ $article->category->name }}
                    </span>
                    @endif
                </div>

                {{-- Content --}}
                <div class="p-4 lg:p-5 flex flex-col flex-1">
                    <h2 class="font-black text-on-background text-[15px] lg:text-[16px] leading-snug mb-1.5 lg:mb-2 line-clamp-2 group-hover:text-primary-container transition-colors">
                        {{ $article->title }}
                    </h2>
                    @if($article->excerpt)
                    <p class="text-gray-500 text-[12.5px] lg:text-[13px] leading-relaxed mb-3 lg:mb-4 line-clamp-3 flex-1">{{ $article->excerpt }}</p>
                    @endif

                    @if($article->tags->count() > 0)
                    <div class="flex items-center justify-end mt-auto pt-2.5 lg:pt-3 border-t border-gray-100">
                        <div class="flex gap-1 flex-wrap justify-end">
                            @foreach($article->tags->take(2) as $tag)
                            <span class="bg-orange-50 text-primary-container text-[11px] px-2 py-0.5 rounded-full font-medium">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($articles->hasPages())
        <div class="flex justify-center">
            {{ $articles->links() }}
        </div>
        @endif

        @else
        <div class="text-center py-20">
            <span class="material-symbols-outlined text-gray-200 text-[80px] mb-4 block">article</span>
            <p class="text-gray-400 text-[16px]">Chưa có bài viết nào.</p>
        </div>
        @endif
    </div>
</section>
