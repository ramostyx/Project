@props([
    'status',
    'colors' => [
    'online'=>'bg-green-500',
    'offline'=>'bg-red-500',
    ],
])

<div {{ $attributes->merge(['class' => "rounded-xl $colors[$status] w-1.5 h-1.5"]) }}></div>
