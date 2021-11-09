@props(['to' => '#'])

@php
$classes = 'inline-flex items-center py-1 px-3 border text-grey-500 border-grey-300 hover:text-gray-900 hover:border-gray-900 transition duration-150 ease-in-out';
@endphp

<a href="{{$to}}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
