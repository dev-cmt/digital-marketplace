<x-backend-layout title="Orders">
    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
    @endpush

    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Orders Management</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Orders</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between d-flex align-items-center">
                    <div class="card-title">All Orders</div>
                    <span class="badge bg-primary-transparent">{{ $orders->total() }} Total</span>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="responsiveDataTable" class="table table-bordered text-nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Order #</th>
                                    <th>Customer</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $key => $order)
                                    <tr>
                                        <td>{{ $orders->firstItem() + $key }}</td>
                                        <td>
                                            <span class="fw-semibold text-primary">{{ $order->order_number }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar avatar-sm rounded-circle bg-primary-transparent d-flex align-items-center justify-content-center">
                                                    {{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}
                                                </div>
                                                <div>
                                                    <span class="d-block fw-semibold">{{ $order->user->name ?? 'Deleted User' }}</span>
                                                    <small class="text-muted">{{ $order->user->email ?? '' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-info-transparent">{{ $order->items->count() }} {{ Str::plural('item', $order->items->count()) }}</span>
                                        </td>
                                        <td>
                                            <span class="fw-bold fs-15">${{ number_format($order->total_amount, 2) }}</span>
                                        </td>
                                        <td>
                                            @if($order->status === 'completed')
                                                <span class="badge bg-success-transparent">Completed</span>
                                            @elseif($order->status === 'pending')
                                                <span class="badge bg-warning-transparent">Pending</span>
                                            @else
                                                <span class="badge bg-danger-transparent">{{ ucfirst($order->status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->payment_status === 'paid')
                                                <span class="badge bg-success-transparent"><i class="ri-checkbox-circle-line me-1"></i>Paid</span>
                                            @else
                                                <span class="badge bg-warning-transparent">{{ ucfirst($order->payment_status) }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                                        <td>
                                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary-light btn-icon" title="View Details">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#responsiveDataTable').DataTable({
                    paging: false,
                    info: false
                });
            });
        </script>
    @endpush
</x-backend-layout>
