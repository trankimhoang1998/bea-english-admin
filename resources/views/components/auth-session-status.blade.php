@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'flex items-center gap-sm px-md py-sm bg-secondary-container/50 border border-secondary-container rounded-lg text-body-sm text-on-surface']) }}>
        <span class="material-symbols-outlined text-[18px] text-primary">info</span>
        {{ $status }}
    </div>
@endif
