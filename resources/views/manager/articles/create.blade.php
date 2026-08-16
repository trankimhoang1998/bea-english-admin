<x-app-layout>
    <x-slot name="title">New Article | BEA English</x-slot>
    <x-slot name="header">
        <div class="flex items-center gap-md">
            <a href="{{ route('manager.articles.index') }}"
               class="text-secondary hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">New Article</h1>
                <p class="text-label-sm text-secondary mt-xs">Create a new news article or post</p>
            </div>
        </div>
    </x-slot>

    @if($errors->any())
    <div class="flex items-start gap-sm p-md bg-error-container border border-error/20 rounded-xl mb-md">
        <span class="material-symbols-outlined text-error text-[20px] shrink-0 mt-xs">error</span>
        <div>
            <p class="text-label-md font-semibold text-on-error-container mb-xs">Please fix the following errors:</p>
            <ul class="list-disc list-inside text-label-sm text-on-error-container space-y-xs">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    </div>
    @endif

    <form method="POST" action="{{ route('manager.articles.store') }}" enctype="multipart/form-data" id="articleForm">
        @csrf
        <div class="grid lg:grid-cols-[1fr_300px] gap-md">

            {{-- Left: main content --}}
            <div class="space-y-md">

                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-md">
                    <label class="block text-label-md font-semibold text-on-surface mb-xs">Title <span class="text-error">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-md bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all">
                </div>

                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-md">
                    <label class="block text-label-md font-semibold text-on-surface mb-xs">Excerpt <span class="text-secondary font-normal">(optional)</span></label>
                    <textarea name="excerpt" rows="3" maxlength="500"
                              class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-md bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all resize-none">{{ old('excerpt') }}</textarea>
                </div>

                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden">
                    <div class="border-b border-outline-variant px-md py-sm">
                        <p class="text-label-md font-semibold text-on-surface">Content <span class="text-error">*</span></p>
                    </div>
                    <div id="content-editor" style="min-height:320px;"></div>
                    <input type="hidden" name="content" id="content-input">
                </div>

            </div>

            {{-- Right: sidebar --}}
            <div class="space-y-md">

                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-md">
                    <label class="block text-label-md font-semibold text-on-surface mb-xs">Status</label>
                    <select name="status" class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm bg-surface-container-lowest focus:border-primary outline-none transition-all mb-md">
                        <option value="draft"     {{ old('status', 'draft') === 'draft'     ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') === 'published'           ? 'selected' : '' }}>Published</option>
                        <option value="archived"  {{ old('status') === 'archived'            ? 'selected' : '' }}>Archived</option>
                    </select>
                    <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-sm bg-primary-container text-on-primary font-label-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Save Article
                    </button>
                </div>

                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-md">
                    <label class="block text-label-md font-semibold text-on-surface mb-xs">Category</label>
                    <select name="article_category_id" class="w-full border border-outline-variant rounded-lg px-md py-sm text-body-sm bg-surface-container-lowest focus:border-primary outline-none transition-all">
                        <option value="">— No category —</option>
                        @foreach($categories as $row)
                        <option value="{{ $row['item']->id }}" {{ old('article_category_id') == $row['item']->id ? 'selected' : '' }}>
                            {{ str_repeat('— ', $row['depth']) }}{{ $row['item']->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-md">
                    <label class="block text-label-md font-semibold text-on-surface mb-sm">Tags</label>
                    <div class="flex flex-wrap gap-xs">
                        @foreach($tags as $tag)
                        <label class="inline-flex items-center gap-xs cursor-pointer">
                            <input type="checkbox" name="tag_ids[]" value="{{ $tag->id }}"
                                   {{ in_array($tag->id, old('tag_ids', [])) ? 'checked' : '' }}
                                   class="rounded border-outline-variant text-primary-container focus:ring-primary/20">
                            <span class="text-body-sm text-on-surface">{{ $tag->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-md">
                    <label class="block text-label-md font-semibold text-on-surface mb-sm">Thumbnail</label>
                    <div id="thumb-drop-create" onclick="document.getElementById('thumb-input-create').click()"
                         class="relative w-full rounded-xl border-2 border-dashed border-outline-variant hover:border-primary cursor-pointer transition-all overflow-hidden group"
                         style="min-height:140px;">
                        <img id="thumb-preview-create" src="" alt="" class="hidden w-full h-40 object-cover">
                        <div id="thumb-placeholder-create" class="flex flex-col items-center justify-center gap-sm py-xl text-secondary group-hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-[36px]">add_photo_alternate</span>
                            <span class="text-label-sm">Click to upload thumbnail</span>
                        </div>
                    </div>
                    <div id="thumb-actions-create" class="hidden mt-xs items-center gap-xs">
                        <button type="button" onclick="document.getElementById('thumb-input-create').click()"
                                class="inline-flex items-center gap-xs px-sm py-xs rounded-lg text-label-sm text-secondary hover:text-on-surface hover:bg-surface-container transition-colors">
                            <span class="material-symbols-outlined text-[16px]">photo_camera</span>
                            Change
                        </button>
                        <button type="button" id="thumb-remove-create"
                                class="inline-flex items-center gap-xs px-sm py-xs rounded-lg text-label-sm text-error hover:bg-error-container/30 transition-colors ml-auto">
                            <span class="material-symbols-outlined text-[16px]">delete</span>
                            Remove
                        </button>
                    </div>
                    <input type="file" id="thumb-input-create" name="thumbnail" accept="image/*" class="hidden">
                </div>

            </div>
        </div>
    </form>

    @include('manager.articles._ckeditor', ['initialContent' => old('content', '')])
    <script>
        (function () {
            const input    = document.getElementById('thumb-input-create');
            const preview  = document.getElementById('thumb-preview-create');
            const holder   = document.getElementById('thumb-placeholder-create');
            const actions  = document.getElementById('thumb-actions-create');
            const removBtn = document.getElementById('thumb-remove-create');

            function showImage() {
                preview.classList.remove('hidden');
                holder.classList.add('hidden');
                actions.classList.remove('hidden');
                actions.classList.add('flex');
            }

            function clearImage() {
                preview.src = '';
                preview.classList.add('hidden');
                holder.classList.remove('hidden');
                actions.classList.add('hidden');
                actions.classList.remove('flex');
                input.value = '';
            }

            input.addEventListener('change', () => {
                const file = input.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = e => { preview.src = e.target.result; showImage(); };
                reader.readAsDataURL(file);
            });

            removBtn.addEventListener('click', e => { e.stopPropagation(); clearImage(); });
        })();
    </script>
</x-app-layout>
