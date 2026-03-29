<x-backend-layout title="Order Details">

    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Order #{{ $order->order_number }}</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
                    <li class="breadcrumb-item active">{{ $order->order_number }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        {{-- Order Info --}}
        <div class="col-xl-4">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">Order Info</div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Order Number</span>
                            <span class="fw-semibold text-primary">{{ $order->order_number }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Status</span>
                            @if($order->status === 'completed')
                                <span class="badge bg-success-transparent">Completed</span>
                            @elseif($order->status === 'pending')
                                <span class="badge bg-warning-transparent">Pending</span>
                            @else
                                <span class="badge bg-danger-transparent">{{ ucfirst($order->status) }}</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Payment</span>
                            @if($order->payment_status === 'paid')
                                <span class="badge bg-success-transparent">Paid</span>
                            @else
                                <span class="badge bg-warning-transparent">{{ ucfirst($order->payment_status) }}</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Method</span>
                            <span>{{ ucfirst($order->payment_method ?? 'N/A') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Date</span>
                            <span>{{ $order->created_at->format('d M Y, h:i A') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted fw-bold">Total</span>
                            <span class="fw-bold fs-18 text-success">${{ number_format($order->total_amount, 2) }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Customer Info --}}
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">Customer</div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar avatar-lg rounded-circle bg-primary-transparent d-flex align-items-center justify-content-center fs-18 fw-bold">
                            {{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <h6 class="mb-0 fw-semibold">{{ $order->user->name ?? 'Deleted User' }}</h6>
                            <small class="text-muted">{{ $order->user->email ?? '' }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Order Items --}}
        <div class="col-xl-8">
            <div class="card custom-card">
                <div class="card-header justify-content-between d-flex align-items-center">
                    <div class="card-title">Purchased Items</div>
                    <span class="badge bg-primary-transparent">{{ $order->items->count() }} {{ Str::plural('item', $order->items->count()) }}</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Thumbnail</th>
                                    <th>Asset</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        @if($item->asset)
                                        <img src="{{ asset($item->asset->thumbnail) }}" class="rounded" width="50" height="40" style="object-fit: cover;">
                                        @else
                                        <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->asset)
                                            <a href="{{ route('assets.show', $item->asset->id) }}" class="fw-semibold">{{ Str::limit($item->asset->title, 40) }}</a>
                                        @else
                                            <span class="text-muted">Asset Deleted</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->asset)
                                        <span class="badge bg-info-transparent">{{ ucfirst($item->asset->type) }}</span>
                                        @else
                                        <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td class="fw-semibold">${{ number_format($item->price, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end fw-bold">Order Total</td>
                                    <td class="fw-bold fs-16 text-success">${{ number_format($order->total_amount, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-backend-layout>
