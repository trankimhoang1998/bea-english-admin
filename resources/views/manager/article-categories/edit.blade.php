<x-app-layout>
    <x-slot name="title">Edit Article Category | BEA English</x-slot>
    <x-slot name="header">
        <div class="flex items-center gap-md">
            <a href="{{ route('manager.articles.categories.index') }}"
               class="text-secondary hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">Edit Article Category</h1>
                <p class="text-label-sm text-secondary mt-xs">{{ $articleCategory->name }}</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-lg">
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

            <form method="POST" action="{{ route('manager.articles.categories.update', $articleCategory) }}" class="space-y-lg">
                @csrf @method('PUT')

                <div class="space-y-xs">
                    <label for="name" class="block text-label-md font-semibold text-on-surface">Category Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $articleCategory->name) }}" required maxlength="100"
                           class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    @error('name')<p class="text-label-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="space-y-xs">
                    <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Slug</label>
                    <div class="px-md py-sm bg-surface-container border border-outline-variant rounded-lg text-body-sm text-secondary font-mono">
                        {{ $articleCategory->slug }}
                    </div>
                    <p class="text-label-sm text-secondary">Slug regenerates automatically when name changes.</p>
                </div>

                <div class="space-y-xs">
                    <label for="parent_id" class="block text-label-md font-semibold text-on-surface">
                        Parent Category <span class="text-secondary font-normal">(optional)</span>
                    </label>
                    <select id="parent_id" name="parent_id"
                            class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                        <option value="">— None (top-level) —</option>
                        @foreach($parents as $row)
                        <option value="{{ $row['item']->id }}" {{ old('parent_id', $articleCategory->parent_id) == $row['item']->id ? 'selected' : '' }}>
                            {{ str_repeat('— ', $row['depth']) }}{{ $row['item']->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('parent_id')<p class="text-label-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="space-y-xs">
                    <label for="sort_order" class="block text-label-md font-semibold text-on-surface">Sort Order</label>
                    <input id="sort_order" name="sort_order" type="number" min="0" max="999"
                           value="{{ old('sort_order', $articleCategory->sort_order) }}"
                           class="w-24 border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    @error('sort_order')<p class="text-label-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="flex items-center gap-md pt-sm border-t border-outline-variant">
                    <button type="submit"
                            class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-lg py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Save Changes
                    </button>
                    <a href="{{ route('manager.articles.categories.index') }}"
                       class="text-label-md text-secondary hover:text-on-surface transition-colors">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
