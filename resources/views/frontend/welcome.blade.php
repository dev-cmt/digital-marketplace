<x-frontend-layout title="PixelVault – Premium Digital Assets" :breadcrumbs="$breadcrumbs" :seotags="$seotags">

@push('css')
<style>
/* ============================
   HOMEPAGE BASE
   ============================ */
.home-wrap { padding-top: 70px; }
</style>
@endpush

<div class="home-wrap">
    @include('frontend.partials.home.hero')
    @include('frontend.partials.home.stats')
    @include('frontend.partials.home.categories')
    @include('frontend.partials.home.trending')
    @include('frontend.partials.home.how-it-works')
    @include('frontend.partials.home.plans')
    @include('frontend.partials.home.creators')
    @include('frontend.partials.home.licensing')
    @include('frontend.partials.home.testimonials')
    @include('frontend.partials.home.cta')
</div>

@push('js')
<script>
// General homepage JS
(function(){
    // Scroll animations
    const observer = new IntersectionObserver(function(entries){
        entries.forEach(function(e){
            if(e.isIntersecting){
                e.target.classList.add('is-visible');
                observer.unobserve(e.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -60px 0px' });
    document.querySelectorAll('.reveal').forEach(function(el){
        observer.observe(el);
    });
})();
</script>
@endpush

</x-frontend-layout>
