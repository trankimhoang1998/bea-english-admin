<x-app-layout>
    <x-slot name="title">Material Categories | BEA English</x-slot>
    <x-slot name="header">
        <div>
            <h1 class="font-bold text-headline-sm text-on-surface">Material Categories</h1>
            <p class="text-label-sm text-secondary mt-xs">Browse learning material categories</p>
        </div>
    </x-slot>

    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
        @if(empty($tree))
            <div class="flex flex-col items-center py-2xl text-secondary">
                <span class="material-symbols-outlined text-[48px] mb-md opacity-30">folder</span>
                <p class="text-body-md">No categories yet.</p>
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
                                    <div class="flex items-center gap-xs" style="padding-left: {{ $depth * 24 }}px">
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
