<x-frontend-layout title="Shopping Cart">

<style>
:root {
    --cart-glass: rgba(255, 255, 255, 0.03);
    --cart-border: rgba(255, 255, 255, 0.08);
}

.cart-hero {
    padding: 100px 0 60px;
    background: radial-gradient(circle at 50% -20%, rgba(108,99,255,0.15) 0%, transparent 60%);
    text-align: center;
}
.cart-title {
    font-size: clamp(32px, 5vw, 48px);
    font-weight: 900; color: #fff; margin-bottom: 12px;
    font-family: 'Outfit'; letter-spacing: -1px;
    text-shadow: 0 0 30px rgba(108, 99, 255, 0.3);
}
.cart-subtitle {
    font-size: 16px; color: rgba(255,255,255,0.4);
    font-weight: 500; letter-spacing: 1px; text-transform: uppercase;
}

.cart-layout {
    display: grid; grid-template-columns: 1.8fr 1fr; gap: 40px;
    padding-bottom: 120px;
}

.cart-item-card {
    background: var(--cart-glass);
    border: 1px solid var(--cart-border);
    border-radius: 24px;
    padding: 24px;
    display: flex; gap: 30px;
    align-items: center;
    backdrop-filter: blur(20px);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    margin-bottom: 20px;
    position: relative;
    overflow: hidden;
    animation: slideInUp 0.6s backwards;
}
.cart-item-card:hover {
    background: rgba(255, 255, 255, 0.06);
    border-color: rgba(255, 255, 255, 0.2);
    transform: translateX(10px);
    box-shadow: -10px 0 30px rgba(108, 99, 255, 0.1);
}

.cart-item-img-wrap {
    width: 180px; height: 120px; border-radius: 16px; 
    overflow: hidden; position: relative;
    border: 1px solid rgba(255,255,255,0.1);
}
.cart-item-img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.6s;
}
.cart-item-card:hover .cart-item-img { transform: scale(1.1); }

.cart-item-info { flex: 1; }
.cart-item-title { 
    font-size: 20px; font-weight: 800; color: #fff; 
    margin-bottom: 8px; text-decoration: none; display: block;
    font-family: 'Outfit';
}
.cart-item-meta {
    font-size: 11px; font-weight: 800; text-transform: uppercase;
    letter-spacing: 1px; color: var(--accent-1);
    background: rgba(108, 99, 255, 0.1);
    padding: 4px 12px; border-radius: 50px; display: inline-block;
    margin-bottom: 12px;
}
.cart-item-price { 
    font-family: 'Outfit'; font-size: 24px; font-weight: 900; 
    background: linear-gradient(to right, #fff, rgba(255,255,255,0.7));
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
}

.btn-remove-studio {
    background: rgba(255,107,107,0.05); border: 1px solid rgba(255,107,107,0.1);
    width: 48px; height: 48px; border-radius: 16px; color: #ff6b6b;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all 0.3s;
}
.btn-remove-studio:hover {
    background: #ff6b6b; color: #fff;
    box-shadow: 0 0 20px rgba(255, 107, 107, 0.4);
    transform: rotate(90deg);
}

.summary-studio-panel {
    background: linear-gradient(145deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0.01) 100%);
    border: 1px solid var(--cart-border);
    border-radius: 32px; padding: 40px;
    position: sticky; top: 120px;
    backdrop-filter: blur(30px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.4);
}
.summary-title { 
    font-size: 22px; font-weight: 900; color: #fff; 
    margin-bottom: 30px; font-family: 'Outfit';
    display: flex; align-items: center; gap: 12px;
}
.summary-row { display: flex; justify-content: space-between; margin-bottom: 20px; color: rgba(255,255,255,0.5); font-size: 15px; font-weight: 600; }
.summary-total-row { 
    border-top: 1px solid rgba(255,255,255,0.1); 
    margin-top: 30px; padding-top: 30px;
    display: flex; justify-content: space-between; align-items: center;
}
.summary-total-label { font-size: 16px; font-weight: 700; color: #fff; text-transform: uppercase; letter-spacing: 1px; }
.summary-total-price { 
    font-size: 32px; font-weight: 900; color: #fff; font-family: 'Outfit';
    text-shadow: 0 0 20px rgba(108, 99, 255, 0.3);
}

.checkout-btn-studio {
    width: 100%; background: var(--accent-1); color: #fff;
    border: none; padding: 22px; border-radius: 20px;
    font-size: 18px; font-weight: 800; font-family: 'Outfit';
    margin-top: 40px; cursor: pointer; transition: all 0.4s;
    display: flex; align-items: center; justify-content: center; gap: 15px;
    box-shadow: 0 10px 30px rgba(108, 99, 255, 0.3);
    text-decoration: none;
}
.checkout-btn-studio:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(108, 99, 255, 0.5);
    background: #7a72ff;
}

@keyframes slideInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

.btn-clear-cart {
    width: 100%;
    background: transparent;
    border: 1px dashed rgba(255,107,107,0.3);
    color: #ff6b6b;
    padding: 18px;
    border-radius: 20px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: all 0.3s;
}
.btn-clear-cart:hover {
    background: rgba(255,107,107,0.08);
    border-color: rgba(255,107,107,0.6);
    box-shadow: 0 10px 30px rgba(255,107,107,0.15);
    transform: translateY(-2px);
}

.empty-studio-state {
    text-align: center; padding: 120px 40px;
    background: var(--cart-glass); border-radius: 40px;
    border: 1px dashed rgba(255,255,255,0.1);
}
.empty-icon-glow {
    width: 100px; height: 100px; background: rgba(108, 99, 255, 0.1);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    margin: 0 auto 30px; font-size: 40px; color: var(--accent-1);
    box-shadow: 0 0 40px rgba(108, 99, 255, 0.2);
}

@media(max-width: 1100px) { 
    .cart-layout { grid-template-columns: 1fr; } 
    .summary-studio-panel { position: static; max-width: 500px; margin: 0 auto; } 
}
@media(max-width: 700px) {
    .cart-item-card { flex-direction: column; align-items: center; text-align: center; }
    .cart-item-img-wrap { width: 100%; max-width: 300px; height: auto; aspect-ratio: 16/10; margin: 0 auto; }
    .btn-remove-studio { position: absolute; right: 20px; top: 20px; }
}
</style>

<div class="cart-hero">
    <div class="container">
        <span class="cart-subtitle">Review Order</span>
        <h1 class="cart-title">Your Studio Cart</h1>
    </div>
</div>

<div class="container">
    @if(count($cartItems) > 0)
    <div class="cart-layout">
        <div class="cart-items">
            @foreach($cartItems as $index => $item)
            <div class="cart-item-card" id="cart-item-{{ $item->id }}" style="animation-delay: {{ $index * 0.1 }}s">
                <div class="cart-item-img-wrap">
                    <img src="{{ asset($item->attributes->thumbnail) }}" alt="{{ $item->name }}" class="cart-item-img">
                </div>
                <div class="cart-item-info">
                    <span class="cart-item-meta">{{ $item->attributes->type }}</span>
                    <a href="{{ route('frontend.assets.show', $item->attributes->slug ?? '') }}" class="cart-item-title">{{ $item->name }}</a>
                    <div class="cart-item-price">${{ number_format($item->price, 2) }}</div>
                </div>
                <button class="btn-remove-studio" onclick="removeCartItem('{{ $item->id }}', this)" title="Remove Item">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            @endforeach
        </div>

        @if(count($cartItems) > 0)
        <div class="cart-summary">
            <div class="summary-studio-panel">
                <h3 class="summary-title"><i class="fa-solid fa-scroll text-primary"></i> Order Summary</h3>
                <div class="summary-row">
                    <span>Active Items (<span id="summary-count">{{ $cartBadgeCount ?? count($cartItems) }}</span>)</span>
                    <span id="summary-subtotal">${{ number_format($total, 2) }}</span>
                </div>
                <div class="summary-row">
                    <span>Tax & Licensing</span>
                    <span style="color: var(--accent-1); font-weight: 800;">Inc.</span>
                </div>

                <div class="summary-total-row">
                    <span class="summary-total-label">Subtotal Price</span>
                    <span id="summary-total" class="summary-total-price">${{ number_format($total, 2) }}</span>
                </div>

                <a href="{{ route('checkout.index') }}" class="checkout-btn-studio">
                    Initialize Checkout <i class="fa-solid fa-shield-halved opacity-50"></i>
                </a>
                
                <form action="{{ route('cart.clear') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="btn-clear-cart">
                        <i class="fa-solid fa-trash-can"></i> Clear Studio Cart
                    </button>
                </form>
            </div>
        </div>
        @endif
    </div>
    @else
    <div class="empty-studio-state reveal-item">
        <div class="empty-icon-glow">
            <i class="fa-solid fa-wand-magic-sparkles"></i>
        </div>
        <h3 class="cart-title" style="font-size: 28px; text-shadow:none;">Your cart is silent</h3>
        <p style="color:rgba(255,255,255,0.4); margin-bottom: 32px; max-width: 400px; margin-left: auto; margin-right: auto;">
            Looks like you haven't added any design fuel yet. Explore our curated assets to start your next masterpiece.
        </p>
        <a href="{{ route('frontend.assets.index') }}" class="btn btn-primary px-5 py-3" style="border-radius: 50px; font-weight: 800;">
            <i class="fa-solid fa-plus me-2"></i> Start Exploring
        </a>
    </div>
    @endif
</div>

@push('js')
<script>
function removeCartItem(rowId, btnElement) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const originalIcon = btnElement.innerHTML;
    btnElement.innerHTML = '<i class="fa-solid fa-spinner fa-spin fs-14"></i>';
    btnElement.disabled = true;

    fetch('{{ route('cart.remove') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: JSON.stringify({ row_id: rowId })
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            const itemElement = document.getElementById('cart-item-' + rowId);
            if(itemElement) {
                itemElement.style.opacity = '0';
                itemElement.style.transform = 'translateX(50px)';
                setTimeout(() => itemElement.remove(), 400);
            }

            const badge = document.querySelector('a[title="Cart"] .nav-badge');
            if (badge) badge.innerText = data.total_items;

            const countEl = document.getElementById('summary-count');
            const subtotalEl = document.getElementById('summary-subtotal');
            const totalEl = document.getElementById('summary-total');

            if(countEl) countEl.innerText = data.total_items;
            
            const formattedTotal = '$' + parseFloat(data.cart_total).toFixed(2);
            if(subtotalEl) subtotalEl.innerText = formattedTotal;
            if(totalEl) totalEl.innerText = formattedTotal;

            if(data.total_items === 0) {
                setTimeout(() => window.location.reload(), 500);
            }
        }
    })
    .catch(error => {
        console.error('Error removing item:', error);
        btnElement.innerHTML = originalIcon;
        btnElement.disabled = false;
    });
}
</script>
@endpush

</x-frontend-layout>
