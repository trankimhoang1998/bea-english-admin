<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-lg py-sm bg-surface-container border border-outline-variant rounded-lg font-semibold text-label-md text-secondary hover:bg-surface-container-low focus:outline-none focus:ring-2 focus:ring-outline-variant focus:ring-offset-2 disabled:opacity-25 transition-all duration-150 active:scale-[0.98]']) }}>
    {{ $slot }}
</button>
