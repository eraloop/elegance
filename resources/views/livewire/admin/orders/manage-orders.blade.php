<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">Orders</h2>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Search orders..."
                        wire:model.live.debounce.300ms="search">
                </div>
                <div class="col-md-3">
                    <select class="form-select" wire:model.live="filterStatus">
                        <option value="">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Order #</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td class="ps-4 fw-bold text-primary">{{ $order->order_number }}</td>
                                <td>
                                    <div class="fw-medium">{{ $order->customer_name }}</div>
                                    <div class="small text-muted">{{ $order->customer_email }}</div>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                                <td class="fw-bold">${{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    @php
                                        $statusClass = match ($order->status) {
                                            'pending' => 'bg-warning text-dark',
                                            'processing' => 'bg-info text-dark',
                                            'completed' => 'bg-success',
                                            'cancelled' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $statusClass }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <button wire:click="view({{ $order->id }})" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-shopping-cart fa-2x mb-3 d-block"></i>
                                    No orders found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0 py-3">
            {{ $orders->links() }}
        </div>
    </div>

    <!-- View Order Modal -->
    @if($isOpen && $viewOrder)
        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5); overflow-y: auto;"
            tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Order Details: {{ $viewOrder->order_number }}</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="fw-bold border-bottom pb-2">Customer Info</h6>
                                <p class="mb-1"><strong>Name:</strong> {{ $viewOrder->customer_name }}</p>
                                <p class="mb-1"><strong>Email:</strong> {{ $viewOrder->customer_email }}</p>
                                <p class="mb-1"><strong>Phone:</strong> {{ $viewOrder->customer_phone }}</p>
                                <p class="mb-1"><strong>Address:</strong> {{ $viewOrder->shipping_address ?: 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold border-bottom pb-2">Order Info</h6>
                                <p class="mb-1"><strong>Date:</strong> {{ $viewOrder->created_at->format('M d, Y H:i') }}
                                </p>
                                <p class="mb-1"><strong>Status:</strong> <span
                                        class="badge bg-secondary">{{ ucfirst($viewOrder->status) }}</span></p>
                                @if($viewOrder->notes)
                                    <p class="mb-1"><strong>Notes:</strong> {{ $viewOrder->notes }}</p>
                                @endif
                            </div>
                        </div>

                        <h6 class="fw-bold border-bottom pb-2">Order Items</h6>
                        <div class="table-responsive mb-4">
                            <table class="table table-sm table-bordered">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-end">Price</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($viewOrder->items as $item)
                                        <tr>
                                            <td>
                                                {{ $item->product_name }}
                                                @if($item->product)
                                                    <a href="#" class="text-decoration-none ms-1"><i
                                                            class="fas fa-external-link-alt small"></i></a>
                                                @else
                                                    <span class="text-danger small">(Deleted Product)</span>
                                                @endif
                                            </td>
                                            <td class="text-end">${{ number_format($item->price, 2) }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-end">${{ number_format($item->subtotal, 2) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">Total</td>
                                        <td class="text-end fw-bold">${{ number_format($viewOrder->total_amount, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h6 class="fw-bold border-bottom pb-2">Update Status</h6>
                        <div class="d-flex gap-2">
                            <button wire:click="updateStatus('pending')"
                                class="btn btn-sm {{ $viewOrder->status === 'pending' ? 'btn-warning' : 'btn-outline-warning' }}">Pending</button>
                            <button wire:click="updateStatus('processing')"
                                class="btn btn-sm {{ $viewOrder->status === 'processing' ? 'btn-info' : 'btn-outline-info' }}">Processing</button>
                            <button wire:click="updateStatus('completed')"
                                class="btn btn-sm {{ $viewOrder->status === 'completed' ? 'btn-success' : 'btn-outline-success' }}">Completed</button>
                            <button wire:click="updateStatus('cancelled')"
                                class="btn btn-sm {{ $viewOrder->status === 'cancelled' ? 'btn-danger' : 'btn-outline-danger' }}">Cancelled</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>