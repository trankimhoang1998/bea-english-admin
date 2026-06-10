<x-app-layout>
    <x-slot name="title">{{ $material->title }} | BEA English</x-slot>
    <x-slot name="header">
        <div class="flex items-center gap-md">
            <a href="{{ route('manager.materials.index') }}"
               class="text-secondary hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">Edit Material</h1>
                <p class="text-label-sm text-secondary mt-xs">{{ $material->title }}</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-lg">
            <form method="POST" action="{{ route('manager.materials.update', $material) }}" enctype="multipart/form-data" class="space-y-lg">
                @csrf @method('PUT')

                {{-- Title --}}
                <div class="space-y-xs">
                    <label for="title" class="block text-label-md font-semibold text-on-surface">Title</label>
                    <input id="title" name="title" type="text"
                           value="{{ old('title', $material->title) }}" required
                           class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    @error('title')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="space-y-xs">
                    <label for="description" class="block text-label-md font-semibold text-on-surface">
                        Description <span class="text-secondary font-normal">(optional)</span>
                    </label>
                    <textarea id="description" name="description" rows="3"
                              class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest resize-y">{{ old('description', $material->description) }}</textarea>
                    @error('description')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- File --}}
                <div class="space-y-xs">
                    <label for="file" class="block text-label-md font-semibold text-on-surface">
                        Replace File <span class="text-secondary font-normal">(leave blank to keep current)</span>
                    </label>
                    <div class="flex items-center gap-sm p-sm bg-surface-container border border-outline-variant rounded-lg mb-sm">
                        <span class="material-symbols-outlined text-secondary text-[18px]">description</span>
                        <p class="text-label-sm text-on-surface truncate">{{ basename($material->file_path) }}</p>
                    </div>
                    <div class="border border-dashed border-outline-variant rounded-xl p-md">
                        <input id="file" name="file" type="file"
                               class="block w-full text-body-sm text-secondary
                                      file:mr-md file:py-xs file:px-md
                                      file:rounded-lg file:border-0
                                      file:text-label-sm file:font-semibold
                                      file:bg-surface-container file:text-secondary
                                      hover:file:bg-surface-container-high cursor-pointer">
                        <p class="mt-xs text-label-sm text-secondary">PDF, DOC, DOCX, PPT, XLSX, JPG, PNG, MP3, MP4, ZIP &mdash; max 50 MB</p>
                    </div>
                    @error('file')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-md pt-sm border-t border-outline-variant">
                    <button type="submit"
                            class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-lg py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Update Material
                    </button>
                    <a href="{{ route('manager.materials.index') }}"
                       class="text-label-md text-secondary hover:text-on-surface transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
