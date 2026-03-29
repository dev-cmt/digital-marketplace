<x-frontend-layout title="Secure Checkout">

<style>
.checkout-hero {
    padding: 100px 0 60px;
    background: radial-gradient(circle at 50% -20%, rgba(108,99,255,0.1) 0%, transparent 60%);
    text-align: center;
}

.checkout-title {
    font-size: clamp(32px, 5vw, 48px);
    font-weight: 900; color: #fff; margin-bottom: 12px;
    font-family: 'Outfit'; letter-spacing: -1px;
}

.checkout-grid {
    display: grid; grid-template-columns: 1.5fr 1fr; gap: 40px;
    padding-bottom: 120px;
}

.checkout-card {
    background: rgba(255,255,255,0.03); backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.08); border-radius: 32px;
    padding: 40px;
}

.checkout-section-title {
    font-size: 20px; font-weight: 800; color: #fff; margin-bottom: 24px;
    display: flex; align-items: center; gap: 12px; font-family: 'Outfit';
}

.checkout-item {
    display: flex; align-items: center; gap: 20px; margin-bottom: 20px;
    padding-bottom: 20px; border-bottom: 1px solid rgba(255,255,255,0.05);
}

.checkout-item:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }

.checkout-item-img {
    width: 100px; height: 70px; border-radius: 12px; object-fit: cover;
    border: 1px solid rgba(255,255,255,0.1);
}

.summary-row {
    display: flex; justify-content: space-between; margin-bottom: 16px;
    color: rgba(255,255,255,0.5); font-weight: 600;
}

.confirm-button {
    width: 100%; padding: 22px; background: var(--accent-1); color: #fff;
    border: none; border-radius: 20px; font-size: 18px; font-weight: 800;
    font-family: 'Outfit'; margin-top: 40px; cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex; align-items: center; justify-content: center; gap: 12px;
    box-shadow: 0 10px 30px rgba(108, 99, 255, 0.3);
}

.confirm-button:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(108, 99, 255, 0.5);
    background: #7a72ff;
}

@media(max-width: 1000px) {
    .checkout-grid { grid-template-columns: 1fr; }
}
</style>

<div class="checkout-hero">
    <div class="container text-center">
        <h1 class="checkout-title">Finalize Order</h1>
        <p style="color:rgba(255,255,255,0.4); font-weight:600; font-size:16px;">One step away from your creative assets</p>
    </div>
</div>

<div class="container">
    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="checkout-grid">
            <!-- Billing Details (Summary only for Digital Goods) -->
            <div class="checkout-main">
                <div class="checkout-card mb-4">
                    <h3 class="checkout-section-title">
                        <i class="fa-solid fa-user-shield text-primary"></i> Customer Information
                    </h3>
                    @auth
                    <div style="background:rgba(108, 99, 255, 0.05); padding:24px; border-radius:20px; border:1px solid rgba(108, 99, 255, 0.1);">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width:50px; height:50px; background:var(--accent-1); border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:900; color:#fff; font-size:20px;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="color:#fff; font-weight:800; font-size:18px;">{{ auth()->user()->name }}</div>
                                <div style="color:rgba(255,255,255,0.4); font-size:13px;">{{ auth()->user()->email }} • {{ auth()->user()->phone ?? 'No phone added' }}</div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label text-white-50 small fw-bold text-uppercase">Full Name</label>
                            <input type="text" name="customer_name" class="form-control" style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); color:#fff; border-radius:12px; padding:12px;" placeholder="Enter your full name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-white-50 small fw-bold text-uppercase">Phone Number</label>
                            <input type="text" name="customer_phone" class="form-control" style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); color:#fff; border-radius:12px; padding:12px;" placeholder="e.g. +1 234 567 890">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-white-50 small fw-bold text-uppercase">Email Address</label>
                            <input type="email" name="customer_email" class="form-control" style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); color:#fff; border-radius:12px; padding:12px;" placeholder="email@example.com" required>
                        </div>
                    </div>
                    @endauth
                </div>

                <div class="checkout-card">
                    <h3 class="checkout-section-title">
                        <i class="fa-solid fa-gift text-primary"></i> Confirm Items
                    </h3>
                    @foreach($cartItems as $item)
                    <div class="checkout-item">
                        <img src="{{ asset($item->attributes->thumbnail) }}" alt="{{ $item->name }}" class="checkout-item-img">
                        <div style="flex:1;">
                            <div style="color:#fff; font-weight:700; font-size:16px;">{{ $item->name }}</div>
                            <div style="color:rgba(255,255,255,0.4); font-size:13px; font-weight:800; text-transform:uppercase; letter-spacing:1px;">{{ $item->attributes->type }} License</div>
                        </div>
                        <div style="color:#fff; font-weight:900; font-size:18px; font-family:'Outfit';">${{ number_format($item->price, 2) }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Sidebar Summary -->
            <div class="checkout-sidebar">
                <div class="checkout-card" style="position:sticky; top:120px;">
                    <h3 class="checkout-section-title">
                        <i class="fa-solid fa-credit-card text-primary"></i> Checkout Summary
                    </h3>
                    
                    <div class="summary-row">
                        <span>Products ({{ count($cartItems) }})</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>License Fees</span>
                        <span style="color:#22c55e;">Gratis</span>
                    </div>
                    <div class="summary-row" style="border-top:1px solid rgba(255,255,255,0.05); padding-top:20px; margin-top:20px;">
                        <span style="color:#fff; font-size:18px; font-weight:800;">Payable Total</span>
                        <span style="color:#fff; font-size:28px; font-weight:900; font-family:'Outfit'; text-shadow:0 0 20px rgba(108, 99, 255, 0.3);">${{ number_format($total, 2) }}</span>
                    </div>

                    <button type="submit" class="confirm-button">
                        Complete Order <i class="fa-solid fa-lock fs-16 opacity-50"></i>
                    </button>

                    <p style="text-align:center; margin-top:24px; color:rgba(255,255,255,0.3); font-size:12px;">
                        By clicking "Complete Order", you agree to our terms of service and license agreement. All digital sales are final.
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>

</x-frontend-layout>
