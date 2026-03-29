<x-frontend-layout title="Enterprise – PixelVault">
    @push('css')
    <style>
    .page-wrap { padding: 120px 0 80px; min-height: 80vh; }
    .enterprise-hero {
        text-align: center; max-width: 800px; margin: 0 auto 60px;
    }
    .enterprise-title { font-family: 'Outfit', sans-serif; font-size: 56px; font-weight: 900; color: #fff; margin-bottom: 24px; }
    .enterprise-desc { font-size: 18px; color: var(--text-secondary); line-height: 1.6; }
    </style>
    @endpush
    <div class="page-wrap">
        <div class="container">
            <div class="enterprise-hero">
                <h1 class="enterprise-title">Empower Your Team</h1>
                <p class="enterprise-desc">Unlimited access to millions of premium digital assets, dedicated support, and custom licensing for enterprise-scale projects.</p>
                <a href="mailto:contact@pixelvault.com" class="btn btn-primary" style="margin-top: 30px; font-size: 16px; padding: 16px 32px;">Contact Sales</a>
            </div>
        </div>
        @include('frontend.partials.home.testimonials')
    </div>
</x-frontend-layout>
