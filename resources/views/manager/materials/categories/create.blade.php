<x-app-layout>
    <x-slot name="title">New Category | BEA English</x-slot>
    <x-slot name="header">
        <div class="flex items-center gap-md">
            <a href="{{ route('manager.materials.categories.index') }}"
               class="text-secondary hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">New Category</h1>
                <p class="text-label-sm text-secondary mt-xs">Add a category to organise learning materials</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-lg">
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-lg">
            <form method="POST" action="{{ route('manager.materials.categories.store') }}" class="space-y-lg">
                @csrf

                <div class="space-y-xs">
                    <label for="name" class="block text-label-md font-semibold text-on-surface">Category Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required
                           placeholder="e.g. Ngữ pháp"
                           class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    @error('name')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-xs">
                    <label for="parent_id" class="block text-label-md font-semibold text-on-surface">
                        Parent Category <span class="text-secondary font-normal">(optional)</span>
                    </label>
                    <select id="parent_id" name="parent_id"
                            class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                        <option value="">— None (top-level category) —</option>
                        @foreach($parentOptions as $opt)
                            <option value="{{ $opt['id'] }}" {{ old('parent_id') == $opt['id'] ? 'selected' : '' }}>
                                {{ $opt['label'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-xs">
                    <label for="description" class="block text-label-md font-semibold text-on-surface">
                        Description <span class="text-secondary font-normal">(optional)</span>
                    </label>
                    <textarea id="description" name="description" rows="3"
                              placeholder="Brief description of this category..."
                              class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest resize-y">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-xs">
                    <label for="sort_order" class="block text-label-md font-semibold text-on-surface">
                        Sort Order <span class="text-secondary font-normal">(optional, default 0)</span>
                    </label>
                    <input id="sort_order" name="sort_order" type="number" min="0" max="999"
                           value="{{ old('sort_order', 0) }}"
                           class="w-24 border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    <p class="text-label-sm text-secondary">Lower number appears first among siblings.</p>
                    @error('sort_order')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-md pt-sm border-t border-outline-variant">
                    <button type="submit"
                            class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-lg py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Create Category
                    </button>
                    <a href="{{ route('manager.materials.categories.index') }}"
                       class="text-label-md text-secondary hover:text-on-surface transition-colors">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
