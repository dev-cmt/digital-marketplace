<x-frontend-layout title="My Profile">
<style>
.profile-wrap {
    padding: 120px 24px 60px;
    max-width: 1100px;
    margin: 0 auto;
}
.profile-header {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 20px;
    padding: 40px;
    display: flex;
    align-items: center;
    gap: 30px;
    margin-bottom: 40px;
}
.profile-avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border: 3px solid #6c63ff;
    object-fit: cover;
}
.profile-info h1 {
    font-size: 32px;
    font-weight: 800;
    margin: 0 0 5px;
}
.profile-info p {
    color: rgba(255,255,255,0.5);
    font-size: 15px;
    margin: 0;
}
.profile-badges {
    display: flex;
    gap: 10px;
    margin-top: 15px;
}
.profile-badge {
    padding: 6px 14px;
    background: rgba(108,99,255,0.1);
    color: #6c63ff;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 700;
}
.profile-content {
    display: grid;
    grid-template-columns: 1fr;
    gap: 30px;
}
.profile-card {
    background: rgba(255,255,255,0.02);
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 16px;
    padding: 30px;
}
.profile-card h3 {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.profile-card h3 i {
    color: #ec4899;
}
.order-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}
.order-item {
    background: rgba(0,0,0,0.2);
    border-radius: 12px;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.order-info {
    display: flex;
    flex-direction: column;
    gap: 5px;
}
.order-id {
    font-weight: 700;
    color: #fff;
    font-size: 16px;
}
.order-date {
    color: rgba(255,255,255,0.4);
    font-size: 13px;
}
.order-total {
    font-size: 18px;
    font-weight: 800;
    color: #10b981;
}
.order-status {
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 700;
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
}
.btn-admin {
    background: linear-gradient(135deg, #ec4899, #a855f7);
    color: #fff;
    padding: 10px 20px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: 0.2s;
}
.btn-admin:hover {
    opacity: 0.9;
    transform: translateY(-2px);
}
@media(max-width: 600px) {
    .profile-header {
        flex-direction: column;
        text-align: center;
        padding: 30px 20px;
    }
    .profile-badges { justify-content: center; }
    .order-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
}
</style>

<div class="profile-wrap">
    
    <div class="profile-header reveal-item">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=6c63ff&color=fff&size=200" alt="Avatar" class="profile-avatar">
        <div class="profile-info">
            <h1>{{ $user->name }}</h1>
            <p>{{ $user->email }}</p>
            <div class="profile-badges">
                <span class="profile-badge">Member since {{ $user->created_at->format('M Y') }}</span>
                <span class="profile-badge" style="background:rgba(236, 72, 153, 0.1);color:#ec4899;">{{ $orders->count() }} Orders</span>
            </div>
        </div>
        @can('view dashboard')
        <div class="ms-md-auto mt-4 mt-md-0">
            <a href="{{ route('dashboard') }}" class="btn-admin"><i class="fa-solid fa-gauge"></i> Admin Dashboard</a>
        </div>
        @endcan
    </div>

    <div class="profile-content">
        <!-- Order History -->
        <div class="profile-card reveal-item" style="transition-delay: 0.1s;">
            <h3><i class="fa-solid fa-bag-shopping"></i> My Orders</h3>
            
            @if($orders->count() > 0)
                <div class="order-list">
                    @foreach($orders as $order)
                        <div class="order-item">
                            <div class="order-info">
                                <span class="order-id">Order #{{ $order->order_number }}</span>
                                <span class="order-date">{{ $order->created_at->format('F j, Y, g:i a') }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-4">
                                <span class="order-total">${{ number_format($order->total_amount, 2) }}</span>
                                <span class="order-status">{{ ucfirst($order->status) }}</span>
                                <a href="#" class="btn btn-sm btn-outline-light" style="border-radius:8px;">View Items</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <div style="font-size:40px; color:rgba(255,255,255,0.1); margin-bottom:15px;"><i class="fa-solid fa-box-open"></i></div>
                    <p style="color:rgba(255,255,255,0.4);">You haven't placed any orders yet.</p>
                    <a href="{{ route('frontend.assets.index') }}" class="btn btn-primary mt-3 px-4 py-2" style="border-radius:10px;font-weight:700;">Start Exploring</a>
                </div>
            @endif
        </div>
    </div>

</div>
</x-frontend-layout>
