@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-label-md font-semibold text-secondary']) }}>
    {{ $value ?? $slot }}
</label>
