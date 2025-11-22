<!-- Primary Button Component -->
@props([
'type' => 'button',
'href' => null,
'text' => 'Submit',
'icon' => null,
'size' => 'medium',
'submit' => false
])

@php
$sizeClasses = [
'small' => 'btn-primary-sm',
'medium' => 'btn-primary',
'large' => 'btn-primary-lg'
];
$buttonClass = $sizeClasses[$size] ?? 'btn-primary';
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