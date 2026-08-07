@php
    $icon = $icon ?? 'fa-solid fa-inbox';
    $message = $message ?? 'Nothing to show';
    $buttonText = $buttonText ?? null;
    $buttonLink = $buttonLink ?? null;
@endphp

<div class="text-center py-5">
    <i class="{{ $icon }} fa-3x text-muted mb-3"></i>
    <h5 class="fw-semibold">{{ $message }}</h5>

    @if($buttonText && $buttonLink)
        <a href="{{ $buttonLink }}" class="btn btn-primary mt-3">{{ $buttonText }}</a>
    @endif
</div>
