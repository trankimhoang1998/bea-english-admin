<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center gap-sm px-lg py-md bg-primary-container border border-transparent rounded-lg font-semibold text-label-md text-white shadow-sm hover:bg-primary focus:outline-none focus:ring-2 focus:ring-primary-container/50 focus:ring-offset-2 active:scale-[0.98] transition-all duration-150']) }}>
    {{ $slot }}
</button>
