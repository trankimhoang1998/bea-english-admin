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

                {{-- Material (Upload File or Paste Link) --}}
                @php $initMaterialType = old('material_type', $material->material_link ? 'link' : 'file'); @endphp
                <div class="space-y-sm" x-data="{ tab: '{{ $initMaterialType }}' }">
                    <label class="block text-label-md font-semibold text-on-surface">Material</label>
                    <input type="hidden" name="material_type" :value="tab">

                    {{-- Tab buttons --}}
                    <div class="flex gap-xs bg-surface-container rounded-lg p-xs w-fit">
                        <button type="button"
                                @click="tab = 'file'"
                                :class="tab === 'file' ? 'bg-surface-container-highest text-on-surface shadow-sm' : 'text-secondary hover:text-on-surface'"
                                class="inline-flex items-center gap-xs px-md py-sm rounded-md text-label-md font-medium transition-all">
                            <span class="material-symbols-outlined text-[16px]">upload_file</span>
                            Upload File
                        </button>
                        <button type="button"
                                @click="tab = 'link'"
                                :class="tab === 'link' ? 'bg-surface-container-highest text-on-surface shadow-sm' : 'text-secondary hover:text-on-surface'"
                                class="inline-flex items-center gap-xs px-md py-sm rounded-md text-label-md font-medium transition-all">
                            <span class="material-symbols-outlined text-[16px]">link</span>
                            Paste Link
                        </button>
                    </div>

                    {{-- Upload File panel --}}
                    <div x-show="tab === 'file'">
                        @if($material->file_path)
                            <div class="flex items-center gap-sm p-sm bg-surface-container border border-outline-variant rounded-lg mb-sm">
                                <span class="material-symbols-outlined text-secondary text-[18px]">description</span>
                                <p class="text-label-sm text-on-surface truncate flex-1">{{ basename($material->file_path) }}</p>
                                <span class="text-label-sm text-secondary shrink-0">Upload a new file to replace it.</span>
                            </div>
                        @endif
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

                    {{-- Paste Link panel --}}
                    <div x-show="tab === 'link'">
                        <input id="material_link" name="material_link" type="url"
                               value="{{ old('material_link', $material->material_link) }}"
                               placeholder="https://drive.google.com/..."
                               class="w-full border border-outline-variant rounded-lg px-md py-sm focus:border-primary focus:ring-1 focus:ring-primary/20 outline-none transition-all text-body-sm text-on-surface bg-surface-container-lowest">
                        <p class="mt-xs text-label-sm text-secondary">Paste a Google Drive, OneDrive, YouTube, or any public URL.</p>
                        @error('material_link')
                            <p class="text-label-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Student Access --}}
                @php $initIds = old('student_ids') !== null ? array_map('intval', (array) old('student_ids')) : $assignedIds; @endphp
                <div class="space-y-xs"
                     x-data="{
                         search: '',
                         selected: {{ json_encode($initIds) }},
                         options: {{ $students->map(fn($s) => ['id' => $s->id, 'name' => $s->user->name, 'code' => $s->student_id])->values()->toJson() }},
                         get filtered() {
                             if (!this.search) return this.options;
                             const q = this.search.toLowerCase();
                             return this.options.filter(o => o.name.toLowerCase().includes(q) || o.code.toLowerCase().includes(q));
                         },
                         toggle(id) {
                             const i = this.selected.indexOf(id);
                             i === -1 ? this.selected.push(id) : this.selected.splice(i, 1);
                         },
                         isSelected(id) { return this.selected.includes(id); }
                     }">
                    <label class="block text-label-md font-semibold text-on-surface">
                        Student Access
                        <span class="text-secondary font-normal">(leave empty = all students can access)</span>
                    </label>

                    {{-- Hidden inputs for selected --}}
                    <template x-for="id in selected" :key="id">
                        <input type="hidden" name="student_ids[]" :value="id">
                    </template>

                    {{-- Selected chips --}}
                    <div class="flex flex-wrap gap-xs min-h-[32px]" x-show="selected.length > 0">
                        <template x-for="id in selected" :key="id">
                            <span class="inline-flex items-center gap-xs bg-primary/10 text-primary text-label-sm px-sm py-xs rounded-full">
                                <span x-text="options.find(o => o.id === id)?.name + ' (' + options.find(o => o.id === id)?.code + ')'"></span>
                                <button type="button" @click="toggle(id)" class="hover:text-error transition-colors">
                                    <span class="material-symbols-outlined text-[14px]">close</span>
                                </button>
                            </span>
                        </template>
                    </div>

                    {{-- Search + list --}}
                    <div class="border border-outline-variant rounded-lg overflow-hidden">
                        <div class="relative border-b border-outline-variant">
                            <span class="absolute left-sm top-1/2 -translate-y-1/2 text-secondary pointer-events-none">
                                <span class="material-symbols-outlined text-[16px]">search</span>
                            </span>
                            <input type="text" x-model="search" placeholder="Search by name or student ID..."
                                   class="w-full pl-xl pr-md py-sm text-body-sm text-on-surface bg-surface-container-lowest outline-none">
                        </div>
                        <div class="max-h-48 overflow-y-auto divide-y divide-outline-variant">
                            <template x-if="filtered.length === 0">
                                <div class="px-md py-sm text-label-sm text-secondary">No students found.</div>
                            </template>
                            <template x-for="opt in filtered" :key="opt.id">
                                <label class="flex items-center gap-sm px-md py-sm hover:bg-surface-container-low cursor-pointer transition-colors">
                                    <input type="checkbox" :checked="isSelected(opt.id)" @change="toggle(opt.id)"
                                           class="rounded border-outline-variant text-primary focus:ring-primary/20 shrink-0">
                                    <span class="text-body-sm text-on-surface" x-text="opt.name"></span>
                                    <span class="text-label-sm text-secondary ml-auto shrink-0" x-text="opt.code"></span>
                                </label>
                            </template>
                        </div>
                        <div class="px-md py-xs border-t border-outline-variant bg-surface-container-low/40 flex items-center justify-between">
                            <span class="text-label-sm text-secondary" x-text="selected.length === 0 ? 'All students' : selected.length + ' student(s) selected'"></span>
                            <button type="button" x-show="selected.length > 0" @click="selected = []"
                                    class="text-label-sm text-secondary hover:text-error transition-colors">Clear all</button>
                        </div>
                    </div>
                    @error('student_ids')
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
