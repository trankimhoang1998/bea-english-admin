@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full border border-outline-variant rounded-lg px-md py-sm text-body-md text-on-surface bg-surface-container-lowest focus:ring-2 focus:ring-primary-container/30 focus:border-primary-container outline-none transition-all disabled:opacity-50 disabled:cursor-not-allowed']) }}>
