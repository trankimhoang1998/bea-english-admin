@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-label-sm text-error space-y-xs']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
