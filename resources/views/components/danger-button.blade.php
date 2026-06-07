<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-lg py-sm bg-error border border-transparent rounded-lg font-semibold text-label-md text-on-error hover:brightness-110 focus:outline-none focus:ring-2 focus:ring-error/50 focus:ring-offset-2 disabled:opacity-25 transition-all duration-150 active:scale-[0.98]']) }}>
    {{ $slot }}
</button>
