@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'color' => null,
    'icon' => null,
    'iconPosition' => 'left',
    'tag' => 'button',
    'href' => null,
])

@php
    $baseClasses = 'inline-flex items-center font-medium rounded-lg shadow-lg transition-all duration-200';
    
    // Color-based gradient variants
    $colorGradients = [
        'red' => 'bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white shadow-red-600/30 hover:shadow-red-600/50 hover:-translate-y-0.5',
        'blue' => 'bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white shadow-blue-600/30 hover:shadow-blue-600/50 hover:-translate-y-0.5',
        'green' => 'bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white shadow-green-600/30 hover:shadow-green-600/50 hover:-translate-y-0.5',
        'purple' => 'bg-gradient-to-r from-purple-600 to-violet-600 hover:from-purple-700 hover:to-violet-700 text-white shadow-purple-600/30 hover:shadow-purple-600/50 hover:-translate-y-0.5',
        'orange' => 'bg-gradient-to-r from-orange-600 to-amber-600 hover:from-orange-700 hover:to-amber-700 text-white shadow-orange-600/30 hover:shadow-orange-600/50 hover:-translate-y-0.5',
        'pink' => 'bg-gradient-to-r from-pink-600 to-rose-600 hover:from-pink-700 hover:to-rose-700 text-white shadow-pink-600/30 hover:shadow-pink-600/50 hover:-translate-y-0.5',
        'cyan' => 'bg-gradient-to-r from-cyan-600 to-teal-600 hover:from-cyan-700 hover:to-teal-700 text-white shadow-cyan-600/30 hover:shadow-cyan-600/50 hover:-translate-y-0.5',
        'yellow' => 'bg-gradient-to-r from-yellow-600 to-amber-600 hover:from-yellow-700 hover:to-amber-700 text-white shadow-yellow-600/30 hover:shadow-yellow-600/50 hover:-translate-y-0.5',
    ];
    
    // Predefined variant styles
    $variants = [
        'primary' => 'bg-blue-600 hover:bg-blue-700 text-white shadow-blue-600/30 hover:shadow-blue-600/50 hover:-translate-y-0.5',
        'secondary' => 'bg-[#1a1f4a] hover:bg-[#252b5e] text-gray-300 hover:text-white border border-[#252b5e]',
        'success' => 'bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white shadow-green-600/30 hover:shadow-green-600/50 hover:-translate-y-0.5',
        'danger' => 'bg-red-600 hover:bg-red-700 text-white shadow-red-600/30 hover:shadow-red-600/50 hover:-translate-y-0.5',
        'gradient' => 'bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white shadow-blue-600/30 hover:shadow-blue-600/50 hover:-translate-y-0.5',
    ];
    
    $sizes = [
        'sm' => 'px-4 py-2 text-sm',
        'md' => 'px-6 py-3',
        'lg' => 'px-8 py-4 text-lg',
    ];
    
    // Determine which style to use: color gradient takes precedence over variant
    if ($color && isset($colorGradients[$color])) { //(true && false) false
        $variantClass = $colorGradients[$color];
    } else {
        $variantClass = $variants[$variant] ?? $variants['primary'];
    }
    
    $sizeClass = $sizes[$size] ?? $sizes['md'];
    
    $classes = $baseClasses . ' ' . $variantClass . ' ' . $sizeClass;
    
    $element = $tag === 'a' || $href ? 'a' : 'button';
@endphp

@if($element === 'a')
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon && $iconPosition === 'left')
            {!! $icon !!}
        @endif
        
        {{ $slot }}
        
        @if($icon && $iconPosition === 'right')
            {!! $icon !!}
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon && $iconPosition === 'left')
            {!! $icon !!}
        @endif
        
        {{ $slot }}
        
        @if($icon && $iconPosition === 'right')
            {!! $icon !!}
        @endif
    </button>
@endif
