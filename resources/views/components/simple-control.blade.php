@props(['run' => 'javascript:void(0)'])

@php
    $classes = 'run inline-flex items-center py-1 px-3 border text-blue-700 border-blue-500 hover:text-gray-900 hover:border-gray-900 transition duration-150 ease-in-out';
@endphp

<button data-run="{{$run}}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
