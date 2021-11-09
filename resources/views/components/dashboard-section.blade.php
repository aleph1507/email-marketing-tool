@props(['route1' => '#', 'slot1' => '',
        'route2' => '#', 'slot2' => ''])

@php
    $divClasses = 'flex flex-col md:flex-row justify-evenly align-middle items-center py-5 border-b';
    $linkClasses = 'px-6 py-3 w-4/6 md:w-1/3 text-center justify-center';
@endphp

<div {{ $attributes->merge(['class' => $divClasses]) }}>
    <x-simple-link to="{{route($route1)}}" {{ $attributes->merge(['class' => $linkClasses]) }}>{{$slot1}}</x-simple-link>
    or
    <x-simple-link to="{{route($route2)}}" {{ $attributes->merge(['class' => $linkClasses]) }}>{{$slot2}}</x-simple-link>
</div>
