<x-app-layout>
    <x-slot name="title">New Tag | BEA English</x-slot>
    <x-slot name="header">
        <div class="flex items-center gap-md">
            <a href="{{ route('manager.articles.tags.index') }}"
               class="text-secondary hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">New Tag</h1>
                <p class="text-label-sm text-secondary mt-xs">Add a tag to classify news articles</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-sm">
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-lg">
            @if($errors->any())
            <div class="flex items-start gap-sm p-md bg-error-container border border-error/20 rounded-xl mb-lg">
                <span class="material-symbols-outlined text-error text-[20px] shrink-0 mt-xs">error</span>
                <div>
                    <p class="text-label-md font-semibold text-on-error-container mb-xs">Please fix the following errors:</p>
                    <ul class="list-disc list-inside text-label-sm text-on-error-container space-y-xs">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            </div>
            @endif

            <form method="POST" action="{{ route('manager.articles.tags.store') }}" class="space-y-lg">
                @csrf

                <div class="space-y-xs">
                    <label for="name" class="block text-label-md font-semibold text-on-surface">Tag Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required maxlength="80"
                           placeholder="e.g. IELTS"
                           class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    @error('name')<p class="text-label-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="flex items-center gap-md pt-sm border-t border-outline-variant">
                    <button type="submit"
                            class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-lg py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Create Tag
                    </button>
                    <a href="{{ route('manager.articles.tags.index') }}"
                       class="text-label-md text-secondary hover:text-on-surface transition-colors">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
