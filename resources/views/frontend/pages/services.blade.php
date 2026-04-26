<x-frontend-layout :title="data_get($page->content, 'header.title', 'Services')" :breadcrumbs="$breadcrumbs" :seotags="$seotags">
    @push('css')
    <style>
        .page-header {
            padding: 120px 0 80px;
            text-align: center;
            background: radial-gradient(ellipse at top, rgba(236,72,153,0.1) 0%, transparent 70%);
        }
        .offer-section {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 60px;
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 80px;
        }
        .offer-text { max-width: 500px; }
        .offer-discount {
            font-family: var(--font-heading);
            font-size: 80px; font-weight: 900;
            background: var(--accent-gradient);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            line-height: 1;
        }
        .services-content-section {
            display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;
            padding: 80px 0;
        }
        .services-image {
            border-radius: var(--radius-lg); overflow: hidden;
            box-shadow: var(--shadow-card);
            position: relative;
        }
        .services-image::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(108,99,255,0.2), transparent);
            z-index: 1;
        }
        .services-image img { width: 100%; height: auto; display: block; }
        
        @media (max-width: 900px) {
            .offer-section { flex-direction: column; text-align: center; gap: 40px; padding: 40px; }
            .services-content-section { grid-template-columns: 1fr; }
            .services-image { order: -1; }
        }
    </style>
    @endpush

    <!-- Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="section-title fade-up">{{ data_get($page->content, 'header.title', 'Our Services') }}</h1>
            <p class="section-subtitle fade-up" style="animation-delay: 0.1s; max-width: 600px; margin: 15px auto 0;">
                {{ data_get($page->content, 'header.subtitle', 'Explore what we have to offer.') }}
            </p>
        </div>
    </section>

    <!-- Content -->
    <section class="section pt-0">
        <div class="container">
            
            @if(data_get($page->content, 'services_offer.title'))
            <!-- Offer Banner -->
            <div class="offer-section fade-up">
                <div class="offer-text">
                    <span class="section-label">{{ data_get($page->content, 'services_offer.title') }}</span>
                    <h3 style="font-size: 32px; font-family: var(--font-heading); font-weight: 800; margin-bottom: 15px;">
                        {{ data_get($page->content, 'services_offer.header') }}
                    </h3>
                    <p style="color: var(--text-secondary);">
                        {{ data_get($page->content, 'services_offer.description') }}
                    </p>
                </div>
                <div class="offer-discount">
                    {{ data_get($page->content, 'services_offer.discount') }}
                </div>
            </div>
            @endif

            @if(data_get($page->content, 'services_content.title'))
            <!-- Detailed Content -->
            <div class="services-content-section fade-up">
                <div>
                    <span class="section-label">{{ data_get($page->content, 'services_content.title') }}</span>
                    <h2 class="section-title" style="margin-bottom: 24px;">{{ data_get($page->content, 'services_content.header') }}</h2>
                    <div style="color: var(--text-secondary); margin-bottom: 30px; font-size: 15px; line-height: 1.8;">
                        {!! data_get($page->content, 'services_content.description') !!}
                    </div>
                    @if(data_get($page->content, 'services_content.button_text'))
                    <a href="{{ data_get($page->content, 'services_content.button_link', '#') }}" class="btn btn-primary btn-lg">
                        {{ data_get($page->content, 'services_content.button_text') }} <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                    @endif
                </div>
                <div class="services-image">
                    <!-- Placeholder aesthetic image for services -->
                    <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?q=80&w=2070&auto=format&fit=crop" alt="Services">
                </div>
            </div>
            @endif

        </div>
    </section>
</x-frontend-layout>
