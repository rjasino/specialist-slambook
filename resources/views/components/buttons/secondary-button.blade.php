<!-- Secondary Button Component -->
@props([
'type' => 'button',
'href' => null,
'text' => 'Cancel',
'icon' => null,
'size' => 'medium',
'submit' => false
])

@php
$sizeClasses = [
'small' => 'btn-secondary-sm',
'medium' => 'btn-secondary',
'large' => 'btn-secondary-lg'
];
$buttonClass = $sizeClasses[$size] ?? 'btn-secondary';
$buttonType = $submit ? 'submit' : $type;
@endphp

@if($href)
<a href="{{ $href }}" class="{{ $buttonClass }}" {{ $attributes }}>
    @if($icon)
    {!! $icon !!}
    @endif
    {{ $text }}
    {{ $slot }}
</a>
@else
<button type="{{ $buttonType }}" class="{{ $buttonClass }}" {{ $attributes }}>
    @if($icon)
    {!! $icon !!}
    @endif
    {{ $text }}
    {{ $slot }}
</button>
@endif