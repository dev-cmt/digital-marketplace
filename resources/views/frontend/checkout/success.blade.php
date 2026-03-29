<x-frontend-layout title="Order Successful">

<style>
.success-hero {
    padding: 120px 0 80px;
    text-align: center;
    background: radial-gradient(circle at 50% -20%, rgba(34, 197, 94, 0.1) 0%, transparent 60%);
}

.success-icon-wrap {
    width: 120px; height: 120px; background: rgba(34, 197, 94, 0.1);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    margin: 0 auto 40px; font-size: 50px; color: #22c55e;
    box-shadow: 0 0 50px rgba(34, 197, 94, 0.2);
    animation: pulseGlow 2s infinite;
}

@keyframes pulseGlow {
    0% { transform: scale(1); box-shadow: 0 0 50px rgba(34, 197, 94, 0.2); }
    50% { transform: scale(1.05); box-shadow: 0 0 80px rgba(34, 197, 94, 0.4); }
    100% { transform: scale(1); box-shadow: 0 0 50px rgba(34, 197, 94, 0.2); }
}

.success-title {
    font-size: clamp(32px, 5vw, 48px);
    font-weight: 900; color: #fff; margin-bottom: 16px;
    font-family: 'Outfit'; letter-spacing: -1px;
}

.order-number-badge {
    display: inline-block; padding: 8px 24px; background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1); border-radius: 50px;
    color: var(--accent-1); font-weight: 800; font-family: 'Outfit';
    margin-bottom: 30px; letter-spacing: 1px;
}

.success-card {
    max-width: 600px; margin: 0 auto;
    background: rgba(255,255,255,0.03); backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.08); border-radius: 32px;
    padding: 40px; text-align: center;
}

.action-grid {
    display: grid; grid-template-columns: 1fr 1fr; gap: 20px;
    margin-top: 40px;
}

@media(max-width: 600px) {
    .action-grid { grid-template-columns: 1fr; }
}
</style>

<div class="success-hero">
    <div class="container">
        <div class="success-icon-wrap">
            <i class="fa-solid fa-check"></i>
        </div>
        <h1 class="success-title">Order Confirmed!</h1>
        <div class="order-number-badge">{{ session('order_number') }}</div>
        
        <div class="success-card">
            <p style="color:rgba(255,255,255,0.5); font-size: 18px; line-height: 1.6; margin-bottom: 0;">
                Your creative fuel has been secured. You can now access your high-quality assets in your dashboard under your purchase history.
            </p>

            <div class="action-grid">
                <a href="{{ route('home') }}" class="btn btn-outline py-3 px-4" style="border-radius:18px; font-weight:800; justify-content:center;">
                    Return Home
                </a>
                <a href="{{ route('frontend.assets.index') }}" class="btn btn-primary py-3 px-4" style="border-radius:18px; font-weight:800; justify-content:center;">
                    Browse More Assets
                </a>
            </div>
        </div>
    </div>
</div>

</x-frontend-layout>
