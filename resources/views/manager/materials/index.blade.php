<x-app-layout>
    <x-slot name="title">Learning Materials | BEA English</x-slot>
    <x-slot name="header">
        <div class="flex flex-wrap items-center gap-sm justify-between">
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">Learning Materials</h1>
                <p class="text-label-sm text-secondary mt-xs">Upload and manage teaching resources</p>
            </div>
            <a href="{{ route('manager.materials.create') }}"
               class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                <span class="material-symbols-outlined text-[18px]">upload_file</span>
                Upload Material
            </a>
        </div>
    </x-slot>

    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
        @if($materials->isEmpty())
            <div class="flex flex-col items-center py-2xl text-secondary">
                <span class="material-symbols-outlined text-[48px] mb-md opacity-30">folder_open</span>
                <p class="text-body-md mb-md">No materials uploaded yet.</p>
                <a href="{{ route('manager.materials.create') }}"
                   class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all">
                    <span class="material-symbols-outlined text-[16px]">upload_file</span>
                    Upload first material
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-outline-variant bg-surface-container-low">
                            <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Title</th>
                            <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Uploaded By</th>
                            <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Date</th>
                            <th class="px-lg py-md text-right text-label-sm font-semibold text-secondary uppercase tracking-wide">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @foreach($materials as $material)
                            <tr class="hover:bg-surface-container-low transition-colors">
                                <td class="px-lg py-md">
                                    <div class="flex items-center gap-md">
                                        <div class="w-9 h-9 rounded-lg bg-surface-container flex items-center justify-center shrink-0">
                                            <span class="material-symbols-outlined text-[18px] text-secondary">description</span>
                                        </div>
                                        <div>
                                            <span class="font-semibold text-body-sm text-on-surface">{{ $material->title }}</span>
                                            @if($material->description)
                                                <p class="text-label-sm text-secondary mt-xs">{{ $material->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-lg py-md text-body-sm text-secondary">{{ $material->uploader->name ?? '—' }}</td>
                                <td class="px-lg py-md text-body-sm text-secondary whitespace-nowrap">{{ $material->created_at->format('d/m/Y') }}</td>
                                <td class="px-lg py-md">
                                    <div class="flex items-center justify-end gap-sm">
                                        <a href="{{ route('manager.materials.edit', $material) }}"
                                           class="inline-flex items-center gap-xs text-label-sm text-primary hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                                            <span class="material-symbols-outlined text-[16px]">edit</span>
                                            Edit
                                        </a>
                                        <a href="{{ route('manager.materials.download', $material) }}"
                                           class="inline-flex items-center gap-xs text-label-sm text-primary hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                                            <span class="material-symbols-outlined text-[16px]">download</span>
                                            Download
                                        </a>
                                        <form id="del-material-{{ $material->id }}" method="POST" action="{{ route('manager.materials.destroy', $material) }}">
                                            @csrf @method('DELETE')
                                        </form>
                                        <button type="button"
                                                @click="$store.confirmModal.show('Delete &quot;{{ addslashes($material->title) }}&quot;? The file will also be removed from storage.', 'del-material-{{ $material->id }}')"
                                                class="inline-flex items-center gap-xs text-label-sm text-error hover:text-on-surface px-sm py-xs rounded-lg hover:bg-error-container/30 transition-colors">
                                            <span class="material-symbols-outlined text-[16px]">delete</span>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($materials->hasPages())
                <div class="px-lg py-md border-t border-outline-variant">
                    {{ $materials->links() }}
                </div>
            @endif
        @endif
    </div>
</x-app-layout>
