@extends('frontend.layouts.app')

@php
    $pageTitle = $page->title;
    $metaDescription = $page->meta_description ?? '';
    $metaKeywords = $page->meta_keywords ?? '';
@endphp

@if($page->meta_title)
    @php $pageTitle = $page->meta_title; @endphp
@endif

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h3 class="fw-bold mb-4">{{ $page->title }}</h3>

            <div class="cms-content" style="font-size: 0.95rem; line-height: 1.8; color: #374151;">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .cms-content img {
        max-width: 100%;
        height: auto;
        border-radius: 6px;
    }
    .cms-content h1, .cms-content h2, .cms-content h3, .cms-content h4, .cms-content h5, .cms-content h6 {
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        font-weight: 600;
    }
    .cms-content p {
        margin-bottom: 1rem;
    }
    .cms-content ul, .cms-content ol {
        padding-left: 1.25rem;
        margin-bottom: 1rem;
    }
    .cms-content table {
        width: 100%;
        margin-bottom: 1rem;
    }
    .cms-content table td,
    .cms-content table th {
        border: 1px solid #e5e7eb;
        padding: 0.5rem 0.75rem;
    }
    .cms-content blockquote {
        border-left: 3px solid var(--primary);
        padding: 0.75rem 1rem;
        background: var(--primary-50);
        margin-bottom: 1rem;
        border-radius: 0 6px 6px 0;
    }
</style>
@endpush
@endsection
