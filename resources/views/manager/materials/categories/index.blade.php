<x-app-layout>
    <x-slot name="title">Material Categories | BEA English</x-slot>
    <x-slot name="header">
        <div class="flex flex-wrap items-center gap-sm justify-between">
            <div>
                <h1 class="font-bold text-headline-sm text-on-surface">Material Categories</h1>
                <p class="text-label-sm text-secondary mt-xs">Organise learning materials into a category tree</p>
            </div>
            <a href="{{ route('manager.materials.categories.create') }}"
               class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110 transition-all active:scale-95">
                <span class="material-symbols-outlined text-[18px]">add</span>
                New Category
            </a>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="flex items-center gap-sm p-md bg-secondary-container border border-secondary-container rounded-xl mb-md">
            <span class="material-symbols-outlined text-primary text-[18px]">check_circle</span>
            <p class="text-label-md text-on-secondary-container">{{ session('success') }}</p>
        </div>
    @endif

    @if($errors->any())
        <div class="flex items-start gap-sm p-md bg-error-container border border-error/20 rounded-xl mb-md">
            <span class="material-symbols-outlined text-error text-[18px] shrink-0">error</span>
            <div>
                @foreach($errors->all() as $error)
                    <p class="text-label-md text-on-error-container">{{ $error }}</p>
                @endforeach
            </div>
        </div>
    @endif

    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
        @if(empty($tree))
            <div class="flex flex-col items-center py-2xl text-secondary">
                <span class="material-symbols-outlined text-[48px] mb-md opacity-30">folder</span>
                <p class="text-body-md mb-md">No categories yet.</p>
                <a href="{{ route('manager.materials.categories.create') }}"
                   class="inline-flex items-center gap-sm bg-primary-container text-on-primary font-label-md px-md py-sm rounded-lg hover:brightness-110">
                    <span class="material-symbols-outlined text-[16px]">add</span>
                    Create first category
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-outline-variant bg-surface-container-low">
                            <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Category</th>
                            <th class="px-lg py-md text-left text-label-sm font-semibold text-secondary uppercase tracking-wide">Description</th>
                            <th class="px-lg py-md text-center text-label-sm font-semibold text-secondary uppercase tracking-wide">Materials</th>
                            <th class="px-lg py-md text-center text-label-sm font-semibold text-secondary uppercase tracking-wide">Order</th>
                            <th class="px-lg py-md text-right text-label-sm font-semibold text-secondary uppercase tracking-wide">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @foreach($tree as $row)
                            @php
                                $cat   = $row['item'];
                                $depth = $row['depth'];
                                $isRoot = $depth === 0;
                            @endphp
                            <tr class="hover:bg-surface-container-low transition-colors {{ $isRoot ? 'bg-surface-container-low/40' : '' }}">
                                <td class="px-lg py-md">
                                    <div class="flex items-center gap-xs"
                                         style="padding-left: {{ $depth * 24 }}px">
                                        @if($depth === 0)
                                            <span class="material-symbols-outlined text-[16px] text-primary shrink-0">folder</span>
                                        @else
                                            <span class="text-secondary text-label-sm shrink-0 select-none">└─</span>
                                            <span class="material-symbols-outlined text-[16px] text-secondary shrink-0">folder_open</span>
                                        @endif
                                        <div>
                                            <span class="{{ $isRoot ? 'font-bold text-body-sm text-on-surface' : 'font-medium text-body-sm text-on-surface' }}">
                                                {{ $cat->name }}
                                            </span>
                                            <p class="text-label-sm text-secondary font-mono">{{ $cat->slug }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-lg py-md">
                                    @if($cat->description)
                                        <span class="text-body-sm text-secondary truncate block max-w-xs">{{ $cat->description }}</span>
                                    @else
                                        <span class="text-label-sm text-secondary/50">—</span>
                                    @endif
                                </td>
                                <td class="px-lg py-md text-center">
                                    <span class="inline-flex items-center justify-center min-w-[28px] text-label-sm font-semibold
                                        {{ $cat->materials_count > 0 ? 'bg-primary/10 text-primary' : 'bg-surface-container text-secondary' }}
                                        px-sm py-xs rounded-full">
                                        {{ $cat->materials_count }}
                                    </span>
                                </td>
                                <td class="px-lg py-md text-center text-body-sm text-secondary">
                                    {{ $cat->sort_order }}
                                </td>
                                <td class="px-lg py-md">
                                    <div class="flex items-center justify-end gap-sm">
                                        <a href="{{ route('manager.materials.categories.edit', $cat) }}"
                                           class="inline-flex items-center gap-xs text-label-sm text-primary hover:text-on-surface px-sm py-xs rounded-lg hover:bg-surface-container transition-colors">
                                            <span class="material-symbols-outlined text-[16px]">edit</span>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('manager.materials.categories.destroy', $cat) }}"
                                              onsubmit="return confirm('Delete category \'{{ addslashes($cat->name) }}\'?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center gap-xs text-label-sm text-error hover:text-on-surface px-sm py-xs rounded-lg hover:bg-error-container/30 transition-colors">
                                                <span class="material-symbols-outlined text-[16px]">delete</span>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
