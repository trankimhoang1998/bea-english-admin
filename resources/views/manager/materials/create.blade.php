<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-md">
            <a href="{{ route('manager.materials.index') }}"
               class="text-secondary hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">Upload Material</h1>
                <p class="text-label-sm text-secondary mt-xs">Add a new learning resource for students</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-lg">
            <form method="POST" action="{{ route('manager.materials.store') }}" enctype="multipart/form-data" class="space-y-lg">
                @csrf

                {{-- Title --}}
                <div class="space-y-xs">
                    <label for="title" class="block text-label-md font-semibold text-on-surface">Title</label>
                    <input id="title" name="title" type="text"
                           value="{{ old('title') }}" required
                           placeholder="e.g. Unit 5 Vocabulary List"
                           class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                    @error('title')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- File --}}
                <div class="space-y-xs">
                    <label for="file" class="block text-label-md font-semibold text-on-surface">File</label>
                    <div class="border-2 border-dashed border-outline-variant rounded-xl p-lg text-center hover:border-primary transition-colors cursor-pointer">
                        <span class="material-symbols-outlined text-[40px] text-secondary mb-sm block">upload_file</span>
                        <p class="text-body-sm text-on-surface mb-xs">Click to upload or drag and drop</p>
                        <p class="text-label-sm text-secondary">PDF, DOC, DOCX, PPT, XLSX, JPG, PNG, MP3, MP4, ZIP &mdash; max 50 MB</p>
                        <input id="file" name="file" type="file" required
                               class="mt-md block w-full text-body-sm text-secondary
                                      file:mr-md file:py-sm file:px-md
                                      file:rounded-lg file:border-0
                                      file:text-label-md file:font-semibold
                                      file:bg-primary-container file:text-on-primary
                                      hover:file:brightness-110 cursor-pointer">
                    </div>
                    @error('file')
                        <p class="text-label-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-md pt-sm border-t border-outline-variant">
                    <button type="submit"
                            class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-lg py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">upload</span>
                        Upload Material
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
