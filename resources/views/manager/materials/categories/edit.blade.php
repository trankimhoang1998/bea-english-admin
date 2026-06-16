<x-app-layout>
    <x-slot name="title">Edit Category | BEA English</x-slot>
    <x-slot name="header">
        <div class="flex items-center gap-md">
            <a href="{{ route('manager.materials.categories.index') }}"
               class="text-secondary hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">Edit Category</h1>
                <p class="text-label-sm text-secondary mt-xs">{{ $category->name }}</p>
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
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('manager.materials.categories.update', $category) }}" class="space-y-lg">
                @csrf @method('PUT')

                <div class="space-y-xs">
                    <label for="name" class="block text-label-md font-semibold text-on-surface">Category Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $category->name) }}" required
                           class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    @error('name')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-xs">
                    <label class="block text-label-sm font-semibold text-secondary uppercase tracking-wide">Slug</label>
                    <div class="px-md py-sm bg-surface-container border border-outline-variant rounded-lg text-body-sm text-secondary font-mono">
                        {{ $category->slug }}
                    </div>
                    <p class="text-label-sm text-secondary">Slug will regenerate automatically if name changes.</p>
                </div>

                <div class="space-y-xs">
                    <label for="parent_id" class="block text-label-md font-semibold text-on-surface">
                        Parent Category <span class="text-secondary font-normal">(optional)</span>
                    </label>
                    <select id="parent_id" name="parent_id"
                            class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                        <option value="">— None (top-level category) —</option>
                        @foreach($parentOptions as $opt)
                            <option value="{{ $opt['id'] }}" {{ old('parent_id', $category->parent_id) == $opt['id'] ? 'selected' : '' }}>
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
                              class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest resize-y">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-xs">
                    <label for="sort_order" class="block text-label-md font-semibold text-on-surface">Sort Order</label>
                    <input id="sort_order" name="sort_order" type="number" min="0" max="999"
                           value="{{ old('sort_order', $category->sort_order) }}"
                           class="w-24 border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    @error('sort_order')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-md pt-sm border-t border-outline-variant">
                    <button type="submit"
                            class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-lg py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Save Changes
                    </button>
                    <a href="{{ route('manager.materials.categories.index') }}"
                       class="text-label-md text-secondary hover:text-on-surface transition-colors">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
