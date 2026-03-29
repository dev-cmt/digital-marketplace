<x-frontend-layout title="Creators – PixelVault">
    @push('css')
    <style>
    .page-wrap { padding: 80px 0; }
    </style>
    @endpush
    <div class="page-wrap">
        @include('frontend.partials.home.creators')
        @include('frontend.partials.home.how-it-works')
    </div>
</x-frontend-layout>
