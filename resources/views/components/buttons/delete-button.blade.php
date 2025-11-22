<!-- Delete Button Component -->
@props([
'route',
'method' => 'DELETE',
'text' => 'Delete',
'confirmMessage' => 'Are you sure you want to delete this item? This action cannot be undone.',
'icon' => true,
'size' => 'medium',
'formId' => null
])

@php
$sizeClasses = [
'small' => 'btn-delete-sm',
'medium' => 'btn-delete',
'large' => 'btn-delete-lg'
];
$buttonClass = $sizeClasses[$size] ?? 'btn-delete';
$generatedFormId = $formId ?? 'delete-form-' . uniqid();
@endphp

<a href="#"
    onclick="event.preventDefault(); if(confirm('{{ $confirmMessage }}')) { document.getElementById('{{ $generatedFormId }}').submit(); }"
    class="{{ $buttonClass }}" {{ $attributes }}>
    @if($icon)
    <svg class="btn-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M3 6H5H21M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
    @endif
    {{ $text }}
</a>

<form id="{{ $generatedFormId }}" method="POST" action="{{ $route }}" style="display: none;">
    @csrf
    @method($method)
</form>